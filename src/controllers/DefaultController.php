<?php

namespace yahve89\basket\controllers;

use yahve89\basket\models\Basket;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `Basket` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $basket = new Basket;

        return $this->render('index', [
            'basket' => $basket,
        ]);
    }

    /**
     * Добавляет \ удаляет оферы в корзину
     */
    public function actionChangeToBasket()
    {
        $request = Yii::$app->request;
        $status = '';

        if (Yii::$app->request->isPost) {
            $group = $request->post('group');
            $id = $request->post('id');
            $session = Yii::$app->session;
            $session->open();

            if (!$session->has('basket')) {
                $session->set('basket', []);
                $basket = [];
            } else {
                $basket = $session->get('basket');
            }

            if (isset($basket['products'][$group][$id])) {
                unset($basket['products'][$group][$id]);
            } else {
                $basket['products'][$group][$id]['id'] = $id;
            }

            $session->set('basket', $basket);
            return;
        }

        throw new \Exception('Page not found', 404, null);
    }

    /**
     * метод Чистит корзину
     */
    public function actionDeleteAll()
    {
        if (Yii::$app->request->isPost) {
            $session = Yii::$app->session;
            $session->open();
            $session->set('basket', []);
        }

        return $this->redirect(['default/index']);
    }

    /**
     * метод Удаляет оферы из корзины
     */
    public function actionDelete()
    {
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $tableName = $request->post('tableName');
            $id = $request->post('id');
            $session = Yii::$app->session;
            $session->open();
            $basket = $session->get('basket');

            if (isset($basket['products'][$tableName][$id])) {
                unset($basket['products'][$tableName][$id]);
            }

            if (count($basket['products'][$tableName]) == 0) {
                unset($basket['products'][$tableName]);
            }

            $session->set('basket', $basket);
        }

        return $this->redirect(['default/index']);
    }
}
