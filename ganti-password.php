<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="images/icon/profile.png"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>SIPeg - Ganti Password</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
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
	  <a href="#"></a>
	  <h2>&nbsp;</h2>
	</div>
</div>

        <div id="buttons">
		<ul>
		
		
		<?
include "inc/config.inc.php";
include "inc/function.inc.php";

$act = "ganti password";
if(!ceksession($session, $act)) header("Location: errorsession.htm");
/* cari nipeg pengunjung */
$sql = "select user from $tbl_session where session='$session'";
$q = mysql_query($sql);
list($user) = mysql_fetch_row($q);

$sql1 = "select kd_posisi from $tbl_bio01 where nipeg='$user'";
$q1 = mysql_query($sql1);
list($kd_posisi) = mysql_fetch_row($q1);
		
		print "
			<li class=first><a href=home.php?session=$session>Home</a></li>
			<li><a href=hak.php?session=$session>Hak</a></li>
			<li><a href=kewajiban.php?session=$session>Kewajiban</a></li>
			<li><a href=info-pegawai.php?session=$session>Informasi Pegawai </a></li>
			
			
			";
			?>
			
			
		</ul></div>
		<a href="#" ></a>
<!-- header ends -->
<!-- content begins -->
<div id="content_bg">
  <div id="content">
	<div id="right">
    	<div id="archives">
				<h2>Menu</h2>
				<ul>
					<?		

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
		   		";
		}

print "
				  <li><a href=ganti-password.php?session=$session>Ganti Password</a></li>
				  <li><a href=logout.php?session=$session>Keluar</a></li>
				  ";	
			?>   
		   
				</ul>
         </div>
				
        </div>
          	<div id="left3">
			
			
			<table align=center width=95% cellpadding=2 cellspacing=0 border=0>
  <tr>
    <td colspan=2 align=center><p class="style1"><font size=4>.: Mengganti Password :.</font></p>
      <p class="style1">&nbsp;</p></td>
  </tr>
  <tr>
   
  </tr>
</table>


<table align=right cellpadding=2 cellspacing=0 width=95%>
 <td colspan=2><hr align=center width=100%></td>
 <?	
 print "
  <form action=ganti-pass-do.php?session=$session method=post>
  ";
  ?>
  <tr>
    <td height="22"><div align="center" class="style1">Password Lama</div></td>
    <td><input type=password name=pass1 maxlength=50></td>
  </tr>
  <tr>
    <td height="37"><div align="center" class="style1">Password Baru</div></td>
    <td><input type=password name=pass2 maxlength=50></td>
  </tr>
  <tr>
    <td><div align="center" class="style1">Konfirmasi Password Baru</div></td>
    <td><input type=password name=pass3 maxlength=50></td>
  </tr>
  <tr>
    <td colspan=2><hr align=center width=100%></td>
  </tr>
  <tr>
    <td align=center colspan=2><input type=submit value=Kirim></td>
  </tr>
  </form>
</table>
		
				<div class="date"></div>

    
            
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