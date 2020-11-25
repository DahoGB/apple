<?php


namespace app\models;


use yii\base\Model;
use yii\validators\NumberValidator;

class EatForm extends Model
{
    public $eating_amount;

    public function rules()
    {
        return [
            [['eating_amount'], 'integer', 'max' => 100, 'min' => 1],
            [['eating_amount'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'eating_amount' => 'Сколько яблок ты хочешь съесть? (%)'
        ];
    }


}