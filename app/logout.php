<?php
session_start();

session_destroy();
if (isset ($_SESSION["email"])) {
    header("Location: employer_login.html");
}
header("Location: student_login.html");
?>