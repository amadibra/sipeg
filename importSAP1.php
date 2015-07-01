<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>SIPeg - Import Data dari SAP</title>
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

$act = "Import data SAP";
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
$sql = "select nipeg from super_admin where nipeg like '$adadata'";
$q = mysql_query($sql);
list($super) = mysql_fetch_row($q);

if($super != '') {
  print "	  
				   <li><a href=daftar-pesan.php?session=$session>Daftar Pesan</a></li>
				   <li><a href=importSAP.php?session=$session>Import Data dari SAP</a></li>
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

          	<div id="left4" >
		
    <table width=100% border=0 cellspacing=8 cellpadding=0 align=center>
      <tr>
        <td colspan=3 align=center><font size=4 color = white><b>.: IMPORT DATA SAP :.</b></font></td>
      </tr>
      
    </table>
    <?
    print "
    <p><font color=white>File SAP yang diimport harus dalam bentuk format .DBF</font>      </p>
    <table width=564 border=0>
        <tr>
      <form action=sisp/buka-file-bio01.php?session=.$session. method=post enctype=multipart/form-data >      
          <td><strong><font color=white>.: File Data Diri :</font></strong></td>
          <td><font color=white>
              <input name=userfile type=file />
            </font></td>
          <td><input name=upload type=submit value=Import></td>
        </form>
        </tr>

        <tr>
     <form action=sisp/buka-file-bio10.php?session=.$session. method=post enctype=multipart/form-data >      
          <td><strong><font color=white>.: File Data Keluarga :</font></strong></td>
          <td><font color=white>
              <input name=userfile type=file />
            </font></td>
          <td><input name=upload type=submit value=Import></td>
          <td> </td>
      </form>
        </tr>

        <tr>
      <form action=sisp/buka-file-bio03.php?session=.$session. method=post enctype=multipart/form-data >      
          <td><strong><font color=white>.: File Riwayat Jabatan :</font></strong></td>
          <td><font color=white>
              <input name=userfile type=file />
            </font></td>
          <td><input name=upload type=submit value=Import /></td>
          <td> </td>
      </form>
        </tr>
        <tr>
      <form action=sisp/buka-file-bio04.php?session=.$session. method=post enctype=multipart/form-data >      
          <td><strong><font color=white>.: File Pendidikan Formal :</font></strong></td>
          <td><font color=white>
              <input name=userfile type=file />
            </font>
          </td>
          <td><input name=upload type=submit value=Import /></td>
          <td>
          </td>
      </form>
        </tr>
		 <tr>
     <form action=sisp/buka-file-bio05.php?session=.$session. method=post enctype=multipart/form-data >      
          <td><strong><font color=white>.: File Pendidikan Non Formal :</font></strong></td>
          <td><font color=white>
              <input name=userfile type=file />
            </font>
          </td>
          <td><input name=upload type=submit value=Import /></td>
          <td>
          </td>
      </form>
        </tr>
		 <tr>
     <form action=sisp/buka-file-tbkondite.php?session=.$session. method=post enctype=multipart/form-data >      
          <td><strong><font color=white>.: File Kondite :</font></strong></td>
          <td><font color=white>
              <input name=userfile type=file />
            </font>
          </td>
          <td><input name=upload type=submit value=Import /></td>
          <td>
          </td>
      </form>
        </tr>
		<tr>
		 <form action=sisp/buka-file-golongan.php?session=.$session. method=post enctype=multipart/form-data >      
          <td><strong><font color=white>.: File Riwayat Golongan :</font></strong></td>
          <td><font color=white>
              <input name=userfile type=file />
            </font>
          </td>
          <td><input name=upload type=submit value=Import /></td>
          <td>
          </td>
      </form>
        </tr>
		<tr>
		 <form action=sisp/buka-file-tbgjdsr.php?session=.$session. method=post enctype=multipart/form-data >      
          <td><strong><font color=white>.: File Riwayat Gaji Dasar sbg PhDP :</font></strong></td>
          <td><font color=white>
              <input name=userfile type=file />
            </font>
          </td>
          <td><input name=upload type=submit value=Import /></td>
          <td>
          </td>
      </form>
        </tr>
		<tr>
		 <form action=sisp/buka-file-profesi.php?session=.$session. method=post enctype=multipart/form-data >      
          <td><strong><font color=white>.: File Riwayat Sebutan Profesi 1 :</font></strong></td>
          <td><font color=white>
              <input name=userfile type=file />
            </font>
          </td>
          <td><input name=upload type=submit value=Import /></td>
          <td>
          </td>
      </form>
        </tr>
		<tr>
		 <form action=sisp/tambah-admin.php?session=.$session. method=post enctype=multipart/form-data >      
          <td><strong><font color=white>.: User_Admin :</font></strong></td>
          <td><font color=white>
              <input name=userfile type=file />
            </font>
          </td>
          <td><input name=upload type=submit value=Import /></td>
          <td>
          </td>
      </form>
        </tr>
    </table>
    <p><br>
    </p>
    <p>   </p>";
    ?>
   

           	  
					   
            
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