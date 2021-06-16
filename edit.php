<?php
//edit.php hedhi
include('database_connection.php');
$message = '';
$form_data = json_decode(file_get_contents("php://input"));
    $data = array(
        ':id'  => $form_data->id,
        ':title'  => $form_data->title,
        ':description'  => $form_data->description,
        ':price'  => $form_data->price,
        ':cat_id' => $form_data->cat_id,
        ':quantity'=> $form_data->quantity,
        ':image' => $form_data->image,
    );
$query =" UPDATE products
SET title = :title, description = :description, price = :price, cat_id = :cat_id, quantity = :quantity, image = :image  WHERE id = :id";
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