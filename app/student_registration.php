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


  if(!empty($name) && !empty($email) && !empty($password) && !empty($company)) {
    include 'db_connect.php';

    $query_check = "select * from Student where uniEmail=\"$uniemail\"";

    $results = $connection->query($query_check);

    if (!$results) {
      $response["failed"] = mysql_error($connection);
      echo json_encode($response);
    }

    $num_results = mysqli_num_rows($results);

    if ($num_results != 0) {
      $response["failed"] = 'User Already Exists';
      // echoing JSON response
      echo json_encode($response);
      exit;
    }

    $query = "insert into Student (name, password, uniEmail) values (\"$name\", \"$password\",\"$uniemail\")";

    $ret = $connection->query($query);


    if (!$ret) {
      $json["error"] = mysql_error($connection);
      echo json_encode($json);
    } else {
      $_SESSION["uniemail"] = $uniemail;

      $response["success"] = 'Registration Sucessfull' . "Welcome  " . $email;
      echo json_encode($response);
    }
  }else {

    $response["Empty"] = 'Please provide all Fields';
    echo json_encode($response);
  }
  ?>
  
  </body>
</html>  
