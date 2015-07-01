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

$tbl_dozir="dozir";

$act = "Hapus Dozir";
    // membaca id file yang akan dihapus
    $namafile      = $_GET['namafile'];
	$nip = $_GET['nip'];
	$time = $_GET['time'];
    // membaca nama file yang akan dihapus berdasarkan id
    $query   = "SELECT * FROM $tbl_dozir WHERE namafile = '$namafile' ";
    $hasil   = mysql_query($query) or die(mysql_error()); 
  	$data    = mysql_fetch_array($hasil);
	$namaFile = $data['name'];

    // query untuk menghapus informasi file berdasarkan 
    $query = "DELETE FROM $tbl_dozir where time = $time && namafile='$namafile' ";
    mysql_query($query)or die(mysql_error()); 
	

    // menghapus file dalam folder sesuai namanya
    unlink("dozir/".$namafile);
    echo "File telah dihapus";
print "<meta http-equiv=Refresh content=\"2; url=carinama.php?session=$session\">";

?>
