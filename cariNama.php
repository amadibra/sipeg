<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>SIPeg - Input Dozir</title>
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

session_start();
session_register("nipeg1");
$act = "Import Dozir";
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

if($nipeg=='9215242ZY') {
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
			
	
		
	
	
	$sql1 = "select nama, jabatan, kd_posisi, grade_sk, tgl_setara, tgl_masuk, tgl_capeg, tgl_tetap, tgl_lahir,tpt_lahir, alamat, kota, kelamin, agama, perkawinan, jml_klrg,gol_darah from $tbl_bio01 where nipeg='$nipeg1'";
$q1 = mysql_query($sql1);
list($nama, $jabatan, $kd_posisi, $grade, $tgl_setara, $tgl_masuk, $tgl_capeg, $tgl_tetap, $tgl_lahir, $tpt_lahir,
     $alamat, $kota, $jk, $agama, $perkawinan, $jml_klrg, $gol_darah) = mysql_fetch_row($q1);

$posisi = sebutposisi2 ($kd_posisi);						
	
	
	print "		
		</ul></div>
		
<!-- header ends -->
<!-- content begins -->
<div id='content_bg'>
  <div id='content'>


<div id='right'>
<div class= 'scroll'>
<form action=dozir_do.php?session=$session method=post enctype=multipart/form-data >
<table border='0' width='350' cellpadding='2'  cellspacing='2' align='center' bgcolor=#FFCC33>
<h1 ><strong> Data Dozir</strong></h1>
<table width=100% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td align=center><span class=style9 style2>No.</span></td>
    <td align=left><span class=style9 style2>Jenis </span></td>
    <td align=left valign=top><span class=style9 style2>Nama</span></td>
    <td align=left><span class=style9 style2>Nomor</span></td>
    <td align=left><span class=style9 style2>Tanggal </span></td>
    <td align=left><span class=style9 style2>File</span></td>
	 <td align=left><span class=style9 style2>Pilihan</span></td>

  </tr>
";

/* dozir */
$urut = 1;
if($urut%2) $warna = 'LIGHTGREY' ;
  else $warna = 'WHITE';
$sql1 = "select keterangan, no_sk, namafile, tgl_sk,time,id
         from $tbl_dozir where nipeg='$nipeg1'&& id_dozir='$id_dozir' order by tgl_SK ASC" ;
$q1 = mysql_query($sql1);
while(list($keterangan, $no_sk, $namafile, $tgl_sk,$time,$id) = mysql_fetch_row($q1)) {
  $sql2 = "select nama_dozir from jenis_dozir where id_dozir='$id_dozir'";
  $q2 = mysql_query($sql2);
  list($nama_dozir) = mysql_fetch_row($q2);
  $tgl_sk = tgl2ind($tgl_sk);  
  print "
  <tr bgcolor= $warna>
    <td align=left valign=top>$urut</td>
    <td align=left valign=top>$nama_dozir</td>
    <td align=left valign=top>$keterangan</td>
    <td align=left valign=top>$no_sk</td>
    <td align=left valign=top>$tgl_sk</td>
     <td align=left valign=top>$namafile</td>
	  <td valign =top>
	 <a href='carinama2.php?session=$session && namafile=".$namafile." && nip = ".$nipeg." && time=".$time." && id_dozir=".$id_dozir." && no_sk=".$no_sk." && keterangan=".$keterangan." && id=".$id."'>Edit</a>
	
	 <a href='hapus.php?session=$session && namafile=".$namafile." && nip = ".$nipeg." && time=".$time." '>Delete</a> 
	 </td>
	 
  </tr>
 ";
  $urut++;
}
print "
</table>
</table>
</form>
</div>
</div>


          	<div id='left5' >
		
	<form action=dozir_do.php?session=$session method=post enctype=multipart/form-data >	
<table border=1 width=100% cellpadding=2  cellspacing=2 align=center bgcolor=#FFCC33>

<h1 class='style1'>
  Input Dozir Pegawai
</h1>



</tr>
<tr>
  <tr>
  <td><strong>NIPEG</strong></td>
  <td><input type=\"text\" name=\"nipeg1\" size=\"30\" id=\"nipeg\" disabled=\"disabled\" maxlength=\"9\" value=$nipeg1></td>
</tr>
<tr><td valign =top><strong>Nama</strong></td><td><textarea name=\"nama\"  disabled=\"disabled\" cols=\"30\" rows=\"1\">$nama</textarea></td></tr>
<tr><td valign =top><strong>Jabatan</strong></td><td><textarea name=\"jabatan\"  disabled=\"disabled\" cols=\"30\" rows=\"4\">$jabatan</textarea></td></tr>

<tr><td><strong>Grade</strong></td><td><input type=\"text\" name=\"grade\" disabled=\"disabled\"  size=\"10\" maxlength=\"10\" id=\"grade\" value=$grade></td></tr>


<tr><td valign =top><strong>Unit</strong></td><td><textarea name=\"unit\"  disabled=\"disabled\" cols=\"30\" rows=\"4\">$posisi</textarea></td></tr>

<tr>


  <td><strong>Jenis Data </strong></td>
  <td>
 
 
 
<select name='dozir[]' >
<option value=0 selected></option>
";


$q = mysql_query("select * from jenis_dozir "); 
 
while ($row1 = mysql_fetch_array($q)){
  echo "<option value=$row1[id_dozir]>$row1[id_dozir].$row1[nama_dozir] </option>";

}

print "
</select>




     </td></tr>

	 <tr>
	 	 <td></td>
	 <td> <input type=submit name=kirim value=Lihat> </td></tr>
	  <tr>
  <td><strong>File </strong></td><td><input type=file name=dozir size=30 maxlength=50/></td></tr>
  
  <tr>
  <td><strong>Nomor</strong></td><td><input type=text name=No_SK size=40 maxlength=50/></td></tr>
	 
<tr>

<tr>
  <td><strong>Tanggal</strong></td>
  <td>
";
  //menampilkan pilihan combobox untuk tanggal
 
   echo "<select name=\"tgl\">";
   for ($tgl=01; $tgl<=31; $tgl++)
  {
       if ($tgl == $tanggal) echo "<option value=\"
                                  ".$tgl."\" selected>".$tgl.
                                "</option>";
       else echo "<option value=\"".$tgl."\">".$tgl."</item>";
  }
   echo "</select>";

   // menampilkan pilihan combobox untuk bulan
 
   echo "<select name=\"bln\">";
 for ($bln=01; $bln<=12; $bln++)
   {
       if ($bln == $bulan) echo "<option value=\"
                                 ".$bln."\" selected>".$bln.
                                 "</option>";
       else echo "<option value=\"".$bln."\">".$bln."</option>";
   }
   echo "</select>";
 
   // menampilkan pilihan combobox untuk tahun
   // dibatasi hanya mulai th. 1940 - 2008
 
   echo "<select name=\"thn\">";
   for ($thn=1955; $thn<=2020; $thn++)
   {
       if ($thn == $tahun) echo "<option value=\"
                                ".$thn."\" selected>".$thn.
                                "</option>";
       else echo "<option value=\"".$thn."\">".$thn."</option>";
   }
   echo "</select>"; 
   
   
	
  
print "
  </td></tr>
  
	 
<tr>
  <tr><td valign =top><strong>Keterangan</strong></td><td><textarea name=\"keterangan\" cols=\"30\" rows=\"4\"></textarea></td></tr>

 
  
<tr><td></td><td>
<input type=submit name=kirim value=Simpan>
  <label><strong>
   <a href='inputdozir1.php?session=$session '>Batal </a>
  </strong></label></td></tr>
  <tr>
  </tr>
</table>

	</form>
		";
		?>
	
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

