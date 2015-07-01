<?
include "inc/config.inc.php";
include "inc/function.inc.php";


if(!ceksession($session, $act)) header("Location: errorsession.htm");
bukadb();
/* cek form isian */
if($pass1 && $pass2 && $pass3) {
  $q = mysql_query("select user, ip from $tbl_session where session='$session'");
  list($user, $ip) = mysql_fetch_row($q);
  $q = mysql_query("select pass from $tbl_user where user='$user'");
  list($pass) = mysql_fetch_row($q);
  /* cek apakah password dan konfirmasi cocok */
  if((!strcmp($pass, $pass1)) && (!strcmp($pass2, $pass3))) {
    $act = "Mengganti password"; $timestamp = time();
    /* ganti password user */
    $q = mysql_query("update $tbl_user set pass='$pass2' where user='$user'");
    /* masukkan ke dalam logs */
    $q = mysql_query("insert into $tbl_logs (user, ip, time, act)
      values ('$user', '$ip', '$timestamp', '$act')");
    $msg = "Perubahan password berhasil dilakukan !";
    $url = "home.php?session=$session";
  }
  else {
    $msg = "Password tidak sama !";
    $url = "home.php?session=$session";
  }
}
else {
  $msg = "Form isian tidak lengkap !";
  $url = "home.php?session=$session";
}

print "
<html>
<head>
  <meta http-equiv=Refresh content=\"2; url=$url\">
</head>
<body>
<center><h3>$msg</h3></center>
</body>
</html>
";
?>