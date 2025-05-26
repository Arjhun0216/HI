<?php
$servername = "localhost";
$username = "root";
$password = "1711104@gceb!!";
$dbname = "db_admission";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search_word = $conn->real_escape_string($_POST['search_word']);
$replace_word = $conn->real_escape_string($_POST['replace_word']);

$sql = "UPDATE student SET class = REPLACE(class, '$search_word', '$replace_word')";

if ($conn->query($sql) === TRUE) {
    echo "**Word replaced successfully**.";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
