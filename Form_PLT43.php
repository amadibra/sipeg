<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>FORMULIR LAPORAN KINERJA HARIAN PEGAWAI</title>
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
$sql2 = "SELECT nipeg FROM laporan_harian WHERE nipeg = '$user'";
$result = mysqli_query($conn, $sql2);

if ($result->num_rows > 0) {
	//header("Location: List_Laporan_Harian.php?session=$session&user2=$user");
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
  <div class="col-md-6 col-md-offset-1"><b style="font-size:20px">FORMULIR LAPORAN KINERJA HARIAN PEGAWAI</b></div>
</div>
<br>
<?php
echo '<form class="form-horizontal" method="post" action="insert_form_harian.php?session='.$session.'">';
?>
<!--div class="form-group">
	<div class="col-sm-3">
      <label for="sel1">PLT:</label>
      <select class="form-control" id="sel1" name="sel1">
        <option>Supervisor</option>
        <option>Deputi Manajer</option>
      </select>
	  </div>
</div-->
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
$hari = 1;
$sql2 = "select * from laporan_harian where nipeg = '$user'";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
	$hari = $hari +1;
    }
}
echo '<div class="row"><div class="col-md-4 col-md-offset-3"><b style="font-size:15px">Hari Ke - '.$hari.'</b></div></div>';
$conn->close();
?>
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Rencana Kerja :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Aktifitas :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="ra">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Target :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="rt">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Realisasi :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="rr">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Aktifitas Kerja :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Aktifitas :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="aa">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Target :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="at">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Realisasi :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="ar">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Outcome / Product :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Aktifitas :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="oa">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Target :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="ot">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Realisasi :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="or">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Keputusan Yang Diambil :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Aktifitas :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="ka">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Target :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="kt">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Realisasi :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="kr">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Lesson Learned :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Aktifitas :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="la">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Target :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="lt">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Realisasi :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="lr">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Catatan :</label>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Aktifitas :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="ca">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Target :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="ct">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> Realisasi :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="" name="cr">
</div>
</div>

<!--div class="form-group">
<div class="col-sm-5">
    <label for="exampleInputName2">Nomor Induk Pegawai</label>
	
    <input type="text" class="form-control" id="exampleInputName2" placeholder="Nipeg Anda" name="nipeg">
	</div>
  </div-->
  
  <input type="submit" name="Submit" value="Next" />
  
</form>

<?php echo '<a href="List_Laporan_Harian.php?session='.$session.'&user2='.$user.'" class="btn btn-success btn-lg active spacer2 btn-sm" role="button">List Formulir</a>';?>
</div>

</div>
</div>
</body>
</html>