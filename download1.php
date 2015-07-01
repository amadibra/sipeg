
    <?php


include_once "inc/function.inc.php";
include_once "inc/tools.inc.php";


$dbhost = "localhost";
$dbuser= "root";
$dbpass = "";
$dbname = "dbsipeg";

//bukadb
$connection = mysql_connect($dbhost, $dbuser, $dbpass) or die("Kesalahan Koneksi ...!!");
mysql_select_db($dbname, $connection) or die("Databasenya Error");

// membaca nilai time file yang berasal dari link download.php?time=...
$id      = $_GET['time'];
  
// query untuk mencari data file yang akan didownload dalam database
$query   = "SELECT * FROM upload WHERE time = $id ";
 
$hasil   = mysql_query($query);
$data    = mysql_fetch_array($hasil);
 
  
   header("Content-Disposition: attachment; filename=".$data['name']);
   header("Content-length: ".$data['size']);
 
   header("Content-type: ".$data['type']);
 
  // proses membaca isi file yang akan didownload dari folder 'dozir'
   $fp  = fopen("dozir/".$data['name'],'r');
   $content = fread($fp, filesize('dozir/'.$data['name']));
   fclose($fp);
 
  // menampilkan isi file yang akan didownload
   echo $content;

  exit;
?>



