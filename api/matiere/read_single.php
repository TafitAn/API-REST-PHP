<?php

    //header
    header('ACCESS-CONTROL-ALLOW-ORIGIN: *');
    header('Content-Type: application/json');    
    header('ACCESS-CONTROL-ALLOW-METHODS: POST');
    header('ACCESS-CONTROL-ALLOW-HEADERS: ACCESS-CONTROL-ALLOW-ORIGIN, Content-Type, ACCESS-CONTROL-ALLOW-METHODS, ACCESS-CONTROL-ALLOW-HEADERS, Authorization, X-Requested-With');


    include_once '../../config/Database.php';
    include_once '../../models/Matiere.php';

    //instantiate db and conn
    $database = new Database();
    $db = $database->connect();

    //instantiate matiere object
    $matiere = new Matiere($db);

    $data = json_decode(file_get_contents("php://input"));

    //set id update
    $matiere->libelle = $data->libelle;
    $matiere->niveau = $data->niveau;

    //get matiere
    $result = $matiere->singleRead();

    $num = $result->rowCount();

    //check if any etudiant
    if($num>0){

        $row=$result->fetchAll(PDO::FETCH_ASSOC);

        //turn into json & output
        $json = json_encode($row);
        echo $json;
    }else{
        //any matiere
        echo json_encode(
            array('message' =>  'No Matiere found')
        );
    }