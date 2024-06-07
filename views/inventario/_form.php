<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Inventario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="inventario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textArea(['rows' => 4, 'maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'quantidade')->input('number', ['min' => 0]) ?></div>
        <div class="col-md-6">
            <?= $form->field($model, 'valorUnitarioStr', [
                'template' => '{label}<div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="valorUnitarioAddon">R$</span>
                    </div>
                    {input}
                    {hint}
                    {error}
                </div>'
            ])->textInput([
                'maxlength' => true,
                'data-mask' => '#.##0,00',
                'data-mask-reverse' => 'true',
                'aria-describedby' => 'valorUnitarioAddon',
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'valor_unitario')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'data_cadastro')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$valorUnitario = Html::getInputId($model, 'valor_unitario');
$valorUnitarioStr = Html::getInputId($model, 'valorUnitarioStr');

$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js', ['depends' => 'app\assets\AppAsset']);

$this->registerJs(<<<JS
$("#$form->id").on('beforeSubmit', function () {

    $("#$valorUnitarioStr").unmask();

    var valUnitario = $("#$valorUnitarioStr").val();    

    if (valUnitario != null && valUnitario != '') {
        $("#$valorUnitario").val(
            parseFloat(valUnitario ?? 0) / 100
        );
    }

    return true;
});

JS);
