<?
include "inc/config.inc.php";
include "inc/function.inc.php";
include "inc/tools.inc.php";

/* cek session pengunjung */
$act = "Biodata pegawai";
if(!ceksession($session, $act)) header("Location: errorsession.htm");
/* cek apakah pengunjung mau melihat data dirinya atau orang lain */
$sql = "select user from $tbl_session where session='$session'";
$q = mysql_query($sql);
list($user) = mysql_fetch_row($q);
if($user != $nipeg) {
  /* pengunjung mencoba melihat data yang bukan dirinya */
  $boleliat = 0;
  /* cari kd_posisi dan kd_jabatan dari user */
  $sql = "select kd_posisi, kd_jabatan from $tbl_bio01 where nipeg like'$user%'";
  $q = mysql_query($sql);
  list($posuser, $jabuser) = mysql_fetch_row($q);
 
  /* cari kd_posisi nipeg yang ingin dilihat */
  $sql = "select kd_posisi from $tbl_bio01 where nipeg='$nipeg'";
  $q = mysql_query($sql);
  list($posnipeg) = mysql_fetch_row($q);

  $jabuser = substr($jabuser, 0, 1);
  if($jabuser == 1) {
    /* pejabat struktural mau lihat data, cek dulu kode posisinya */
    $cekpos = strpos($posnipeg, $posuser);
    $tipecekpos = gettype($cekpos);
    if(($cekpos == 0) && (is_int($cekpos))) {
      /* pejabat struktural dengan kode posisi yang sesuai */
      $boleliat = 1;
    }

    $sql = "select kd_posisi from $tbl_admin where nipeg='$user'";
    $q = mysql_query($sql);
    while(list($posuser) = mysql_fetch_row($q)) {
      $cekpos = strpos($posnipeg, $posuser);
      $tipecekpos = gettype($cekpos);
      if(($cekpos == 0) && (is_int($cekpos))) {
        $boleliat = 1;
        break;
      }
    }

  }
  else {
    /* orang recehan mau lihat data orang lain, cek dulu apakah seorang special user */
    $sql = "select kd_posisi from $tbl_admin where nipeg='$user'";
    $q = mysql_query($sql);
    while(list($posuser) = mysql_fetch_row($q)) {
      $cekpos = strpos($posnipeg, $posuser);
      $tipecekpos = gettype($cekpos);
      if(($cekpos == 0) && (is_int($cekpos))) {
        $boleliat = 1;
        break;
      }
    }
  }

  if($boleliat) include "biodata1.php";
  else {
    /* kick his ass */
    print "
      <html>
      <head>
        <meta http-equiv=Refresh content=\"2; url=daftar-pegawai.php?session=$session\">
      </head>
      <body>
      <center><h3>Anda tidak punya hak akses untuk melihat biodata $nipeg!</h3></center>
      </body>
      </html>
    ";
  }
}
else {
  /* pengunjung boleh liat biodata dirinya */
  include "biodata.php";
}
?>
