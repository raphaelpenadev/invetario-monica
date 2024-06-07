<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Inventario;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\search\InventarioSearch;

/**
 * InventarioController implements the CRUD actions for Inventario model.
 */
class InventarioController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Inventario models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new InventarioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $teste = '';

        $valorTotal = 0;

        $registrosProdutos = Inventario::find()->all();

        if (count($registrosProdutos) != 0) {
            $teste .= '<ul>';

            foreach ($registrosProdutos as $registro) {
                $teste .= '<li>' . $registro->nome . ' ( ' . $registro->quantidade . ' ) ' . '</li>';
            }

            $teste .= '</ul>';
        }

        foreach ($registrosProdutos as $registro) {
            $valorTotal += $registro->valor_unitario * $registro->quantidade;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'valorTotal' => $valorTotal,
            'teste' => $teste
        ]);
    }

    /**
     * Displays a single Inventario model.
     * @param int $idproduto Idproduto
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idproduto)
    {
        return $this->render('view', [
            'model' => $this->findModel($idproduto),
        ]);
    }

    /**
     * Creates a new Inventario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Inventario();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->data_cadastro = date('Y-m-d');
                if ($model->save()) {
                    return $this->redirect(['view', 'idproduto' => $model->idproduto]);
                } else {
                    Yii::$app->session->setFlash('error', 'O produto não foi registrado');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Inventario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idproduto Idproduto
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idproduto)
    {
        $model = $this->findModel($idproduto);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idproduto' => $model->idproduto]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Inventario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idproduto Idproduto
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idproduto)
    {
        $this->findModel($idproduto)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Inventario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idproduto Idproduto
     * @return Inventario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idproduto)
    {
        if (($model = Inventario::findOne(['idproduto' => $idproduto])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
