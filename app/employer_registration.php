<?php
session_start();
?>

<html>
<head>
    <title>Employer Registration</title>
</head>
<body>

<?php

header('Content-type: Application/json');
if (isset ($_POST["name"])) {
    $name1 = $_POST["name"];
}
if (isset ($_POST["email"])) {
    $email1 = $_POST["email"];
}
if (isset ($_POST["password"])) {
    $password1= $_POST["password"];
}
if (isset ($_POST["company"])) {
    $company1 = $_POST["company"];
}

if(!empty($name1) && !empty($email1) && !empty($password1) && !empty($company1)){

    $name2= strip_tags($name1);
    $email2= strip_tags($email1);
    $password2= strip_tags($password1);
    $company2= strip_tags($company1);

    $name = $connection->real_escape_string($name2);
    $email = $connection->real_escape_string($email2);
    $password = $connection->real_escape_string($password2);
    $company = $connection->real_escape_string($company2);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT); //here i am hashing the password
}
echo json_encode('Please provide all Fields');

include 'db_connect.php';

$query_check = "select * from Employer where email=\"$email\"";

$results = $connection->query ($query_check);

if (!$results) {
    $json["error"] =  mysql_error();
    echo json_encode($json);
}

$num_results = mysqli_num_rows ($results);

if ($num_results != 0) {

    // user already exists
    // failed

    $response["failed"] = 'User Already Exists';

    // echoing JSON response

    echo json_encode($response);

}

$query = "insert into Employer (name, password, email, company) values (\"$name\", \"$hashed_password\",\"$email\",\"$company\")";

$ret = $connection->query ($query);


if (!$ret) {

    $json["error"] =  mysql_error($connection);
    echo json_encode($json);
}

    $_SESSION["email"] = $email;

// success

$response["success"] = 'Registration Sucessfull' . $email;

// echoing JSON response

echo json_encode($response);

echo json_encode($email);

?>

</body>
</html>
