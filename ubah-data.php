<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>SIPeg - Koreksi Data</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-size: 14px}
.style2 {
	color: #FFFF33;
	font-weight: bold;
}
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

$act = "Koreksi Data";
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
<div id="content_bg">
  <div id="content">
	
		     	
                	<div id="left2">
			
			
	<p>
	  <?
/* cari nipeg dan nama pengirim */
bukadb();
$sql = "select user from $tbl_session where session='$session'";
$q = mysql_query($sql);
list($nipeg) = mysql_fetch_row($q);
$sql = "select nama, kd_posisi from $tbl_bio01 where nipeg='$nipeg'";
$q = mysql_query($sql);
list($nama, $kd_posisi) = mysql_fetch_row($q);

print "



<form action=form-ubah-data-do.php?session=$session method=post enctype=multipart/form-data >
  <table width=100% border=0 cellspacing=0 cellpadding=2 align=center>
    <tr>
      <td align=center ><b><font size=3 color=white>.: FORM KOMENTAR DAN KOREKSI DATA :.</font></b></td>
    </tr>
    <tr>
      <td><hr></td>
    </tr>
    <tr>
      <td><b><font color=white>Kepada : ADMINISTRATOR SIPEG </font></b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
     
      <td><b><font color=white>Koreksi Data :</font></b></td>
    </tr>
    <tr>
      <td>
        <table width=100% border=2 cellspacing=0 cellpadding=3 align=center>
          <tr>
            <td width=30% bgcolor=#FFFF66 align=center><font color=#0000FF><b>TERTULIS</b></font></td>
            <td bgcolor=#FFFF66 align=center><font color=#0000FF><b>SEHARUSNYA</b></font></td>
          </tr>
          <tr bgcolor=#CCCCCC>
            <td align=center><textarea name=tertulis cols=42 rows=10></textarea></td>
            <td align=center><textarea name=seharusnya cols=42 rows=10></textarea></td>
          </tr>
          <tr bgcolor=#CCCCCC>
		  
		 <td><label for=file>Nama file:</label><input type=file name=userfile /></td>
		 		
		  <td align=left><input type=submit value=Kirim name=Kirimkan></td>
			
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
	  
    </tr>
    <tr>
      <td>
	  
	 	 
        <table width=40% border=0 cellspacing=0 cellpadding=2 align=right>
          <tr>
            <td align=center bgcolor=lightgrey>Tertanda</td>
          </tr>
          <tr>
            <td align=center bgcolor=lightgrey>&nbsp;</td>
          </tr>
          <tr>
            <td align=center bgcolor=lightgrey><b><u>$nama</u></b></td>
          </tr>
          <tr>
            <td align=center bgcolor=lightgrey><b>$nipeg</b></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</form>
"
	?>
	  </p>
	<p>&nbsp;   </p>
	<p align="left" class="style1"><font color=white>Keterangan : Untuk perubahan data, </font><span class="style2">diharapkan melampirkan file dalam bentuk pdf dan menunjukkan juga dokumen aslinya ke SDM</span><font color=white> supaya data yang kurang sesuai dapat segera dikoreksi kembali. Terima kasih.</font></p>
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