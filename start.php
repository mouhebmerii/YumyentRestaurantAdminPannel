
<?php

//delete.php

include('database_connection.php');

$message = '';

$form_data = json_decode(file_get_contents("php://input"));

$query = "UPDATE orderss SET `done` = 'PROCESSING' , `Track_order` = 'Your order has been Confirmed.' WHERE `orderss`.`id` = '".$form_data->id."'";

$statement = $connect->prepare($query);
if($statement->execute())
{
 $message = 'Order Updated';
}

$output = array(
 'message' => $message
);

echo json_encode($output);

?>