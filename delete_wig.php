<?php
include "inc/config.inc.php";
include "inc/function.inc.php";
include "inc/tools.inc.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbsipeg";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql2 = "select user from session where session='$session'";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
	$user = $row["user"];
    }
}

$sql .= "DELETE FROM wig WHERE nipeg='$user';";
$sql .= "DELETE FROM lagmeasure1 WHERE nipeg='$user';";
$sql .= "DELETE FROM lagmeasure2 WHERE nipeg='$user';";


if ($conn->multi_query($sql) === TRUE) {
   // echo "New record created successfully";
   header("Location: Form_PLT.php?session=$session");
   //header("Location: info-pegawai.php?session=$session");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>