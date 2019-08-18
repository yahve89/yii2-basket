<?php

namespace yahve89\basket\models;

use Yii;
use yii\base\Model;

class Basket extends Model
{
    /**
     * Метод возвращает содержимое корзины
     * @return array
     */
    public function getBasket()
    {
        $session = Yii::$app->session;
        $session->open();
        if (!$session->has('basket')) {
            $session->set('basket', []);

            return [];
        } else {
            $products = $session->get('basket');

            if (!empty($products['products'])) {
                return $products['products'];
            }

            return [];
        }
    }

    /**
     * Метод получает офер
     * @return ActiveRecord
     */
    public function getOffer($id, $tableName)
    {
        $model = new $tableName;

        return $model::findOne($id);
    }

    /*
     * Метод возвращает все колонки из таблицы
     * @return array
     */
    public function getColumns($tableName)
    {
        $columns = [];
        $model = new $tableName;

        foreach ($model->getTableSchema()->columns as $column) {
            $columns[] = $model->getAttributeLabel($column->name);
        }

        return $columns;
    }
}
