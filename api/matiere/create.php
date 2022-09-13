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

    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $matiere->libelle = $data->libelle;
    $matiere->coef = $data->coef;
    $matiere->niveau = $data->niveau;

    //create matiere
    if($matiere->create()){
        echo json_encode(
            array('message' => 'matiere created')
        );
    }else {
        echo json_encode(
            array('message' => 'matiere not created')
        );
    }