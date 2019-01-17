<?php

/*
  $dbhost = 'localhost:3036';
  $dbuser = 'id6257739_tracker';
  $dbpass = 'tracker';
  $db="tracker";
 */

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$db = "tracker";

$table_name = "grp_cropbalancesheet_balance";
$backup_file = "C:/xamppnew/htdocs/projects/tracker/dbbackup/cropbalanceshee.sql";


$con = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$table_name = "grp_cropbalancesheet_balance";
$sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";
if (!mysqli_query($con, $sql)) {
    echo("Error description: " . mysqli_error($con));
}


mysqli_close($con);
