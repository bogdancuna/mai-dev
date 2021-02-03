<?php

namespace frontend\controllers;

use Yii;
use app\models\Ordonatori;
use frontend\models\OrdonatoriSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

/**
 * OrdonatoriController implements the CRUD actions for Ordonatori model.
 */
class OrdonatoriController extends Controller
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
     * Lists all Ordonatori models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->can('admin')) {
            throw new ForbiddenHttpException('Nu aveți permisiuni să accesați această pagină!');    
        }

        $searchModel = new OrdonatoriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);        
    }

    /**
     * Displays a single Ordonatori model.
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
     * Creates a new Ordonatori model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can('admin')) {
            throw new ForbiddenHttpException('Nu aveți permisiuni să accesați această pagină!');    
        }

        $model = new Ordonatori();
        $oldModel = new Ordonatori();

        if ($model->load(Yii::$app->request->post())) {

            $model->save();

            /*-----ADAUGARE IN LOG-----*/
            date_default_timezone_set("Europe/Bucharest");           
            $datetime = date("Y-m-d H:i:s");
            $changes = $this->compare_models($oldModel, $model);
            $ip = Yii::$app->getRequest()->getUserIP();
            Yii::$app->db->createCommand('INSERT INTO log(id_user_log, action_log, tabela_log, id_model_log, changes_log, data_log, ip_log) VALUES ('.Yii::$app->user->identity->id.',"ADĂUGARE", "ORDONATORI", "'.$model->id.'", "'.$changes.'","'.$datetime.'","'.$ip.'");')->execute();

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ordonatori model.
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

            $model->save();

            /*-----ADAUGARE IN LOG-----*/
            date_default_timezone_set("Europe/Bucharest");           
            $datetime = date("Y-m-d H:i:s");
            $changes = $this->compare_models($oldModel, $model);
            $ip = Yii::$app->getRequest()->getUserIP();
            Yii::$app->db->createCommand('INSERT INTO log(id_user_log, action_log, tabela_log, id_model_log, changes_log, data_log, ip_log) VALUES ('.Yii::$app->user->identity->id.',"MODIFICARE", "ORDONATORI", "'.$id.'", "'.$changes.'","'.$datetime.'","'.$ip.'");')->execute();

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Ordonatori model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->can('admin')) {
            throw new ForbiddenHttpException('Nu aveți permisiuni să accesați această pagină!');    
        }

        $this->findModel($id)->delete();

        /*-----ADAUGARE IN LOG-----*/
        date_default_timezone_set("Europe/Bucharest");           
        $datetime = date("Y-m-d H:i:s");
        $ip = Yii::$app->getRequest()->getUserIP();
        Yii::$app->db->createCommand('INSERT INTO log(id_user_log, action_log, tabela_log, id_model_log, data_log, ip_log) VALUES ('.Yii::$app->user->identity->id.',"ȘTERGERE", "ORDONATORI", "'.$id.'","'.$datetime.'","'.$ip.'");')->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ordonatori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ordonatori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if(!Yii::$app->user->can('admin')) {
            throw new ForbiddenHttpException('Nu aveți permisiuni să accesați această pagină!');    
        }

        if (($model = Ordonatori::findOne($id)) !== null) {
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
                    if($key == 'id_parinte_ord')
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
