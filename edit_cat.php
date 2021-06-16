<?php
//edit.php hedhi
include('database_connection.php');
$message = '';
$form_data = json_decode(file_get_contents("php://input"));
    $data = array(
        ':id'  => $form_data->id,
        ':title'  => $form_data->title,
    );
$query =" UPDATE `categories` 
SET id=:id, title = :title  WHERE `categories`.`id` = :id";
$statement = $connect->prepare($query);
if($statement->execute($data))
{
 $message = 'Category Edited Successfuly';
}

$output = array(
 'message' => $message
);

echo json_encode($output);

?>