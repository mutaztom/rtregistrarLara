<?php
use koolreport\widgets\koolphp\Table;

?>
<html>
<head>    
<div class="text-center">
    <h1>Registration Request Order</h1>
    <h4>View of request</h4>
</div>
</head>
<body>
<?php
Table::create([
    'dataStore' => $this->dataStore('order_print_report'),
    'cssClass' => [
        'table' => 'table table-hover table-bordered',
    ],
]);
?>
</body>
</html>