<?php
include "inc/config.inc.php";
include "inc/function.inc.php";
include "inc/tools.inc.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbsipeg";

$selectOption = $_POST['sel1'];
$nipeg = (string)$_POST["nipeg"];
$wig01 = (string)$_POST["wig01"];
$wig02 = (string)$_POST["wig02"];

$b = 1;
$hasil = (string)"lmw1".$b;
while($_POST[$hasil] != null)
{
$$hasil = (string)$_POST["lmw1".$b.""];
$b =$b+1;
$hasil = (string)"lmw1".$b;
}
echo "<br>";
$b = 1;
$hasil = (string)"lmw2".$b;
while($_POST[$hasil] != null)
{
$$hasil = (string)$_POST["lmw2".$b.""];
$b =$b+1;
$hasil = (string)"lmw2".$b;
}


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

$sql = "INSERT INTO wig (nipeg, wig1, wig2, plt)
    VALUES ('$user', '$wig01', '$wig02', '$selectOption');";
$c=1;
$hasil2 = (string)"lmw1".$c;
while($$hasil2 != null)
{
$res = $$hasil2;
$sql .= "INSERT INTO lagmeasure1 (nipeg, lagmeasure1)
	VALUES ('$user','$res');";
	$c = $c+1;
	$hasil2 = (string)"lmw1".$c;
}

$d=1;
$hasil3 = (string)"lmw2".$d;
while($$hasil3 != null)
{
$res2 = $$hasil3;
$sql .= "INSERT INTO lagmeasure2 (nipeg, lagmeasure2)
	VALUES ('$user','$res2');";
	$d = $d+1;
	$hasil3 = (string)"lmw2".$d;
}	


if ($conn->multi_query($sql) === TRUE) {
   // echo "New record created successfully";
   $message = "Formulir Work Plan Berhasil Tersimpan";
echo "<script type='text/javascript'>alert('$message');window.location.href='Form_PLT.php?session=$session';</script>";

   //header("Location: info-pegawai.php?session=$session");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>