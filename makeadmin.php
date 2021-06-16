<?php

//makeadmin.php

include('database_connection.php');

$message = '';

$form_data = json_decode(file_get_contents("php://input"));


    $query ="
    UPDATE admins
    SET `role` = 'superadmin' WHERE `admins`.`id` = '".$form_data->id."'";
    $statement = $connect->prepare($query);
    if($statement->execute($data))
    {
     $message = 'User Edited Successfuly';
    }
    
    $output = array(
     'message' => $message
    );
    
    echo json_encode($output);

?>