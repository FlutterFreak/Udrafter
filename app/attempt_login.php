<?php
  session_start();
?>

<html>
  <head>  
    <title>Simple Login</title>
  </head>
  <body>
  
  <?php
	
	if (isset ($_SESSION["username"])) {
		echo "<p>You are already logged in.</p>";
		return;
	}
	
    $username = $_POST["username"];
    $password = $_POST["password"];

  include 'db_connect.php';

    $query = "select * from User where Username="$username"";

	$results = $connection->query ($query);
    
    $num_results = mysqli_num_rows ($results);
  	
  	if ($num_results > 0) {
		$row = mysqli_fetch_array ($results);
		$pass = $row["Password"];

      if ($pass == $password) {
          $_SESSION["username"] = $username;          
          echo "<p>Login successful, ". $_SESSION["username"] . ".  Click <a href = \"front_end.php\">here</a> to go to your Assessment list.</p>";
      }
	  else {
        echo "<p>Invalid login</p>";
        echo "<a href = \"example_login.html\">Try again</a>";
	  }
	}	  
    else {
      echo "<p>Invalid login</p>";
      echo "<a href = \"example_registration.html\">Register</a>";
    }       
  ?>
  
  </body>
</html>  
