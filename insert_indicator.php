<?php
include "inc/config.inc.php";
include "inc/function.inc.php";
include "inc/tools.inc.php";



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbsipeg";

$kuantitas11 = (string)$_POST["kuantitas11"];
$kuantitas12 = (string)$_POST["kuantitas12"];
$kuantitas13 = (string)$_POST["kuantitas13"];

$kuantitas21 = (string)$_POST["kuantitas21"];
$kuantitas22 = (string)$_POST["kuantitas22"];
$kuantitas23 = (string)$_POST["kuantitas23"];

$kualitas11 = (string)$_POST["kualitas11"];
$kualitas12 = (string)$_POST["kualitas12"];
$kualitas13 = (string)$_POST["kualitas13"];

$kualitas21 = (string)$_POST["kualitas21"];
$kualitas22 = (string)$_POST["kualitas22"];
$kualitas23 = (string)$_POST["kualitas23"];

$waktu11 = (string)$_POST["waktu11"];
$waktu12 = (string)$_POST["waktu12"];
$waktu13 = (string)$_POST["waktu13"];
$waktu21 = (string)$_POST["waktu21"];
$waktu22 = (string)$_POST["waktu22"];
$waktu23 = (string)$_POST["waktu23"];


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

for($a=1;$a<3;$a++)
{
$sql3 = "SELECT lagmeasure".$a." FROM lagmeasure".$a." where nipeg = '$user'";
$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
    // output data of each row
	$i = 1;
    while($row = $result3->fetch_assoc()) {
	$hasil = (string)"kuantitas".$a.$i;
	$sql .= "UPDATE lagmeasure".$a." SET kuantitas='".$$hasil."' WHERE lagmeasure".$a."='".$row["lagmeasure".$a.""]."';";

	$i=$i+1;
    }
}
}

for($a=1;$a<3;$a++)
{
$sql3 = "SELECT lagmeasure".$a." FROM lagmeasure".$a." where nipeg = '$user'";
$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
    // output data of each row
	$i = 1;
    while($row = $result3->fetch_assoc()) {
	$hasil = (string)"kualitas".$a.$i;
	$sql .= "UPDATE lagmeasure".$a." SET kualitas='".$$hasil."' WHERE lagmeasure".$a."='".$row["lagmeasure".$a.""]."';";

	$i=$i+1;
    }
}
}

for($a=1;$a<3;$a++)
{
$sql3 = "SELECT lagmeasure".$a." FROM lagmeasure".$a." where nipeg = '$user'";
$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
    // output data of each row
	$i = 1;
    while($row = $result3->fetch_assoc()) {
	$hasil = (string)"waktu".$a.$i;
	$sql .= "UPDATE lagmeasure".$a." SET waktu='".$$hasil."' WHERE lagmeasure".$a."='".$row["lagmeasure".$a.""]."';";

	$i=$i+1;
    }
}
}
	if ($conn->multi_query($sql) === TRUE) {
		   $message = "Formulir Timeline Target Kinerja Berhasil Tersimpan";
echo "<script type='text/javascript'>alert('$message');window.location.href='Form_PLT42.php?session=$session';</script>";
		//header("Location: info-pegawai.php?session=$session");
   } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	

$conn->close();

?>