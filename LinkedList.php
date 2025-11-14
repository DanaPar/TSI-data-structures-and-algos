<?php
//Viens elements saistītajā sarakstā
class Node{
    public $key; //glabā atslēgu
    public $data; //glabā datus
    public $next; //glabā norādi uz nākamo elementu

    public function __construct($key, $data){
        $this->key = $key;
        $this->data = $data;
        $this->next = null;
    }
}

class LinkedList{
    public $head = null; //saraksta pirmais elements

    //Pievieno jaunu elementu saraksta beigās
    public function append($key, $data){
        //ja atslēga eksistē, tad pārraksta vērtību
        $current = $this->head;
        while($current !== null){
            if($current->key === $key){
                $current->data = $data;
                return;
            }
            $current = $current->next;
        }

        $newNode = new Node($key, $data);

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
    public function delete($key){
        $current = $this->head;
        $previous = null;

        //ja pirmais elements dzēšams
        if($current !== null && $current->key === $key) {
            $this->head = $current->next;
            unset($current);
            return;
        }

        //ja dzēšamais elements saraksta vidū/beigās
        while($current !== null && $current->key !== $key){
            $previous = $current;
            $current = $current->next;
        }

        //ja elements nav atrasts
        if ($current === null) {
            echo "Atslēga $key nav atrasta!\n";
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
    //atrod elemnut pēc atslēgas
    public function find($key){
        $current = $this->head;
        while($current !== null) {
            if($current->key === $key){
                return $current->data; //atgriež vērtību
            }
            $current = $current->next;
        }
        //ja vērtība nav atrasta
        return null;
    }
}
