<?php
session_start();


if (isset ($_SESSION["email"])) {
    $email = $_SESSION["email"];
    
    
    
}else if(isset ($_SESSION["uniemail"])){
    $email = $_SESSION["uniemail"];
}