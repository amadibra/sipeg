<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<!--title>SIPeg - Biodata</title-->
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" media="all">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


<style type="text/css">

.spacer {
    margin-top: 40px; /* define margin as you see fit */
}
.spacer2 {
    margin-top: 20px; /* define margin as you see fit */
}
* {
    margin: 0;
}
html, body {
    height: 100%;
}
.wrapper {
    min-height: 100%;
    height: auto !important;
    height: 100%;
    margin: 0 auto -142px; /* the bottom margin is the negative value of the footer's height */
}
.footer, .push {
    height: 142px; /* .push must be the same height as .footer */
}
</style>
</head>
<body>
<div class="wrapper">
<input type='button' class='hidden-print' value='Print' onClick='window.print()'>
<div class="col-xs-5 col-xs-offset-7">Lampiran 4.1</div>
<div class="col-xs-5 col-xs-offset-7">Peraturan Kepala PT PLN (Persero) Pusat Pendidikan dan Pelatihan</div>
<div class="col-xs-5 col-xs-offset-7">Nomor  : 1012 .K/KPUSDIKLAT/2015</div>
<div class="col-xs-5 col-xs-offset-7">Tanggal   : <?php echo date("d M Y") ?> </div>
<br>
<br>
<div class="col-xs-7 spacer"><b>PT PLN (PERSERO)</b></div><div class="col-md-9"> </div>
<div class="col-xs-7"><b>PUSAT PENDIDIKAN DAN PELATIHAN</b></div>
<div class="col-xs-7 col-xs-offset-3 spacer"><center><b>Formulir WorkPlan</b></center></div><div class="col-md-9"> </div>
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
$sql2 = "SELECT plt FROM wig where nipeg = '$nipeg'";
$result2 = $conn->query($sql2); 
echo '<div class="col-xs-7 col-xs-offset-3"><center><b>PLT Deputi Manajer/Supervisor *) ';
	  if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        echo  $row["plt"];
    }
}
echo '</b></center></div><div class="col-md-9"> </div>';



echo '<div class="col-xs-7 col-xs-offset-3"><center><b>Periode**) ……………</b></center></div><div class="col-md-9"> </div>';

echo '<div class="col-xs-7 spacer2"><b>Focus/WIG ***) : </b></div><div class="col-md-9"> </div>';
for($y=1;$y<3;$y++)
{
$sql = "SELECT wig".$y." FROM wig where nipeg = '$nipeg'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo '<div class="col-xs-7">- ';
        echo  $row["wig".$y.""];
		echo '</div>';
    }
} else {
    echo "0 results";
}
}

//echo '<div class="col-xs-12 spacer2"><b>Lag Measure WIG-1 dari keberhasilan kinerja PLT DM/SPV*) ................................ adalah :</b></div><div class="col-md-9"> </div>';
//echo '<div class="col-xs-7 col-xs-offset-1">1  </div>';
//echo '<div class="col-xs-7 col-xs-offset-1">2....................................................................................</div>';
//echo '<div class="col-xs-7 col-xs-offset-1">3....................................................................................</div>';
//echo '<div class="col-xs-7 col-xs-offset-1">4....................................................................................</div>';
//echo '<div class="col-xs-7 col-xs-offset-1">5....................................................................................</div>';

for($y=1;$y<3;$y++)
{
	echo '<div class="col-xs-12 spacer2"><b>Lag Measure WIG-'.$y.' dari keberhasilan kinerja PLT DM/SPV*) ................................ adalah :</b></div><div class="col-md-9"> </div>';
$sql = "SELECT lagmeasure".$y." FROM lagmeasure".$y." where nipeg = '$nipeg'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
	$i = 1;
    while($row = $result->fetch_assoc()) {
		
	echo '<div class="col-xs-7 col-xs-offset-1">'.$i.'  ';
	echo $row["lagmeasure".$y.""];
	echo '</div>';

	$i=$i+1;
    }
} else {
    echo "0 results";
}
}
  

$conn->close();
/*
echo '<div class="form-group">';
echo '<div class="col-sm-5">';
    echo '<label for="exampleInputName2">Nomor Induk Pegawai</label>';
	echo '<p class="form-control-static">';
	echo $user;
	echo '</p>';
	echo '</div>';
  echo '</div>';
  
echo '<div class="form-group">';
echo '<div class="col-sm-5">';
    echo '<label for="exampleInputName2">Feedback :  </label>';
	echo '<textarea class="form-control" rows="3"></textarea>';
	echo '</div>';
  echo '</div>';*/
?>





<!--div class="col-xs-12 spacer2"><b>Lag Measure WIG-2 dari keberhasilan kinerja PLT DM/SPV*) ................................ adalah :</b></div><div class="col-md-9"> </div>
<div class="col-xs-7 col-xs-offset-1">1....................................................................................</div>
<div class="col-xs-7 col-xs-offset-1">2....................................................................................</div>
<div class="col-xs-7 col-xs-offset-1">3....................................................................................</div>
<div class="col-xs-7 col-xs-offset-1">4....................................................................................</div>
<div class="col-xs-7 col-xs-offset-1">5....................................................................................</div-->

<div class="col-xs-12 spacer2">Keterangan :</div><div class="col-md-9"> </div>
<div class="col-xs-7">*) Pilih salah satu</div>
<div class="col-xs-7">**) Diisi 6 (enam) bulanan periode PLT</div>
<div class="col-xs-7">      Contoh : Periode 20 Mei 2015 - 19 November 2015</div>
<div class="col-xs-7">***) Focus/WIG yang ditetapkan 2-3 WIG </div>
<div class="col-xs-7">****) Jabatan tertinggi adalah Manajer</div>

<div class="push"></div>
</div>
<div class="footer">
<div class="col-xs-3 col-xs-offset-6">Pihak Terkait</div>
<div class="col-xs-3">Tanda Tangan</div>
<div class="col-xs-3 col-xs-offset-6 spacer2">1.........................</div>
<div class="col-xs-3 col-xs-offset-6 spacer2">2.........................</div>
<div class="col-xs-3 col-xs-offset-6 spacer2">3.........................</div>
</div>
</body>
</html>