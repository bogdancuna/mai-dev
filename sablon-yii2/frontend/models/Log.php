<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property int $id_log
 * @property int $id_user_log
 * @property string $action_log
 * @property string $tabela_log
 * @property int $id_model_log
 * @property string $changes_log
 * @property string $data_log
 *
 * @property User $userLog
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user_log', 'action_log', 'tabela_log', 'id_model_log', 'changes_log', 'data_log'], 'required'],
            [['id_user_log', 'id_model_log'], 'integer'],
            [['data_log','ip_log'], 'safe'],
            [['action_log', 'tabela_log'], 'string', 'max' => 50],
            [['changes_log'], 'string', 'max' => 1000],
            [['id_user_log'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user_log' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_log' => 'Id Log',
            'id_user_log' => 'Utilizator',
            'action_log' => 'Acțiune',
            'tabela_log' => 'Tabelă',
            'id_model_log' => 'Id Model',
            'changes_log' => 'Modificări',
            'data_log' => 'Data și ora',
            'ip_log' => 'IP',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLog()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user_log']);
    }
}
