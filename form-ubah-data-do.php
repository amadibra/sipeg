<?
include_once "inc/config.inc.php";
include_once "inc/function.inc.php";
include_once "inc/tools.inc.php";

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


/*inputan ke database upload */

// membaca nama file
$fileName = $_FILES['userfile']['name'];    
 
// membaca nama file temporary
$tmpName  = $_FILES['userfile']['tmp_name'];
 
// membaca size file
$fileSize = $_FILES['userfile']['size'];
 
// membaca tipe file
$fileType = $_FILES['userfile']['type'];
 
 
 
 
 
// langkah membaca isi file yang diupload
$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);
 
// query SQL untuk menyimpan file ke database 
 
$query = "INSERT INTO upload (name,time, size, type, content)
          VALUES ('$fileName','$timestamp', '$fileSize', '$fileType', '$content')";
 
mysql_query($query);

// setting nama folder tempat upload
$uploaddir = 'pesan/';

// menggabungkan nama folder dan nama file
$uploadfile = $uploaddir . $fileName;
echo $uploadfile;
// proses upload file ke folder 'dozir'
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File telah dipindah ke folder";
} else {
    echo "File gagal dipindah ke folder";
}

/* rapihkan input */
$tanggal= date("y,m,d");
$tertulis = ereg_replace("\n", "<br>", $tertulis);
$seharusnya = ereg_replace("\n", "<br>", $seharusnya);
/* masukkan ke dalam tabel pesan */
$sql = "insert into $tbl_pesan (time ,tanggal,nipeg, nama, ip, kd_posisi, komentar, tertulis, seharusnya)
        values ('$timestamp','$tanggal', '$nipeg', '$nama', '$ip', '$kd_posisi', '$fileName', '$tertulis',
        '$seharusnya')";
$q = mysql_query($sql);
/* masukkan ke dalam logs */
$act = "Kirim form komentar dan perubahan data";
$sql = "insert into $tbl_logs (user, ip, kd_posisi, time, act) values ('$nipeg', '$ip', '$kd_posisi', '$timestamp', '$act')";
$q = mysql_query($sql);



print "
<html>
<head>
  <meta http-equiv=Refresh content=\"2; url=ubah-data.php?session=$session\">
</head>
<body>
<center><h3>Masukan telah kami terima !</h3></center>
</body>
</html>
";
?>