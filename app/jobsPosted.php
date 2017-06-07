<?php
session_start();
//Jobs Applied
include 'db_connect.php';

header('Content-type: application/json');

$email= $_SESSION["email"];
$query_get = "select * from Employer where  email=\"$email\"";

$results = $connection->query ($query_get);

$row = mysqli_fetch_array($results);
$employerId = $row["employerId"];
$query_check = "select jobId from Application where employerId=\"$employerId\"";

$results = $connection->query($query_check);

$num_results = mysqli_num_rows($results);
$encode = array();
for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_array($results);

    $jobId = $row["jobId"];
    $query_get = "select * from Job where  jobId=\"$jobId\"";
    $result = $connection->query ($query_get);


    $row = mysqli_fetch_assoc($result);
    array_push ($encode, $row);

}

echo json_encode($encode);
$connection->close();

?>
