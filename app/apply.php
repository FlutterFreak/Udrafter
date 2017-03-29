<?php

session_start();
echo "xx".$uniemail;
if (!isset ($_SESSION["uniemail"])) {
    echo "<p>Sign In as a student to apply for Jobs. <a href = \"student_login.html\">Login</a>  </p>";
    return;
}
    else {
    $uniemail= $_SESSION["uniemail"];
    }
    echo "xx".$uniemail;
    include 'db_connect.php';
    $query_get = "select * from Student where  uniEmail=\"$uniemail\"";

    $results = $connection->query ($query_get);

    $row = mysqli_fetch_array($results);
    $studentId = $row["studentId"];

     echo $jobId;

    $query = "insert into Application ( jobId, studentId, employerId) values($jobId, \"$studentId\",\"$employerId\")";
    $ret = $connection->query ($query);
    if (!$ret) {
        echo "<p>Failed to Apply for Job:" . mysqli_error($connection) . "</p>";
    } else{
        echo "<p>Your Have succesfully applied to this job</p>";
    }
    
