<?php
session_start();


if (isset ($_SESSION["email"])) {
    $email = $_SESSION["email"];

    echo "<p>$email<?p>";
}


    include 'db_connect.php';
    $query_get = "select * from Employer where  email=\"$email\"";

    $results = $connection->query ($query_get);

    $row = mysqli_fetch_array($results);
    $employerId = $row["employerId"];

echo "<p>aaaaa axx $employerId xx<?p>";

if (isset ($_GET["title"])) {
$title = $_GET["title"]; 
}
if (isset ($_get["description"])) { 
$description = $_get["description"]; 
} 
if (isset ($_get["category"])) { 
$category= $_get["category"]; 
} 
if (isset ($_get["wages"])) { 
$wages= $_get["wages"]; 
}
if (isset ($_get["company"])) { 
$company = $_get["company"]; 
} 
if (isset ($_get["location"])) { 
$location = $_get["location"]; 
} 
if (isset ($_get["date"])) { 
    $date = $_get["date"];

}

echo "<p>Date is $date</p>";

$query = "insert into job (employerId, title, description,category, wages, company, location) values($employerId, \"$title\",\"$description\",\"$category\",\"$wages\",\"$company\",\"$location\")";
$ret = $connection->query ($query); 
if (!$ret) {
    echo "<p>Failed to post Job:" . mysqli_error($connection) . "</p>";
} 
//echo "<p>Your Job is Sucessfully Posted</p>";

else {
    echo "<p>Please sign in as Employer</p>";
    echo "<a href = \"employer_login.html\">Login</a>";
}
