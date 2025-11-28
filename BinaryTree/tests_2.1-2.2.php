<?php
require_once "AVLTree.php";

//2.1 Pārbauda LL rotāciju
echo "TESTS 2.1: \n";
$tree = new AVLTree();
echo "adding 30:\n";
$tree->insert(30);
$tree->display();
echo "\nadding 20\n";
$tree->insert(20);
$tree->display();
echo "\nadding 10\n";
$tree->insert(10);
$tree->display();

//2.2 Pārbauda RR rotāciju
echo "\nTESTS 2.2: \n";
$tree2 = new AVLTree();
echo "adding 10:\n";
$tree2->insert(10);
$tree2->display();
echo "\nadding 20\n";
$tree2->insert(20);
$tree2->display();
echo "\nadding 30\n";
$tree2->insert(30);
$tree2->display();

//2.3 Pārbauda LR rotāciju
echo "\nTESTS 2.3: \n";
$tree3 = new AVLTree();
echo "adding 30:\n";
$tree3->insert(30);
$tree3->display();
echo "\nadding 10\n";
$tree3->insert(10);
$tree3->display();
echo "\nadding 20\n";
$tree3->insert(20);
$tree3->display();

//2.4 Pārbauda RL rotāciju
echo "\nTESTS 2.4: \n";
$tree4 = new AVLTree();
echo "adding 10:\n";
$tree4->insert(10);
$tree4->display();
echo "\nadding 30\n";
$tree4->insert(30);
$tree4->display();
echo "\nadding 20\n";
$tree4->insert(20);
$tree4->display();