
<?php

session_start();

if (isset ($_GET["submit"])) {
    if (isset($_GET["title"])) {
        $Title = $_GET["title"];

    } else {
        echo "<p>Please Enter a Search Query</p>";
    }}



//connect to database 
    include 'db_connect.php';
    $query_get = "select * from job where  title like '%" . $Title . "%' or description like '%" . $Title . "%' ";

    $results = $connection->query ($query_get);
//  get results


$title = $row["title"];
$description = $row["description"];
$category = $row["category"];
$wages = $row["wages"];
$company = $row["company"];
$location = $row["location"];
$date = $row["date"];

    $num_results = mysqli_num_rows ($results);

$encode = array();

while($row = mysqli_fetch_assoc($results)) {
    $encode[] = $row;
}

echo json_encode($encode);

$connection->close();
?>

  
