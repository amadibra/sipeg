<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Form Pengukuran Penilaian Kinerja PLT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <link href="styles.css" rel="stylesheet" type="text/css" />
  
  <style type="text/css">

.spacer {
    margin-top: 50px; /* define margin as you see fit */
}
.spacer2 {
    margin-top: 80px; /* define margin as you see fit */
}
.wrap {

	word-wrap: break-word;
}
</style>

</head>
<body>
<div id="bg">
<div id= "main">

<div id="header">	
	<div id="logo">
	  <h1><a href="http://www.pln.co.id">PT. PLN (Persero) </a> </h1>
	  <h2><a href="https://simdiklat.pln-pusdiklat.co.id/portal/"> Pusat Pendidikan dan Pelatihan </a></h2>
	</div>
</div>

        <div id="buttons">
		<ul>
		
		
	<?
include "inc/config.inc.php";
include "inc/function.inc.php";
include "inc/tools.inc.php";


$act = "Informasi Pegawai";
if(!ceksession($session, $act)) header("Location: errorsession.htm");
/* cari nipeg pengunjung */
$sql = "select user from $tbl_session where session='$session'";
$q = mysql_query($sql);
list($user) = mysql_fetch_row($q);

$sql1 = "select kd_posisi from $tbl_bio01 where nipeg='$user'";
$q1 = mysql_query($sql1);
list($kd_posisi) = mysql_fetch_row($q1);

		
		print "
			<li class=first><a href=info-pegawai.php?session=$session>Awal</a></li>
			<li><a href=daftar-pegawai.php?session=$session>Daftar Pegawai</a></li>
			<li><a href=cek-pegawai.php?session=$session&nipeg=$user&pos=$kd_posisi>Biodata</a></li>
			<li><a href=ubah-data.php?session=$session>Koreksi Data</a></li>
			<li><a href=Dozir.php?session=$session>Lihat Dosir</a></li>
			<li><a href=Input_Restitusi.php?session=$session>Input Restitusi</a></li>
					<li class='dropdown'>
      <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Menu 1 <span class='caret'></span></a>
      <ul class='dropdown-menu'>
        <li><a href='#' style='color:black'>Form 4.1</a></li>
        <li><a href='#' style='color:black'>Form 4.2</a></li>                        
      </ul>
			</li>
			";
			
/* cari nipeg pengunjung */
$sql = "select user from $tbl_session where session='$session'";
$q = mysql_query($sql);
list($nipeg) = mysql_fetch_row($q);
/* cek apakah pengunjung adalah admin atau bukan */
$sql = "select nipeg from $tbl_admin where nipeg='$nipeg'";
$q = mysql_query($sql);
list($adadata) = mysql_fetch_row($q);
/* apabila admin, tambahan menu baru */
$sql = "select nipeg from admin_dosir where nipeg like '$adadata'";
$q = mysql_query($sql);
list($cek_nipeg) = mysql_fetch_row($q);

$sql = "select nipeg from super_admin where nipeg like '$adadata'";
$q = mysql_query($sql);
list($super) = mysql_fetch_row($q);

if($super != '') {
  print "	  
				   <li><a href=daftar-pesan.php?session=$session>Daftar Pesan</a></li>
				   <li><a href=importSAP.php?session=$session>Import Data dari SAP</a></li>
				  
		   		";
		}
if($cek_nipeg != ''){		
		 print "	  
				  <li><a href=inputdozir1.php?session=$session>Input Dosir</a></li>
		   		";
		}
		
print "	
			<li><a href=logout.php?session=$session>Keluar</a></li>
			
			
			";
			
			
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
$sql2 = "SELECT nipeg FROM wig WHERE nipeg = '$user'";
$result = mysqli_query($conn, $sql2);

if ($result->num_rows > 0) {
	//header("Location: Form_PLT3.php?session=$session&user2=$user");
    // output data of each row
   // while($row = $result->fetch_assoc()) {
   //     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    //}
} else {
    //echo "0 results";
}

$sql2 = "SELECT kd_posisi FROM bio01 WHERE nipeg = '$user'";
$result = mysqli_query($conn, $sql2);

if ($result->num_rows > 0) {
	//header("Location: Form_PLT2.php?session=$session");
    while($row = $result->fetch_assoc()) {
		$posisi = $row["kd_posisi"];
		$posisi = str_replace(" ","",$posisi);
}
} else {
    //echo "0 results";
}

$sql2 = "SELECT wig.nipeg, bio01.kd_posisi
FROM bio01
INNER JOIN wig
ON bio01.nipeg=wig.nipeg;
";
$result = mysqli_query($conn, $sql2);

if ($result->num_rows > 0) {
	//header("Location: Form_PLT2.php?session=$session");
	while($row = $result->fetch_assoc()) {
		$nama = $row["kd_posisi"];
		$array = str_split($nama);
		$num_digits = strlen($array);
		$jumlah ="";
		for($i=0;$i<$num_digits;$i++)
		{
			$jumlah .= $array[$i]; 
		}

			$pengisi = $row["nipeg"]; 

		if($jumlah == $posisi)
	{
			//header("Location: Form_PLT2.php?session=$session&user2=$pengisi");
	}
	else{}
	}
} else {
    
}

			?>			
			
		</ul></div>
		
		
<div class="container">
<br>
<div class="row">

  <div class='col-sm-8'><center><b style="font-size:20px">Form Pengukuran Penilaian Kinerja PLT</b></center></div>

</div>

<br>
<?php

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
$sql2 = "select pekan from penilaian_kinerja where nipeg_plt = '$user2' AND nipeg_pengisi='$user'";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
	$pekan = $row["pekan"] +1;
    }
}
else{
	$pekan = 1;
}
echo '<div class="row"><div class="col-md-4 col-md-offset-3"><b style="font-size:15px">Minggu Ke - '.$pekan.'</b></div></div>';
$conn->close();
?>
<?php
echo '<form class="form-horizontal" method="post" action="insert_penilaian_kinerja.php?session='.$session.'&user2='.$user2.'&pekan='.$pekan.'">';
?>

<?php echo '<div class="form-group">';
echo '<div class="col-sm-5">';
    echo '<label for="exampleInputName2">Nomor Induk Pegawai PLT</label>';
	echo '<p class="form-control-static">';
	echo $user2;
	echo '</p>';
	echo '</div>';
  echo '</div>';
  echo '<div class="form-group">';
echo '<div class="col-sm-5">';
    echo '<label for="exampleInputName2">Nomor Induk Pegawai Pengisi</label>';
	echo '<p class="form-control-static">';
	echo $user;
	echo '</p>';
	echo '</div>';
  echo '</div>';?>
	  
 <div class="form-group">
    <label for="inputEmail3" class="control-label">PRODUKTIVITAS :</label>
</div>


 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 1. PLT dapat mencapai hasil kerja sesuai yang diharapkan.:</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a1" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a1" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a1" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a1" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a1" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a1" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a1" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a1" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a1" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a1" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_a1"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 2. PLT mampu memberikan kepuasan kepada pelanggannya.:</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a2" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a2" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a2" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a2" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a2" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a2" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a2" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a2" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a2" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a2" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_a2"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 3. PLT mampu menunjukkan kerja secara cerdas :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a3" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a3" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a3" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a3" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a3" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a3" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a3" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a3" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a3" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a3" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_a3"></textarea>
</div></div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 4. PLT mempunyai inisiatif dan tanggungjawab dalam menyelesaikan tugas :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a4" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a4" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a4" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a4" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a4" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a4" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a4" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a4" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a4" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a4" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_a4"></textarea>
</div></div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 5. PLT mampu merencanakan dan mengorganisasikan secara efektif :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a5" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a5" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a5" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a5" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a5" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a5" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a5" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a5" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a5" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a5" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_a5"></textarea>
</div></div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 6. PLT mampu memanfaatkan waktu kerja, peralatan dan material secara tepat:</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a6" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a6" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a6" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a6" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a6" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a6" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a6" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a6" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a6" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a6" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_a6"></textarea>
</div></div>
<br>
<div class="form-group">
    <label for="inputEmail3" class="control-label spacer2">SIKAP PROFESIONAL :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 7. PLT mampu mengaplikasikan hasil pelatihan teknis / ilmiah / professional :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a7" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a7" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a7" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a7" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a7" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a7" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a7" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a7" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a7" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a7" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_b7"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 8. PLT mampu mengaplikasikan pengalaman kerjanya dengan cara yang konstruktif .:</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a8" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a8" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a8" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a8" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a8" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a8" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a8" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a8" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a8" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a8" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_b8"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 9. PLT terdorong bertindak melebihi yang dibutuhkan oleh pekerjaan / lingkungan. :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a9" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a9" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a9" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a9" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a9" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a9" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a9" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a9" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a9" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a9" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_b9"></textarea>
</div></div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 10. PLT mampu melakukan sesuatu tanpa menunggu perintah :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a10" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a10" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a10" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a10" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a10" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a10" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a10" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a10" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a10" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a10" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_b10"></textarea>
</div></div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 11. PLT mampu memperbaiki dan meningkatkan hasil pekerjaan :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a11" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a11" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a11" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a11" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a11" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a11" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a11" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a11" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a11" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a11" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_b11"></textarea>
</div></div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 12. PLT mampu menghindari timbulnya masalah dan menciptakan peluang baru:</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a12" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a12" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a12" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a12" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a12" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a12" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a12" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a12" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a12" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a12" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_b12"></textarea>
</div></div>
<div class="form-group">
    <label for="inputEmail3" class="control-label spacer2">KEMAMPUAN DIRI :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 13. PLT mampu membuat keputusan yang tepat :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a13" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a13" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a13" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a13" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a13" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a13" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a13" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a13" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a13" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a13" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_c13"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 14. PLT mempunyai daya cipta dalam memperbaiki situasi dan menghilangkan hal-hal yang tidak diperlukan.:</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a14" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a14" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a14" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a14" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a14" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a14" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a14" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a14" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a14" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a14" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_c14"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 15. PLT mampu memformulasikan gagasan baru.  :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a15" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a15" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a15" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a15" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a15" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a15" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a15" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a15" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a15" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a15" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_c15"></textarea>
</div></div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 16. PLT mampu memanfaatkan fakta-fakta dari pengalaman sebelumnya  :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a16" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a16" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a16" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a16" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a16" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a16" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a16" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a16" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a16" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a16" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_c16"></textarea>
</div></div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 17. PLT mampu untuk memperbaiki metode, probis, prosedur, instruksi kerja :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a17" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a17" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a17" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a17" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a17" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a17" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a17" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a17" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a17" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a17" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_c17"></textarea>
</div></div>

<div class="form-group">
    <label for="inputEmail3" class="control-label spacer2">KOMUNIKASI :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 18. PLT mempunyai inisiatif  :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a18" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a18" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a18" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a18" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a18" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a18" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a18" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a18" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a18" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a18" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_d18"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 19. PLT mampu berkomunikasi dengan jelas dan ringkas :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a19" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a19" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a19" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a19" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a19" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a19" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a19" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a19" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a19" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a19" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_d19"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 20. PLT mampu membuat laporan tertulis.  :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a20" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a20" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a20" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a20" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a20" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a20" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a20" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a20" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a20" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a20" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_d20"></textarea>
</div></div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 21. PLT mampu meyakinkan, mempengaruhi atau mengesankan orang lain  :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a21" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a21" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a21" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a21" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a21" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a21" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a21" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a21" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a21" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a21" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_d21"></textarea>
</div></div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 22. PLT punya keinginan untuk mengajarkan atau mendorong pengembangan orang lain. :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a22" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a22" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a22" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a22" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a22" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a22" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a22" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a22" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a22" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a22" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_d22"></textarea>
</div></div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label wrap text-left" style="max-width:768px; text-align:left; word-wrap: break-word"> 23. PLT mampu untuk memahami dan mendengarkan hal – hal yang tidak diungkapkan dengan perkataan bisa berupa pemahaman atas perasaan, keinginan atau pemikiran dari orang lain.:</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a23" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a23" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a23" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a23" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a23" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a23" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a23" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a23" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a23" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a23" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_d23"></textarea>
</div></div>
  
<div class="form-group">
    <label for="inputEmail3" class="control-label spacer2">CONTINUOUS LEARNING :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 24. PLT mampu mengikuti saran-saran penyempurnaan yang telah dibuat selama evaluasi sebelumnya.  :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a24" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a24" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a24" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a24" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a24" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a24" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a24" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a24" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a24" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a24" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_e24"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 25. PLT peduli terhadap pekerjaannya  :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a25" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a25" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a25" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a25" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a25" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a25" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a25" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a25" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a25" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a25" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_e25"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 26. PLT terdorong  untuk bekerja dengan lebih baik atau diatas standard.  :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a26" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a26" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a26" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a26" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a26" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a26" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a26" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a26" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a26" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a26" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_e26"></textarea>
</div></div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 27. PLT mampu memastikan /mengurangi ketidakpastian pekerjaan.  :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a27" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a27" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a27" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a27" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a27" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a27" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a27" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a27" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a27" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a27" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="aeedback_e27"></textarea>
</div></div>

<div class="form-group">
    <label for="inputEmail3" class="control-label spacer2">KEPEMIMPINAN :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 28. PLT mampu menunjukkan kinerjanya dalam bidang bidang perencanaan, pengorganisasian, pengendalian, pengarahan dan pendelagasian dengan baik  :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a28" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a28" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a28" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a28" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a28" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a28" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a28" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a28" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a28" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a28" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="aeedback_f28"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 29. PLT mampu menyelesaikan tanggung jawabnya dengan baik :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a29" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a29" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a29" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a29" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a29" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a29" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a29" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a29" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a29" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a29" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="aeedback_f29"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 30. PLT mampu untuk memahami situasi pekerjaan  :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a30" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a30" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a30" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a30" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a30" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a30" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a30" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a30" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a30" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a30" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="aeedback_f30"></textarea>
</div></div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 31. PLT mampu mengamati akibat suatu keadaan tahap demi tahap berdasarkan pengalaman masa lalu.  :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a31" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a31" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a31" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a31" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a31" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a31" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a31" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a31" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a31" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a31" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="aeedback_f31"></textarea>
</div></div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label"> 32. PLT mempunyai keyakinan untuk menyelesaikan suatu tugas / tantangan :</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a32" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a32" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a32" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a32" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a32" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a32" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a32" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a32" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a32" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a32" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="aeedback_f32"></textarea>
</div></div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label wrap text-left" style="max-width:768px; text-align:left; word-wrap: break-word"> 33. PLT mempunyai kemampuan untuk memerintah dan mengarahkan orang lain untuk melakukan sesuatu sesuai posisi dan kewenangannya:</label>
</div>
<div class="col-sm-12" >
<label class="radio-inline">
  <input type="radio" name="a33" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="a33" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="a33" id="inlineRadio3" value="3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="a33" id="inlineRadio3" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="a33" id="inlineRadio3" value="5"> 5
</label>
<label class="radio-inline">
  <input type="radio" name="a33" id="inlineRadio3" value="6"> 6
</label>
<label class="radio-inline">
  <input type="radio" name="a33" id="inlineRadio3" value="7"> 7
</label>
<label class="radio-inline">
  <input type="radio" name="a33" id="inlineRadio3" value="8"> 8
</label>
<label class="radio-inline">
  <input type="radio" name="a33" id="inlineRadio3" value="9"> 9
</label>
<label class="radio-inline">
  <input type="radio" name="a33" id="inlineRadio3" value="10"> 10
</label>
</div>
<div class="form-group spacer"><div class="col-sm-5">
<textarea class="form-control" rows="1" name="feedback_f33"></textarea>
</div></div>

  <input type="submit" name="Submit" value="Next" />
  
</form>
</div>

</div>
</div>
</body>
</html>