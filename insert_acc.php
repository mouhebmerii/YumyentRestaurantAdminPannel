<?php  

//insert.php

include('database_connection.php');

$message = '';

$form_data = json_decode(file_get_contents("php://input"));

$data = array(
 ':username'  => $form_data->username,
 ':password'  => $form_data->password,
 ':name'  => $form_data->name,
);

$query = "
INSERT INTO `admins` (`id`, `role`, `username`, `password`, `name`) VALUES (NULL, 'admin', :username, :password, :name)
";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
 $message = 'Admin Added Successfuly';
}

$output = array(
 'message' => $message
);

echo json_encode($output);

?>

