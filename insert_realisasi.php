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
$sql2 = "select pekan from realisasi_lagmeasure1 where nipeg = '$user'";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
	$pekan = $row["pekan"] +1;
    }
}
else{
	$pekan = 1;
}
for($a=1;$a<3;$a++)
{
$sql3 = "SELECT lagmeasure".$a." FROM lagmeasure".$a." where nipeg = '$user'";
$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
    // output data of each row
	$i = 1;
    while($row = $result3->fetch_assoc()) {
	$hasilwaktu2 = (string)"realisasi_waktu".$a.$i;
	$hasilkualitas2 = (string)"realisasi_kualitas".$a.$i;
	$hasilkuantitas2 = (string)"realisasi_kuantitas".$a.$i;
	$hasilwaktu = $$hasilwaktu2;
	$hasilkualitas = $$hasilkualitas2;
	$hasilkuantitas = $$hasilkuantitas2;
	$lgmeasure = $row["lagmeasure".$a.""];
	$sql .= "INSERT INTO realisasi_lagmeasure".$a." (pekan, nipeg, lagmeasure".$a.", realisasi_kuantitas,realisasi_kualitas, realisasi_waktu)
	VALUES ('$pekan','$user','$lgmeasure','$hasilkuantitas','$hasilkualitas','$hasilwaktu');";

	$i=$i+1;
    }
}
}

if ($conn->multi_query($sql) === TRUE) {
   // echo "New record created successfully";
   header("Location: info-pegawai.php?session=$session");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>