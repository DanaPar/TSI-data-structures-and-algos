<?php
require_once 'HashTable.php';

// ------    add() TESTI ----------

//1.Tiek pievienoti elementi dažādos spaiņos
echo "\nTEST 1\n";
$table1 = new HashTable(1);
$table1->add(1, 12);
$table1->add(2, 99);
$table1->add(3, 89);
$table1->add(4, 79);
$table1->display();

//2.Tiek pievienoti elementi ar kolīziju
echo "\nTEST 2\n";
$table2 = new HashTable(2);
$table2->add(1, 12);
$table2->add(2, 99);
$table2->add(3, 89);
$table2->add(6, 79);
$table2->add(7, 100);
$table2->add(96, 50);
$table2->display();

//3.Tiek pievienots elements kā atslēgu norādot teksta virkni
echo "\nTEST 3\n";
$table3 = new HashTable(5);
$table3->add("key", 4);
$table3->display();

//4.Tiek pievienots elements ar jau eksistējošu atslēgu (elementa vērtība tiek pārrakstīta)
echo "\nTEST 4\n";
$table4 = new HashTable(3);
$table4->add(1, 4);
$table4->add(2, 12);
$table4->add(3, 99);
$table4->add(2, 56);
$table4->display();

//5.Tiek pievienoti vairāk nekā 1000 elementi
echo "\nTEST 5\n";
$table = new HashTable(1);
for ($i = 0; $i < 1002; $i++) {
    $table->add($i, $i+2);
}
$table->display();

// ------    find() TESTI ----------

//6.Tiek meklēts elements pēc atslēgas ar elementiem dažādos spaiņos
echo "\nTEST 6\n";
$table6 = new HashTable(1);
$table6->add(1, 12);
$table6->add(2, 99);
$table6->add(3, 89);
$table6->add(4, 79);
echo $table6->find(3) . "\n";

//7.Tiek meklēts elements pēc atslēgas ar kolīziju
echo "\nTEST 7\n";
$table7 = new HashTable(2);
$table7->add(1, 12);
$table7->add(2, 99);
$table7->add(3, 89);
$table7->add(6, 79);
$table7->add(7, 100);
$table7->add(96, 50);
echo $table7->find(6) . "\n";

//8.Tiek meklēta neeksistējoša atslēga (eksistējošā spainī)
echo "\nTEST 8\n";
$table8 = new HashTable(1);
$table8->add(1, 12);
$table8->add(2, 99);
$table8->add(3, 89);
$table8->add(4, 79);
echo $table8->find(6);

//9.Tiek meklēta neeksistējoša atslēga (neeksitējošā spainī)
echo "\nTEST 9\n";
$table9 = new HashTable(7);
$table9->add(1, 12);
$table9->add(2, 99);
$table9->add(3, 89);
$table9->add(4, 79);
echo $table9->find(9);

// ------    delete() TESTI ----------

//10.Tiek dzēsts elements pēc atslēgas ar elementiem dažādos spaiņos
echo "\nTEST 10\n";
$table10 = new HashTable(1);
$table10->add(1, 12);
$table10->add(2, 99);
$table10->add(3, 89);
$table10->add(4, 79);
$table10->delete(3);
$table10->display();

//11.tiek dzēsts elements pēc atslēgas ar kolīziju
echo "\nTEST 11\n";
$table11 = new HashTable(2);
$table11->add(1, 12);
$table11->add(2, 99);
$table11->add(3, 89);
$table11->add(6, 79);
$table11->add(7, 100);
$table11->add(96, 50);
$table11->delete(6);
$table11->display();

//12.Tiek dzēsta neeksistējoša atslēga (eksistējošā spainī)
echo "\nTEST 12\n";
$table12 = new HashTable(1);
$table12->add(1, 12);
$table12->add(2, 99);
$table12->add(3, 89);
$table12->add(4, 79);
$table12->delete(6);
$table12->display();

//13.Tiek dzēsta neeksistējoša atslēga (neeksitējošā spainī)
echo "\nTEST 13\n";
$table13 = new HashTable(7);
$table13->add(1, 12);
$table13->add(2, 99);
$table13->add(3, 89);
$table13->add(4, 79);
$table13->delete(9);
$table13->display();