<?php
/**
 * Created by PhpStorm.
 * User: 1516734
 * Date: 15/03/2017
 * Time: 13:07
 */
$host = "eu-cdbr-azure-west-d.cloudapp.net";
$user = "b46b41d46340e3";
$pass = "95f0622b";
$database = "udrafter_db";

$connection  = mysqli_connect($host, $user, $pass, $database)
or die ("Error is " . $mysqli_error ($connection));

?>