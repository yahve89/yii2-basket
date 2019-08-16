<thead>
    <tr>
        <?php foreach ($columns as $column): ?>
            <th><?php echo $column; ?></th>   
        <?php endforeach ?>
        <th>Count (<?php echo count($products) ?>)</th>
    </tr>
</thead>