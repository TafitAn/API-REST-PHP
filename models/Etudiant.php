<?php

    class Etudiant{
        //db stuff
        private $conn;
        private $table='etudiant';

        //etudiant properties
        public $id;
        public $num_Et;
        public $nom;
        public $niveau;
        
        //constructor with db
        public function __construct($db)
        {
            $this->conn = $db;
        }

        //get etudiant
        public function read(){
            //create query
            $query = ' SELECT 
                id,
                num_Et,
                nom,
                niveau
                FROM '
                .$this->table. ' 
               ORDER BY nom AND niveau DESC ';
            //prepare statement
            $stmt = $this->conn->prepare($query);

            //execute query
            $stmt->execute();

            return $stmt;
        }

        //read single etudiant 
        public function singleRead(){
            //create query
            $query = ' SELECT 
                id,
                num_Et,
                nom,
                niveau
                FROM '
                .$this->table. '
                WHERE
                    num_Et  = :num_Et
                    AND
                    niveau  = :niveau';

            //prepare statement
            $stmt = $this->conn->prepare($query);
            
            $this->num_Et = htmlspecialchars(strip_tags($this->num_Et));
            $this->niveau = htmlspecialchars(strip_tags($this->niveau));
            
            $stmt->bindParam(':num_Et', $this->num_Et);
            $stmt->bindParam(':niveau', $this->niveau);

            //execute query
            $stmt->execute();

            return $stmt;

        }

        //create etudiant
        public function create(){
            //create query
            $query = 'INSERT INTO '
            .$this->table. '
            SET
                num_Et  = :num_Et, 
                nom     = :nom,
                niveau  = :niveau';

            //prepare statement
            $stmt = $this->conn->prepare($query);

          
            $this->num_Et   = htmlspecialchars(strip_tags($this->num_Et));
            $this->nom      = htmlspecialchars(strip_tags($this->nom));
            $this->niveau   = htmlspecialchars(strip_tags($this->niveau));

            //bind data
            $stmt->bindParam(':num_Et', $this->num_Et);
            $stmt->bindParam(':nom', $this->nom);
            $stmt->bindParam(':niveau', $this->niveau);

            //execute query
            if($stmt->execute()){
                return true;
            }
            
            //print error if something goes wrong
                printf("Error: %s.\n" , $stmt->error);
                return false;
            
            
        }

        //update etudiant
        public function update(){
            //create query
            $query = 'UPDATE '
            .$this->table. '
            SET
                num_Et = :num_Et, 
                nom = :nom,
                niveau = :niveau
            WHERE
                id  = :id';
            
            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->num_Et = htmlspecialchars(strip_tags($this->num_Et));
            $this->nom = htmlspecialchars(strip_tags($this->nom));
            $this->niveau = htmlspecialchars(strip_tags($this->niveau));
            $this->id = htmlspecialchars(strip_tags($this->id));

            //bind data
            $stmt->bindParam(':num_Et', $this->num_Et);
            $stmt->bindParam(':nom', $this->nom);
            $stmt->bindParam(':niveau', $this->niveau);
            $stmt->bindParam(':id', $this->id);

            //execute query
            if($stmt->execute()){
                return true;
            }
            
            //print error if something goes wrong
                printf("Error: %s.\n" , $stmt->error);
                return false;
            
            
        }

        //delete etudiant
        public function delete(){
            //create query
            $query = 'DELETE FROM '.$this->table.' WHERE id = :id';
            
            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            //bind data
            $stmt->bindParam(':id', $this->id);

            //execute query
            if($stmt->execute()){
                return true;
            }
            
            //print error if something goes wrong
                printf("Error: %s.\n" , $stmt->error);
                return false;
        }
    }
?>