<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Form Pengukuran Kompetensi 360 PLT Deputi Manajer</title>
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

  <div class='col-sm-8'><center><b style="font-size:20px">Form Pengukuran Kompetensi 360 PLT Deputi Manajer</b></center></div>

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
$sql2 = "select triwulan from kompetensi_dm where nipeg_plt = '$user2' AND nipeg_pengisi='$user'";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
	$triwulan = $row["triwulan"] +1;
    }
}
else{
	$triwulan = 1;
}
echo '<div class="row"><div class="col-md-4 col-md-offset-3"><b style="font-size:15px">Triwulan Ke - '.$triwulan.'</b></div></div>';
$conn->close();
?>
<?php
echo '<form class="form-horizontal" method="post" action="insert_kompetensi_dm.php?session='.$session.'&user2='.$user2.'&triwulan='.$triwulan.'">';
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
    <label for="inputEmail3" class="control-label">ACHIEVEMENT ORIENTATION :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 1. Ketika target kinerja tidak tercapai, ybs mampu melakukan proses evaluasi dan menetapkan strategi pencapaian kinerja selanjutnya :</label>
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
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 2. Saat terlibat dalam suatu tim kerja, ybs mampu mengembangkan cara-cara pengelolaan pencapaian sasaran kerja yang efektif dan efisien :</label>
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
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 3. Ketika menghadapi tugas dengan tuntutan pekerjaan yang lebih tinggi, ybs mampu menetapkan target organisasi yang visioner melampaui batasan kemampuan organisasi saat ini  :</label>
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
    <label for="inputEmail3" class="control-label spacer2">ANALYTICAL THINKING :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 4. Ketika menghadapi permasalahan dalam pekerjaan, ybs mampu menyusun alternatif solusi beserta langkah antisipasinya  :</label>
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
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 5. Ketika tim kerjanya menghadapi hambatan dalam pekerjaan, ybs mampu menyusun tindakan sebagai bagian dari pengembangan sistem preventif dan antisipatif  :</label>
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
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 6. Ybs mampu mengkaji faktor internal dan eksternal dalam membuat alternatif solusi permasalahan guna meningkatkan efisiensi di unit  :</label>
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

<div class="form-group">
    <label for="inputEmail3" class="control-label spacer2">CONCERN FOR ORDER :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 7. Ybs mampu membuat prosedur pengendalian setiap bagian & penyelesaian pekerjaan guna memenuhi standar kerja yang tinggi  :</label>
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
<textarea class="form-control" rows="1" name="feedback_a7"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 8. Ketika menghadapi hasil kerja kelompok yang kurang memuaskan, ybs mampu melakukan monitoring proses kerja yang sedang berlangsung untuk menghindari kesalahan yang sama   :</label>
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
<textarea class="form-control" rows="1" name="feedback_a8"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 9. Ybs mampu melakukan monitoring terhadap prosedur kerja dalam menegakkan prosedur kerja di unit  :</label>
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
<textarea class="form-control" rows="1" name="feedback_a9"></textarea>
</div></div>

<div class="form-group">
    <label for="inputEmail3" class="control-label spacer2">CONTINUOUS LEARNING :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 10. Ketika di tempat kerja diterapkan sistem/aplikasi program yang baru, ybs mampu melakukan kajian tentang sistem/aplikasi baru sebelum diterapkan di tempat kerja  :</label>
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
<textarea class="form-control" rows="1" name="feedback_a10"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 11. Setiap kali mendapat tugas baru, ybs mampu membagi (share) hal-hal baru yag didapatkan selama proses penyelesaian tugasnya  :</label>
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
<textarea class="form-control" rows="1" name="feedback_a11"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 12. Ketika menghadapi keterbatasan kesempatan program pelatihan, ybs mampu mengoptimalkan kegiatan knowledge sharing untuk saling berbagi pengetahuan dan pengalaman  :</label>
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
<textarea class="form-control" rows="1" name="feedback_a12"></textarea>
</div></div>

<div class="form-group">
    <label for="inputEmail3" class="control-label spacer2">CUSTOMER SERVICE ORIENTATION :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 13. Ybs mampu membuat langkah penyelesaian yang lebih efektif dalam menyikapi permintaan bantuan dari rekan kerja  :</label>
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
<textarea class="form-control" rows="1" name="feedback_a13"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 14. Dalam mengangai keluhan, ybs mampu merencanakan metode  kerja yang baru untuk mencegah keluhan serupa tidak terjadi lagi.  :</label>
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
<textarea class="form-control" rows="1" name="feedback_a14"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 15. Ybs mampu membuat usulan dan berkoordinasi dengan bidang lain untuk membuat bentuk layanan yang memenuhi harapan pihak terkait dalam rangka meningkatkan kualitas layanan di tempat kerja   :</label>
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
<textarea class="form-control" rows="1" name="feedback_a15"></textarea>
</div></div>

<div class="form-group">
    <label for="inputEmail3" class="control-label spacer2">DEVELOPING OTHERS :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 16. Dalam menghadapi bawahan yang melanggar aturan, ybs mampu memberikan pembinaan dan melakukan tindakan agar permasalahan tersebut tidak terjadi pada bawahan lain  :</label>
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
<textarea class="form-control" rows="1" name="feedback_a16"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 17. Dalam rangka meningkatkan karier bawahan, ybs mampu membuat peta kekuatan dan kelemahan bawahan untuk memenuhi kebutuhan jenjang karir mereka  :</label>
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
<textarea class="form-control" rows="1" name="feedback_a17"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 18. Ybs mampu membuat usulan peningkatan karier bawahan dan melakukan CMC secara rutin dalam rangka mengembangkan bawahannya   :</label>
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
<textarea class="form-control" rows="1" name="feedback_a18"></textarea>
</div></div>

<div class="form-group">
    <label for="inputEmail3" class="control-label spacer2">LEADERSHIP :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 19. Dalam memimpin tim kerja, ybs mampu mengarahkan seluruh bidang untuk bersinergi mencapai sasaran  :</label>
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
<textarea class="form-control" rows="1" name="feedback_a19"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 20. Dalam menjalankan tugas di tempat kerja, ybs mampu mensinergikan seluruh bidang untuk mencapai sasaran  :</label>
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
<textarea class="form-control" rows="1" name="feedback_a20"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 21. Dalam mendorong pencapaian target kinerja, ybs mampu memberikan arahan mengenai strategi yang efektif untuk mencapai sasaran kerja   :</label>
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
<textarea class="form-control" rows="1" name="feedback_a21"></textarea>
</div></div>

<div class="form-group">
    <label for="inputEmail3" class="control-label spacer2">TEAMWORK :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 22. Ketika mendapatkan suatu penugasan baru, ybs mampu melibatkan bidang lain dalam membantu penyelesaian tugas   :</label>
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
<textarea class="form-control" rows="1" name="feedback_a22"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 23. Ketika menyelesaikan permasalahan dalam tim kerja, ybs mampu melibatkan bagian lain dalam menyelesaikan permasalahan tersebut  :</label>
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
<textarea class="form-control" rows="1" name="feedback_a23"></textarea>
</div></div>

 <div class="form-group">
    <label for="inputEmail3" class="control-label" style="max-width:768px; text-align:left; word-wrap: break-word"> 24. Dalam memberikan bantuan kepada rekan kerja, ybs mampu memberikan bantuan sesuai dengan kemampuannya dan mengajak bagian lain untuk membantu   :</label>
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
<textarea class="form-control" rows="1" name="feedback_a24"></textarea>
</div></div>

  <input type="submit" name="Submit" value="Next" />
  
</form>
</div>

</div>
</div>
</body>
</html>