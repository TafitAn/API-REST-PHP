<?php

    //header
    header('ACCESS-CONTROL-ALLOW-ORIGIN: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Etudiant.php';

    //instantiate db and conn
    $database = new Database();
    $db = $database->connect();

    //instantiate etudiant object
    $etudiant = new Etudiant($db);

    //etudiant query
    $result = $etudiant->read();

    //get row count
    $num = $result->rowCount();

    //check if any etudiant
    if($num>0){

        $row=$result->fetchAll(PDO::FETCH_ASSOC);

        //turn into json & output
        $json = json_encode($row);
        echo $json;
    }else{
        //any etudiant
        echo json_encode(
            array('message' =>  'No student found')
        );
    }