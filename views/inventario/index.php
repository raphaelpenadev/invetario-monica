<?php

use app\models\Inventario;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\search\InventarioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Inventário';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventario-index">

    <h1 class='text-center'><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Novo Item', ['create'], ['class' => 'btn btn-success w-100']) ?>

    </p>
    <h4>
        <?php if ($teste == '' || $teste == null) : ?>
            <b>Valor total dos produtos:</b> <span id="badge-to-change" class="badge">R$ <?= number_format($valorTotal, 2, ',', '.') ?></span>
        <?php else : ?>
            <b>Valor total dos produtos:</b> <span id="badge-to-change" class="badge" , data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?= $teste ?>" data-bs-html="true">R$ <?= number_format($valorTotal, 2, ',', '.') ?></span>
        <?php endif; ?>

    </h4>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'idproduto',
            'nome',
            'descricao',
            'quantidade',
            [
                'label' => 'Valor Unitário',
                'attribute' => 'valor_unitario',
                'value' => function ($model) {
                    return 'R$ ' . number_format($model->valor_unitario, 2, ',', '.');
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="d-flex justify-content-around">{view}{update}{delete}</div>',
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idproduto' => $model->idproduto]);
                },
                'buttons' => [
                    'view' =>  function ($url) {
                        return Html::a(\kartik\icons\Icon::show('eye'), $url, [
                            'title' => Yii::t('yii', 'View'),
                            'class' => 'text-success mr-1'
                        ]);
                    },
                    'update' =>  function ($url) {
                        return Html::a(\kartik\icons\Icon::show('pencil-alt'), $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'class' => 'text-primary mr-1'
                        ]);
                    },
                    'delete' => function ($url) {
                        return Html::a(\kartik\icons\Icon::show('trash'), $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'class' => 'text-danger',
                            'data-confirm' => Yii::t('yii', 'Tem certeza que deseja excluir esse registro?'),
                            'data-method' => 'post',
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

<?php
$this->registerJs(<<<JS
let valueSpy = $valorTotal;
let badge = $('#badge-to-change');

if(valueSpy == 0) {
    badge.addClass('bg-warning');
} else {
    badge.addClass('bg-success');
}
JS)
?>