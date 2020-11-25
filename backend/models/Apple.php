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
 * @property float $size Размер
 */
class Apple extends \yii\db\ActiveRecord
{
    public const _status = [
        'in_tree' => 'На дереве',
        'in_earth' => 'Упало',
        'rotten' => 'Гнилое яблоко'
    ];

    public const status = [
        'in_tree' => 'in_tree',
        'in_earth' => 'in_earth',
        'rotten' => 'rotten'
    ];
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
            [['color', 'seen_time', 'status', 'eating_amount', 'size'], 'required'],
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
            'size' => 'Размер',
        ];
    }

    /**
     * Generates random date
     * @return false|string
     */
    private function randomDate(){
        $time = rand( 0, time() );
        return date("d-m-Y H:i:s", $time);
    }

    public function __construct($color = null)
    {
        $config = [
            'color' => $color,
            'status' => self::status['in_tree'],
            'eating_amount' => 0,
            'seen_time' => $this->randomDate(),
            'size' => 1
        ];
        parent::__construct($config);
    }


    /**
     * Eating apple
     * @param int $amount
     * @return \Error
     */
    public function eat(int $amount){
        if ($this->status === self::status['in_tree'])
            return new \Error('Ты не можешь есть это яблоко. Потому что это на дереве.');

        if ($this->status === self::status['rotten'])
            return new \Error('Ты не можешь есть это яблоко. Потому что он гнилой.');

        $this->eating_amount = $this->eating_amount + $amount;
        if ($this->eating_amount > 100)
            $this->eating_amount = 100;

        $this->size = (100 - $this->eating_amount) / 100;

        $this->save();
    }

    public function fallToGround(){
        if ($this->status === self::status['in_earth'])
            return new \Exception('Это яблоко уже на земле.');

        if ($this->status === self::status['rotten'])
            return new \Exception('Это яблоко уже гнилое.');

        $this->status = self::status['in_earth'];
        $this->fall_time = date("d-m-Y H:i:s", time());
    }




}
