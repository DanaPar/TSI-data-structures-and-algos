<?php
require_once 'HashTable.php';
require_once 'HashTable.php';


$table = new HashTable(1);
for ($i = 0; $i < 1002; $i++) {
    $table->add($i, $i+2);
}
$table->display();

