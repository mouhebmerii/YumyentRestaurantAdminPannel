<?php
//edit.php hedhi
include('database_connection.php');

$message = '';
$form_data = json_decode(file_get_contents("php://input"));
    $data = array(
        ':id' => $form_data->id,
    );

$query =" UPDATE orderss SET `done` = 'FINISHED' , `Track_order` = 'Your order has been delivered.' WHERE id = :id";


$statement = $connect->prepare($query);
if($statement->execute($data))
{
 $message = 'Item Edited Successfuly';
}

$output = array(
 'message' => $message
);

echo json_encode($output);

?>
