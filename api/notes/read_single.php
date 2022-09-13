<?php

    //header
    header('ACCESS-CONTROL-ALLOW-ORIGIN: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Notes.php';

    //instantiate db and conn
    $database = new Database();
    $db = $database->connect();

    //instantiate notes object
    $notes = new Notes($db);

    //get nom_mat
    $notes->num_inscription = isset($_GET['num_inscription']) ? $_GET['num_inscription'] : die();

    //Notes query
    $result = $notes->singleRead();

    //create array
    $n_arr = array(
        'num_Et'=> $notes->num_Et,
        'codemat' => $notes->codemat,
        'num_inscription' => $notes->num_inscription,
        'note' => $notes->note
    );

    //json
    print_r(json_encode($n_arr));
