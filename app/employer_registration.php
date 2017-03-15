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

include 'db_connect.php';

$query_check = "select * from Student where email=\"$email\"";

$results = $connection->query ($query_check);

if (!$results) {
    echo "<p>" . mysql_error() . "</p>";
}

$num_results = mysqli_num_rows ($results);

if ($num_results != 0) {
    echo "<p>That user already exists</p>";
    echo "<a href = \"employer_login.php\">Emplyer login</a>";
    exit;
}

$query = "insert into Employer (name, password, email, company) values (\"$name\", \"$password\",\"$email\",\"$company\")";

$ret = $connection->query ($query);


if (!$ret) {
    echo "<p>Failed registration: " . mysqli_error($connection) . "</p>";
}

echo "<p>Registration successful</p>";
echo "<a href = \"employer_login.html\"> Employer login</a>";


?>

</body>
</html>  
