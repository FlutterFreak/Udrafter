
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
    $row = mysqli_fetch_array($results);

    $num_results = mysqli_num_rows ($results);

    if ($num_results == 0) {
        return "Oh no! no results found";
    }
echo $num_results;
    $doc = new DOMDocument();
    $doc->formatOutput = true;

    $root = $doc->createElement( "Jobs" );
    $doc->appendChild( $root );

    for ($i = 0; $i < $num_results; $i++) {

        $row = mysqli_fetch_array ($results);

        $node = $doc->createElement( "job" );





        $jobId = $doc->createElement( "jobID" );

        $jobId->appendChild($doc->createTextNode($row["jobID"]));

        $node->appendChild( $jobID);


        $employerId = $doc->createElement( "employerId" );

        $employerId->appendChild($doc->createTextNode($row["employerId"]));

        $node->appendChild( $employerId);


        $title = $doc->createElement( "title" );

        $title ->appendChild($doc->createTextNode($row["title"]));

        $node->appendChild( $title);


        $description = $doc->createElement( "description" );

        $description->appendChild($doc->createTextNode($row["description"]));

        $node->appendChild( $description);



        $category = $doc->createElement( "category" );

        $category->appendChild($doc->createTextNode($row["category"]));

        $node->appendChild( $category);

        $wages = $doc->createElement( "wages" );

        $wages->appendChild($doc->createTextNode($row["wages"]));

        $node->appendChild( $wages);


        $company = $doc->createElement( "company" );

        $company->appendChild($doc->createTextNode($row["company"]));

        $node->appendChild( $company);



        $location = $doc->createElement( "location" );

        $location->appendChild($doc->createTextNode($row["location"]));

        $node->appendChild( $location);


        $date = $doc->createElement( "date" );

        $date->appendChild($doc->createTextNode($row["date"]));

        $node->appendChild( $date);


    }

    mysqli_close($connection);

    echo $doc->saveXML();



   /* $title = $row["title"];
        $description = $row["description"];
        $category = $row["category"];
        $wages = $row["wages"];
        $company = $row["company"];
        $location = $row["location"];
        $date = $row["date"];
//display the results   
        echo "<ul>\n";
        echo "<li>" . $title . "\n </li>\n";
    echo "<li> $description . \"\n \" . $category . \"\n \" . $wages . \"\n \" . $company . \"\n \" . $location . \"\n \" . $date  </li>\n";
        echo "</ul>";


} else {
    echo "<p>No results Found</p>";
}