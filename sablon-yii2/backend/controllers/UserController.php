<?php

namespace backend\controllers;

use Yii;
use backend\models\Ordonatori;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->can('admin')) {
            throw new ForbiddenHttpException('Nu aveți permisiuni să accesați această pagină!');    
        }

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(!Yii::$app->user->can('admin')) {
            throw new ForbiddenHttpException('Nu aveți permisiuni să accesați această pagină!');    
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new User();
    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->can('admin')) {
            throw new ForbiddenHttpException('Nu aveți permisiuni să accesați această pagină!');    
        }

        $model = $this->findModel($id);
        $oldModel = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $post = Yii::$app->request->post();     
            $privilegiu = isset($post['privilegiu']) ?  $post['privilegiu'] : '';

            Yii::$app->db->createCommand("delete from auth_assignment where user_id =".$id)->execute();
            
            if($privilegiu)
            {
                Yii::$app->db->createCommand('INSERT INTO `auth_assignment` (`item_name`, `user_id`) VALUES (\''.$privilegiu.'\','.$id.')')->execute();
            }

            $model->save();

            /*-----ADAUGARE IN LOG-----*/
            $ip = Yii::$app->getRequest()->getUserIP();
            date_default_timezone_set("Europe/Bucharest");           
            $datetime = date("Y-m-d H:i:s");
            $changes = $this->compare_models($oldModel, $model);
            Yii::$app->db->createCommand('INSERT INTO log(id_user_log, action_log, tabela_log, id_model_log, changes_log, data_log, ip_log) VALUES ('.Yii::$app->user->identity->id.',"MODIFICARE", "UTILIZATOR", "'.$model->id.'", "'.$changes.'","'.$datetime.'","'.$ip.'");')->execute();

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdate2($id, $act) //pentru activeaza/dezactiveaza user   act=1 => dezactiveaza; act=2 => activeaza.
    {
        if(!Yii::$app->user->can('admin')) {
            throw new ForbiddenHttpException('Nu aveți permisiuni să accesați această pagină!');    
        }

        $model = $this->findModel($id);
        $actiune_log = '';

        if($act == 1) //dezactiveaza
        {
            $model->status = 9;
            $actiune_log = 'DEZACTIVARE UTILIZATOR';
            
        }
        elseif($act == 2) //activeaza
        {
            $model->status = 10;
            $actiune_log = 'ACTIVARE UTILIZATOR';
        }

        $model->save();

        /*-----ADAUGARE IN LOG-----*/
        $ip = Yii::$app->getRequest()->getUserIP();
        date_default_timezone_set("Europe/Bucharest");           
        $datetime = date("Y-m-d H:i:s");
        Yii::$app->db->createCommand('INSERT INTO log(id_user_log, action_log, tabela_log, id_model_log, data_log, ip_log) VALUES ('.Yii::$app->user->identity->id.',"'.$actiune_log.'", "UTILIZATOR", "'.$id.'","'.$datetime.'","'.$ip.'");')->execute();

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {   
        if(!Yii::$app->user->can('admin')) {
            throw new ForbiddenHttpException('Nu aveți permisiuni să accesați această pagină!');    
        }
        
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function compare_models($modelOld,$modelNew)
    {
        $diff ='';

        foreach($modelOld as $key=>$modelo)
        {
            $val1='';
            $val2='';
            (isset($modelOld->$key)) ? $val1 = $modelOld->$key : $val1='';
            (isset($modelNew[$key])) ? $val2 = $modelNew[$key] : $val2='';

            (is_array($val1)) ? $val1 = implode(",",$val1) : "";
            (is_array($val2)) ? $val2 = implode(",",$val2) : "";

            if($val1!=$val2)
            {
                if($val2!=NULL)
                {
                    if($key == 'id_ord')
                    {
                      $query1 = Ordonatori::find()->where(['id' => $val1])->one();
                      $val1   = $query1['denumire']; 

                      $query2 = Ordonatori::find()->where(['id' => $val2])->one();
                      $val2   = $query2['denumire']; 
                    }
                    
                    $diff.= "[".$modelOld->getAttributeLabel($key)."]: <font color='red'>".$val1."</font> => <font color='green'>".$val2."</font>  ";
                }
                
            }
        }

        return $diff;
    }

}
