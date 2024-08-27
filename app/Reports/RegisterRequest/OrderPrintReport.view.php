<?php 
    use \koolreport\widgets\koolphp\Table;
    use \koolreport\widgets\google\BarChart;
?>

<div class="text-center">
    <h1>Registration Request Order</h1>
    <h4>View of request</h4>
</div>
<hr/>

<?php
Table::create(array(
    "dataStore"=>$this->dataStore('order_print_report'),
        "columns"=>array(
            "regname"=>array(
                "label"=>"Registrant Name",
            ),
           
        ),
    "cssClass"=>array(
        "table"=>"table table-hover table-bordered"
    )
));
?>