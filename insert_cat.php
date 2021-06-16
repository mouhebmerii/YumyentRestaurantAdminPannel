<?php  

//insert.php

include('database_connection.php');

$message = '';

$form_data = json_decode(file_get_contents("php://input"));

$data = array(
    ':id'  => $form_data->id,
    ':title'  => $form_data->title,
);

$query = "
 INSERT INTO `categories` 
 (id, title) VALUES 
 (:id, :title)
";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
 $message = 'Category Added Successfuly';
}

$output = array(
 'message' => $message
);

echo json_encode($output);

?>

