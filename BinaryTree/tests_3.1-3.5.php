<?php
require_once "AVLTree.php";

// --- EDGE CASES TESTI--- //

//3.1 Pārbauda monotoniski augošu secību
echo "TESTS 3.1: \n";
$tree = new AVLTree();
$elements = [1, 2, 3, 4, 5];

foreach ($elements as $element) {
    echo "adding $element:\n";
    $tree->insert($element);
    $tree->display();
}

//3.2 Pārbauda monotoniski dilstošu secību
echo "\nTESTS 3.2: \n";
$tree2 = new AVLTree();
$elements2 = [5, 4, 3, 2, 1];

foreach ($elements2 as $element) {
    echo "adding $element:\n";
    $tree2->insert($element);
    $tree2->display();
}

//3.3 Pārbauda dublikātu ignorēšanu
echo "\nTESTS 3.3: \n";
$tree3 = new AVLTree();
$elements3 = [10, 20, 10, 20, 30];
foreach ($elements3 as $element) {
    $tree3->insert($element);
}
$tree3->display();

//3.4 Pārbauda kas notiek, ja koks tukšs
echo "\nTESTS 3.4: \n";
$tree4 = new AVLTree();
echo "adding 10:\n";
$tree4->insert(10);
$tree4->display();
echo "deleting 10: \n";
$tree4->delete(10);
$tree4->display();
echo "\n";

//3.5. Pārbauda, kas notiek ja lietotājs ievada burtus nevis skaitļus
echo "\nTESTS 3.5: \n";
$tree5 = new AVLTree();$elements5 = ["A", "C", "B"];
foreach ($elements5 as $element) {
    echo "\nadding $element:\n";
    $tree5->insert($element);
    $tree5->display();
}