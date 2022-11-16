<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "datastore";

$db = new mysqli($hostname, $username, $password, $dbname);
if ($db->connect_error) {
    die("connect failed");
}