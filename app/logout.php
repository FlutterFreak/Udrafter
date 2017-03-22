<?php
session_start();

session_destroy();

header("Location: emplpoyer_login.html");
?>