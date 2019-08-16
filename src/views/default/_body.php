<?php foreach ($products as $product): ?>
    <?php $model = $basket->getOffer($product['id'], (string)$tableName); ?>
    <tr>
        <?php foreach ($model as $column => $value): ?>
            <td><?php echo $value; ?></td>
        <?php endforeach; ?>
        <td>
            <?php echo yii\helpers\Html::a('Delete', ['default/delete'], [
                'class' => 'btn  btn-primary',
                'data' => [
                    'method' => 'post',
                    'params' => [
                        'id' => $product['id'],
                        'tableName' => $tableName
                    ]
                ]
            ]); ?>   
        </td>
    </tr>
<?php endforeach; ?>   

