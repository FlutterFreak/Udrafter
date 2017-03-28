
<?php

session_start();

if (isset ($_GET["submit"])) {
    if (isset($_GET["title"])) {
        $Title = $_GET["title"];

    } else {
        echo "<p>Please Enter a Search Query</p>";
    }


echo "<p> xxx  $Title</p> ";
//connect to database 
    include 'db_connect.php';
    $query_get = "select * from job where  title like '%" . $Title . "%' ";

    $results = $connection->query ($query_get);

    $row = mysqli_fetch_array($results);


// create while loop and loop through results

        $title = $row["title"];
        $description = $row["description"];
        $category = $row["category"];
        $wages = $row["wages"];
        $company = $row["company"];
        $location = $row["location"];
        $date = $row["date"];
//display the results   
        echo "<ul>\n";
        echo "<li>" . $title . " " . $description . " " . $category . " " . $wages . " " . $company . " " . $location . " " . $date . "</li>\n";
        echo "</ul>";


} else {
    echo "<p>No results Found</p>";
}