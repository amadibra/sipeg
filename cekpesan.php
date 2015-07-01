<?

include_once "inc/config.inc.php";
include_once "inc/function.inc.php";
include_once "inc/tools.inc.php";

$tbl_pesan="pesan";

bukadb();
$act = "cek Pesan";
    // membaca id file yang akan dihapus
  	$nipeg = $_GET['nipeg'];
	$id = $_GET['id'];
    // membaca nama file yang akan dihapus berdasarkan id
    $query   = "SELECT * FROM $tbl_pesan WHERE id = '$id' ";
    $hasil   = mysql_query($query) or die(mysql_error()); 
  	$data    = mysql_fetch_array($hasil);
	
    // query untuk menghapus informasi file berdasarkan 
    $query = "UPDATE $tbl_pesan SET status = 'SELESAI' where id = '$id' ";
    mysql_query($query)or die(mysql_error()); 


  
    echo "Pesan telah diupdate";
print "<meta http-equiv=Refresh content=\"2; url=daftar-pesan.php?session=$session\">";

?>
