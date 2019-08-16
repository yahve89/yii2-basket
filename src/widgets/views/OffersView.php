<?= yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => array_merge($columns, [    
        [
            'class' => 'yii\grid\CheckboxColumn',
            'checkboxOptions' => function($model, $id) use ($tableName){
                return [
                    'checked' => yahve89\basket\widgets\Offers::isCheck($id, $tableName),
                    'id' => $tableName,
                    'onchange' => '$.post(
                        "' .yii\helpers\Url::to(['/basket/default/change-to-basket']) .'", 
                        {  
                            id: $(this).val(), 
                            group: $(this).attr("id"), 
                        }
                    )'
                ];  
            }
        ]
    ])
]); ?>