<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ordonatori".
 *
 * @property int $id
 * @property string $denumire
 * @property int|null $tip_ord
 *
 * @property User[] $users
 */
class Ordonatori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordonatori';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denumire'], 'required', 'message' => 'Câmpul este obligatoriu!'],
            [['tip_ord'], 'integer'],
            [['denumire'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denumire' => 'Denumire',
            'tip_ord' => 'Tip Ord',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id_ord' => 'id']);
    }
}
