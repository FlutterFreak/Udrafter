
<?php

session_start();

if (isset ($_GET["submit"])) {
    if (isset($_GET["title"])) {
        $Title = $_GET["title"];
        echo "<p> " . $Title . "</p> ";
    } else {
        echo "<p>Please Enter a Search Query</p>";
    }
} else{
    echo "<p>No results Found</p>";
}

//connect to database 
    include 'db_connect.php';
    $query = "SELECT * from Job WHERE title =\"$Title=\"";


    $results = $connection->query($query);
$row = mysqli_fetch_array($results);
$description = $row["description"];

// create while loop and loop through results 
    while ($row = mysql_fetch_array($results)) {
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
    }

