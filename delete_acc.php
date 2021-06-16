
<?php

//delete.php

include('database_connection.php');

$message = '';

$form_data = json_decode(file_get_contents("php://input"));

$query = "DELETE FROM `admins` WHERE `admins`.`id` = '".$form_data->id."'";

$statement = $connect->prepare($query);
if($statement->execute())
{
 $message = 'User Deleted';
}

$output = array(
 'message' => $message
);

echo json_encode($output);

?>