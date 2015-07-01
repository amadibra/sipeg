<?php
include "inc/config.inc.php";
include "inc/function.inc.php";
include "inc/tools.inc.php";



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbsipeg";

$feedback = (string)$_POST["feedback"];
$status = $_POST["tombol1"];
$feedback_timeline = (string)$_POST["feedback_timeline"];
$status_timeline = $_POST["tombol2"];
$feedback_harian = (string)$_POST["feedback_harian"];
$status_harian = $_POST["tombol3"];
$feedback_realisasi = (string)$_POST["feedback_realisasi"];
$status_realisasi = $_POST["tombol4"];
$feedback_pelaksanaan = (string)$_POST["feedback_pelaksanaan"];
$status_pelaksanaan = $_POST["tombol5"];

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

if($feedback != null || $status!= null)
{
$sql = "UPDATE wig SET feedback='$feedback' WHERE nipeg='$user2';";
$sql .= "UPDATE wig SET status='$status' WHERE nipeg='$user2';";
}
if($feedback_timeline != null || $status_timeline != null)
{
$sql = "UPDATE wig SET feedback_timeline='$feedback_timeline' WHERE nipeg='$user2';";
$sql .= "UPDATE wig SET status_timeline='$status_timeline' WHERE nipeg='$user2';";
}
if($feedback_harian != null || $status_harian!= null)
{
$sql = "UPDATE laporan_harian SET feedback='$feedback_harian' WHERE nipeg='$user2' AND hari='$hari';";
$sql .= "UPDATE laporan_harian SET status='$status_harian' WHERE nipeg='$user2' AND hari='$hari';";
}
if($feedback_realisasi != null || $status_realisasi!= null)
{
$sql = "INSERT INTO feedback_realisasi (pekan, nipeg, feedback, status) VALUES ('$pekan','$user2','$feedback_realisasi','$status_realisasi');";
}
if($feedback_pelaksanaan != null || $status_pelaksanaan!= null)
{
$sql = "UPDATE laporan_pelaksanaan SET feedback='$feedback_pelaksanaan' WHERE nipeg='$user2';";
$sql .= "UPDATE laporan_pelaksanaan SET status='$status_pelaksanaan' WHERE nipeg='$user2';";
}


if ($conn->multi_query($sql) === TRUE) {
   // echo "New record created successfully";
   header("Location: info-pegawai.php?session=$session");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>