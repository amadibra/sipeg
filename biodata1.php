<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>SIPeg - Biodata</title>
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
list($nipeg1) = mysql_fetch_row($q);
/* cek apakah pengunjung adalah admin atau bukan */
$sql = "select nipeg from $tbl_admin where nipeg='$nipeg1'";
$q = mysql_query($sql);
list($adadata) = mysql_fetch_row($q);
/* apabila admin, tambahan menu baru */
$sql = "select nipeg from admin_dosir where nipeg like '$adadata'";
$q = mysql_query($sql);
list($cek_nipeg) = mysql_fetch_row($q);

$sql = "select nipeg from super_admin where nipeg like '$adadata'";
$q = mysql_query($sql);
list($super) = mysql_fetch_row($q);

if($super != '') {  print "	  
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
print "
<table width=98% border=0 cellspacing=0 cellpadding=2 align=center>
  <tr>
    <td colspan=3 align=center><font size=4 color = white><b>.: BIODATA :.</b></font></td>
	<td ><strong> <font size=2 ><a href='dozir1.php?session=$session&nipeg1=$nipeg '><img src=images/folder_copy.png></a></font></strong></td>
	 <td ><strong> <font size=2 ><a href='cetak.php?session=$session&nipeg=$nipeg 'target='_blank'><img src=images/print_icon.png></a></font></strong></td>
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
  <tr>
    <td><font size=2 color = white>Grade / Tanggal Grade Terakhir</font></td>
    <td><b><font size=2 color = white>$tprkat</font></b></td>
  </tr>
  <tr>
    <td><font size=2 color = white>Tanggal Masuk</font></td>
    <td><b><font size=2 color = white>$tgl_masuk</font></b></td>
  </tr>
  <tr>
    <td><font size=2 color = white>Tanggal Capeg</font></td>
    <td><b><font size=2 color = white>$tgl_capeg</font></b></td>
  </tr>
  <tr>
    <td><font size=2 color = white>Tanggal Pegawai</font></td>
    <td><b><font size=2 color = white>$tgl_tetap</font></b></td>
  </tr>
  <tr>
    <td><font size=2 color = white>Tempat / Tanggal Lahir</font></td>
    <td><b><font size=2 color = white>$ttl</font></b></td>
  </tr>
  <tr>
    <td><font size=2 color = white>Alamat</font></td>
    <td><b><font size=2 color = white>$alamat</font></b></td>
  </tr>
  <tr>
    <td><font size=2 color = white>Agama</font></td>
    <td><b><font size=2 color = white>$agama</font></b></td>
  </tr>
  <tr>
    <td><font size=2 color = white>Jenis Kelamin</font></td>
    <td><b><font size=2 color = white>$kelamin</font></b></td>
  </tr>  
   <tr>
    <td><font size=2 color = white>Golongan Darah</font></td>
    <td><b><font size=2 color = white>$gol_darah</font></b></td>
  </tr>  
  <tr>
    <td colspan=3><hr></td>
  </tr>
</table>
";
?>
******************************************************************************************
<table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=8 align=center><b><font color=#0000FF>Riwayat Jabatan</font></b></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    <td align=left><span class="style9 style2">Jabatan</span></td>
  	<td align=left><span class="style9 style2">Organitation unit</span></td>
    <td align=left><span class="style9 style2">Business Area</span></td>
    <td align=left><span class="style9 style2">Personel Area</span></td>
    <td align=left><span class="style9 style2">Sejak</span></td>
    <td align=left><span class="style9 style2">Hingga</span></td>

  </tr>
  <?
/* riwayat jabatan */
$urut = 1;
$sql1 = "select jabatan, kd_unit, unit_kerja, barea, parea ,tgl_jabat, tgl_akhir,grade_sk
         from $tbl_bio03 where nipeg='$nipeg' order by tgl_jabat ASC";
$q1 = mysql_query($sql1);
while(list($jabatan, $kd_unit, $unit_kerja, $barea, $parea, $tgl_jabat, $tgl_akhir, $grade_sk, $no_sk) = mysql_fetch_row($q1)) {
  /* rapihkan tampilan */
  $tgl_jabat = tgl2ind($tgl_jabat);
  $tgl_akhir = tgl2ind($tgl_akhir);

//if (strlen($kd_unit) >= 5)
//if (substr($kd_unit,4,1) = '0')
// $kd_unit = substr($kd_unit,0,3);
//else $kd_unit = substr($kd_unit,0,3);
$posisi2 = sebutposisi($kd_unit);
/*$peringkat = ($peringkat == 0) ? "" : $peringkat; */
/*
$sql2 = "select posisi
         from $tbl_posisi where kode = rtrim('$kd_unit')";
$q2 = mysql_query($sql2);
list($posisi) = mysql_fetch_row($q2);
*/
  print "
  <tr bgcolor= white>
    <td align=left>$urut</td>
    <td>$jabatan&nbsp;</td>
    <td>$unit_kerja</td>
	 <td>$barea</td>
	  <td>$parea</td>
    <td align=left>$tgl_jabat</td>
	 <td align=left>$tgl_akhir</td>
 
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
    <td colspan=6 align=center><b><font color=#0000FF>Riwayat Pendidikan Formal</font></b></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    <td align=left><span class="style9 style2">Pendidikan</span></td>
    <td align=left><span class="style9 style2">Tahun Lulus</span></td>
    <td align=left><span class="style9 style2">Lembaga</span></td>
    <td align=left><span class="style9 style2">Lokasi</span></td>
    <td align=left><span class="style9 style2">Gelar</span></td>
  </tr>

<?
/* riwayat pendidikan formal */
$urut = 1;
$sql1 = "select pendidikan, thn_lulus, lembaga, lokasi, gelar
         from $tbl_bio04 where nipeg='$nipeg' order by thn_lulus ASC";
$q1 = mysql_query($sql1);
while(list($pendidikan, $thn_lulus, $lembaga, $lokasi, $gelar) = mysql_fetch_row($q1)) {
  //$sql2 = "select pendidikan from $tbl_pendidikan where kode='$pendidikan'";
  //$q2 = mysql_query($sql2);
  //list($pendidikan) = mysql_fetch_row($q2);
  if(!$gelar) $gelar = "&nbsp;";
    $thn_lulus = substr($thn_lulus,0,4);
  print "
  <tr bgcolor= white>
    <td align=left>$urut</td>
    <td>$pendidikan</td>
    <td align=left>$thn_lulus</td>
    <td>$lembaga</td>
    <td>$lokasi</td>
    <td>$gelar</td>
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
    <td colspan=6 align=center><font color=#0000FF><b>Riwayat Pendidikan Non Formal</b></font></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    <td align=left><span class="style9 style2">Kursus</span></td>
    <td align=left><span class="style9 style2">Tanggal Mulai</span></td>
    <td align=left><span class="style9 style2">Tanggal Akhir</span></td>
    <td align=left><span class="style9 style2">Lembaga</span></td>
    <td align=left><span class="style9 style2">Lokasi</span></td>
  </tr>

<?
/* riwayat pendidikan non formal */
$urut = 1;
$sql1 = "select kursus, tgl_mulai, tgl_akhir, lembaga, lokasi
         from $tbl_bio05 where nipeg='$nipeg' order by tgl_mulai ASC ";
$q1 = mysql_query($sql1);
while(list($kursus, $tgl_mulai, $tgl_akhir, $lembaga, $lokasi) = mysql_fetch_row($q1)) {
  /* rapihkan tampilan */
  $tgl_mulai = tgl2ind($tgl_mulai);
  $tgl_akhir = tgl2ind($tgl_akhir);
  print "
  <tr bgcolor= white>
    <td align=left>$urut</td>
    <td >$kursus</td>
    <td align=left>$tgl_mulai</td>
    <td align=left>$tgl_akhir</td>
    <td>$lembaga</td>
    <td>$lokasi</td>
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
    <td colspan=5 align=center><b><font color=#0000FF>Riwayat Pekerjaan Sebelum PLN</font></b></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    <td align=left><span class="style9 style2">Instansi dan Jabatan Pekerjaan</span></td>    
    <td align=left><span class="style9 style2">Sejak</span></td>
    <td align=left><span class="style9 style2">Hingga</span></td>
  </tr>

<?
/* riwayat jabatan sebelum di PLN */
$urut = 1;
$sql1 = "select instansi, tgl_mulai, tgl_akhir
         from $tbl_bio06 where nipeg='$nipeg' order by tgl_mulai ASC";
$q1 = mysql_query($sql1);
while(list($instansi, $tgl_mulai, $tgl_akhir) = mysql_fetch_row($q1)) {
  /* rapihkan tampilan */
  $tgl_mulai = tgl2ind($tgl_mulai);
  $tgl_akhir = tgl2ind($tgl_akhir);
  print "
  <tr bgcolor= white>
    <td align=left>$urut</td>
    <td>$instansi</td>
    <td align=left>$tgl_mulai</td>
    <td align=left>$tgl_akhir</td>
  </tr>
  ";
  $urut++;
}

/*
?>
</table>
<hr width=95%>
<table width=95% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=6 align=center><b><font color=#0000FF>Riwayat Penugasan Lain</font></b></td>
  </tr>
  <tr>
    <td width=5% align=center>No.</td>
    <td align=center>Penugasan</td>
    <td align=center>Jabatan</td>
    <td align=center>Tanggal</td>
  </tr>

<?
*/

/* riwayat penugasan lain */
//$urut = 1;
//$sql1 = "select penugasan, jabatan, unit_kerja, tgl_mulai, tgl_akhir
//        from $tbl_bio07 where nipeg='$nipeg'";
//$q1 = mysql_query($sql1);
//while(list($penugasan, $jabatan, $unit_kerja, $tgl_mulai, $tgl_akhir) = mysql_fetch_row($q1)) {
  /* rapihkan tampilan */
//  $tgl_mulai = tgl2ind($tgl_mulai);
//  $tgl_akhir = tgl2ind($tgl_akhir);
//  print "
//  <tr>
//   <td align=center>$urut</td>
//    <td>$penugasan</td>
//    <td>$jabatan</td>
//    <td align=center>$tgl_mulai</td>
//  </tr>
//  ";
//  $urut++;
//}

/*
?>
</table>
<hr width=95%>
<table width=95% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=7 align=center><b><font color=#0000FF>Riwayat Tenaga Harian</font></b></td>
  </tr>
  <tr>
    <td width=5% align=center>No.</td>
    <td align=center>No. SPK</td>
    <td align=center>Tanggal SPK</td>
    <td align=center>Tanggal Mulai</td>
    <td align=center>Tanggal Akhir</td>
    <td align=center>Golongan</td>
    <td align=center>Unit Kerja</td>
  </tr>

<?
*/
/* riwayat tenaga harian */
//$urut = 1;
//$sql1 = "select nomor_spk, tgl_spk, tgl_mulai, tgl_akhir, golongan, unit_kerja
//         from $tbl_bio08 where nipeg='$nipeg'";
//$q1 = mysql_query($sql1);
//while(list($nomor_spk, $tgl_spk, $tgl_mulai, $tgl_akhir, $golongan, $unit_kerja) = //mysql_fetch_row($q1)) {
  /* rapihkan tampilan */
//  $tgl_spk = tgl2ind($tgl_spk);
//  $tgl_mulai = tgl2ind($tgl_mulai);
//  $tgl_akhir = tgl2ind($tgl_akhir);
//  if(!$unit_kerja) $unit_kerja = "&nbsp;";
//  print "
//  <tr>
//    <td align=center>$urut</td>
//    <td>$nomor_spk</td>
//    <td align=center>$tgl_spk</td>
//    <td align=center>$tgl_mulai</td>
//    <td align=center>$tgl_akhir</td>
//    <td>$golongan</td>
//    <td>$unit_kerja</td>
// </tr>
//  ";
//  $urut++;
//}


/* riwayat penghargaan */
//$urut = 1;
//$sql1 = "select urai, pemberi, tanggal
//         from $tbl_bio09 where nipeg='$nipeg' and jenis=1";
//$q1 = mysql_query($sql1);
//while(list($urai, $pemberi, $tanggal) = mysql_fetch_row($q1)) {
//  /* rapihkan tampilan */
// $tanggal = tgl2ind($tanggal);
//  print "
//  <tr>
//    <td align=center>$urut</td>
//    <td>$urai</td>
//    <td>$pemberi</td>
//    <td align=center>$tanggal</td>
//  </tr>
//  ";
//  $urut++;
//}

?>
</table>
******************************************************************************************
<hr width=98%>
******************************************************************************************
<table width=98% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td colspan=8 align=center><font color=#0000FF><b>Data Suami / Istri</b></font></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>    
    <td align=left><span class="style9 style2">Nama</span></td>
	<td align=left><span class="style9 style2">Hubungan</span></td>
    <td align=left><span class="style9 style2">Jenis Kelamin</span></td>
    <td align=left><span class="style9 style2">Tanggal Lahir</span></td>   
    <td align=left><span class="style9 style2">Tunjangan</span></td>    
  </tr>

<?
/* data keluarga */
$urut = 1;
$sql1 = "select nama, hubungan, kelamin, tgl_lahir, tunjangan
         from $tbl_bio10 where nipeg='$nipeg' and hubungan=1 order by tgl_lahir ASC";
$q1 = mysql_query($sql1);
while(list($nama, $hubungan, $kelamin, $tgl_lahir, $tunjangan) = mysql_fetch_row($q1)) {
  /* cari hubungan keluarga dengan pegawai */
  if($hubungan == 1) {
    if($jk == 1) $hubungan = "Istri";
    else $hubungan = "Suami";
  }
  elseif($hubungan == 2) $hubungan = "Anak Kandung";
  elseif($hubungan == 3) $hubungan = "Anak Angkat";
  elseif($hubungan == 4) $hubungan = "Anak Tiri";
  /* rapihkan tampilan */
  $kelamin = ($kelamin == 1) ? "Laki-laki" : "Perempuan";
  $tgl_lahir = tgl2ind($tgl_lahir);
  /*$pekerjaan = $arrpekerjaan[$pekerjaan];*/
  $tunjangan = ($tunjangan == 1) ? "Dapat" : "Tidak Dapat";
  /*$stat_sipil = $arrstatus[$stat_sipil];*/
  print "
  <tr bgcolor= white>
    <td align=left>$urut</td>
	<td>$nama</td>
    <td>$hubungan</td>    
    <td>$kelamin</td>
    <td align=left>$tgl_lahir</td>  
    <td align=left>$tunjangan</td>    
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
    <td colspan=8 align=center><font color=#0000FF><b>Data Anak</b></font></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>    
    <td align=left><span class="style9 style2">Nama</span></td>
	<td align=left><span class="style9 style2">Hubungan</span></td>
    <td align=left><span class="style9 style2">Jenis Kelamin</span></td>
    <td align=left><span class="style9 style2">Tanggal Lahir</span></td>   
    <td align=left><span class="style9 style2">Tunjangan</span></td>    
  </tr>

<?
/* data keluarga */
$urut = 1;
$sql1 = "select nama, hubungan, kelamin, tgl_lahir, tunjangan
         from $tbl_bio10 where nipeg='$nipeg' and hubungan>1 order by tgl_lahir ASC";
$q1 = mysql_query($sql1);
while(list($nama, $hubungan, $kelamin, $tgl_lahir, $tunjangan) = mysql_fetch_row($q1)) {
  /* cari hubungan keluarga dengan pegawai */
  if($hubungan == 1) {
    if($jk == 1) $hubungan = "Istri";
    else $hubungan = "Suami";
  }
  elseif($hubungan == 2) $hubungan = "Anak Kandung";
  elseif($hubungan == 3) $hubungan = "Anak Angkat";
  elseif($hubungan == 4) $hubungan = "Anak Tiri";
  /* rapihkan tampilan */
  $kelamin = ($kelamin == 1) ? "Laki-laki" : "Perempuan";
  $tgl_lahir = tgl2ind($tgl_lahir);
  /*$pekerjaan = $arrpekerjaan[$pekerjaan];*/
  $tunjangan = ($tunjangan == 1) ? "Dapat" : "Tidak Dapat";
  /*$stat_sipil = $arrstatus[$stat_sipil];*/
  print "
  <tr bgcolor= white >
    <td align=left>$urut</td>
	<td>$nama</td>
    <td>$hubungan</td>    
    <td>$kelamin</td>
    <td align=left>$tgl_lahir</td>  
    <td align=left>$tunjangan</td>    
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
    <td colspan=6 align=center><strong><font color=#0000FF>Riwayat Golongan</font></strong></td>
  </tr>
  <tr>
    <td align=left><span class="style9 style2">Tanggal</span></td>
    <td align=left><span class="style9 style2">Golongan </span></td>    
  </tr>

<?
/* Riwayat Golongan/Skala Gaji Dasar sbg PhDP */
$urut = 1;
$sql1 = "select tgl_mulai, gjdasar_sk
         from $tbl_golongan where nipeg='$nipeg' order by tgl_mulai ASC";
$q1 = mysql_query($sql1);
while(list($tgl_mulai, $gjdasar_sk) = mysql_fetch_row($q1)) { 
  $tgl_mulai = tgl2ind($tgl_mulai);
  print "
  <tr bgcolor= white>
    <td align=left>$tgl_mulai</td>   
    <td align=left>$gjdasar_sk</td>    
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
    <td colspan=6 align=center><strong><font color=#0000FF>Riwayat Skala Gaji Dasar sbg PhDP</font></strong></td>
  </tr>
  <tr>
    <td align=left><span class="style9 style2">Tanggal</span></td>
    <td align=left><span class="style9 style2">Skala Gaji Dasar sbg PhDP</span></td>    
  </tr>

<?
/* Riwayat Golongan/Skala Gaji Dasar sbg PhDP */
$urut = 1;
$sql1 = "select tgl_mulai, gjdasar_sk
         from $tbl_gjdasar where nipeg='$nipeg' order by tgl_mulai ASC";
$q1 = mysql_query($sql1);
while(list($tgl_mulai, $gjdasar_sk) = mysql_fetch_row($q1)) { 
  $tgl_mulai = tgl2ind($tgl_mulai);
  print "
  <tr bgcolor= white>
    <td align=left>$tgl_mulai</td>   
    <td align=left>$gjdasar_sk</td>    
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
    <td colspan=6 align=center><b><font color=#0000FF>Riwayat Kondite / Kriteria Talenta</font></b></td>
  </tr>
  <tr>
    <td align=left><span class="style9 style2">Tanggal Mulai Penilaian</span></td>
    <td align=left><span class="style9 style2">Tanggal Akhir Penilaian</span></td>
    <td align=left><span class="style9 style2">Kondite / Kriteria Talenta</span></td>
   
  </tr>

<?
/* riwayat Kondite/Kriteria Talenta */
$urut = 1;
$sql1 = "select tgl_mulai, tgl_akhir, talenta, grade_sk
         from $tbl_tbkondite where nipeg='$nipeg' order by tgl_mulai ASC";
$q1 = mysql_query($sql1);
while(list($tgl_mulai, $tgl_akhir, $talenta, $grade_sk) = mysql_fetch_row($q1)) {
  /* rapihkan tampilan */
 /* $gj_dasar = number_format($gj_dasar, 0, ',', '.'); */
 /* $tg_gaji = tgl2ind($tg_gaji);*/
  $tgl_mulai = tgl2ind($tgl_mulai);
  $tgl_akhir = tgl2ind($tgl_akhir);
  print "
  <tr bgcolor= white>
    <td align=left>$tgl_mulai</td>
    <td align=left>$tgl_akhir</td>
    <td align=left>$talenta</td>
   
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
    <td colspan=8 align=center><font color=#0000FF><b>Riwayat Profesi dan Sebutan Profesi 1</b></font></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    <td align=left><span class="style9 style2">Nama Profesi 1</span></td>
    <td align=left><span class="style9 style2">Sebutan Profesi 1</span></td>
    <td align=left><span class="style9 style2">Sejak</span></td>
    <td align=left><span class="style9 style2">Hingga</span></td>   
  </tr>

<?
/* Data Riwayat Profesi 1 */
$urut = 1;
$sql1 = "select  nm_profesi, sb_profesi, tgl_mulai, tgl_akhir
         from $tbl_profesi where nipeg='$nipeg' order by tgl_mulai ASC";
$q1 = mysql_query($sql1);
while(list( $nm_profesi, $sb_profesi, $tgl_mulai, $tgl_akhir) = mysql_fetch_row($q1)) {
  
  $tgl_mulai = tgl2ind($tgl_mulai);
  $tgl_akhir = tgl2ind($tgl_akhir);

  print "
  <tr bgcolor= white>
    <td align=left>$urut</td>
    <td>$nm_profesi</td>
    <td>$sb_profesi</td>
    <td align=left>$tgl_mulai</td>
    <td align=left>$tgl_akhir</td>     
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
    <td colspan=8 align=center><font color=#0000FF><b>Riwayat Profesi dan Sebutan Profesi 2</b></font></td>
  </tr>
  <tr>
    <td width=5% align=left><span class="style9 style2">No.</span></td>
    <td align=left><span class="style9 style2">Nama Profesi 2</span></td>
    <td align=left><span class="style9 style2">Sebutan Profesi 2</span></td>
    <td align=left><span class="style9 style2">Sejak</span></td>
    <td align=left><span class="style9 style2">Hingga</span></td>   
  </tr>


<?
/* Data Riwayat Profesi 2 */
$urut = 1;
$sql1 = "select no_urut, nm_profesi, sb_profesi, tgl_mulai, tgl_akhir
         from $tbl_profesi where nipeg='$nipeg' and jenis='2' order by tgl_mulai ASC";
$q1 = mysql_query($sql1);
while(list($no_urut, $nm_profesi, $sb_profesi, $tgl_mulai, $tgl_akhir) = mysql_fetch_row($q1)) {
  
  $tgl_mulai = tgl2ind($tgl_mulai);
  $tgl_akhir = tgl2ind($tgl_akhir);

  print "
  <tr bgcolor= white>
    <td align=left>$no_urut</td>
    <td>$nm_profesi</td>
    <td>$sb_profesi</td>
    <td align=left>$tgl_mulai</td>
    <td align=left>$tgl_akhir</td>     
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