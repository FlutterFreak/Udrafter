<?php
session_start();
?>


<?php
include 'db_connect.php';
header('Content-type: application/json');
if (!isset ($_SESSION["uniemail"])) {


    $uniemail = $_POST["uniemail"];
    $password = $_POST["password"];

    include 'db_connect.php';

    $query = "select * from Student where  uniEmail=\"$uniemail\"";

    $results = $connection->query($query);

    $num_results = mysqli_num_rows($results);

    if ($num_results > 0) {
        $row = mysqli_fetch_array($results);
        $pass = $row["password"];

        if ($pass == $password) {
            $_SESSION["uniemail"] = $uniemail;
            $response["Success"] = 'Login successful' . "" . $_SESSION["uniemail"];
            echo json_encode($response);
        } else {
            $response["Failed"] = 'email or password is not correct, please enter correct details';
            echo json_encode($response);
        }
    } else {
        $response["Failed"] = 'Not a valid user, please Register to Sign In';
        echo json_encode($response);
    }}
else {
    $response["Success"] = 'you are already logged in';
    echo json_encode($response);
}
  ?>

