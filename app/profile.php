<?php
session_start();
include 'db_connect.php';
header('Content-type: application/json');
if (isset ($_SESSION["email"])) {
    $email = $_SESSION["email"];

    include 'db_connect.php';
    $query_get = "select * from Employer where  email=\"$email\"";

    $results = $connection->query($query_get);


    $row = mysqli_fetch_array($results);

    $name = $row["name"];
    $email = $row["email"];
    $company = $row["company"];
    $profilePic = $row["profilePic"];
    
    $num_results = mysqli_num_rows ($results);

    $encode = array();

    while($row = mysqli_fetch_assoc($results)) {
        $encode[] = $row;
    }

    echo json_encode($encode);



}
else if (isset ($_SESSION["uniemail"])) {
    $uniemail = $_SESSION["uniemail"];
    include 'db_connect.php';

    $query_get = "select * from Student where  uniEmail=\"$uniemail\"";

    $results = $connection->query($query_get);


    $row = mysqli_fetch_array($results);

    $name = $row["name"];

    $uniemail = $row["uniemail"];
    $profilePic = $row["profilePic"];


    $num_results = mysqli_num_rows ($results);

    $encode = array();

    while($row = mysqli_fetch_assoc($results)) {
        $encode[] = $row;
    }

    echo json_encode($encode);


}
$connection->close();
?>


