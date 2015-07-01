
    <?php

include_once "inc/config.inc.php";
include_once "inc/function.inc.php";
include_once "inc/tools.inc.php";


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
   $fp  = fopen("pesan/".$data['name'],'r');
   $content = fread($fp, filesize('pesan/'.$data['name']));
   fclose($fp);
   echo $data['content'];

?>



