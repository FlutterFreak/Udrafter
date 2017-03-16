<?php
session_start();
?>

<html>
<head>
    <title>Employer Login</title>
</head>
<body>

<?php

if (isset ($_SESSION["email"])) {
    echo "<p>You are already logged in.</p>";
    return;
}

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
        echo "<p>Login successful, ". $_SESSION["email"] . ".  Click <a href = refrences\"front_end.php\">here</a> to go to your Assessment list.</p>";
    }
    else {
        echo "<p>Invalid login</p>";
        echo "<a href = \"employer_login.html\">Try again</a>";
    }
}
else {
    echo "<p>Invalid login</p>";
    echo "<a href = \"employer_registration.html\">Register</a>";
}
?>

</body>
</html>  
