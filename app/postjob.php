
// postjob.php 
<?php 
if (isset ($_SESSION["email"])){
    $email= $_SESSION["email"];
    include 'db_connect.php';
    $query_get = "select employerId, email from Employer where    email=\"$email\"";

$employerId= $query_get; 
if (isset ($_get["title"])) { 
$title = $_get["title"]; 
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
$query = "insert into Job (employerId, title, description,category, wages, company, 
location, date) values " 
. "(\"$employerId\", \"$title\",\"$description\",\"$category\",\"$wages\",\"$company\",\"$location\",\"$date\")"; 
$ret = $connection->query ($query); 
if (!$ret) {
    echo "<p>Failed to post Job:" . mysqli_error($connection) . "</p>";
} 
echo "<p>Your Job is Sucessfully Posted</p>"; 
}
else {
    echo "<p>Please sign in as Employer</p>";
    echo "<a href = \"employer_login.html\">Login</a>";
}