<?php
$databaseHost = 'localhost';
$databaseName = 'u559678163_crm';
$databaseUsername = 'u559678163_crmu';
$databasePassword = '!@#123qweasdZXC';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

$conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
	
if(!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>