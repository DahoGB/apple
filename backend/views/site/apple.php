<?php

/* @var $this yii\web\View */

use app\models\Apple;
use yii\bootstrap\Button;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\Html;

$this->title = 'Управление яблоками';
$query = Apple::find();
$dataProvider = new ActiveDataProvider([
        'query' => $query,

]);

$columns = [
    'id',
    'color',
    'seen_time',
    'status',
    'eating_amount',
    'size',
    [
        'class' => ActionColumn::class,
        'template' => '{eat}{fall}',
        'header' => 'Управление яблоками',
        'buttons' => [
            'eat' => function ($url, $model, $key) {
                         return Html::a(HTML::tag('i', '', [
                             'class' => 'glyphicon glyphicon-cutlery',
                             'title' => 'Съесть яблоко',
                         ]),
                             '/backend/web/index.php?r=site/eat', [
                             'class' => 'btn btn-primary',


                         ]);
                     },
            'fall' => function ($url, $model, $key) {
                return Html::a(HTML::tag('i', '', [
                    'class' => 'glyphicon glyphicon-tree-deciduous',
                    'title' => 'Бросьте яблоко на землю',
                ]),
                    '/backend/web/index.php?r=site/eat', [
                        'class' => 'btn btn-primary',


                    ]);
            },
        ]
    ],
];

echo \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => $columns
]);
