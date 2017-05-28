<?php
session_start();

include 'db_connect.php';
header('Content-type: application/json');
if (isset ($_SESSION["email"])) {
    $email = $_SESSION["email"];

    
}else {

    $json['response']= "Please sign in as Employer to post Jobs";
     echo json_encode($json);
}


    include 'db_connect.php';
    $query_get = "select * from Employer where  email=\"$email\"";

    $results = $connection->query ($query_get);

    $row = mysqli_fetch_array($results);
    $employerId = $row["employerId"];



if (isset ($_GET["title"])) {
$title = $_GET["title"];

}
if (isset ($_GET["description"])) {
$description = $_GET["description"];
} 
if (isset ($_GET["category"])) {
$category= $_GET["category"];
} 
if (isset ($_GET["wages"])) {
$wages= $_GET["wages"];

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
    if (isset ($_GET["jobPic"])) {
        $jobPic = $_GET["jobPic"];

}


$date1 = date_format($date,'%m/%d/%Y');
echo $date1;







$query = "insert into job (employerId, title, description,category, wages, company, location, date, jobPic )
 values( \"$employerId \", \"$title\",\"$description\",\"$category\",\"$wages\",\"$company\",\"$location\",\"$date\",\"$jobPic\")";
$ret = $connection->query ($query); 
if (!$ret) {

    $json['failed']= "Failed to post Job:" . mysqli_error($connection);

    echo json_encode($json);

} else{
    $json['success']= "Your Have succesfully posted this job";

    echo json_encode($json);
}



