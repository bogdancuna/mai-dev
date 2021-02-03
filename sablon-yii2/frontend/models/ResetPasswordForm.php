<?php
namespace frontend\models;

use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password_hash;
    public $username;
    /**
     * @var \common\models\User
     */
    private $_user;

    public $password_hash1;
    public $old_password;
    /**
     * @var \common\models\User
     */


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        /*if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('Wrong password reset token.');
        }
        parent::__construct($config);*/
    }

    /**
     * {@inheritdoc}
     */
     public function rules()
    {
       
        return [
            ['password_hash', 'required', 'message' => 'Câmpul este obligatoriu!'],
            ['password_hash', 'string', 'min' => 6, 'tooShort' => 'Parola nouă trebuie să conțină minim 6 caractere!'],
            ['password_hash1', 'required', 'message' => 'Câmpul este obligatoriu!'],
            ['password_hash1', 'string', 'min' => 6, 'tooShort' => 'Parola nouă trebuie să conțină minim 6 caractere!'],
            ['username', 'required', 'message' => 'Câmpul este obligatoriu!'],
            ['username', 'string'],
            ['old_password', 'required', 'message' => 'Câmpul este obligatoriu!'],
            ['old_password', 'string', 'min' => 6, 'tooShort' => 'Parola veche trebuie să conțină minim 6 caractere!'],
        ];

        

    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
     public function resetPassword()
    {

        $model->password_hash = Yii::$app->security->generatePasswordHash($this->password_hash);

        return $model->save(false);
    }
}
