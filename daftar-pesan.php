<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>SIPeg - Daftar Pesan</title>
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

$act = "Daftar pesan";
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
	
          	<div id= "left2" >
			
<?

print "
<table width=100% border=0 cellspacing=0 cellpadding=2 align=center>
  <tr>
    <td colspan=3 align=center><font size=4 color = white><b>.: DAFTAR PESAN :.</b></font></td>
  </tr>

  <tr>
    <td colspan=3 align=center>
  
    </td>
  </tr>
  <tr>
    <td colspan=3><hr></td>
  </tr>
  </table>
";

print "
<table width=100% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=black>
    <td align=center><b><font color=#FFFFFF>No</font></b></td>
    <td align=center><b><font color=#FFFFFF>Nipeg</font></b></td>
    <td align=center><b><font color=#FFFFFF>Nama</font></b></td>
    <td align=center><b><font color=#FFFFFF>Tanggal</font></b></td>
    <td align=center><b><font color=#FFFFFF>File</font></b></td>
    <td align=center><b><font color=#FFFFFF>Tertulis</font></b></td>
    <td align=center><b><font color=#FFFFFF>Seharusnya</font></b></td>
	<td align=center><b><font color=#FFFFFF>Cek</font></b></td>
  </tr>
";

  $sql1 = "select no,id, nipeg, nama, kd_posisi, time, tanggal, komentar, tertulis, seharusnya, flag,status
          from $tbl_pesan where flag='0' order by  tanggal ASC";
  $q1 = mysql_query($sql1);
  echo mysql_error();
  $jumdata = mysql_num_rows($q1);

/* riwayat pengobatan */
$urut = 1;
while(list($no,$id, $nipeg, $nama, $kd_posisi, $time, $tanggal, $filename, $tertulis, $seharusnya, $flag,$status) = mysql_fetch_row($q1)) {
  if($urut%2) $warna = "LIGHTGREY";
  else $warna = "WHITE";

  /* rapihkan tampilan */
  $time=input2float($time);
  
//$query = "SELECT * FROM upload where time=$time ";
//$hasil = mysql_query($query);
// nama-nama file yang telah diupload 
//$data = mysql_fetch_array($hasil);

  
    print "
  <tr  bgcolor=$warna>
    <td align=center>$urut</td>
    <td align=left>$nipeg</td>
    <td align=left><font size=1>$nama</td>
    <td align=left>$tanggal</td>
    <td align=left><font size=1> <a href='pesan/$filename' >".$filename."</td></a>
    <td align=left><font size=1>$tertulis</td>
    <td align=left><font size=1>$seharusnya</td>
	";
	if ($status ==''){
	print"
	<td align = center> <a href='cekpesan.php?session=$session && id=".$id." '><img src=images/edit.jpg></a> </td>
  </tr>
  ";
  }
  else{
  print"
  <td align = center> <img src=images/cek.jpg></td>
  </tr>
  ";
  }
  $urut++;
}

?>

</table>
<hr align=center width=100%>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
  <tr>
    <td align="center">
<?
print "
</table>
<center>

</center>
";
?>
	<div class="date">
	
	</div>

    
		
				   
            
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