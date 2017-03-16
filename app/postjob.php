<?php

if (isset ($_SESSION["email"])){
    $email= $_SESSION["email"];
    include 'db_connect.php';

    $query = "select employerId, email from Employer where  email=\"$email\"";
    
    $employerId= employerId;
    
}