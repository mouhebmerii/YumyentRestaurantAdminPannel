<?php
//edit.php hedhi
include('database_connection.php');
$message = '';
$form_data = json_decode(file_get_contents("php://input"));
    $data = array(
        ':id'  => $form_data->id,
        ':username'  => $form_data->username,
        ':password'  => $form_data->password,
        ':name'  => $form_data->name,
    );
$query ="
UPDATE admins
SET username = :username, password = :password, name = :name WHERE id = :id";
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