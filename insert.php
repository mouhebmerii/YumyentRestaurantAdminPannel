<?php  

//insert.php

include('database_connection.php');

$message = '';

$form_data = json_decode(file_get_contents("php://input"));

$data = array(
 ':title'  => $form_data->title,
 ':description'  => $form_data->description,
 ':price'  => $form_data->price,
 ':cat_id' => $form_data->cat_id,
 ':quantity'=> $form_data->quantity,
 ':image' => $form_data->image,
);

$query = "
 INSERT INTO products 
 (title, image, description, price, quantity, cat_id) VALUES 
 (:title, :image, :description, :price, :quantity, :cat_id)
";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
 $message = 'Item Added Successfuly';
}

$output = array(
 'message' => $message
);

echo json_encode($output);

?>

