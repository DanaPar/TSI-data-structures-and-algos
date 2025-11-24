<?php
//Viens elements saistītajā sarakstā
class Node{
    public $data; //glabā datus
    public $next; //glabā norādi uz nākamo elementu

    public function __construct($data){
        $this->data = $data;
        $this->next = null;
    }
}

class LinkedList{
    public $head = null; //saraksta pirmais elements

    //Pievieno jaunu elementu saraksta beigās
    public function append($data){
        $newNode = new Node($data);

        //ja saraksts tukšs, elements kļūst par pirmo elementu
        if($this->head === null){
            $this->head = $newNode;
        } else {
            //tiek meklēts pēdējais elements
            $current = $this->head;
            while($current->next !== null){
                $current = $current->next;
            }
            //pēdējā elementa rādītājs norāda uz jauno elementu
            $current->next = $newNode;
        }
    }

    //funkcija, kas dzēš pirmo atrasto elementu pēc vērtības
    public function delete($data){
        $current = $this->head;
        $previous = null;

        //ja pirmais elements dzēšams
        if($current !== null && $current->data === $data) {
            $this->head = $current->next;
            unset($current);
            return;
        }

        //ja dzēšamais elements saraksta vidū/beigās
        while($current !== null && $current->data !== $data){
            $previous = $current;
            $current = $current->next;
        }

        //ja elements nav atrasts
        if ($current === null) {
            echo "Element $data not found!";
            return;
        }

        //ja elements atrasts dzēš un pārliek norādi
        $previous->next = $current->next;
        unset($current);
    }

    //izvada uz ekrāna saraksta elementus
    public function display() {
        $current = $this->head;
        while($current !== null) {
            echo $current->data;
            if($current->next !== null){
                echo ",";
            }
            $current = $current->next;
        }
    }

    //atgriež elementu skaitu sarakstā
    public function elementCount(): int{
        $count = 0;
        $current = $this->head;
        while($current !== null){
            $count++;
            $current = $current->next;
        }
        return $count;
    }
    //palīgfunkcija, atrod vidējo elementu sarakstā
    function findMiddle(){
        $count = $this->elementCount();
        if ($count === 0) {
            return null;
        }
        $middle = floor($count / 2);
        $current = $this->head;
        $i = 0;
        while($i < $middle){
            $current = $current->next;
            $i++;
        }
        return $current;
    }
}



function quickSort(LinkedList $list){
    //ja saraksts tukšs vai 1 elements
    if ($list->head === null || $list->head->next === null) {
        return $list;
    }

    $pivotNode = $list->findMiddle();
    $pivotData = $pivotNode->data;

    //tiek izveidoti jauni apakšsaraksti
    $left = new LinkedList();
    $right = new LinkedList();

    //sadala elementus pa apakšsarasktiem
    $current = $list->head;
    while($current !== null){
        if($current !== $pivotNode) { //izlaiž pašu pivotu
            if ($current->data < $pivotData) {
                $left->append($current->data);
            } else {
                $right->append($current->data);
            }
        }
        $current = $current->next;
    }

    //rekursīvi sašķiro
    $left = quickSort($left);
    $right = quickSort($right);

    //apakšaraksti tiek salikti kopā
    $result = new LinkedList();
    $current = $left->head;
    while($current !== null) {
        $result->append($current->data);
        $current = $current->next;
    }
    $result->append($pivotData);
    $current = $right->head;
    while($current !== null) {
        $result->append($current->data);
        $current = $current->next;
    }
    return $result;
}


//----TESTI-----

////Test 1
//$list = new LinkedList();
//$list->append(5);
//$list->append(3);
//$list->append(8);
//$list->append(4);
//$list->append(2);
//$sortedList = quickSort($list);
//echo "Test 1 \n";
//echo "Original: ";
//echo $list->display() . "\n";
//echo "Sorted: ";
//echo $sortedList->display() . "\n\n";

////Test 2
//$list2 = new LinkedList();
//$sortedList2 = quickSort($list2);
//echo "Test 2 \n";
//echo "Original: ";
//echo $list2->display() . "\n";
//echo "Sorted: ";
//echo $sortedList2->display() . "\n\n";

////Test 3
//$list3 = new LinkedList();
//$list3->append(7);
//$sortedList3 = quickSort($list3);
//echo "Test 3 \n";
//echo "Original: ";
//echo $list3->display() . "\n";
//echo "Sorted: ";
//echo $sortedList3->display() . "\n\n";

////Test 4
//$list4 = new LinkedList();
//$list4->append(1);
//$list4->append(2);
//$list4->append(3);
//$list4->append(4);
//$list4->append(5);
//$sortedList4 = quickSort($list4);
//echo "Test 4 \n";
//echo "Original: ";
//echo $list4->display() . "\n";
//echo "Sorted: ";
//echo $sortedList4->display() . "\n\n";

////Test 5
//$list5 = new LinkedList();
//$list5->append(5);
//$list5->append(4);
//$list5->append(3);
//$list5->append(2);
//$list5->append(1);
//$sortedList5 = quickSort($list5);
//echo "Test 5 \n";
//echo "Original: ";
//echo $list5->display() . "\n";
//echo "Sorted: ";
//echo $sortedList5->display() . "\n\n";

////Test 6
//$list6 = new LinkedList();
//$list6->append(3);
//$list6->append(3);
//$list6->append(3);
//$list6->append(3);
//$list6->append(3);
//$sortedList6 = quickSort($list6);
//echo "Test 6 \n";
//echo "Original: ";
//echo $list6->display() . "\n";
//echo "Sorted: ";
//echo $sortedList6->display() . "\n\n";

//// Test 7
//$list7 = new LinkedList();
//$list7->append(1);
//$list7->append(2);
//$list7->append(1);
//$list7->append(3);
//$list7->append(2);
//$sortedList7 = quickSort($list7);
//echo "Test 7 \n";
//echo "Original: ";
//echo $list7->display() . "\n";
//echo "Sorted: ";
//echo $sortedList7->display() . "\n\n";

////Test 8
//$list8 = new LinkedList();
//$list8->append(-5);
//$list8->append(0);
//$list8->append(3);
//$list8->append(-1);
//$list8->append(2);
//$sortedList8 = quickSort($list8);
//echo "Test 8 \n";
//echo "Original: ";
//echo $list8->display() . "\n";
//echo "Sorted: ";
//echo $sortedList8->display() . "\n\n";

////Test 9
//$list9 = new LinkedList();
//$list9->append(1000);
//$list9->append(1);
//$list9->append(50);
//$sortedList9 = quickSort($list9);
//echo "Test 9 \n";
//echo "Original: ";
//echo $list9->display() . "\n";
//echo "Sorted: ";
//echo $sortedList9->display() . "\n\n";

////Test 10
//$list10 = new LinkedList();
//$list10->append(3.1);
//$list10->append(1.5);
//$list10->append(2);
//$sortedList10 = quickSort($list10);
//echo "Test 10 \n";
//echo "Original: ";
//echo $list10->display() . "\n";
//echo "Sorted: ";
//echo $sortedList10->display() . "\n\n";




