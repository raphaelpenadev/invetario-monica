<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Inventario $model */

$this->title = 'Atualizar Produto: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Inventário', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Produto: ' . $model->nome, 'url' => ['view', 'idproduto' => $model->idproduto]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="inventario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>