<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>SIPeg - Informasi Pegawai</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<link href="styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style2 {color: #000000}
.style3 {color: #FFFFFF}
.style5 {color: #FFFFFF; font-weight: bold; }
-->
</style>
</head>
<body>
<div id="bg">
<div id="main">
<!-- header begins -->
<div id="header">	
	<div id="logo">
	  <h1><a href="http://www.pln.co.id">PT. PLN (Persero) </a> </h1>
	  <h2><a href="https://simdiklat.pln-pusdiklat.co.id/portal/"> Pusat Pendidikan dan Pelatihan </a></h2>
	</div>
</div>

        <div id="buttons">
		<ul>
		
		
	<?
	
				print "
			<li class=first><a href=info-pegawai.php?session=$session>Awal</a></li>
			<li><a href=daftar-pegawai.php?session=$session>Daftar Pegawai</a></li>
			<li><a href=cek-pegawai.php?session=$session&nipeg=$user&pos=$kd_posisi>Biodata</a></li>
			<li><a href=ubah-data.php?session=$session>Koreksi Data</a></li>
			<li><a href=Dozir.php?session=$session>Lihat Dosir</a></li>
			<li><a href=Input_Restitusi.php?session=$session>Input Restitusi</a></li>
			";
			
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

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbsipeg";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql2 = "SELECT nipeg FROM plt";
$result = mysqli_query($conn, $sql2);

if ($result->num_rows > 0) {
	//header("Location: Form_PLT2.php?session=$session");
    while($row = $result->fetch_assoc()) {
		$nipeg = $row["nipeg"];
		if($nipeg == $user)
		{
			print "<li class='dropdown'>
			<a class='dropdown-toggle' data-toggle='dropdown' href='#'>Hasil Evaluasi PLT <span class='caret'></span></a>
			<ul class='dropdown-menu'>
			<li><a href='List_Evaluasi_Atasan.php?session=$session' style='color:black'>Penilaian Mentor</a></li>
			<li><a href='List_Evaluasi_360.php?session=$session' style='color:black'>Penilaian 360</a></li>
			</ul>
			</li>";
			
			print "<li class='dropdown'>
			<a class='dropdown-toggle' data-toggle='dropdown' href='#'>Form_PLT <span class='caret'></span></a>
			<ul class='dropdown-menu'>
			<li><a href='Form_PLT.php?session=$session' style='color:black'>Form 4.1</a></li>
			<li><a href='Form_PLT42.php?session=$session' style='color:black'>Form 4.2</a></li>
			<li><a href='Form_PLT43.php?session=$session' style='color:black'>Form 4.3</a></li> 
			<li><a href='Form_PLT44.php?session=$session' style='color:black'>Form 4.4</a></li> 
			<li><a href='Form_PLT45.php?session=$session' style='color:black'>Form 4.5</a></li> 
			</ul>
			</li>";
		}
}
} else {}

$sql2 = "SELECT kd_posisi FROM bio01 WHERE nipeg = '$user'";
$result = mysqli_query($conn, $sql2);

if ($result->num_rows > 0) {
	//header("Location: Form_PLT2.php?session=$session");
    while($row = $result->fetch_assoc()) {
		$posisi = $row["kd_posisi"];
		$posisi = str_replace(" ","",$posisi);
}
} else {}
$sql2 = "SELECT plt.nipeg, bio01.kd_posisi, plt.plt
FROM bio01
INNER JOIN plt
ON bio01.nipeg=plt.nipeg;
";
$result = mysqli_query($conn, $sql2);

if ($result->num_rows > 0) {
	print "<li class='dropdown'>
			<a class='dropdown-toggle' data-toggle='dropdown' href='#'>Penilaian PLT<span class='caret'></span></a>
			<ul class='dropdown-menu'>";
	while($row = $result->fetch_assoc()) {
		$nama = $row["kd_posisi"];
		$nama = str_replace(" ","",$nama);
		$pengisi = $row["nipeg"];
		$plt = $row["plt"];	
		$array = str_split($nama);
		$num_digits = strlen($array);
		$jumlah ="";
		for($i=0;$i<$num_digits;$i++)
		{
			$jumlah .= $array[$i]; 
		}
		if(strpos($nama,$posisi) !== false AND $pengisi!=$user)
	{
			if($plt == "supervisor")
			{
			print 
			"
			<li><a href='Form_PLT51.php?session=$session&user2=$pengisi' style='color:black'>Form 5.1 ".$pengisi."</a></li> 
			<li><a href='Form_PLT56.php?session=$session&user2=$pengisi' style='color:black'>Form 5.6 ".$pengisi."</a></li> 
			";	
			}
			else{
			print "			
			<li><a href='Form_PLT51.php?session=$session&user2=$pengisi' style='color:black'>Form 5.1 ".$pengisi."</a></li> 
			<li><a href='Form_PLT54.php?session=$session&user2=$pengisi' style='color:black'>Form 5.6 ".$pengisi."</a></li> 
			";	
			}
	}
		elseif((strpos($posisi,$nama) !== false OR strpos($posisi,$jumlah) !== false) AND $pengisi!=$user)
		{
			if($plt == "supervisor")
			{
			print 
			"
			<li><a href='Form_PLT56.php?session=$session&user2=$pengisi' style='color:black'>Form 5.6 ".$pengisi."</a></li> 
			";	
			}
			else{
			print "			
			<li><a href='Form_PLT54.php?session=$session&user2=$pengisi' style='color:black'>Form 5.6 ".$pengisi."</a></li> 
			";	
			}
		}
		else {}
	}
} else {
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
			print "
			<li><a href='Form_PLT2.php?session=$session&user2=$pengisi' style='color:black'>Form 4.1 ".$pengisi."</a></li>
			<li><a href='Form_PLT422.php?session=$session&user2=$pengisi' style='color:black'>Form 4.2 ".$pengisi."</a></li>
			";
	}
	else{}
	}
} else {
echo "</ul></li>";}

$sql2 = "SELECT laporan_pelaksanaan.nipeg, bio01.kd_posisi
FROM bio01
INNER JOIN laporan_pelaksanaan
ON bio01.nipeg=laporan_pelaksanaan.nipeg;
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
			print 
			"<li><a href='List_Laporan_Harian2.php?session=$session&user2=$pengisi' style='color:black'>Form 4.3 ".$pengisi."</a></li> 
			<li><a href='List_Laporan_Mingguan2.php?session=$session&user2=$pengisi' style='color:black'>Form 4.4 ".$pengisi."</a></li> 
			<li><a href='Form_PLT452.php?session=$session&user2=$pengisi' style='color:black'>Form 4.5 ".$pengisi."</a></li> ";	
	}
		else{}
	}
} else {
    echo "</ul></li>";
}


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
			?>
			
			
		</ul></div>
		
<!-- header ends -->
<!-- content begins -->
<div id="content_bg">
  <div id="content">
	
       	<div id="left">
			
			<h1>Informasi Pegawai </h1>			
			<p><video width="290" height="240" style="float:right; padding-left: 10px;" controls>
  <source src="images/video_sdm.mp4" type="video/mp4">
  </video> </p>
			<p>Pada halaman ini terdapat berbagai informasi tentang Pegawai. Sehingga memudahkan Pegawai untuk memperoleh informasi tentang data diri, daftar Pegawai yang ada di PT. PLN (Persero) Pusat Pendidikan dan Pelatihan.</p>
			
			<p>&nbsp;</p>
    <table width=59% border=0 cellspacing=0 cellpadding=2 align=center>
  <tr bordercolor="#ECE9D8" bgcolor=#FFFFFF>
    <td colspan=5 align=center><span class="style2"><b>Pegawai yang berulang tahun hari ini</b>
	</span>
      <p class="style2"><img src="images/HappyBirthdayAnimation.gif" alt="" width="372" height="109" style="float:center; padding-left: 0px;"/></p></td>
  </tr>
  <tr bordercolor="#ECE9D8" bgcolor="#666666">
    <td width=5% align=left><span class="style9 style3"><strong>No.</strong></span></td>
    <td align=center><span class="style9 style3"><strong>Nama</strong></span></td>    
    <td align=left><div align="center" class="style3"><span class="style9 "><strong>Jabatan</strong></span></div></td>
	 <td align=center><span class="style5">Foto</span></td>
  </tr>

<?

$tgl_sekarang = date("Y-m-d");
$tgl_sekarang=substr($tgl_sekarang,5);

$urut = 1;
$sql1 = "select nipeg,nama, jabatan,tgl_lahir
         from $tbl_bio01 ";
$q1 = mysql_query($sql1);
while(list($nipeg,$nama, $jabatan, $tgl_lahir) = mysql_fetch_row($q1)) {
 if($urut%2) $warna = "LIGHTGREY" ;
  else $warna = "WHITE";
 $tgl_lahir= substr($tgl_lahir,5);
if ($tgl_lahir == $tgl_sekarang) {
 $nipeg = trim($nipeg, " ");
  $foto = $fotodir.$nipeg.".jpg";
  /* rapihkan tampilan */
   $tgl_lahir = tgl2ind($tgl_lahir);
   print "
  <tr bgcolor=$warna>
    <td align=left valign=top>$urut</td>
    <td align=left valign=top>$nama</td>
    <td align=left valign=top>$jabatan</td>
	  ";

  /* trap nama file foto pegawai */
  if(file_exists($foto)) print "
    <td valign=top><img src=$foto width=50 height=70> </td>
	
  ";
  else print "
    <td align=center>&nbsp;</td>
  ";
  print "
  </tr>
  ";
  $urut++;}
 
}

			  ?>
		  </table>
			  
           	  <p>&nbsp;</p>
           	  <p>&nbsp;</p>
           	  <p>&nbsp;</p>
           	  <p>&nbsp;</p>
           	  <p>&nbsp;</p>
           	  <p>&nbsp;</p>
           	  <p>&nbsp;</p>
       	</div>    
    </div>    
</div>
<!-- content ends -->
<!-- footer begins -->
<div id="footer">
  <p>Copyright  2011. Designed by <a href="../SDMO/Dimas's Blog/index.html" >Dimas - SDMO P3B Jawa Bali </a></p>
	</div>
<!-- footer ends -->
</div>
</div>
</body>
</html>