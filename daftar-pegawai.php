<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>SIPeg - Daftar Pegawai</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="styles.css" rel="stylesheet" type="text/css" />
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

$act = "Daftar pegawai";
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
			
			
			
			<table align=center width=98% cellpadding=2 cellspacing=0 border=1>
  
  <tr>
<?

/* definisi field yang akan di urut */
if(!$fld) $fld = 1;
if($fld == 1) $field = "grade_sk";
elseif($fld == 2) $field = "nipeg";
elseif($fld == 3) $field = "jabatan";
elseif($fld == 4) $field = "nama";
elseif($fld == 5) $field = "kd_posisi";
elseif($fld == 6) $field = "alamat";
elseif($fld == 7) $field = "gol_darah";

/* cara pengurutan data */
if(!$rev) { $rev = 1; $sort = "asc"; }
else { $rev = 0; $sort = "desc"; }

if($search || $namaposisi) {
  $judul = sebutposisi($namaposisi);
  if($namafld == "grade_sk") $trap = "$namafld = $search";
  else $trap = "$namafld like '%$search%'";

  if($namafld == "nipeg") $trap = "$namafld like '$search%'";

  $sql = "select count(*) from $tbl_bio01
          where ".$trap." and kd_posisi like '$namaposisi%'";
  $q = mysql_query($sql);
  list($jumrec) = mysql_fetch_row($q);
  $jumrec = "Jumlah Pegawai = ".$jumrec ;
  $judul = $judul."<br>".$jumrec;
  echo mysql_error();
}

else $judul = "&nbsp;";

print "


<table align=center width=100% cellpadding=2 cellspacing=0 border=0>
  <tr>
    <td colspan=2 align=center><font size=4 color=white><b>.: DAFTAR PEGAWAI :.</b></font></td>
  </tr>
  <tr>
    <form action=daftar-pegawai.php?session=$session method=post>
    <td>
      <font size=3 color=white>Cari : </font><input type=text name=search size=12 >
      <select name=namafld >
        <option value=nama >Nama 
        <option value=nipeg>NIP
       <option value=agama>Agama
        <option value=kelamin>Kelamin 
		  <option value=Gol_Darah>Gol_darah
      </select>
	  <p>&nbsp;</p>
      <select name=namaposisi>
";

$sql = "select kode, posisi from $tbl_posisi";
$q = mysql_query($sql);
while(list($kode, $posisi) = mysql_fetch_row($q)) {
  print "<option value=$kode > $posisi\n  ";
}

print "
      </select>
	  <input type=submit value=OK>
      </form>
    </tr>
  <tr>
    <td colspan=2><font size=2 ><b>$judul</b></font></td>
  </tr>
</table>

<hr align=center width=100%>
<table align=center width=100% cellpadding=2 cellspacing=0 border=1>
  <tr bgcolor=yellow>
    <td align=center  ><a href=?session=$session&fld=4&rev=$rev&search=$search&namafld=$namafld&namaposisi=$namaposisi>Nama</a></td>
    <td align=center><a href=?session=$session&fld=2&rev=$rev&search=$search&namafld=$namafld&namaposisi=$namaposisi>NIP</a></td>
    <td align=center><a href=?session=$session&fld=3&rev=$rev&search=$search&namafld=$namafld&namaposisi=$namaposisi>Jabatan</a></td>
    <td align=center ><a href=?session=$session&fld=5&rev=$rev&search=$search&namafld=$namafld&namaposisi=$namaposisi>Posisi</a></td>
    <td align=center><a href=?session=$session&fld=6&rev=$rev&search=$search&namafld=$namafld&namaposisi=$namaposisi>Alamat</a></td>    
	<td align=center><a href=?session=$session&fld=6&rev=$rev&search=$search&namafld=$namafld&namaposisi=$namaposisi>Gol_darah</a></td>  
    <td align=center>Data Keluarga</td>
	 <td align=center>Foto</td>
  </tr>
  
";


bukadb();
if($search || $namaposisi) {
  /* mencari data berdasarkan field tertentu */
 
  if($namafld == "nipeg") $trap = "$namafld like '$search%'"; 
  $sql = "select nipeg from $tbl_bio01
          where ".$trap." and kd_posisi like '$namaposisi%'";
  $q = mysql_query($sql);
  echo mysql_error();
  $jumdata = mysql_num_rows($q);
  /* cari data yang ingin ditampilkan */
  if(!$startpeg) $startpeg = 0;
  $sql = "select nama, nipeg, jabatan, kd_posisi, gol_darah, alamat, kota
          from $tbl_bio01 where ".$trap." and kd_posisi like '$namaposisi%'
          order by $field $sort limit $startpeg, $limitpeg";
  $q = mysql_query($sql);
  echo mysql_error();
}
else {
  /* cari jumlah data keseluruhan */
  $sql = "select nipeg from $tbl_bio01";
  $q = mysql_query($sql);
  echo mysql_error();
  $jumdata = mysql_num_rows($q);
  /* cari data yang ingin ditampilkan */
  if(!$startpeg) $startpeg = 0;
  $sql = "select nama, nipeg, jabatan, kd_posisi,gol_darah, alamat, kota
          from $tbl_bio01 where kd_posisi like '511%' order by $field $sort limit $startpeg, $limitpeg";
  $q = mysql_query($sql);
  echo mysql_error();}

$i = 1;
while(list($nama, $nipeg, $jabatan, $kd_posisi,$gol_darah,  $alamat, $kota) = mysql_fetch_row($q)) {
  if($i%2) $warna = "LIGHTGREY" ;
  else $warna = "WHITE";
  $alamat = $alamat.", ".$kota;
  /* buat nama file foto pegawai */
  $nipeg = trim($nipeg, " ");
  $foto = $fotodir.$nipeg.".jpg";
  /*if(!file_exists($foto)) $foto = $fotodir.$nipeg.".bmp";
  if(!file_exists($foto)) $foto = $fotodir.$nipeg.".gif";*/
  /* cari data keluarga */
  $sql1 = "select hubungan, nama, kelamin from $tbl_bio10 where nipeg='$nipeg'
           and (hubungan=1 or tunjangan=1) and (stat_sipil < 4)
           order by no_urut";
  $q1 = mysql_query($sql1);
  $datakeluarga = "";
  while(list($hubungan, $namakeluarga, $kelamin) = mysql_fetch_row($q1)) {
    if($hubungan == 1) {
      if($kelamin == 1) $datakeluarga = "Suami : ".$namakeluarga;
      if($kelamin == 2) $datakeluarga = "Istri : ".$namakeluarga;
    }
    else $datakeluarga .= "<br>Anak : ".$namakeluarga;
  }
  if(!$datakeluarga) $datakeluarga = "&nbsp;";
  $posisi = sebutposisi ($kd_posisi);

  print "
  <tr bgcolor=$warna>
    <td valign=top><font size=1>$nama </font></td>
    <td align=center valign=top><font size=2>
      <a href=cek-pegawai.php?session=$session&nipeg=$nipeg&pos=$kd_posisi>$nipeg</a> </font>
    </td>
    <td valign=top><font size=1>$jabatan </font></td>
    <td align=left valign=top><font size=1>$posisi </font></td>
      <td valign=top><font size=1>$alamat </font></td>  
	  <td valign=top><font size=1>$gol_darah </font></td> 
    <td valign=top><font size=1>$datakeluarga </font></td>
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
  $i++;
}

?>


</table>
<hr align=center width=100%>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
  <tr>
    <td align="center">

<?
/* navigator next dan prev */
$rev = ($rev == 0) ? 1 : 0;
/* tampilan prev ( << ) */
if($startpeg) {
  $prevpeg = $startpeg - $limitpeg;
  print"
      <a href=?session=$session&fld=$fld&rev=$rev&startpeg=$prevpeg&search=$search&namafld=$namafld&namaposisi=$namaposisi><<</a>&nbsp;
  ";
}
/* cari total jumlah halaman data */
$jumhalpeg = ceil($jumdata / $limitpeg);
for($nohalpeg = 1; $nohalpeg <= $jumhalpeg; $nohalpeg++) {
  $nextpeg = $limitpeg * ($nohalpeg - 1);
  print "
      <a href=?session=$session&fld=$fld&rev=$rev&startpeg=$nextpeg&search=$search&namafld=$namafld&namaposisi=$namaposisi>$nohalpeg</a>&nbsp;
  ";
}

if($jumhalpeg && ($jumhalpeg != 1) &&
  (($startpeg / $limitpeg) != ($jumhalpeg - 1))) {
  $nextpeg = $startpeg + $limitpeg;
  print "
      <a href=?session=$session&fld=$fld&rev=$rev&startpeg=$nextpeg&search=$search&namafld=$namafld&namaposisi=$namaposisi>>></a>
  ";
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