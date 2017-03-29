<?php

session_start();

if (!isset ($_SESSION["uniemail"])) {
    echo "<p>Sign In as a student to apply for Jobs. <a href = \"edit_student.html\">Login</a>  </p>";
    return;
    $uniemail= $_SESSION["uniemail"];

    include 'db_connect.php';
    $query_get = "select * from Student where  uniEmail=\"$unimail\"";

    $results = $connection->query ($query_get);

    $row = mysqli_fetch_array($results);
    $StudentId = $row["studentId"];
    
}