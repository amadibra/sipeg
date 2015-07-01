<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>LAPORAN PELAKSANAAN PENUGASAN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <link href="styles.css" rel="stylesheet" type="text/css" />
  

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
  <div class="col-md-5 col-md-offset-2"><b style="font-size:20px">LAPORAN PELAKSANAAN PENUGASAN</b></div>
</div>

<br>
<?php
echo '<form class="form-horizontal" method="post" action="insert_laporan_pelaksanaan.php?session='.$session.'">';
?>

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

$sql2 = "SELECT plt FROM wig where nipeg = '$user2'";
$result2 = $conn->query($sql2); 
echo '<div class="form-group">';
	echo '<div class="col-sm-3">';
      echo '<label for="sel1">PLT:</label>';
      echo '<p class="form-control-static">';
	  if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        $jabatan = $row["plt"];
    }
	echo $jabatan;
		  echo '</p>';
	  echo '</div>';
	  echo	'</div>';
}

$sql2 = "SELECT * FROM laporan_pelaksanaan where nipeg = '$user'";
$result2 = $conn->query($sql2); 
	  if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {

print'
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 text-left">JUDUL :</label>
</div>

 <div class="form-group">
    <div class="col-sm-5" >';
echo '<p class="form-control-static">'.$row["judul"].' </p></div></div>';


echo '<br>';

print'
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 text-left">ABSTRAK :</label>
</div>

 <div class="form-group">
    <div class="col-sm-5">';
echo '<p class="form-control-static">'.$row["abstrak"].' </p></div></div><br>';

print'
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 text-left">LATAR BELAKANG :</label>
</div>

 <div class="form-group">
    <div class="col-sm-5">';
echo '<p class="form-control-static">'.$row["latar_belakang"].' </p></div></div><br>';

print'
 <div class="form-group">
    <label for="inputEmail3" class="col-md-4 text-left">LAPORAN PENCAPAIAN WIG DAN LAG MEASURE :</label>
</div>

 <div class="form-group">
    <div class="col-sm-5">';
echo '<p class="form-control-static">'.$row["laporan_pencapaian"].' </p></div></div><br>';

print'
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 text-left">USULAN DAN REKOMENDASI :</label>
</div>

 <div class="form-group">
    <div class="col-sm-5">';
echo '<p class="form-control-static">'.$row["usulan_rekomendasi"].' </p></div></div>';	
		
    }
}

$sql = "SELECT feedback FROM laporan_pelaksanaan where nipeg = '$user2'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
	echo '<div class="form-group">';
	echo '<div class="col-sm-5">';
    echo '<label for="exampleInputName2">Feedback :  </label><br>';
	echo $row['feedback'];
	echo '</div>';
	echo '</div>';

    }
} else {
    echo "0 results";
}

$status = null;  
$sql = "SELECT status FROM laporan_pelaksanaan where nipeg = '$user2'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
	if($row["status"] == 0)
	{
		echo '<div id="tombol">';
		echo '<button type="submit" class="btn btn-warning" name="tombol1" value="1" disabled="disabled">Belum Disetujui</button>';
		echo '</div>';
	}
	else{
		echo '<div id="tombol">';
		echo '<button type="submit" class="btn btn-success" name="tombol1" value="0" disabled="disabled">Disetujui</button>';
		echo '</div>';
	}

    }
} else {
      echo '<div id="tombol">';
		echo '<button type="submit" class="btn btn-warning" name="tombol1" value="1" disabled="disabled">Belum Disetujui</button>';
	echo '</div>';
}

  $conn->close();
?>

<br>

<!--div class="form-group">
<div class="col-sm-5">
    <label for="exampleInputName2">Nomor Induk Pegawai</label>
	
    <input type="text" class="form-control" id="exampleInputName2" placeholder="Nipeg Anda" name="nipeg">
	</div>
  </div-->
  
  <input type="submit" name="Submit" value="Next" />
  
</form>
</div>

</div>
</div>
</body>
<script>
var nomor = 4;
function add() 
{
		$("#tambah").append(' <div class="form-group"><label for="inputEmail3" class="col-sm-2 control-label"> '+nomor+' :</label><div class="col-sm-5" ><textarea type="text" class="form-control" placeholder="Text input" name="lmw1'+nomor+'"></textarea></div></div>');		
	nomor++;
}
var nomor2 = 4;
function add2() 
{
		$("#tambah2").append(' <div class="form-group"><label for="inputEmail3" class="col-sm-2 control-label"> '+nomor2+' :</label><div class="col-sm-5" ><textarea type="text" class="form-control" placeholder="Text input" name="lmw2'+nomor2+'"></textarea></div></div>');		
	nomor2++;
}		
</script>
</html>