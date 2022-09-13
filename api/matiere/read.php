<?php

    //header
    header('ACCESS-CONTROL-ALLOW-ORIGIN: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Matiere.php';

    //instantiate db and conn
    $database = new Database();
    $db = $database->connect();

    //instantiate matiere object
    $matiere = new Matiere($db);

    //matiere query
    $result = $matiere->read();

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
            array('Message: ' => 'No Matiere found')
        );
    }