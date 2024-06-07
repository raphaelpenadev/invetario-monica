<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Inventario $model */

$this->title = 'Produto: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Inventário', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="inventario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'idproduto' => $model->idproduto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Remover', ['delete', 'idproduto' => $model->idproduto], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idproduto',
            'nome',
            'descricao',
            'quantidade',
            [
                'label' => 'Valor Unitário',
                'attribute' => 'valor_unitario',
                'value' => 'R$ ' . number_format($model->valor_unitario, 2, ',', '.'),
            ],
            'data_cadastro:date',
        ],
    ]) ?>

</div>