<?php

/* @var $this yii\web\View */

use app\models\Apple;
use app\models\EatForm;
use yii\bootstrap\Button;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Управление яблоками';

/* @var $apple Apple */
/* @var $model EatForm */




$form = ActiveForm::begin([
    'id' => 'eat-form',
    'fieldConfig' => [
        'template' => "{label}\n{input}\n{hint}\n{error}",

    ],
]) ?>
<?= $form->field($model, 'eating_amount') ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
