<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string|null $nume
 * @property int|null $id_ord
 * @property string|null $telefon
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 *
 * @property Log[] $logs
 * @property Ordonatori $ord
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public $privilegiu;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'nume', 'id_ord'], 'required', 'message' => 'Câmpul este obligatoriu!'],
            [['id_ord', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['nume'], 'string', 'max' => 100],
            [['telefon'], 'string', 'max' => 20],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique', 'message' => 'Acest username este deja utilizat!'],
            [['email'], 'unique', 'message' => 'Adresa de email este deja utilizată!'],
            [['email'], 'email', 'message' => 'Adresa de email nu este validă!'],
            [['password_reset_token'], 'unique'],
            [['id_ord'], 'exist', 'skipOnError' => true, 'targetClass' => Ordonatori::className(), 'targetAttribute' => ['id_ord' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'nume' => 'Nume',
            'id_ord' => 'Id Ord',
            'telefon' => 'Telefon',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['id_user_log' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrd()
    {
        return $this->hasOne(Ordonatori::className(), ['id' => 'id_ord']);
    }
}
