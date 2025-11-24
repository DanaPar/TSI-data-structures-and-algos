<?php
require_once "LinkedList.php";

class HashTable{
    private $dayOfWeek; // dzimšanas dienas nedēļas dienas numurs (1 līdz 7);
    private $maxSize; // tabulas elementu maximālais daudzums
    private $size; // tabulas esošais lielums
    private $buckets; //'spaiņi' datu glabāšanai
    public function __construct($dayOfWeek){
        //pārbauda vai ievadīts dienas numurs korekti
        if ($dayOfWeek < 0 || $dayOfWeek > 7) {
            echo "Dienas numuram jābūt no 1 līdz 7\n";
        }

        $this->dayOfWeek = $dayOfWeek;
        $this->maxSize = 1000;
        $this->size = 0;
        $this->buckets = [];
    }

    private function hash($key){
        //pārbauda vai atslēga ir ievadīta kā skaitlis
        if(!is_int($key)){
            echo"Atslēgai jābūt veselam skaitlim!\n";
            return null;
        }
        return $key % ($this->dayOfWeek + 3);
    }

    //pievieno elementu pēc atslēgas
    public function add($key, $data){
        if ($this->size >= $this->maxSize) {
            echo "Haštabula ir pilna!\n";
            return;
        }
        //aprēķina 'spaiņa indeksu'
        $index = $this->hash($key);

        //pārbauda vai hash izdevās
        if($index === null){
            return;
        }
        //ja 'spainis' neeksistē, tiek izveidots jauns saistītais saraksta
        if (!isset($this->buckets[$index])) {
            $this->buckets[$index] = new LinkedList();
        }
        //pārbauda vai atslēga jau eksistē
        $existing = $this-> buckets[$index]->find($key);
        $this->buckets[$index]->append($key, $data);
        //palielina skaitu, ja atslēga ir jauna
        if($existing  === null) {
            $this->size++;
        }
    }

    //atrod elementu pēc atslēgas
    public function find($key) {
        $index = $this->hash($key);
        //pārbauda vai hash izdevās
        if($index === null){
            return null;
        }

        if (!isset($this->buckets[$index])) {
            echo "Spainis atslēgai $key neeksistē, atslēgas nav!\n";
            return null;
        }

        $result =  $this->buckets[$index]->find($key);

        if($result === null){
            echo "Atslēga $key nav atrasta!\n";
        }

        return $result;
    }

    public function delete($key){
        $index = $this->hash($key);

        //pārbauda vai 'spainis' eksistē, ja nē atslēgas nav
        if(!isset($this->buckets[$index])){
            echo "Spainis atslēgai $key neeksistē, atslēgas nav!\n";
            return;
        }
        //pārbauda vai atslēga eksistē
        $existing = $this-> buckets[$index]->find($key);
        if($existing === null){
            echo "Atslēga $key nav atrasta!\n";
            return;
        }

        //izdzēš elementu no saistītā saraksta un samazina skaitu tabulā
        $this->buckets[$index]->delete($key);
        $this->size--;
    }

    //izvada uz ekrāna visu tabulu
    public function display(){
        echo "HashTable size: ".$this->size . "\n";
        foreach ($this->buckets as $index => $linkedList) {
            if($linkedList->head !== null) {
                echo "Bucket $index: ";
                $linkedList->display();
                echo "\n";
            }
        }
    }
}