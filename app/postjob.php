<?php
session_start();

include 'db_connect.php';
header('Content-type: application/json');
if (isset ($_SESSION["email"])) {
    $email = $_SESSION["email"];

    
}else {

    $json['response']= "Please sign in as Employer to post Jobs";
     echo json_encode($json);
}


    include 'db_connect.php';
    $query_get = "select * from Employer where  email=\"$email\"";

    $results = $connection->query ($query_get);

    $row = mysqli_fetch_array($results);
    $employerId = $row["employerId"];



if (isset ($_POST["title"])) {
$title = $_POST["title"];

}
if (isset ($_POST["description"])) {
$description = $_POST["description"];
} 
if (isset ($_POST["category"])) {
$category= $_POST["category"];
} 
if (isset ($_POST["wages"])) {
$wages= $_POST["wages"];

}
if (isset ($_POST["company"])) {
$company = $_POST["company"];
} 
if (isset ($_POST["location"])) {
$location = $_POST["location"];
} 
if (isset ($_POST["date"])) {
    $date = $_POST["date"];
}
    if (isset ($_POST["jobPic"])) {
        $jobPic = $_POST["jobPic"];

}
echo $jobPic;
     function imageCreateFromAny($jobPic) {
        $type = exif_imagetype($jobPic); //
      $allowedTypes = array(
                       1, // [] gif
                       2, // [] jpeg
                       3, // [] png
                         4,// [] bmp
      );
     if (!in_array($type, $allowedTypes)) {
        return false;
}
  switch($type){
      case 1:
            $im = imageCreateFromGif($jobPic);
      break;
      case 2 :
         $im = imageCreateFromJpeg($jobPic);
      break;
         case 3 :
         $im = imageCreateFromPng($jobPic);
      break;
      case 4 :
            $im = imageCreateFromBmp($jobPic);
     break;
    }
return $im;
     }






$query = "insert into job (employerId, title, description,category, wages, company, location, date, jobPic )
 values($employerId, \"$title\",\"$description\",\"$category\",\"$wages\",\"$company\",\"$location\",\"$date\",\"$jobPic\")";
$ret = $connection->query ($query); 
if (!$ret) {

    $json['failed']= "Failed to post Job:" . mysqli_error($connection);

    echo json_encode($json);

} else{
    $json['success']= "Your Have succesfully posted this job";

    echo json_encode($json);
}



