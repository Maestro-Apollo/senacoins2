<?php

$host = "localhost:3325"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "datastore2"; /* Database name */

$con = mysqli_connect($host, $user, $password, $dbname);
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}