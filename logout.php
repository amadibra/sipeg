<?
include "inc/config.inc.php";
include "inc/function.inc.php";

$timestamp = time();
bukadb();
/* masukkan ke dalam logs */
$q = mysql_query("select user, ip from $tbl_session where session='$session'");
list($user, $ip) = mysql_fetch_row($q);
$act = "User logout";
$q = mysql_query("insert into $tbl_logs (user, ip, time, act)
  values ('$user', '$ip', '$timestamp', '$act')");

/* hapus session dan session lain yang sudah expired */
$q = mysql_query("delete from $tbl_session where session='$session'");
$q = mysql_query("delete from $tbl_session where last < ($timestamp - $secexpire)");
header("Location: index.php");
?>