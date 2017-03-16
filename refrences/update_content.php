<?php
	session_start();

$host = "eu-cdbr-azure-west-d.cloudapp.net";
$user = "b46b41d46340e3";
$pass = "95f0622b";
$database = "udrafter_db";
	$action = 0;
	
	if (!isset ($_SESSION["username"])) {
		header( 'Location: example_login.html' ) ;
		return;
	}
	else {
		$username = $_SESSION["username"];
	}
	
    $connection  = mysqli_connect($host, $user, $pass, $database) 
      or die ("Error is " . $mysqli_error ($connection));  
  
	if (isset ($_GET["description"])) {
		$description = $_GET["description"];
	}

	if (isset ($_GET["due"])) {
		$due= $_GET["due"];
	}

	if (isset ($_GET["action"])) {
		$action = $_GET["action"];
	}
	
	if (isset ($_GET["done"])) {
		$done = $_GET["done"];
	}
	
	if (isset ($_GET["id"])) {
		$id= $_GET["id"];
    }

  
	switch ($action) {
	  case "new":
		$query = "INSERT INTO AssessmentEntry (Username, Description, WhenDue, Done) VALUES ('$username', '$description', '$due', false)";
				
		$ret = $connection->query ($query) or die (mysqli_error ($connection));
		
	  break;
	  case "done":
		$wdone=time();
		echo "<p>Done is $id $done $wdone</p>";
		$query = "UPDATE AssessmentEntry SET Done = '$done', WhenDone = '$wdone' WHERE Username='$username' AND ID='$id'";        
		$ret = $connection->query ($query);
	 
	  break;
	}
  
?>  
