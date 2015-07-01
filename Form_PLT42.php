<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Formulir Timeline Target Kinerja</title>
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
$sql2 = "SELECT kuantitas FROM lagmeasure1 WHERE nipeg = '$user'";
$result = mysqli_query($conn, $sql2);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		if($row["kuantitas"] != null){
	header("Location: Form_PLT423.php?session=$session&user2=$user");
		}
    // output data of each row
   // while($row = $result->fetch_assoc()) {
   //     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    //}
	}
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
			//header("Location: Form_PLT422.php?session=$session&user2=$pengisi");
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
  <div class="col-md-4 col-md-offset-2"><b style="font-size:20px">Formulir Timeline Target Kinerja</b></div>
</div>
<br>
<?php
echo '<form class="form-horizontal" method="post" action="insert_indicator.php?session='.$session.'">';
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
$sql2 = "SELECT plt FROM wig where nipeg = '$user'";
$result2 = $conn->query($sql2); 
echo '<div class="form-group">';
	echo '<div class="col-sm-3">';
      echo '<label for="sel1">PLT:</label>';
      echo '<p class="form-control-static">';
	  if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        echo  $row["plt"];
    }
}
else{
		$message = "Anda Belum Mengisi Formulir Work Plan";
		echo "<script type='text/javascript'>alert('$message');window.location.href='Form_PLT.php?session=$session';</script>";
	}
	  echo '</p>';
	  echo '</div>';
	  echo	'</div>';
for($y=1;$y<3;$y++)
{
$sql = "SELECT wig".$y." FROM wig where nipeg = '$user'";
$result = $conn->query($sql);

 echo '<div class="form-group">';
 echo '<label class="col-sm-1 control-label">WIG '.$y.' :</label>';
 echo '<div class="col-sm-7">';
 echo '<p class="form-control-static">';
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["wig".$y.""];
    }
} else {
    echo "0 results";
}

 echo '</p>';
 echo '</div>';
 echo '</div>';
 echo '<div class="form-group">';
 echo '<label for="inputEmail3" class="col-sm-2 control-label">Lag Measure WIG '.$y.' :</label>';
 echo '</div>';

$sql = "SELECT lagmeasure".$y." FROM lagmeasure".$y." where nipeg = '$user'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
	$i = 1;
    while($row = $result->fetch_assoc()) {
		
	echo '<div class="form-group">';
    echo '<label for="inputEmail3" class="col-sm-2 control-label">'.$i.':</label>';
    echo '<div class="col-sm-5">';
	echo '<p class="form-control-static">'.$row["lagmeasure".$y.""].' </p>';
	echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group">';
    echo '<label for="inputEmail3" class="col-sm-2 control-label"> Target Kuantitas :</label>';
    echo '<div class="col-sm-5">';
	echo '<textarea type="text" class="form-control" placeholder="" name="kuantitas'.$y.$i.'"></textarea>';
	echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group">';
    echo '<label for="inputEmail3" class="col-sm-2 control-label"> Target Kualitas :</label>';
    echo '<div class="col-sm-5">';
	echo '<textarea type="text" class="form-control" placeholder="" name="kualitas'.$y.$i.'"></textarea>';
	echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group">';
    echo '<label for="inputEmail3" class="col-sm-2 control-label"> Target Waktu :</label>';
    echo '<div class="col-sm-5">';
	echo '<textarea type="text" class="form-control" placeholder="" name="waktu'.$y.$i.'"></textarea>';
	echo '</div>';
	echo '</div>';
	
	$i=$i+1;
    }
} else {
    echo "0 results";
}
  
}
$conn->close();
echo '<div class="form-group">';
echo '<div class="col-sm-5">';
    echo '<label for="exampleInputName2">Nomor Induk Pegawai</label>';
	echo '<p class="form-control-static">';
	echo $user;
	echo '</p>';
	echo '</div>';
  echo '</div>';
  
?>


 <!--div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> 1 :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="Text input">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> 2 :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="Text input">
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> 3 :</label>
    <div class="col-sm-5">
<input type="text" class="form-control" placeholder="Text input">
</div>
</div-->


  
  <input type="submit" name="Submit" value="Next" />

  
</form>
</div>

</div>
</div>
</body>
</html>