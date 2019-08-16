<?php

use yahve89\components\TreeWidget;
use yahve89\components\BrandsWidget;
use yii\helpers\Html;
use yii\helpers\Url;


$products = $basket->getBasket();
?>
<section>
    <div class="container">
        <h1>Basket</h1>
        <?php if (!empty($products)): ?>
            <table class="table table-bordered">
                <?php foreach ($products as $tableName => $products): ?>
                    <?php if (!empty($tableName)): ?>
                        <?php $columns = $basket->getColumns($tableName); ?>
                        <?php echo $this->render('_head', [
                            'columns' => $columns,
                            'products' => $products
                        ]); ?>
                        <?php echo $this->render('_body', [
                            'products' => $products,
                            'basket' => $basket,
                            'tableName' => $tableName
                        ]); ?>
                    <?php endif ?>
                <?php endforeach; ?>
            </table>
            <div class="text-right">
                <?php echo yii\helpers\Html::a('Delete all', ['default/delete-all'], [
                    'class' => 'btn  btn-primary',
                    'data' => [
                        'method' => 'post',
                        'params' => ['basket' => 'clear']
                    ]
                ]); ?>
            </div>
        <?php else: ?>
            <p>Ваша корзина пуста</p>
        <?php endif; ?>
    </div>
</section>