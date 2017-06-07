<?php
session_start();

session_destroy();
$response["loggedOut"] = 'You have Successfully logged out';
echo json_encode($response);
exit;
?>