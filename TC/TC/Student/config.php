<?php
$host_name = "localhost";
$database = "db_admission"; // Change your database name
$username = "root";          // Your database user id 
$password = "1711104@gceb!!";          // Your password

//////// Do not Edit below /////////
try {
$dbo = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?>