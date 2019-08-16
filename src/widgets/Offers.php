<?php 
namespace yahve89\basket\widgets;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;


class Offers extends Widget
{
    public $tableName;
    private $model;

    public function init()
    {
        parent::init();

        if ($this->tableName === null)
            throw new Exception('Bad Request', 400, null);

        if ($this->model === null)
            $this->model = new $this->tableName;   
    }

    public function run()
    {
        $query = $this->model::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('OffersView', [
            'dataProvider' => $dataProvider,
            'columns' => $this->getColums(),
            'tableName' => $this->tableName
        ]);
    }

    /**
     * Метод получает все колонки
     * @return array
     */
    private function getColums()
    {
        $columns = [];

        foreach ($this->model->getTableSchema()->columns as $column) {
            $columns[] = [
                'class' => 'yii\grid\DataColumn',
                'attribute' => $column->name,
            ];
        }
            
        return array_merge([['class' => 'yii\grid\SerialColumn']], $columns);
    }

    /**
     * Проверяет наличее позиции в корзине
     * @return bool
     */
    public static function isCheck($id, $tableName)
    {
        $session = \Yii::$app->session;
        $session->open();
        $basket = $session->get('basket');
        
        if (isset($basket['products'][$tableName][$id]))
            return true;

        return false;
    }
}