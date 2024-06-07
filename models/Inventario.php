<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%inventario}}".
 *
 * @property int $idproduto
 * @property string $nome
 * @property string|null $descricao
 * @property int $quantidade
 * @property float $valor_unitario
 * @property string $data_cadastro
 */
class Inventario extends \yii\db\ActiveRecord
{

    public $valorUnitarioStr;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inventario}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'quantidade'], 'required'],
            [['quantidade'], 'integer'],
            [['valor_unitario'], 'number'],
            [['data_cadastro'], 'safe'],
            [['nome', 'descricao', 'valorUnitarioStr'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idproduto' => 'Idproduto',
            'nome' => 'Nome',
            'descricao' => 'Descrição',
            'quantidade' => 'Quantidade',
            'valor_unitario' => 'Valor Unitário',
            'data_cadastro' => 'Data de Cadastro',
            'valorUnitarioStr' => 'Valor Unitário',
        ];
    }
}
