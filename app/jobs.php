<?

include 'db_connect.php';

$query_get = "select * from Job";

echo $query_get;
$results = $connection->query ($query_get);

$num_results = mysqli_num_rows($results);
echo "xx". $num_results;

for ($i = 0; $i < $num_results; $i++) {
   while( $row = mysqli_fetch_array($results)){

       $jobId = $row["jobId"];

       echo"xx". $jobid;
   }



}