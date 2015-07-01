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
			<li><a href=Dozir.php?session=$session>Lihat Dozir</a></li>
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
if($adadata) {
  print "	  
				   <li><a href=daftar-pesan.php?session=$session>Daftar Pesan</a></li>
				   <li><a href=importSAP.php?session=$session>Import Data dari SAP</a></li>
				    <li><a href=inputdozir1.php?session=$session>Input Dozir</a></li>
		   		";
		}
print "	
			<li><a href=logout.php?session=$session>Keluar</a></li>
			
							
			";	
	
		
	$nipeg=$_POST['nipeg1'];
	
	
	$sql1 = "select nama, jabatan, kd_posisi, grade_sk, tgl_setara, tgl_masuk, tgl_capeg, tgl_tetap, tgl_lahir,tpt_lahir, alamat, kota, kelamin, agama, perkawinan, jml_klrg,gol_darah from $tbl_bio01 where nipeg='$nipeg'";
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
<table border='1' width='90%' cellpadding='2'  cellspacing='2' align='center' bgcolor=#FFCC33>
<h1 ><strong> Data Dozir</strong></h1>
<table width=100% border=2 cellspacing=0 cellpadding=2 align=center>
  <tr bgcolor=#FFFF66>
    <td width=5% align=center><span class=style9 style2>No.</span></td>
    <td align=center><span class=style9 style2>Jenis dozir</span></td>
    <td align=center><span class=style9 style2>Keterangan</span></td>
    <td align=center><span class=style9 style2>Nomor Sk</span></td>
    <td align=center><span class=style9 style2>Tgl SK</span></td>
    <td align=center><span class=style9 style2>nama File</span></td>
  </tr>
";


 echo "id_dozir";
/* dozir */
$urut = 1;
if($urut%2) $warna = 'LIGHTGREY' ;
  else $warna = 'WHITE';
$sql1 = "select id_dozir, keterangan, no_sk, namafile, tgl_sk
         from $tbl_dozir where nipeg='$nipeg1' &  id_dozir='$id_dozir'";
$q1 = mysql_query($sql1);
while(list($id_dozir, $keterangan, $no_sk, $namafile, $tgl_sk) = mysql_fetch_row($q1)) {
  $sql2 = "select nama_dozir from jenis_dozir where id_dozir='$id_dozir'";
  $q2 = mysql_query($sql2);
  list($nama_dozir) = mysql_fetch_row($q2);
 
  
  print "
  <tr bgcolor= $warna>
    <td align=center>$urut</td>
    <td>$nama_dozir</td>
    <td align=center>$keterangan</td>
    <td>$no_sk</td>
    <td>$tgl_sk</td>
     <td >$namafile</td>
  </tr>
 ";
  $urut++;
}
print "
</table>
</table>


</div>


          	<div id='left5' >
		
		<form action=dozir_do.php?session=$session method=post enctype=multipart/form-data >
<table border=1 width=100% cellpadding=2  cellspacing=2 align=center bgcolor=#FFCC33>

<h1 class='style1'>
  Input Dozir Pegawai
</h1>


<tr>
<td></td>
</tr>
<tr>
  <tr>
  <td><strong>NIPEG</strong></td>
  <td><input type=\"text\" name=\"nipeg1\" size=\"30\" id=\"nipeg\" disabled=\"disabled\" maxlength=\"9\" value=$nipeg1></td>
</tr>
<tr><td><strong>Nama</strong></td>
  <td><input type=\"text\" name=\"nama\" size=\"30\" disabled=\"disabled\" maxlength=\"30\" value=$nama></td>
  
</tr>
<tr><td><strong>Jabatan</strong></td><td><textarea name=\"jabatan\"  disabled=\"disabled\" cols=\"30\" rows=\"4\">$jabatan</textarea></td></tr>

<tr><td><strong>Grade</strong></td><td><input type=\"text\" name=\"grade\" disabled=\"disabled\"  size=\"30\" maxlength=\"50\" id=\"grade\" value=$grade></td></tr>


<tr><td><strong>Unit</strong></td><td><textarea name=\"unit\"  disabled=\"disabled\" cols=\"30\" rows=\"4\">$posisi</textarea></td></tr>

<tr><td><strong>Grade</strong></td><td><input type=\"text\" name=\"grade\" disabled=\"disabled\"  size=\"30\" maxlength=\"50\" id=\"grade\" value=$grade></td></tr>
<tr>

  <td><strong>Jenis Dozir </strong></td>
  <td>
  
<select name='dozir[]'>
<option value=0 selected>- dozir -</option>
";

$q = mysql_query("select * from jenis_dozir "); 
 
while ($row1 = mysql_fetch_array($q)){
  echo "<option value=$row1[id_dozir]>$row1[id_dozir].$row1[nama_dozir] </option>";

}


print "
</select>

<a href='cekdozir.php'session='$session' class='style3'>Cek</a>


     </td></tr>
	  <tr>
  <td><strong>File Dozir</strong></td><td><input type=file name=dozir size=30 maxlength=50/></td></tr>
  
  <tr>
  <td><strong>Nomor</strong></td><td><input type=text name=no_sk size=30 maxlength=50/></td></tr>
	 
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
   for ($thn=1980; $thn<=2020; $thn++)
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
  <td><strong>Keterangan</strong></td><td><input type=text name=keterangan size=30 maxlength=50/></td></tr>
  
 
  
<tr><td></td><td><input type=submit name=kirim value=Simpan>
  <label>
  <input type=reset name=reset id=button value=Batal>
  </label></td></tr>
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

