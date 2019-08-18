<?php

namespace yahve89\basket;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
            '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
        ]);
    }
}
