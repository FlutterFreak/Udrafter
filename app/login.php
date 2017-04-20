<?php
session_start();




$uniemail = $_POST["uniemail"];
$password = $_POST["password"];

include 'db_connect.php';

$query = "select * from Student where  uniEmail=\"$uniemail\"";

$results = $connection->query ($query);

$num_results = mysqli_num_rows ($results);

if ($num_results > 0) {
    $row = mysqli_fetch_array ($results);
    $pass = $row["password"];

    if ($pass == $password) {
        $_SESSION["uniemail"] = $uniemail;
    }}

$encode = array();

while($row = mysqli_fetch_assoc($results)) {
    $encode[] = $row;
}

echo json_encode($encode);
?>