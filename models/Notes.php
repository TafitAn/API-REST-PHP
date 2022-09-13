<?php

    class Notes{

        //db stuff
        private $conn;
        private $table = 'notes';

        //Notes properties
        public $codemat;
        public $num_inscription;
        public $note;

        //constructor with db
        public function __construct($db)
        {
            $this->conn = $db;
        }

        //get Notes
        public function read(){
            //read query
            $query = 'SELECT
                n.num_inscription,
                e.num_Et,
                e.nom as nom_Et,
                m.libelle as nom_mat,
                n.codemat,
                n.note,
                m.coef as coefficient
                FROM '.$this->table.' n
                LEFT JOIN matiere m 
                    ON n.codemat = m.codemat
                LEFT JOIN etudiant e
                    ON e.id = n.num_inscription
                ORDER BY n.codemat, e.niveau, e.num_et';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //execute
            $stmt->execute();

            return $stmt;
        }

        //get single Notes
        public function singleRead(){
            // single read query
            $query = 'SELECT 
                m.libelle as nom_mat,
                e.nom as nom_Et,
                e.num_Et,
                n.codemat,
                n.num_inscription,
                n.note
                FROM '.$this->table.' n
                LEFT JOIN matiere m 
                    ON n.codemat = m.codemat
                LEFT JOIN etudiant e
                    AND e.id = n.num_inscription
                WHERE
                n.num_inscription = ?
                LIMIT 0,1';
            
            //prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind id
            $stmt->bindParam(1, $this->num_inscription);

            //execute
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //set properties
            
            
            $this->note = $row['note'];
        } 

        //Create Note
        public function create(){
            //create query
            $query = 'INSERT INTO '
            .$this->table. ' 
            SET
                codemat = :codemat,
                num_inscription = :num_inscription,
                note = :note 
            ';
            
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->codemat = htmlspecialchars(strip_tags($this->codemat));
            $this->num_inscription = htmlspecialchars(strip_tags($this->num_inscription));
            $this->note = htmlspecialchars(strip_tags($this->note));

            //bind data
            $stmt->bindParam(':codemat', $this->codemat);
            $stmt->bindParam(':num_inscription', $this->num_inscription);
            $stmt->bindParam(':note', $this->note);

            if($stmt->execute()){
                return true;
            }

            printf('Error: %s\n', $stmt->error);
            return false;
        }

        //update Note
        public function update(){
             //create query
             $query = 'UPDATE '
             .$this->table. ' 
             SET
                note = :note 
             WHERE
                codemat = :codemat 
             AND
                num_inscription = :num_inscription
             ';
             
             $stmt = $this->conn->prepare($query);
 
             //clean data
             $this->note = htmlspecialchars(strip_tags($this->note));
             $this->codemat = htmlspecialchars(strip_tags($this->codemat));
             $this->num_inscription = htmlspecialchars(strip_tags($this->num_inscription));
             
             //bind data
             $stmt->bindParam(':note', $this->note);
             $stmt->bindParam(':codemat', $this->codemat);
             $stmt->bindParam(':num_inscription', $this->num_inscription);

            if($stmt->execute()){
                return true;
            }

            printf('Error: %s\n', $stmt->error);
            return false;
        }

        //delete note
        public function delete(){
            //delete query
            $query = 'DELETE FROM ' .$this->table.'
            WHERE
                codemat = :codemat 
             OR
                num_inscription = :num_inscription ';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->codemat = htmlspecialchars(strip_tags($this->codemat));
            $this->num_inscription = htmlspecialchars(strip_tags($this->num_inscription));

            //bind data
            $stmt->bindParam(':codemat', $this->codemat);
            $stmt->bindParam(':num_inscription', $this->num_inscription);

            //execute
            if($stmt->execute()){
                return true;
            }

            printf('Error: %s\n', $stmt->error);
            return false;
        }
    }