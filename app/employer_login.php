<?php
session_start();
?>



<?php

if (!isset ($_SESSION["email"])) {


    $email = $_POST["email"];
    $password = $_POST["password"];

    include 'db_connect.php';

    $query = "select * from Employer where  email=\"$email\"";

    $results = $connection->query ($query);

    $num_results = mysqli_num_rows ($results);

    if ($num_results > 0) {
        $row = mysqli_fetch_array ($results);
        $pass = $row["password"];

        if ($pass == $password) {
            $_SESSION["email"] = $email;

            $response["Success"] = 'Login successful'. "". $_SESSION["email"];
            echo json_encode($response);

        }
        else {
            $response["Incorrect"] = 'email or password is not correct, please enter correct details';
            echo json_encode($response);
        }
    }
    else {

        $response["Failed"] = 'Not a valid user, please Register to Sign In';
        echo json_encode($response);
    }
 }
else {
    session_destroy();
    $response["LoggedOut"] = 'you are logged out please login again';
    echo json_encode($response);
}


?>
