<?php
session_start();


if (isset ($_SESSION["email"])) {
    $email = $_SESSION["email"];
echo $email;
include 'db_connect.php';
$query_get = "select * from Employer where  email=\"$email\"";

$results = $connection->query ($query_get);


$row = mysqli_fetch_array($results);

    $name = $row["name"];
    $email = $row["email"];
    $company = $row["company"];
    $profilePic= $row["profilePic"];
    echo "xx" .$name ;
}

?>


 <table width="398" border="0" align="center" cellpadding="0">
    <tr>
        <td height="26" colspan="2">Your Profile Information </td>
        <td><div align="right"><a href="logout.php">logout</a></div></td>
    </tr>
    <tr>
        <td width="129" rowspan="5"><img src="<?php echo $profilePic ?>" width="129" height="129" alt="no image found"/></td>
        <td width="82" valign="top"><div align="left">Name:</div></td>
        <td width="165" valign="top"><?php echo $name ?></td>
    </tr>
    <tr>
        <td valign="top"><div align="left">Email:</div></td>
        <td valign="top"><?php echo $email ?></td>
    </tr>
    <tr>
        <td valign="top"><div align="left">Company:</div></td>
        <td valign="top"><?php echo $company ?></td>
    </tr>
    <tr>
        <td valign="top"><div align="left">Address:</div></td>
        <td valign="top"><?php echo $address ?></td>
    </tr>
    <tr>
        <td valign="top"><div align="left">Contact No.: </div></td>
        <td valign="top"><?php echo $contact ?></td>
    </tr>
</table>
<p align="center"><a href="index.php"></a></p>

