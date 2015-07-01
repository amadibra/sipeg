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

$sql .= "INSERT INTO penilaian_kinerja (pekan,nipeg_plt, nipeg_pengisi)
    VALUES ('$pekan','$user2','$user');";
	
for($i=1;$i<=33;$i++)
{
	$tmp1 = (string)"a".$i;
	$a1 = $$tmp1;
	$tmp2 = (string)"feedback_a".$i;
	$catatan_1 = $$tmp2;
	$sql .= "UPDATE penilaian_kinerja SET a".$i."='$a1' WHERE nipeg_plt='$user2' AND nipeg_pengisi='$user' AND pekan='$pekan';";
	$sql .= "UPDATE penilaian_kinerja SET catatan_".$i."='$catatan_1' WHERE nipeg_plt='$user2' AND nipeg_pengisi='$user' AND pekan='$pekan';";
}

if ($conn->multi_query($sql) === TRUE) {
   // echo "New record created successfully";
   header("Location: info-pegawai.php?session=$session");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>