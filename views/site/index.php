<?php

use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'Gerenciador';
?>
<div class="site-index">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Produtos</h2>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Produtos Cadastrados</h5>

                    <?= Html::a('Ver', 'inventario', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div> -->
    </div>
</div>