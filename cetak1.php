<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<STYLE type="text/css">  
# @media screen {  
#    BODY {font-size: medium; line-height: 1em; background: silver;}  
# }  
# @media print {  
#    BODY {font-size: 10pt; line-height: 80%; background: white;}  
# }  

#print {
	font-size:10px;	}
</style>

</head>

<body>





<?	
include_once "inc/config.inc.php";
include_once "inc/function.inc.php";
include_once "inc/tools.inc.php";



if(!ceksession($session, $act)) header("Location: errorsession.htm");
$sql1 = "select nama, jabatan, kd_posisi, grade_sk, tgl_setara, tgl_masuk, tgl_capeg, tgl_tetap, tgl_lahir,tpt_lahir, alamat, kota, kelamin, agama, perkawinan, jml_klrg,gol_darah from $tbl_bio01 where nipeg='$nipeg'";
$q1 = mysql_query($sql1);
list($nama, $jabatan, $kd_posisi, $grade_sk, $tgl_setara, $tgl_masuk, $tgl_capeg, $tgl_tetap, $tgl_lahir, $tpt_lahir,
     $alamat, $kota, $jk, $agama, $perkawinan, $jml_klrg, $gol_darah) = mysql_fetch_row($q1);




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
print "
<table width=98% border=0 cellspacing=0 cellpadding=2 align=center>



  <tr>
    <td colspan=3 align=center><font size=4 ><b>.: DOZIR :.</b></font></td>
	 <td ><strong> <input type='button' value='Print' onClick='window.print()'> </strong></td>
  </tr>
  <tr>
    <td colspan=3><hr></td>
  </tr>
  <tr>
    <td width=26%><font size=2 >Nama</font></td>
    <td><b><font size=2 >$nama</font></b></td>
";

/* trap nama file foto pegawai */
if(file_exists($foto)) print "
    <td rowspan=13 align=center valign=top>
      <img src=$foto width=90 height=120 border=2>
    </td>
";
else print "
    <td rowspan=13 valign=top>&nbsp;</td>
";

print "
  </tr>
  <tr>
    <td><font size=2 >Nomor Induk</font></td>
    <td><b><font size=2 >$nipeg</font></b></td>
  </tr>
  <tr>
    <td><font size=2 >Jabatan</font></td>
    <td><b><font size=2 >$jabatan</font></b></td>
  </tr>
  <tr>
    <td><font size=2 >&nbsp;</font></td>
    <td><b><font size=2 >$posisi</font></b></td>
  </tr>
 
  <tr>
  
 
    <td colspan=3><hr></td>
  </tr>
</table>
";
?>
<div id = "print">
<hr width=98%>

<table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=6 align=center><b><font color=#0000FF>Data pensiun</font></b></td>
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
$sql1 = "select time,Keterangan, No_SK, Tgl_SK,namafile
         from $tbl_dozir where nipeg='$nipeg' && id_dozir='01' order by tgl_SK ASC";
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
	 
$query = "SELECT * FROM upload where time=$time ";
$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
$data = mysql_fetch_array($hasil);
 
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
<hr width=98%>
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
$sql1 = "select time,Keterangan, No_SK, Tgl_SK,namafile
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
	$query = "SELECT * FROM upload where time=$time ";
$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
$data = mysql_fetch_array($hasil);
 
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
<hr width=98%>
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
$sql1 = "select time,Keterangan, No_SK, Tgl_SK,namafile
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
	$query = "SELECT * FROM upload where time=$time ";
$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
$data = mysql_fetch_array($hasil);
 
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
<hr width=98%>
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
$sql1 = "select time,Keterangan, No_SK, Tgl_SK,namafile
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
	$query = "SELECT * FROM upload where time=$time ";
$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
$data = mysql_fetch_array($hasil);
 
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

<hr width=98%>
<table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=8 align=center><b><font color=#0000FF>Data Keluarga</font></b></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    
    <td align=left><span class="style9 style2">Nama</span></td>
    <td align=left><span class="style9 style2">Nomor </span></td>
    <td align=left><span class="style9 style2">Tanggal</span></td>
	<td align=left><span class="style9 style2">File</span></td>
    </tr>
  <?
/* data keluarga */
$urut = 1;
$sql1 = "select time,Keterangan, No_SK, Tgl_SK,namafile
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
	$query = "SELECT * FROM upload where time=$time ";
$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
$data = mysql_fetch_array($hasil);
 
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


	<hr width=98%>
	<table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=8 align=center><b><font color=#0000FF>Riwayat Penugasan Khusus </font></b></td>
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
$sql1 = "select time,Keterangan, No_SK, Tgl_SK,namafile
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
	$query = "SELECT * FROM upload where time=$time ";
$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
$data = mysql_fetch_array($hasil);
 
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

    <hr width=98%>
    <table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=8 align=center><b><font color=#0000FF>Riwayat Golongan</font></b></td>
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
$sql1 = "select time,Keterangan, No_SK, Tgl_SK,namafile
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
	$query = "SELECT * FROM upload where time=$time ";
$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
$data = mysql_fetch_array($hasil);
 
	$filedir="dozir/";
 $namafileku=$filedir.$namafile;
 
	 print "
	  <td><a href='$namafileku'>".$namafile."</a></td></td>
  </tr>
   ";

  $urut++;
}
?></table>         	  
    <hr width=98%>
    <table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=8 align=center><b><font color=#0000FF>Riwayat Grade/Peringkat</font></b></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    
    <td align=left><span class="style9 style2">Nama SK </span></td>
    <td align=left><span class="style9 style2">No.SK</span></td>
    <td align=left><span class="style9 style2">Tgl.SK</span></td>
	<td align=left><span class="style9 style2">File </span></td>
    </tr>
  <?
/* riwayat jabatan */
$urut = 1;
$sql1 = "select time,Keterangan, No_SK, Tgl_SK,namafile
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
	$query = "SELECT * FROM upload where time=$time ";
$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
$data = mysql_fetch_array($hasil);
 
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
	
    <hr width=98%>
    <table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=8 align=center><b><font color=#0000FF>Riwayat Penghargaan/Hukuman Disiplin</font></b></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    
    <td align=left><span class="style9 style2">Nama</span></td>
    <td align=left><span class="style9 style2">Nomor</span></td>
    <td align=left><span class="style9 style2">Tanggal</span></td>
	<td align=left><span class="style9 style2">File </span></td>
    </tr>
  <?
/* riwayat jabatan */
$urut = 1;
$sql1 = "select time,Keterangan, No_SK, Tgl_SK,namafile
         from $tbl_dozir where nipeg='$nipeg' && id_dozir='09' order by tgl_SK ASC";
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
	$query = "SELECT * FROM upload where time=$time ";
$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
$data = mysql_fetch_array($hasil);
 
	$filedir="dozir/";
 $namafileku=$filedir.$namafile;
 
	 print "
	  <td><a href='$namafileku'>".$namafile."</a></td></td>
  </tr>
   ";

  $urut++;
}
?></table>
  <hr width=98%>
  <table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=8 align=center><b><font color=#0000FF>Berkas Lamaran</font></b></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    
    <td align=left><span class="style9 style2">Nama Berkas </span></td>
    <td align=left><span class="style9 style2">Nomor</span></td>
    <td align=left><span class="style9 style2">Tanggal</span></td>
	<td align=left><span class="style9 style2">File</span></td>
    </tr>
  <?
/* riwayat jabatan */
$urut = 1;
$sql1 = "select time,Keterangan, No_SK, Tgl_SK,namafile
         from $tbl_dozir where nipeg='$nipeg' && id_dozir='10' order by tgl_SK ASC";
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
	$query = "SELECT * FROM upload where time=$time ";
$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
$data = mysql_fetch_array($hasil);
 
	$filedir="dozir/";
 $namafileku=$filedir.$namafile;
 
	 print "
	  <td><a href='$namafileku'>".$namafile."</a></td></td>
  </tr>
   ";

  $urut++;
}
?></table>
	<hr width=98%>
	<table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=8 align=center><b><font color=#0000FF>Keterangan Lain</font></b></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    
    <td align=left><span class="style9 style2">Nama</span></td>
    <td align=left><span class="style9 style2">Nomor</span></td>
    <td align=left><span class="style9 style2">Tanggal</span></td>
	<td align=left><span class="style9 style2">File</span></td>
    </tr>
  <?
/* keterangan lain */
$urut = 1;
$sql1 = "select time,Keterangan, No_SK, Tgl_SK,namafile
         from $tbl_dozir where nipeg='$nipeg' && id_dozir='11' order by tgl_SK ASC";
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
	$query = "SELECT * FROM upload where time=$time ";
$hasil = mysql_query($query) or die(mysql_error()); 
// nama-nama file yang telah diupload 
$data = mysql_fetch_array($hasil);
 
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

<!-- footer ends -->
</div>
</div>
</body>
</html>