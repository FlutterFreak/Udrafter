<html>
  <head>  
    <title>Simple Login</title>
  </head>
  <body>
  
  <?php

    
	if (isset ($_POST["username"])) {
		$username = $_POST["username"];
	}

	if (isset ($_POST["password"])) {
		$password= $_POST["password"];
	}

  $host = "eu-cdbr-azure-west-d.cloudapp.net";
  $user = "b46b41d46340e3";
  $pass = "95f0622b";
  $database = "udrafter_db";;

    $connection  = mysqli_connect($host, $user, $pass, $database) 
      or die ("Error is " . $mysqli_error ($connection));  

    $query_check = "select * from User where Username=\"$username\"";

	$results = $connection->query ($query_check);
    
    if (!$results) {
      echo "<p>" . mysql_error() . "</p>";
    }
     
    $num_results = mysqli_num_rows ($results);

    if ($num_results != 0) {
      echo "<p>That username already exists</p>";
      echo "<a href = \"example_login.html\">login</a>";
      exit;
    }
    
    $query = "insert into User (Username, Password) values (\"$username\"
    , \"$password\")";
    
	$ret = $connection->query ($query);
    

    if (!$ret) {
      echo "<p>Failed registration: " . mysqli_error($connection) . "</p>";
    }

    echo "<p>Registration successful</p>";
    echo "<a href = \"example_login.html\">login</a>";
    
        
  ?>
  
  </body>
</html>  
