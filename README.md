<p align="center">
    <h1 align="center">Yii 2 Виджет корзины с модулем - пример</h1>
    <br>
</p>

    ### Install

Either run

```
$ php composer.phar require yahve89/yii2-basket "@dev"
```

or add

```
"yahve89/yii2-basket": "@dev"
```

to the ```require``` section of your `composer.json` file.

## Usage
```php
<?php

use yahve89\basket\widgets\Offers;
use yii\helpers\Html;


$this->title = 'My Yii Application';

$js = <<< SCRIPT
$(function(){ 
    $("#myTab>li>a").click(function(e){
        e.preventDefault();
        $(this).tab('show');
    });
});
SCRIPT;
$this->registerJs($js);
?>
<div class="site-index">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#transport">Transport</a></li>
        <li><a href="#billboard">Billboard</a></li>
        <li><a href="#metro">Metro</a></li>
        <li class="pull-right">
            <b><?= Html::a('To basket', ['basket/default/index'], ['class' => 'btn btn-warning']) ?></b>
        </li>
    </ul>
    <div class="tab-content">
        <div id="transport" class="tab-pane fade in active">
            <?php echo Offers::widget([
                'tableName' => 'app\models\Transport'
            ]); ?>
        </div>
        <div id="billboard" class="tab-pane fade">
            <?php echo Offers::widget([
                'tableName' => 'app\models\Billboard'
            ]); ?>
        </div>
        <div id="metro" class="tab-pane fade">

            <?php echo Offers::widget([
                'tableName' => 'app\models\Metro'
            ]); ?>
        </div>
    </div>
</div>
```
