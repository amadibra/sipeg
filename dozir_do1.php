<?
include_once "inc/config.inc.php";
include_once "inc/function.inc.php";
include_once "inc/tools.inc.php";

$action = strtolower($_POST['kirim']);


session_start();
session_register("nipeg1","id_dozir");

/* cari ip pengirim */
$timestamp = time();
/* cari nipeg dan nama pengirim */
bukadb();
$sql = "select user, ip from $tbl_session where session='$session'";
$q = mysql_query($sql);
list($nipeg, $ip) = mysql_fetch_row($q);
$sql = "select nama, kd_posisi from $tbl_bio01 where nipeg='$nipeg'";
$q = mysql_query($sql);
list($nama, $kd_posisi) = mysql_fetch_row($q);

// setting nama folder tempat upload
$uploaddir = 'dozir/';

/*inputan ke database upload */


// membaca nama file
$fileName = $_FILES['dozir']['name'];    
 
// membaca nama file temporary
$tmpName  = $_FILES['dozir']['tmp_name'];
 
// membaca size file
$fileSize = $_FILES['dozir']['size'];
 
// membaca tipe file
$fileType = $_FILES['dozir']['type'];
 
if ($filename != ''){ 
// langkah membaca isi file yang diupload
$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

$tgl_entry=date("d/m/y");
$timestamp = time();



foreach ($_POST['dozir'] as $id_dozir)
{
        
// query SQL untuk menyimpan file ke database 
 
$query = "INSERT INTO upload (name,time, size, type, content)
          VALUES ('$fileName','$timestamp', '$fileSize', '$fileType', '$content')";
 
mysql_query($query);



// menggabungkan nama folder dan nama file
$uploadfile = $uploaddir . $fileName;
// proses upload file ke folder 'dozir'
if (move_uploaded_file($_FILES['dozir']['tmp_name'], $uploadfile)) {
    echo "File telah disimpan ke folder";
} else {
    echo "File gagal disimpan ke folder";
}
}


$time= time();

 $tanggal_sk =$tgl."/".$bln."/".$thn; 
$tanggal_sk = tgl2Eng($tanggal_sk);  


if($filename != ''){
/* masukkan ke dalam tabel dozir */
$sql1 = "UPDATE $tbl_dozir SET  nipeg='$nipeg1',id_dozir='$id_dozir',time='$time',keterangan='$keterangan',namafile='$fileName',No_sk='$No_SK',tgl_sk='$tanggal_sk',tgl_entry='$tgl_entry' WHERE id='$id'";
mysql_query($sql) or die (mysql_error());
}
else 
{

$sql1 = "UPDATE $tbl_dozir SET  nipeg='$nipeg1',id_dozir='$id_dozir',time='$time',keterangan='$keterangan',No_sk='$No_SK',tgl_sk='$tanggal_sk',tgl_entry='$tgl_entry' WHERE id='$id'";
mysql_query($sql) or die (mysql_error());

}
}

/* masukkan ke dalam logs */
$act = "update data dozir";
$sql = "insert into $tbl_logs (user, ip, kd_posisi, time, act) values ('$nipeg1', '$ip', '$kd_posisi', '$timestamp', '$act')";
$q = mysql_query($sql);



print "
<html>
<head>
<meta http-equiv=Refresh content=\"2; url=carinama.php?session=$session\">
</head>
<body>
<center><h3>Update Dozir berhasil !</h3></center>
</html>
";


?>