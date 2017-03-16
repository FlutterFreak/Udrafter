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
      $email = $_POST["uniemail"];
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
    
    $query = "insert into Student (name, password, uniEmail) values (\"$name\", \"$password\",\"$email\")";
    
	$ret = $connection->query ($query);
    

    if (!$ret) {
      echo "<p>Failed registration: " . mysqli_error($connection) . "</p>";
    }

    echo "<p>Registration successful</p>";
    echo "<a href = \"student_login.html\"> Student login</a>";
    
        
  ?>
  
  </body>
</html>  
