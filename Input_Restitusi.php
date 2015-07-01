<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>SIPeg - Informasi Pegawai</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
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
			?>			
			
		</ul></div>
		
<!-- header ends -->
<!-- content begins -->


<html>
<head>
    <title>Input Data ke Database dengan PHP dan MySQL</title>
</head>
<body>
    <form action="action_input.php" method="POST" enctype="multipart/form-data">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td height="40">&nbsp;</td>
            <td>&nbsp;</td>
            <td><font size="4" color="blue"><b>INPUT DATA RESTITUSI</b></font></td>
        </tr>
       
        <tr>
            <td height="40">&nbsp;</td>
            <td>NIP</td>
            <td><input type="text" name="nipeg" size="12"></td>
        </tr>
        <tr>
            <td height="40">&nbsp;</td>
            <td>Nama</td>
            <td><input type="text" name="nama" size="30"></td>
        </tr>
        <tr>
            <td height="40">&nbsp;</td>
            <td>Tes 1</td>
            <td><input type="text" name="tes1" size="30"></td>
        </tr>
        <tr>
            <td height="40">&nbsp;</td>
            <td>Tes 2</td>
            <td><input type="text" name="tes2" size="30"></td>
        </tr>
        <tr>
            <td height="36">&nbsp;</td>
            <td>Tes 3</td>
            <td><input type="text" name="tes3" size="30"></td>
        </tr>
		<tr>
            <td height="36">&nbsp;</td>
            <td>Tes 4</td>
            <td><input type="text" name="tes4" size="30"></td>
        </tr>
		<tr>
            <td height="36">&nbsp;</td>
            <td>Tes 5</td>
            <td><input type="text" name="tes5" size="30"></td>
        </tr>
		<tr>
            <td height="36">&nbsp;</td>
            <td>Tes 6</td>
            <td><input type="text" name="tes6" size="30"></td>
        </tr>
        <tr>
            <td height="60">&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="Submit">&nbsp;&nbsp;&nbsp;
            <input type="reset" name="reset" value="Reset">&nbsp;&nbsp;&nbsp;
			</td>
			</tr>
				
			<a href=viewrest.php><input type="button" name="button" value = "Lihat Input"</a>
			
					
        </table>
		
		
		
    </form>
</body>
</html>
			
			
			?>

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