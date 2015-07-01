<?
include "inc/config.inc.php";
include "inc/function.inc.php";
//$user = $_POST["user"];
//$pass = $_POST["pass"];

/* file ini melakukan pengecekan login, apabila sukses akan menuju home.php */
if(!ceklogin($user, $pass)) header("Location: errorlogin.htm");
?>