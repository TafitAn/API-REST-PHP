<?php

    class Matiere{
        //db stuff
        private $conn;
        private $table = 'matiere';

        //matiere properties
        public $codemat;
        public $libelle;
        public $coef;
        public $niveau;
        
        //constructor with db
        public function __construct($db)
        {
            $this->conn = $db;
        }

        //get matiere
        public function read(){
            //create query
            $query='SELECT
                codemat,
                libelle,
                coef,
                niveau
                FROM ' .$this->table. ' 
                ORDER by codemat';
            
            //prepare statement
            $stmt = $this->conn->prepare($query);

            //execute query
            $stmt->execute();

            return $stmt;
        }

        //single read matiere
        public function singleRead(){
            //create query
            $query='SELECT
            codemat,
            libelle,
            coef,
            niveau
            FROM ' .$this->table. ' 
            WHERE
            libelle = :libelle
            AND
            niveau = :niveau';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            $this->libelle = htmlspecialchars(strip_tags($this->libelle));
            $this->niveau = htmlspecialchars(strip_tags($this->niveau));

            //Bind id
            $stmt->bindParam(':libelle',$this->libelle);
            $stmt->bindParam(':niveau',$this->niveau);

            //execute statement
            $stmt->execute();

            return $stmt;
        }

        //Add matiere
        public function create(){
            //create query
            $query = 'INSERT INTO '
            .$this->table. '
            SET
                libelle = :libelle,
                coef = :coef,
                niveau = :niveau';
                
            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->libelle = htmlspecialchars(strip_tags($this->libelle));
            $this->coef = htmlspecialchars(strip_tags($this->coef));
            $this->niveau = htmlspecialchars(strip_tags($this->niveau));
            
            //bind data
            $stmt->bindParam(':libelle', $this->libelle);
            $stmt->bindParam(':coef', $this->coef);
            $stmt->bindParam(':niveau', $this->niveau);

            //execute query
            if($stmt->execute()){
                return true;
            }

            //print error if something goes wrong
            printf('Error: %s\n', $stmt->error);
            return false;
        
        }

        //update matiere
        public function update(){
            //create query
            $query = 'UPDATE '
            .$this->table. '
            SET
                libelle = :libelle,
                coef = :coef,
                niveau = :niveau
            WHERE
                codemat = :codemat';
                
            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->libelle = htmlspecialchars(strip_tags($this->libelle));
            $this->coef = htmlspecialchars(strip_tags($this->coef));
            $this->niveau = htmlspecialchars(strip_tags($this->niveau));
            $this->codemat = htmlspecialchars(strip_tags($this->codemat));
            
            //bind data
            $stmt->bindParam(':libelle', $this->libelle);
            $stmt->bindParam(':coef', $this->coef);
            $stmt->bindParam(':niveau', $this->niveau);
            $stmt->bindParam(':codemat', $this->codemat);

            //execute query
            if($stmt->execute()){
                return true;
            }

            //print error if something goes wrong
            printf('Error: %s\n', $stmt->error);
            return false;
        
        }

        //delete matiere
        public function delete(){
            //create query
            $query = 'DELETE FROM ' .$this->table.' WHERE codemat = :codemat';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->codemat = htmlspecialchars(strip_tags($this->codemat));

            //bind data
            $stmt->bindParam(':codemat', $this->codemat);

            //execute query
            if($stmt->execute()){
                return true;
            }

            //print error if something goes wrong
            printf('Error: %s\n', $stmt->error);
            return false;
        }
    }
    ?>