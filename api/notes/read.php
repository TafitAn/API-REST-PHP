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

    //Notes query
    $result = $notes->read();

    //get row count
    $num = $result->rowCount();

    //check if any matiere
    if($num > 0){
        $row = $result->fetchAll(PDO::FETCH_ASSOC);

        //turn into json output
        echo json_encode($row);

    }else{
        //any matiere
        echo json_encode(
            array('Message: ' => 'No notes found')
        );
    }