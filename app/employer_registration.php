<?php
session_start();
?>


<?php
// http://udrafter2017.azurewebsites.net
header('Content-type: application/json');

if (isset ($_POST["name"])) {
    $name = $_POST["name"];
}
if (isset ($_POST["email"])) {
    $email = $_POST["email"];
}
if (isset ($_POST["password"])) {
    $password= $_POST["password"];
}
if (isset ($_POST["company"])) {
    $company = $_POST["company"];
}

 if(!empty($name) && !empty($email) && !empty($password) && !empty($company)) {

     $hashed_password = password_hash($password, PASSWORD_DEFAULT); //here i am hashing the password

     include 'db_connect.php';

     $query_check = "select * from Employer where email=\"$email\"";

     $results = $connection->query($query_check);

     if (!$results) {
         $json["error"] = mysql_error();
         echo json_encode($json);
     }

     $num_results = mysqli_num_rows($results);

     if ($num_results = 0) {

         $query = "insert into Employer (name, password, email, company) values (\"$name\", \"$hashed_password\",\"$email\",\"$company\")";

         $ret = $connection->query($query);


         if (!$ret) {

             $json["error"] = mysql_error($connection);
             echo json_encode($json);
         }

         $_SESSION["email"] = $email;

// success

         $response["success"] = 'Registration Sucessfull' . "" . $email;




     } else {

         // user already exists
         // failed
         $response["failed"] = 'User Already Exists';
         // echoing JSON response
         echo json_encode($response);


     }}
 else {
         echo json_encode('Please provide all Fields');
     }


?>


