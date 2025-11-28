<?php
require_once "AVLTree.php";

//--- PAMATFUNKCIJU TESTI --- //

//1.1. Standarta ievietošana (bez rotācijas)
echo "TESTS 1.1: \n";
$avlTree = new AVLTree();
$elements = [15, 10, 20, 5, 12, 17, 25];

foreach ($elements as $element) {
    $avlTree->insert($element);
}
$avlTree->display();

//1.2 Lapas mezgla dzēšana 0 child
echo "\nTESTS 1.2: \n";
$avlTree->delete(5);
$avlTree->display();

//1.3 Elementa ar vienu child dzēšana
echo "\nTESTS 1.3: \n";
$avlTree->delete(10);
$avlTree->display();

//1.4 Elementa ar diviem child dzēšana
echo "\nTESTS 1.4: \n";
$avlTree->delete(20);
$avlTree->display();

//1.7 Saknes dzēšana
echo "\nTESTS 1.4: \n";
$avlTree->delete(15);
$avlTree->display();