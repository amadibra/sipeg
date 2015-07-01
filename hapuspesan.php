<?

$dbuser = "root";                       /* database user */
$dbpass = "";                       /* database password */
$dbname = "dbsipeg";                     /* database name */
$dbhost = "localhost";               /* database server location */
$secexpire = "900";                      /* session expire time, in second */


$koneksi=mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname,$koneksi);
include "inc/function.inc.php";
include "inc/tools.inc.php";

$tbl_pesan="pesan";

$act = "Hapus Pesan";
    // membaca id file yang akan dihapus
  	$nipeg = $_GET['nipeg'];
	$id = $_GET['id'];
    // membaca nama file yang akan dihapus berdasarkan id
    $query   = "SELECT * FROM $tbl_pesan WHERE id = '$id' ";
    $hasil   = mysql_query($query) or die(mysql_error()); 
  	$data    = mysql_fetch_array($hasil);
	
    // query untuk menghapus informasi file berdasarkan 
    $query = "DELETE FROM $tbl_pesan where id = $id  ";
    mysql_query($query)or die(mysql_error()); 


  
    echo "Pesan telah dihapus";
print "<meta http-equiv=Refresh content=\"2; url=daftar-pesan.php?session=$session\">";

?>
