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
			<li><a href=benefit.php?session=$session&nipegku=$user>Benefit</a></li>
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
$sql = "select nipeg from admin_dosir where nipeg like '$adadata%'";
$q = mysql_query($sql);
list($cek_nipeg) = mysql_fetch_row($q);

$sql = "select nipeg from super_admin where nipeg like '$adadata%'";
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
		<div class = "scroll2">
		<?
		
			 print"
    
                    	    <table width=120% border=2 cellspacing=0 cellpadding=2 align=center>
                    	    <tr>
       <td width=4% align=left><span class=style9 style2><strong>No.</strong></span></td>
      <td width=12% align=left bgcolor=#CCCCCC><span class=style9 style2><strong>Nipeg</strong></span></td>
  	  <td width=20% align=left ><span class=style9 style2><strong>Nama Pegawai</strong></span></td>
      <td width=25% align=left bgcolor=#CCCCCC><span class=style9 style2><strong>Nama Pasien </strong></span></td>
      <td width=7% align=left><span class=style9 style2><strong>Hubungan</strong></span></td>
      <td width=5% salign=left bgcolor=#CCCCCC><span class=style9 style2><strong>Jenis Rawat </strong></span></td>
      <td width=18% align=left><span class=style9 style2><strong>Tempat Berobat</strong> </span></td>
	   <td width=20% align=left bgcolor=#CCCCCC><span class=style9 style2><strong>Tindakan </strong></span></td>
	  <td width=7% align=left ><span class=style9 style2><strong>Tanggal Berobat</strong></span></td>
	  <td width=7% align=left bgcolor=#CCCCCC><span class=style9 style2><strong>Tanggal Selesai Berobat</strong></span></td>
	  <td align=left><span class=style9 style2><strong>Jenis Penyakit</strong></span></td>
	  <td align=left bgcolor=#CCCCCC><span class=style9 style2><strong>Biaya Berobat </strong></span></td>
  </tr>
";
	
/* riwayat benefit ALL*/
$urut = 1;
$sql1 = "select nipeg, nama, PA9002_ZZCLPATIENT, Memb, Rawat_Jalan,	Rawat_Inap ,Account_Number_of_Vendor_or_Creditor,	PA9002_ZZCLNONLNGN,PA9002_ZZCLKET,start_date,end_date,Z9002_DISEASE_ZZCLDISEASE,ZPA9002_DETAIL_ZZCLAMT from tb_benefit where nipeg='$nipegku'  ";
$q1 = mysql_query($sql1);


while(list($nipeg1, $nama, $pasien, $hubungan, $rawat_jalan, $Rawat_Inap, $tempat1, $tempat2,$tindakan, $tgl_berobat1,$tgl_selesai,$penyakit,$biaya) = mysql_fetch_row($q1)) {
  
  print "
  <tr bgcolor= white>
    <td align=left valign=top>$urut</td>
    <td valign=top bgcolor=#CCCCCC >$nipeg1</td>
	 <td  valign=top width=13% >$nama</td>
	 <td  valign=top width=15% bgcolor=#CCCCCC>$pasien</td>
	 ";
	 if($hubungan=="1") $hubungan="Suami/Istri";
	 else if ($hubungan=="2") $hubungan="Anak";
	 else $hubungan="Ybs";
	 print"
	  <td  valign=top>$hubungan</td>
    ";
	
	 $jenis_rawat = ($rawat_jalan == "X") ? "Rawat jalan" : "Rawat Inap";
	
	print"
	
	 <td  valign=top align=left bgcolor=#CCCCCC>$jenis_rawat</td>
	";
	 $tempat_berobat = ($tempat1 == "") ? "$tempat2" : "$tempat1";
	print"
	 
	 <td  valign=top>$tempat_berobat</td>
	 <td  valign=top bgcolor=#CCCCCC>$tindakan</td>
	 <td  valign=top>$tgl_berobat1</td>
	 <td  valign=top bgcolor=#CCCCCC>$tgl_selesai</td>
	 ";
	 $penyakit = ($penyakit == "") ? "--------" : "$penyakit";
	 
	 $biaya = 'Rp.'. number_format($biaya, 0, '.', ','); 
	print"
	 <td  valign=top width=10%>$penyakit</td>
	  <td  valign=top bgcolor=#CCCCCC>$biaya</td>
  </tr>
  ";
  
    $urut++;

}
print " </table> ";

$sql = "select SUM(ZPA9002_DETAIL_ZZCLAMT) AS total_biaya  from tb_benefit WHERE nipeg ='$nipeg' ";
 $result = mysql_query($sql) or die (mysql_error());
    $t = mysql_fetch_array($result);
	$jumlah = $t['total_biaya'];
	$totalbiaya += $jumlah;
	
$in_rp = 'Rp. '. number_format($totalbiaya, 0, '.', ','); 
print" <b>Total Biaya Kesehatan = $in_rp,-</b> ";

?>
			<h1>&nbsp;</h1>			
			<p>&nbsp;</p>
           	  <p>&nbsp;</p>
           	  <p>&nbsp;</p>
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