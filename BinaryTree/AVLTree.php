<?php

class Node {
    public $data;
    public $right;
    public $left;
    public $height;

    public function __construct($data) {
        $this->data = $data;
        $this->right = null;
        $this->left = null;
        $this->height = 1; //jaunie mezgli ir "lapas", tātad augstums 1
    }
}

class AVLTree {
    public $root;

    public function __construct() {
        $this->root = null;
    }

    // ---- PALĪGFUNKCIJAS ----//
    //atgriež augstumu
    private function getHeight($node) {
        if ($node == null) {
            return 0;
        } else {
            return $node->height;
        }
    }

    //atjauno mezgla augstumu atkarībā no tā child-mezglu augstumiem
    private function updateHeight($node) {
        $node->height = 1 + max($this->getHeight($node->left), $this->getHeight($node->right));
    }

    //aprēķina vai koks balansā (kreisais augstums - labais augstums)
    private function getBalance($node) {
        if ($node === null) {
            return 0;
        } else {
            return $this->getHeight($node->left) - $this->getHeight($node->right);
        }
    }

    // --- ROTĀCIJAS METODES --- //

    //veic kreiso rotāciju mezglam Z
    private function rotateLeft($z) {
        $y = $z->right;
        $T2 = $y->left;
        //veic pagriezienu
        $y->left = $z;
        $z->right = $T2;
        //atjauno augstumus (no apakšas uz augšu)
        $this->updateHeight($z);
        $this->updateHeight($y);

        return $y;
    }

    //veica labo rotāciju mezglam Z
    private function rotateRight($z) {
        $y = $z->left;
        $T2 = $y->right;
        //veic pagriezienu
        $y->right = $z;
        $z->left = $T2;
        //atjauno augsutmus (no apakšas uz augšu)
        $this->updateHeight($z);
        $this->updateHeight($y);

        return $y;
    }

    // pārbalansē mezglu pēc ievietošanas/dzēšanas atkarībā no balansa
    private function balance ($node) {
        //vienmēr jāatjauno augstumu pirms balansa pārbaudīšanas
        $this->updateHeight($node);
        $balance = $this->getBalance($node);

        //Labais pagrieziens (LL)
        if ($balance > 1 && $this->getBalance($node->left) >= 0) {
            return $this->rotateRight($node);
        }
        //Kreisais pagrieziens (RR)
        if ($balance < -1 && $this->getBalance($node->right) <= 0) {
            return $this->rotateLeft($node);
        }
        //Kreisais-labais pagrieziens (LR)
        if ($balance > 1 && $this->getBalance($node->left) < 0) {
            //pagrieziens pa kreisi pie child
            $node->left = $this->rotateLeft($node->left);
            //pagrieziens pa labi pie root
            return $this->rotateRight($node);
        }
        //Labais-Kreisais pagrieziens (RL)
        if ($balance < -1 && $this->getBalance($node->right) > 0) {
            //pagrieziens pa labi pie child
            $node->right = $this->rotateRight($node->right);
            //pagrieziens pa kreisi pie root
            return $this->rotateLeft($node);
        }
        return $node;
    }

    // --- IEVIETOŠANA --- //
    public function insert($data) {
        $this->root = $this->recursionInsert($this->root, $data);
    }

    //rekursīvā metode elementa pievienošanai
    private function recursionInsert($node, $data) {
        if($node === null) {
            return new Node($data);
        }
        if ($data < $node->data) {
            $node->left = $this->recursionInsert($node->left, $data);
        } elseif ($data > $node->data) {
            $node->right = $this->recursionInsert($node->right, $data);
        } else {
            return $node;
        }

        //veicam balansēšanu
        return $this->balance($node);
    }

    // --- DZĒŠANA --- //

    //palīgfunkcija mazākā elementa atrašanai
    private function minNode($node) {
        $current = $node;
        while ($current->left !== null) {
            $current = $current->left;
        }
        return $current;
    }
    public function delete($data) {
        $this->root = $this->recursionDelete($this->root, $data);
    }
    //rekursīvā metode elementa dzēšanai
    private function recursionDelete($node, $data) {
        if ($node === null) {
            return null;
        }

        if ($data < $node->data) {
            $node->left = $this->recursionDelete($node->left, $data);
        } elseif ($data > $node->data) {
            $node->right = $this->recursionDelete($node->right, $data);
        }
        //kad mezgls, kas jādzēš, atrasts
        else {
            //gadījums ar vienu child vai bez
            if ($node->left === null || $node->right === null) {
                $temp = $node->left ? $node->left : $node->right;
                $node = $temp;
            }
            //gadījums ar diviem child, meklējam mazāko vērtību labajā apakškokā
            else {
                $temp = $this->minNode($node->right);
                $node->data = $temp->data; //aizstājam vērtību
                $node->right = $this->recursionDelete($node->right, $temp->data); //izdzēš aizstājēju
            }
        }
        if($node === null) {
            return null;
        }
        //veicam balansēšanu
        return $this->balance($node);
    }


    //--- Izvade ---//
    public function display() {
        if ($this->root === null) {
            echo "Koks ir tukšs!";
            return;
        }

        $treeHeight = $this->getHeight($this->root);

        //rinda glabā mezglus
        $queue = [$this->root];

        // sākotējo atstarpju aprēķins
        $startInitialSpace = ($treeHeight * 2) - 1;
        $startInternalSpace = 0;

        while(!empty($queue)) {
            $levelNodes = count($queue);

            //atstarpju veidošana no garumiem
            $initialSpace = str_repeat(" ", (int)$startInitialSpace);
            $internalSpace = str_repeat(" ", (int)$startInternalSpace);

            $output = $initialSpace;

            $nextQueue = [];
            $allNull = true;

            for ($i = 0; $i < $levelNodes; $i++) {
                $node = array_shift($queue);

                //izdruka
                if ($node !== null) {
                    $output .= $node->data;
                    $allNull = false;
                    //pievieno child nodes nākamajam līmenim
                    $nextQueue[] = $node->left;
                    $nextQueue[] = $node->right;
                } else {
                    $output .= "n";
                    //pievieno null, lai saglabātu stuktūru
                    $nextQueue[] = null;
                    $nextQueue[] = null;
                }

                //pievieno atstarpi pēc elementa (izņemot pēdējo elementu)
                if($i < $levelNodes - 1) {
                    $output .= $internalSpace;
                }
            }
            //ja viss līmenis bija tikai null, pārtraucam
            if($allNull) {
                break;
            }
            echo $output . "\n";

            $startInternalSpace = $startInitialSpace;
            $startInitialSpace = floor($startInitialSpace / 2);
            //ja sākuma atstarpe ir 0 vai mazāka pārtraucam
            if ($startInitialSpace < 0) {
                $startInitialSpace = 0;
            }
            $queue = $nextQueue;
        }
    }
}



