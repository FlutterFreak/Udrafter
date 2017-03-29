<?php
session_start();

include 'db_connect.php';
$query_get = "select * from Jobs";

$results = $connection->query ($query_get);

$num_results = mysqli_num_rows ($results);

for ($i = 0; $i < $num_results; $i++) {
   while( $row = mysqli_fetch_array($results)){

       $jobId = $row["jobId"];

       echo $jobid;
   }



}