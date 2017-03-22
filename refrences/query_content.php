<?php

	session_start();
  
	header('Content-Type: text/xml; charset=utf-8');
  
  	if (!isset ($_SESSION["username"])) {
		header( 'Location: example_login.html' ) ;
		return;
	}
	else {
		$username = $_SESSION["username"];
	}

$host = "eu-cdbr-azure-west-d.cloudapp.net";
$user = "b46b41d46340e3";
$pass = "95f0622b";
$database = "udrafter_db";
	$action = 0;

    $connection  = mysqli_connect($host, $user, $pass, $database) 
      or die ("Error is " . $mysqli_error ($connection));  
    

	if (isset ($_GET["action"])) {
		$action = $_GET["action"];
	}
	if (isset ($_GET["date"])) {
		$date = $_GET["date"];
	}

  if (!$action) {
    $query = "SELECT * from AssessmentEntry where Username ='$username'";
  }
  else {
    $query = "SELECT * from AssessmentEntry where Username ='$username' and Done=0 and WhenDue > $date";
  }
  
  
  $ret = $connection->query ($query);
 
  $num_results = mysqli_num_rows ($ret);
 
  if ($num_results == 0) {
    return "Oh no!";
  }     
  
  $doc = new DOMDocument(); 
  $doc->formatOutput = true; 
  
  $root = $doc->createElement( "Assessment_entry" ); 
  $doc->appendChild( $root ); 
  
  for ($i = 0; $i < $num_results; $i++) {
  
    $row = mysqli_fetch_array ($ret);
  
  
  
  
    $node = $doc->createElement( "entry" ); 





    $id = $doc->createElement( "ID" ); 
  
    $id->appendChild($doc->createTextNode($row["ID"])); 
    
    $node->appendChild( $id); 
    
      
      
      
      
    $description = $doc->createElement( "Description" ); 
  
    $description->appendChild($doc->createTextNode($row["Description"])); 
    
    $node->appendChild( $description ); 
 



    $done = $doc->createElement( "Done" ); 
  
    $done->appendChild($doc->createTextNode($row["Done"])); 
    
    $node->appendChild( $done); 

      
      
      
      

    $whendone = $doc->createElement( "WhenDone" ); 
  
    $whendone->appendChild($doc->createTextNode($row["WhenDone"])); 
    
    $node->appendChild( $whendone); 


    $whendue = $doc->createElement( "WhenDue" ); 
  
    $whendue->appendChild($doc->createTextNode($row["WhenDue"])); 
    



    $node->appendChild( $whendue); 
  
    $root->appendChild ($node);
  
  }
  
  mysqli_close($connection);
  
  echo $doc->saveXML();


?>  
