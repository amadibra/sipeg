<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>SIPeg - Dozir</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style2 {color: #FFFFFF}
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
include_once "inc/config.inc.php";
include_once "inc/function.inc.php";
include_once "inc/tools.inc.php";



$act = "Detail pegawai";
if(!ceksession($session, $act)) header("Location: errorsession.htm");
$sql1 = "select nama, jabatan, kd_posisi, grade_sk, tgl_setara, tgl_masuk, tgl_capeg, tgl_tetap, tgl_lahir,tpt_lahir, alamat, kota, kelamin, agama, perkawinan, jml_klrg,gol_darah from $tbl_bio01 where nipeg='$nipeg'";
$q1 = mysql_query($sql1);
list($nama, $jabatan, $kd_posisi, $grade_sk, $tgl_setara, $tgl_masuk, $tgl_capeg, $tgl_tetap, $tgl_lahir, $tpt_lahir,
     $alamat, $kota, $jk, $agama, $perkawinan, $jml_klrg, $gol_darah) = mysql_fetch_row($q1);


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
			
			
	<?	
		/* buat nama file foto pegawai */
$foto = $fotodir.$nipeg.".bmp";
if(!file_exists($foto)) $foto = $fotodir.$nipeg.".jpg";
if(!file_exists($foto)) $foto = $fotodir.$nipeg.".gif";
/* rapihkan tampilan */
$tgl_masuk = tgl2ind($tgl_masuk);
$tgl_capeg = tgl2ind($tgl_capeg);
$tgl_tetap = tgl2ind($tgl_tetap);
$ttl = $tpt_lahir." / ".tgl2ind($tgl_lahir);
$tprkat = $grade_sk." / tanggal ".tgl2ind($tgl_setara);
$alamat = $alamat.", ".$kota;
/*$agama = $arragama[$agama];*/
$kelamin = ($jk == 1) ? "LAKI-LAKI" : "PEREMPUAN";
/* untuk mengetahui susunan keluarga */
if($jml_klrg > 0) $jml_klrg = $jml_klrg - 1;
$susunan = $arrkeluarga[$perkawinan].$jml_klrg;
$posisi = sebutposisi ($kd_posisi);
/* data umum pegawai */


$sql1 = "select nama, jabatan, kd_posisi, grade_sk, tgl_setara, tgl_masuk, tgl_capeg, tgl_tetap, tgl_lahir,tpt_lahir, alamat, kota, kelamin, agama, perkawinan, jml_klrg,gol_darah from $tbl_bio01 where nipeg='$nipeg'";
$q1 = mysql_query($sql1);
list($nama, $jabatan, $kd_posisi, $grade_sk, $tgl_setara, $tgl_masuk, $tgl_capeg, $tgl_tetap, $tgl_lahir, $tpt_lahir,
     $alamat, $kota, $jk, $agama, $perkawinan, $jml_klrg, $gol_darah) = mysql_fetch_row($q1);



print "
<table width=98% border=0 cellspacing=0 cellpadding=2 align=center>
  <tr>
    <td colspan=3 align=center><font size=4 color = white><b>.: DOSIR :.</b></font></td>
	<td ><strong> <font size=2 ><a href='cetak1.php?session=$session&nipeg=$user&pos=$kd_posisi' target='_blank' ><img src=images/print_icon.png></a></font></strong></td>

  </tr>
  <tr>
    <td colspan=3><hr></td>
  </tr>
  <tr>
    <td width=26%><font size=2 color = white>Nama</font></td>
    <td><b><font size=2 color = white>$nama</font></b></td>
";

/* trap nama file foto pegawai */
if(file_exists($foto)) print "
    <td rowspan=13 align=center valign=top>
      <img src=$foto width=110 height=140 border=2>
    </td>
";
else print "
    <td rowspan=13 valign=top>&nbsp;</td>
";

print "
  </tr>
  <tr>
    <td><font size=2 color = white>Nomor Induk</font></td>
    <td><b><font size=2 color = white>$nipeg</font></b></td>
  </tr>
  <tr>
    <td><font size=2 color = white>Jabatan</font></td>
    <td><b><font size=2 color = white>$jabatan</font></b></td>
  </tr>
  <tr>
    <td><font size=2 color = white>&nbsp;</font></td>
    <td><b><font size=2 color = white>$posisi</font></b></td>
  </tr>
  
    <td colspan=3><hr></td>
  </tr>
</table>
";


?>

<hr width=98%>

<table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=6 align=center><b><font color=#0000FF>Data Lamaran </font></b></td>
  </tr>
  <tr>
      <td width=5% align=left><span class="style9 style2">No.</span></td>
    
    <td align=left><span class="style9 style2">Nama</span></td>
    <td align=left><span class="style9 style2">Nomor</span></td>
    <td align=left><span class="style9 style2">Tanggal</span></td>
	<td align=left><span class="style9 style2">File</span></td>
  </tr>

<?
/* Data Pensiun */


$urut = 1;
$sql1 = "select DISTINCT namafile, time,Keterangan, No_SK, Tgl_SK
         from $tbl_dozir where nipeg='$nipeg' && id_dozir ='01' order by tgl_SK ASC";
$q1 = mysql_query($sql1);
while(list($namafile,$time,$keterangan, $no_sk, $tgl_sk) = mysql_fetch_row($q1)) {
 $tgl_sk = tgl2ind($tgl_sk);
 
  print "
  <tr bgcolor= white>
     <tr bgcolor= white>
    <td align=center>$urut</td>
    <td>$keterangan&nbsp;</td>
    <td>$no_sk</td>
	 <td>$tgl_sk</td>
	 ";
	 
//$query = "SELECT * FROM upload where time=$time ";
//$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
//$data = mysql_fetch_array($hasil);
 
 $filedir="dozir/";
 $namafileku=$filedir.$namafile;
 
	 print "
	  <td><a href='$namafileku'>".$namafile."</a></td></td>
  </tr>
   ";
  $urut++;
}
?>
</table>
******************************************************************************************
<hr width=98%>
******************************************************************************************

<hr width=98%>

<table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=6 align=center><b><font color=#0000FF>Riwayat Pendidikan Formal</font></b></td>
  </tr>
  <tr>
      <td width=5% align=left><span class="style9 style2">No.</span></td>
    
    <td align=left><span class="style9 style2">Nama Ijazah </span></td>
    <td align=left><span class="style9 style2">No.Ijazah</span></td>
    <td align=left><span class="style9 style2">Tgl.Ijazah </span></td>
	<td align=left><span class="style9 style2">File</span></td>
  </tr>

<?
/* riwayat pendidikan formal */
$urut = 1;
$sql1 = "select DISTINCT time,Keterangan, No_SK, Tgl_SK,namafile
         from $tbl_dozir where nipeg='$nipeg' && id_dozir='02' order by Tgl_SK ASC";
$q1 = mysql_query($sql1);


while(list($time,$keterangan, $no_sk, $tgl_sk,$namafile) = mysql_fetch_row($q1)) {
   $tgl_sk = tgl2ind($tgl_sk);
  print "
  <tr bgcolor= white>
     <tr bgcolor= white>
    <td align=center>$urut</td>
    <td>$keterangan&nbsp;</td>
    <td>$no_sk</td>
	 <td>$tgl_sk</td>
";	 
	//$query = "SELECT * FROM upload where time=$time ";
//$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
//$data = mysql_fetch_array($hasil);
 
	$filedir="dozir/";
 $namafileku=$filedir.$namafile;
 
	 print "
	  <td><a href='$namafileku'>".$namafile."</a></td></td>
  </tr>
   ";

  $urut++;
}
?>
</table>
******************************************************************************************
<hr width=98%>
******************************************************************************************
<table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=6 align=center><strong><font color="#0000FF">Riwayat Pendidikan Nonformal </font></strong></td>
  </tr>
  <tr>
      <td width=5% align=left><span class="style9 style2">No.</span></td>
    
    <td align=left><span class="style9 style2">Nama Pendidikan </span></td>
    <td align=left><span class="style9 style2">No.Sertifikat</span></td>
    <td align=left><span class="style9 style2">Tgl.Sertifikat</span></td>
	<td align=left><span class="style9 style2">File </span></td>
  </tr>

<?
/* riwayat pendidikan non formal */
$urut = 1;
$sql1 = "select DISTINCT time,Keterangan, No_SK, Tgl_SK,namafile
         from $tbl_dozir where nipeg='$nipeg' && id_dozir='03' order by tgl_SK ASC";
$q1 = mysql_query($sql1);
while(list($time,$keterangan, $no_sk, $tgl_sk,$namafile) = mysql_fetch_row($q1)) {
  $tgl_sk = tgl2ind($tgl_sk);
  print "
  <tr bgcolor= white>
     <tr bgcolor= white>
    <td align=center>$urut</td>
    <td>$keterangan&nbsp;</td>
    <td>$no_sk</td>
	 <td>$tgl_sk</td>
";	 
//	$query = "SELECT * FROM upload where time=$time ";
//$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
//$data = mysql_fetch_array($hasil);
 
	$filedir="dozir/";
 $namafileku=$filedir.$namafile;
 
	 print "
	  <td><a href='$namafileku'>".$namafile."</a></td></td>
  </tr>
   ";

  $urut++;
}
?>
</table>
******************************************************************************************
<hr width=98%>
******************************************************************************************
<table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=8 align=center><b><font color=#0000FF>Riwayat Jabatan</font></b></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    
    <td align=left><span class="style9 style2">Nama SK </span></td>
    <td align=left><span class="style9 style2">No.SK</span></td>
    <td align=left><span class="style9 style2">Tgl.SK</span></td>
	<td align=left><span class="style9 style2">File</span></td>
      </tr>
  <?
/* riwayat Jabatan */
$urut = 1;
$sql1 = "select DISTINCT time,Keterangan, No_SK, Tgl_SK,namafile
         from $tbl_dozir where nipeg='$nipeg' && id_dozir='04' order by tgl_SK ASC";
$q1 = mysql_query($sql1);
while(list($time,$keterangan, $no_sk, $tgl_sk,$namafile) = mysql_fetch_row($q1)) {
   $tgl_sk = tgl2ind($tgl_sk);
  print "
  <tr bgcolor= white>
     <tr bgcolor= white>
    <td align=center>$urut</td>
    <td>$keterangan&nbsp;</td>
    <td>$no_sk</td>
	 <td>$tgl_sk</td>
";	 
//	$query = "SELECT * FROM upload where time=$time ";
//$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
//$data = mysql_fetch_array($hasil);
 
	 $filedir="dozir/";
 $namafileku=$filedir.$namafile;
 
	 print "
	  <td><a href='$namafileku'>".$namafile."</a></td></td>
  </tr>
   ";

  $urut++;
}
?>
</table>

******************************************************************************************
<hr width=98%>
******************************************************************************************
<table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=8 align=center><b><font color=#0000FF>Riwayat Golongan/MUK/Talenta </font></b></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    
    <td align=left><span class="style9 style2">Nama</span></td>
    <td align=left><span class="style9 style2">No. SK </span></td>
    <td align=left><span class="style9 style2">Tgl. SK</span></td>
	<td align=left><span class="style9 style2">File</span></td>
      </tr>
  <?
/* data keluarga */
$urut = 1;
$sql1 = "select DISTINCT time,Keterangan, No_SK, Tgl_SK,namafile
         from $tbl_dozir where nipeg='$nipeg' && id_dozir='05' order by tgl_SK ASC";
$q1 = mysql_query($sql1);
while(list($time,$keterangan, $no_sk, $tgl_sk,$namafile) = mysql_fetch_row($q1)) {
  $tgl_sk = tgl2ind($tgl_sk);
  print "
  <tr bgcolor= white>
     <tr bgcolor= white>
    <td align=center>$urut</td>
    <td>$keterangan&nbsp;</td>
    <td>$no_sk</td>
	 <td>$tgl_sk</td>
";	 
//	$query = "SELECT * FROM upload where time=$time ";
//$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
//$data = mysql_fetch_array($hasil);
 
	$filedir="dozir/";
 $namafileku=$filedir.$namafile;
 
	 print "
	  <td><a href='$namafileku'>".$namafile."</a></td></td>
  </tr>
   ";

  $urut++;
}
?>
</table>


******************************************************************************************
<hr width=98%>
******************************************************************************************
<table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=8 align=center><b><font color=#0000FF>Data Keluarga </font></b></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    
    <td align=left><span class="style9 style2">Nama Penugasan </span></td>
    <td align=left><span class="style9 style2">Nomor </span></td>
    <td align=left><span class="style9 style2">Tanggal </span></td>
	<td align=left><span class="style9 style2">File</span></td>
      </tr>
  <?
/* riwayat jabatan */
$urut = 1;
$sql1 = "select DISTINCT time,Keterangan, No_SK, Tgl_SK,namafile
         from $tbl_dozir where nipeg='$nipeg' && id_dozir='06' order by tgl_SK ASC";
$q1 = mysql_query($sql1);
while(list($time,$keterangan, $no_sk, $tgl_sk,$namafile) = mysql_fetch_row($q1)) {
  $tgl_sk = tgl2ind($tgl_sk);
  print "
  <tr bgcolor= white>
     <tr bgcolor= white>
    <td align=center>$urut</td>
    <td>$keterangan&nbsp;</td>
    <td>$no_sk</td>
	 <td>$tgl_sk</td>
";	 
//	$query = "SELECT * FROM upload where time=$time ";
//$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
//$data = mysql_fetch_array($hasil);
 
	$filedir="dozir/";
 $namafileku=$filedir.$namafile;
 
	 print "
	  <td><a href='$namafileku'>".$namafile."</a></td></td>
  </tr>
   ";

  $urut++;
}
?>
</table>	

******************************************************************************************
<hr width=98%>
******************************************************************************************
<table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=8 align=center><b><font color=#0000FF>Riwayat Penghargaan dan Hukuman </font></b></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    
    <td align=left><span class="style9 style2">Nama SK </span></td>
    <td align=left><span class="style9 style2">No.SK</span></td>
    <td align=left><span class="style9 style2">Tgl.SK</span></td>
	<td align=left><span class="style9 style2">File</span></td>
      </tr>
  <?
/* riwayat jabatan */
$urut = 1;
$sql1 = "select DISTINCT time,Keterangan, No_SK, Tgl_SK,namafile
         from $tbl_dozir where nipeg='$nipeg' && id_dozir='07' order by tgl_SK ASC";
$q1 = mysql_query($sql1);
while(list($time,$keterangan, $no_sk, $tgl_sk,$namafile) = mysql_fetch_row($q1)) {
 $tgl_sk = tgl2ind($tgl_sk);
  print "
  <tr bgcolor= white>
     <tr bgcolor= white>
    <td align=center>$urut</td>
    <td>$keterangan&nbsp;</td>
    <td>$no_sk</td>
	 <td>$tgl_sk</td>
";	 
//	$query = "SELECT * FROM upload where time=$time ";
//$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
//$data = mysql_fetch_array($hasil);
 
	$filedir="dozir/";
 $namafileku=$filedir.$namafile;
 
	 print "
	  <td><a href='$namafileku'>".$namafile."</a></td></td>
  </tr>
   ";

  $urut++;
}
?></table>         	  
******************************************************************************************
<hr width=98%>
******************************************************************************************
<table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=8 align=center><b><font color=#0000FF>Lain-lain</font></b></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    
    <td align=left><span class="style9 style2">Nama SK </span></td>
    <td align=left><span class="style9 style2">Nomor</span></td>
    <td align=left><span class="style9 style2">Tanggal</span></td>
	<td align=left><span class="style9 style2">File </span></td>
      </tr>
  <?
/* riwayat jabatan */
$urut = 1;
$sql1 = "select DISTINCT time,Keterangan, No_SK, Tgl_SK,namafile
         from $tbl_dozir where nipeg='$nipeg' && id_dozir='08' order by tgl_SK ASC";
$q1 = mysql_query($sql1);
while(list($time,$keterangan, $no_sk, $tgl_sk,$namafile) = mysql_fetch_row($q1)) {
  $tgl_sk = tgl2ind($tgl_sk);
  print "
  <tr bgcolor= white>
     <tr bgcolor= white>
    <td align=center>$urut</td>
    <td>$keterangan&nbsp;</td>
    <td>$no_sk</td>
	 <td>$tgl_sk</td>
";	 
//	$query = "SELECT * FROM upload where time=$time ";
//$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
//$data = mysql_fetch_array($hasil);
 
	$filedir="dozir/";
 $namafileku=$filedir.$namafile;
 
	 print "
	  <td><a href='$namafileku'>".$namafile."</a></td></td>
  </tr>
   ";

  $urut++;
}
?>
</table>
	

				   
            
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