<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $id_ord;
    public $nume;
    public $telefon;
    public $privilegiu;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Câmpul este obligatoriu!'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Acest username este deja utilizat!'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Câmpul este obligatoriu!'],
            ['email', 'email', 'message' => 'Adresa de email nu este validă!'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Adresa de email este deja utilizată!'],

            ['password', 'required', 'message' => 'Câmpul este obligatoriu!'],
            ['password', 'string', 'min' => 6, 'tooShort' => 'Parola trebuie să conțină minim 6 caractere!'],

            ['id_ord', 'required', 'message' => 'Câmpul este obligatoriu!'],
            ['nume', 'required', 'message' => 'Câmpul este obligatoriu!'],
            ['privilegiu', 'required', 'message' => 'Câmpul este obligatoriu!'],
            ['telefon', 'safe'], 

        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->id_ord = $this->id_ord;
        $user->nume = $this->nume;
        $user->telefon = $this->telefon;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;

    }


}
