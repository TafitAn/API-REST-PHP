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

    $etudiant->num_Et   = $data->num_Et;
    $etudiant->nom      = $data->nom;
    $etudiant->niveau   = $data->niveau;

    //create etudiant
    if($etudiant->create()){
        echo json_encode(
            array('message '=>'Student Created')
        );
    }else{
        echo json_encode(
            array('message '=>'Student Not Created')
        );
    }