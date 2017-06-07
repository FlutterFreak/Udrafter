<?php
session_start();
include 'db_connect.php';
header('Content-type: application/json');
if (isset ($_SESSION["email"])) {
    $email = $_SESSION["email"];

    $query_get ="delete from Employer where email=\"$email\"";
    $results = $connection->query($query_get);

    if($results== true) {
        $response["deleted"] = 'Account Successfully Deleted';
        // echoing JSON response
        echo json_encode($response);
        session_destroy();
        exit;
    }


}else if (isset ($_SESSION["uniemail"])) {
    $uniemail = $_SESSION["uniemail"];

    $query_get ="delete from Student where uniEmail=\"$uniemail\"";
    $results = $connection->query($query_get);
    if($results== true){
        $response["deleted"] = 'Account Successfully Deleted';
        // echoing JSON response
        echo json_encode($response);
        session_destroy();
        exit;
}}
$connection->close();

?>
