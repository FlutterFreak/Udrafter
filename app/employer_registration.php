<?php
session_start();
?>

<html>
<head>
    <title>Employer Registration</title>
</head>
<body>

<?php

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

$name = mysql_real_escape_string($_POST['name']);
$email = mysql_real_escape_string($_POST['email']);
$company = mysql_real_escape_string($_POST['company']);
$password = mysql_real_escape_string($_POST['password']);
echo json_encode($name);


include 'db_connect.php';

$query_check = "select * from Employer where email=\"$email\"";

$results = $connection->query ($query_check);

if (!$results) {
    $error= mysql_error();
    echo json_encode($error);
}

$num_results = mysqli_num_rows ($results);

if ($num_results != 0) {

    // user already exists
    // failed

    $response["failed"] = 1;

    // echoing JSON response

    echo json_encode($response);

}

$query = "insert into Employer (name, password, email, company) values (\"$name\", \"$password\",\"$email\",\"$company\")";

$ret = $connection->query ($query);


if (!$ret) {
    echo "<p>Failed registration: " . mysqli_error($connection) . "</p>";
}

    $_SESSION["email"] = $email;

// success

$response["success"] = 1;

// echoing JSON response

echo json_encode($response);

echo json_encode($email);

?>

</body>
</html>
