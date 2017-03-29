<?php
session_start();
?>


<html>
<head>
    <title>Student Login</title>
</head>
<body>

<?php

if (isset ($_SESSION["uniemail"])) {
    echo "<p>You are already logged in.</p>";
    echo "<p>Click <a href = \"profile.php\">here</a>  to view/edit your profile.</p>";
    return;
}

$uniemail = $_POST["uniemail"];
$password = $_POST["password"];

include 'db_connect.php';

$query = "select * from Student where  uniEmail=\"$uniemail\"";

	$results = $connection->query ($query);
    
    $num_results = mysqli_num_rows ($results);

  	if ($num_results > 0) {
        $row = mysqli_fetch_array ($results);
        $pass = $row["password"];

        if ($pass == $password) {
            $_SESSION["uniemail"] = $uniemail;
            echo "<p>Login successful, ". $_SESSION["uniemail"] . ".  Click <a href = \"job.html\">here</a> to go to view/search Jobs.</p>";
            echo "<p>Click <a href = \"profile.php\">here</a>  to view/edit your profile.</p>";
        }
        else {
            echo "<p>Invalid login</p>";
            echo "<a href = \"student_login.html\">Try again</a>";
        }
    }
    else {
        echo "<p>Invalid login</p>";
        echo "<a href = \"student_registration.html\">Register</a>";
    }       
  ?>

</body>
</html>  
