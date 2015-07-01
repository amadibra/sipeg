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
$sql2 = "select hari from laporan_harian where nipeg = '$user'";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
	$hari = $row["hari"] +1;
    }
}
else{
	$hari = 1;
}
$sql = "INSERT INTO laporan_harian (hari, nipeg, tanggal, rencanakerja_aktivitas, rencanakerja_target, rencanakerja_realisasi, aktivitaskerja_aktivitas, aktivitaskerja_target, aktivitaskerja_realisasi, outcome_aktivitas, outcome_target, outcome_realisasi, keputusan_aktivitas, keputusan_target, keputusan_realisasi, lesson_aktivitas, lesson_target, lesson_realisasi, catatan_aktivitas, catatan_target, catatan_realisasi)
    VALUES ('$hari','$user', '', '$ra', '$rt', '$rr', '$aa', '$at', '$ar', '$oa', '$ot', '$or', '$ka', '$kt', '$kr', '$la', '$lt', '$lr', '$ca', '$ct', '$cr');";

if ($conn->multi_query($sql) === TRUE) {
   // echo "New record created successfully";
   header("Location: info-pegawai.php?session=$session");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>