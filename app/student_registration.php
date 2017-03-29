<html>
  <head>  
    <title>Student Registration</title>
  </head>
  <body>
  
  <?php

  if (isset ($_POST["name"])) {
      $name = $_POST["name"];
  }

  if (isset ($_POST["uniemail"])) {
      $uniemail = $_POST["uniemail"];
  }
	if (isset ($_POST["password"])) {
		$password= $_POST["password"];
	}
  
  include 'db_connect.php';

    $query_check = "select * from Student where uniEmail=\"$uniemail\"";

	$results = $connection->query ($query_check);
    
    if (!$results) {
      echo "<p>" . mysql_error() . "</p>";
    }
     
    $num_results = mysqli_num_rows ($results);

    if ($num_results != 0) {
      echo "<p>That user already exists</p>";
      echo "<a href = \"student_login.php\">Student login</a>";
      exit;
    }
    
    $query = "insert into Student (name, password, uniEmail) values (\"$name\", \"$password\",\"$uniemail\")";
    
	$ret = $connection->query ($query);
    

    if (!$ret) {
      echo "<p>Failed registration: " . mysqli_error($connection) . "</p>";
    }
    else {
      $_SESSION["uniemail"] = $uniemail;
      echo "<p>Registration successful</p>";
      echo "<a href = \"student_login.html\"> Student login</a>";
    }
        
  ?>
  
  </body>
</html>  
