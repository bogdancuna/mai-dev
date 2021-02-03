<?php
namespace backend\controllers;

use backend\models\ResendVerificationEmailForm;
use backend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use backend\models\SignupForm;
use backend\models\ContactForm;
use yii\web\ForbiddenHttpException;
use backend\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
           $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->redirect('?r=user');
            } 
           else {
                  return $this->render('login', [
                    'model' => $model,
                     ]);
                }
            }
        else{           
            return $this->redirect('?r=user');
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
      if(!Yii::$app->user->can('admin')) {
        throw new ForbiddenHttpException('Nu aveți permisiuni să accesați această pagină!');    
      }

      $model = new SignupForm();
      if ($model->load(Yii::$app->request->post())) {

          if ($user = $model->signup()) {
              Yii::$app->session->setFlash('success', 'Utilizator salvat cu succes.');
             
              if($model->privilegiu)
              {   
                  Yii::$app->db->createCommand('INSERT INTO `auth_assignment` (`item_name`, `user_id`) VALUES (\''.$model->privilegiu.'\','.$user->id.')')->execute();
              }
              
              /*-----ADAUGARE IN LOG-----*/
              $ip = Yii::$app->getRequest()->getUserIP();
              date_default_timezone_set("Europe/Bucharest");           
              $datetime = date("Y-m-d H:i:s");
              Yii::$app->db->createCommand('INSERT INTO log(id_user_log, action_log, tabela_log, id_model_log, data_log, ip_log) VALUES ('.Yii::$app->user->identity->id.',"ADĂUGARE", "UTILIZATOR", "'.$user->id.'", "'.$datetime.'","'.$ip.'");')->execute();              
              
              return $this->redirect(['user/index']);
          }
      }

      return $this->render('signup', [
          'model' => $model,
      ]);
    }


     /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword()
    {
      if(!Yii::$app->user->can('admin')) {
        throw new ForbiddenHttpException('Nu aveți permisiuni să accesați această pagină!');    
      }

      $token = 1;
      try {
          $model = new ResetPasswordForm($token);
      } catch (InvalidParamException $e) {
          throw new BadRequestHttpException($e->getMessage());
      }
      $model->load(Yii::$app->request->post());
      
      if($model->password_hash!='')
      {   

          $hash = Yii::$app->security->generatePasswordHash($model->password_hash);
          \Yii::$app->db->createCommand("UPDATE user SET password_hash=:v1 WHERE id=:id")
          ->bindValue(':id', $model->username)
          ->bindValue(':v1', $hash)
          ->execute();

          /*-----ADAUGARE IN LOG-----*/
          $ip = Yii::$app->getRequest()->getUserIP();
          date_default_timezone_set("Europe/Bucharest");           
          $datetime = date("Y-m-d H:i:s");
          $aux = User::find()->select('id')->where(['id' => $model->username])->one();
          Yii::$app->db->createCommand('INSERT INTO log(id_user_log, action_log, tabela_log, id_model_log, data_log, ip_log) VALUES ('.Yii::$app->user->identity->id.',"RESETARE PAROLA", "UTILIZATOR", "'.$aux->id.'","'.$datetime.'","'.$ip.'");')->execute();

          return $this->redirect(['user/index']);
      }
      else
          return $this->render('resetPassword', [
          'model' => $model,
      ]);
    
    }


     public function actionResetPasswordUser(){

            $token = 1;
            try {
              $model = new ResetPasswordForm($token);
          } catch (InvalidParamException $e) {
              throw new BadRequestHttpException($e->getMessage());
          }
          $model->load(Yii::$app->request->post());

          if($model->password_hash!='')
          {            
              $query1 = new \yii\db\Query;
              $query1->select('password_hash')
              ->from('user')
              ->where('id ='.Yii::$app->user->identity->id);

              $command = $query1->createCommand();
              $hash = $command->queryAll();  

              $hashdb = $hash[0]['password_hash'];

              $hashOK = Yii::$app->security->validatePassword($model->old_password,$hashdb);

              $password1 = $model->password_hash;
              $password2 = $model->password_hash1;



              if(!$hashOK)
              {
                return $this->render('resetPasswordUser', [
                  'model' => $model,
                  'hashError' => '1!',
              ]);
            }
            else if($password1!=$password2)
            {
             return $this->render('resetPasswordUser', [
                'model' => $model,
                'hashError' => '2',
            ]);

         }
         else
         {

             $hash = Yii::$app->security->generatePasswordHash($model->password_hash);
             \Yii::$app->db->createCommand("UPDATE user SET password_hash=:v1 WHERE id=:id")
             ->bindValue(':id', Yii::$app->user->identity->id)
             ->bindValue(':v1', $hash)
             ->execute();

            /*-----ADAUGARE IN LOG-----*/
            $ip = Yii::$app->getRequest()->getUserIP();
            date_default_timezone_set("Europe/Bucharest");           
            $datetime = date("Y-m-d H:i:s");
            Yii::$app->db->createCommand('INSERT INTO log(id_user_log, action_log, tabela_log, id_model_log, data_log, ip_log) VALUES ('.Yii::$app->user->identity->id.',"SCHIMBARE PAROLA", "UTILIZATOR", "'.Yii::$app->user->identity->id.'","'.$datetime.'","'.$ip.'");')->execute();

            $model->old_password = '';
            $model->password_hash = '';
            $model->password_hash1 = '';

             return $this->render('resetPasswordUser', [
                'model' => $model,
                'hashError' => '3',
            ]);
         }

        }
        else
            return $this->render('resetPasswordUser', [
              'model' => $model,
              'hashError' => '',
          ]);
        }

        

    
}
