<?php

    //header
    header('ACCESS-CONTROL-ALLOW-ORIGIN: *');
    header('Content-Type: application/json');
    header('ACCESS-CONTROL-ALLOW-METHODS: PUT');
    header('ACCESS-CONTROL-ALLOW-HEADERS: ACCESS-CONTROL-ALLOW-ORIGIN, Content-Type, ACCESS-CONTROL-ALLOW-METHODS, ACCESS-CONTROL-ALLOW-HEADERS, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Notes.php';

    //instantiate db and conn
    $database = new Database();
    $db = $database->connect();

    //instantiate notes object
    $notes = new Notes($db);

    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    
    //set key update
    $notes->codemat = $data->codemat;
    $notes->num_inscription = $data->num_inscription;
    
    $notes->note = $data->note;

    //create notes
    if($notes->update()){
        echo json_encode(
            array('Message' => 'Notes updated')
        );
    }else {
        echo json_encode(
            array('Message' => 'Notes Not updated')
        );
    }