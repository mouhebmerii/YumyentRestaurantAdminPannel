<?php
//select.php
include ('database_connection.php');

$query = "SELECT * FROM `orderss` WHERE `done`='FINISHED' OR `done`='CANCELED' ORDER BY `orderss`.`id` DESC";
$statement = $connect->prepare($query);
if( $statement->execute())
{
    while($row = $statement->fetch(PDO:: FETCH_ASSOC)){
    $data[] = $row;
    }
    echo json_encode($data);

}
?>
