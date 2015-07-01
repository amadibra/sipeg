<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Formulir Penilaian Mentor </title>
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
<div class='col-sm-8'><center><b style="font-size:20px">Formulir Penilaian Mentor </b></center></div>
</div>

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
print '<div class="row">
  <div class="col-md-6 col-md-offset-1">'; 
echo '<div class="col-xs-7 spacer2"></div>';
print '<table style="width:100%; align:center;">
  <tr>
	<th>NO.</th>
    <th>ASPEK PENILAIAN KINERJA</th>		
    <th>Triwulan 1</th>
	<th>Triwulan 2</th>
  </tr>';
  
  
$pekan = 1;
$sql2 = "select * from kompetensi_supervisor where nipeg_plt = '$user'";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
	$produktivitas = ($row["a1"] + $row["a2"] + $row["a3"] + $row["a4"] + $row["a5"] + $row["a6"])/6;
	$sikap_profesional = ($row["a7"] + $row["a8"] + $row["a9"] + $row["a10"] + $row["a11"] + $row["a12"])/6;
	$kemampuan_diri = ($row["a13"] + $row["a14"] + $row["a15"] + $row["a16"] + $row["a17"])/5;
	$komunikasi = ($row["a18"] + $row["a19"] + $row["a20"] + $row["a21"] + $row["a22"] + $row["a23"])/6;
	$continous_learning = ($row["a24"] + $row["a25"] + $row["a26"] + $row["a27"])/4;
	$kepemimpinan = ($row["a28"] + $row["a29"] + $row["a30"] + $row["a31"] + $row["a32"] + $row["a33"])/6;
	
	print'
	<tr>
		<td>Minggu ke - '.$pekan.'</td>
		<td> '.$produktivitas.' </td>
		<td> '.$sikap_profesional.' </td>
		<td> '.$kemampuan_diri.' </td>
		<td> '.$komunikasi.' </td>
		<td> '.$continous_learning.' </td>
		<td> '.$kepemimpinan.' </td>
	</tr>';
	$pekan = $pekan + 1;
	
    }
}
echo '</table>';
print '</div></div>';

$conn->close();
?>

</div>
</div>
</div>
</body>
</html>