<?php 
namespace yahve89\basket\widgets;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;


class Offers extends Widget
{
    public $tableName;

    public function init()
    {
        parent::init();

        if ($this->tableName === null)
            throw new Exception('Bad Request', 400, null); 
    }

    public function run()
    {
        $model = new $this->tableName;  
        $query = $model::find();
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
        $model = new $this->tableName;
        
        foreach ($model->getTableSchema()->columns as $column) {
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