<?php
//session_start();
//Jobs Applied
include 'db_connect.php';

header('Content-type: application/json');

//$uniemail= $_SESSION["uniemail"];
$uniemail= "abc@rgu.ac.uk";

$query_get = "select * from Student where  uniEmail=\"$uniemail\"";

$results = $connection->query ($query_get);

$row = mysqli_fetch_array($results);
$studentId = $row["studentId"];
echo $studentId;
$query_check = "select jobId from Application where studentId=\"$studentId\"";

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