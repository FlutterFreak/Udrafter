<?php
session_start();
?>


<?php
include 'db_connect.php';
header('Content-type: application/json');

if (isset ($_POST["name"])) {
    $name = $_POST["name"];
}
if (isset ($_POST["email"])) {
    $email = $_POST["email"];
}
if (isset ($_POST["password"])) {
    $password= $_POST["password"];
}
if (isset ($_POST["company"])) {
    $company = $_POST["company"];
}

if(!empty($name) && !empty($email) && !empty($password) && !empty($company)) {

    

    $query_check = "select * from Employer where email=\"$email\"";


    $results = $connection->query($query_check);
    $num_results = mysqli_num_rows($results);

    if (!$results) {
        $response["error"] = mysql_error($connection);
        echo json_encode($response);
    }

    if ($num_results != 0) {
        $response["failed"] = 'User Already Exists';
        // echoing JSON response
        echo json_encode($response);
        exit;
    }

    $query = "insert into Employer (name, password, email, company) values (\"$name\", \"$password\",\"$email\",\"$company\")";


    $ret = $connection->query($query);


    if (!$ret) {

        $json["error"] = mysql_error($connection);
        echo json_encode($json);
    }
else {
    $_SESSION["email"] = $email;

// success

    $response["success"] = 'Registration Sucessfull' . "Welcome  " . $email;
    echo json_encode($response);

}
}else {

    $response["empty"] = 'Please provide all Fields';
    echo json_encode( $response);
}
$connection->close();
?>
