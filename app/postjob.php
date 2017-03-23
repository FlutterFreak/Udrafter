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
    echo "Title is $title";
}
if (isset ($_GET["description"])) {
$description = $_GET["description"];
} 
if (isset ($_GET["category"])) {
$category= $_GET["category"];
} 
if (isset ($_GET["wages"])) {
$wages= $_GET["wages"];
    echo "wage is $wages";
}
if (isset ($_GET["company"])) {
$company = $_GET["company"];
} 
if (isset ($_GET["location"])) {
$location = $_GET["location"];
} 
if (isset ($_GET["date"])) {
    $date = $_GET["date"];

}

echo "<p>Date is $date</p>";

$query = "insert into job (employerId, title, description,category, wages, company, location) values($employerId, \"$title\",\"$description\",\"$category\",\"$wages\",\"$company\",\"$location\",\"$date\")";
$ret = $connection->query ($query); 
if (!$ret) {
    echo "<p>Failed to post Job:" . mysqli_error($connection) . "</p>";
} 
//echo "<p>Your Job is Sucessfully Posted</p>";

else {
    echo "<p>Please sign in as Employer</p>";
    echo "<a href = \"employer_login.html\">Login</a>";
}
