<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apple".
 *
 * @property int $id ID
 * @property string $color Цвет
 * @property string $seen_time Дата появления
 * @property string $fall_time Дата падения
 * @property string $status Статус 
 * @property int $eating_amount Сколько съели (%)
 */
class Apple extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color', 'seen_time', 'fall_time', 'status', 'eating_amount'], 'required'],
            [['seen_time', 'fall_time'], 'safe'],
            [['eating_amount'], 'integer'],
            [['color', 'status'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Цвет',
            'seen_time' => 'Дата появления',
            'fall_time' => 'Дата падения',
            'status' => 'Статус ',
            'eating_amount' => 'Сколько съели (%)',
        ];
    }
}
