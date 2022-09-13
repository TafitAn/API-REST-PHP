<?php

    //header
    header('ACCESS-CONTROL-ALLOW-ORIGIN: *');
    header('Content-Type: application/json');
    header('ACCESS-CONTROL-ALLOW-METHODS: POST');
    header('ACCESS-CONTROL-ALLOW-HEADERS: ACCESS-CONTROL-ALLOW-ORIGIN, Content-Type, ACCESS-CONTROL-ALLOW-METHODS, ACCESS-CONTROL-ALLOW-HEADERS, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Etudiant.php';

    //instantiate db and conn
    $database = new Database();
    $db = $database->connect();

    //instantiate etudiant object
    $etudiant = new Etudiant($db);

    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //set ID to DEL
    $etudiant->id = $data->id;

    //create etudiant
    if($etudiant->delete()){
        echo json_encode(
            array('message '=>'Student deleted')
        );
    }else{
        echo json_encode(
            array('message '=>'Student Not deleted')
        );
    }
?>