<?php

session_start();

if (!isset ($_SESSION["uniemail"])) {

    $json['response']= "Sign In as a student to apply for Jobs";

    echo json_encode($json);
    return;
}
    else {
    $uniemail= $_SESSION["uniemail"];
    }
if (isset ($_GET["jobId"])) {
    $jobId = $_GET["jobId"];
}
if (isset ($_GET["employerId"])) {
    $employerId = $_GET["employerId"];
}

    include 'db_connect.php';
    $query_get = "select * from Student where  uniEmail=\"$uniemail\"";

    $results = $connection->query ($query_get);

    $row = mysqli_fetch_array($results);
    $studentId = $row["studentId"];

$query = "insert into Application ( jobId, studentId, employerId) values($jobId, \"$studentId\",\"$employerId\")";
    
    $ret = $connection->query ($query);
    if (!$ret) {
        $json['failed']= "Failed to Apply for Job:" . mysqli_error($connection);

        echo json_encode($json);
      
    } else{
        $json['success']= "Your Have succesfully applied to this job";

        echo json_encode($json);
    }

$connection->close();
?>