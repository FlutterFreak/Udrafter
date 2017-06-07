<?php

session_start();

/*if (!isset ($_SESSION["uniemail"])) {

    $json['response']= "Sign In as a student to apply for Jobs";

    echo json_encode($json);
    return;
}*/

    $uniemail= $_SESSION["uniemail"];

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

$query_check = "select * from Student where jobId=\"$jobId\"";

$results = $connection->query($query_check);

if (!$results) {
    $response["failed"] = mysql_error($connection);
    echo json_encode($response);
}

$num_results = mysqli_num_rows($results);

if ($num_results != 0) {
    $response["applied"] = 'Yo have already applied for this job';
    // echoing JSON response
    echo json_encode($response);
    exit;
}

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