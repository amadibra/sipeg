<?
include_once "inc/config.inc.php";
include_once "inc/function.inc.php";
include_once "inc/tools.inc.php";

$action = strtolower($_POST['kirim']);

if ($action == "update")
{
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
+

// membaca nama file
$fileName = $_FILES['dozir']['name'];    
 
// membaca nama file temporary
$tmpName  = $_FILES['dozir']['tmp_name'];
 
// membaca size file
$fileSize = $_FILES['dozir']['size'];
 
// membaca tipe file
$fileType = $_FILES['dozir']['type'];
 
 
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
echo $uploadfile;
// proses upload file ke folder 'dozir'
if (move_uploaded_file($_FILES['dozir']['tmp_name'], $uploadfile)) {
    echo "File telah dipindah ke folder";
} else {
    echo "File gagal dipindah ke folder";
}

$time= time();

 $tanggal_sk =$tgl."/".$bln."/".$thn; 
$tanggal_sk = tgl2Eng($tanggal_sk);  
/* masukkan ke dalam tabel dozir */
$sql = "UPDATE $tbl_dozir SET nipeg='$nipeg1',id_dozir='$id_dozir',time='$time',keterangan='$keterangan',namafile='$fileName',No_sk='$No_SK',tgl_sk='$tanggal_sk',tgl_entry='$tgl_entry'";
mysql_query($sql);

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
}



if ($action == "simpan")
{
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
+

// membaca nama file
$fileName = $_FILES['dozir']['name'];    
 
// membaca nama file temporary
$tmpName  = $_FILES['dozir']['tmp_name'];
 
// membaca size file
$fileSize = $_FILES['dozir']['size'];
 
// membaca tipe file
$fileType = $_FILES['dozir']['type'];
 
 
// langkah membaca isi file yang diupload
$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

$tgl_entry=date("y/m/d");
$timestamp = time();





$sql = "SELECT  nipeg,No_sk FROM $tbl_dozir WHERE nipeg ='$nipeg1'";
$cek = mysql_query($sql);
list($nip,$nomor) = mysql_fetch_row($cek);


if(($nip == $nipeg1)&& ($nomor == $no_sk)) {
	 
	 print "
   
      <head>
        <meta http-equiv=Refresh content=\"2; url=carinama.php?session=$session\">
      </head>
      <body>
      <center><h3>SK Nomor $no_sk sudah ada!</h3></center>
      </body>
      
    ";
	}
	else {

foreach ($_POST['dozir'] as $id_dozir)
{
        
// query SQL untuk menyimpan file ke database 
 
$query = "INSERT INTO upload (name,time, size, type, content)
          VALUES ('$fileName','$timestamp', '$fileSize', '$fileType', '$content')";
 
mysql_query($query);

// menggabungkan nama folder dan nama file
$uploadfile = $uploaddir . $fileName;
echo $uploadfile;
// proses upload file ke folder 'dozir'
if (move_uploaded_file($_FILES['dozir']['tmp_name'], $uploadfile)) {
    echo "File telah dipindah ke folder";
} else {
    echo "File gagal dipindah ke folder";
}

$time= time();

 $tanggal_sk =$tgl."/".$bln."/".$thn; 
$tanggal_sk = tgl2Eng($tanggal_sk);

/*$sql = "INSERT INTO $tbl_dozir (nipeg ,id_Dozir,no_urut, keterangan, nama_file, no_sk, tgl_sk, tgl_entry)
        VALUES ('$nipeg','$id_dozir', '$no_urut', '$keterangan', '$filename', '$no_sk', '$tgl_sk', '$tgl_entry')";
mysql_query($sql);*/
/* masukkan ke dalam tabel dozir */
$sql = "INSERT INTO $tbl_dozir (nipeg,id_dozir,time,keterangan,namafile,No_sk,tgl_sk,tgl_entry) VALUES ('$nipeg1','$id_dozir','$time','$keterangan','$fileName','$No_SK','$tanggal_sk','$tgl_entry')";
mysql_query($sql);

}

/* masukkan ke dalam logs */
$act = "Masukkan data dozir";
$sql = "insert into $tbl_logs (user, ip, kd_posisi, time, act) values ('$nipeg1', '$ip', '$kd_posisi', '$timestamp', '$act')";
$q = mysql_query($sql);



print "
<html>
<head>
  <meta http-equiv=Refresh content=\"2; url=carinama.php?session=$session\">
</head>
<body>
<center><h3>Masukan Dozir telah kami terima !</h3></center>
</html>
";
}
}
else
{

session_start();
session_register("nipeg1","id_dozir","no_sk");
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
+

// membaca nama file
$fileName = $_FILES['dozir']['name'];    
 
// membaca nama file temporary
$tmpName  = $_FILES['dozir']['tmp_name'];
 
// membaca size file
$fileSize = $_FILES['dozir']['size'];
 
// membaca tipe file
$fileType = $_FILES['dozir']['type'];
 
 

$tgl_entry=date("d/m/y");
$timestamp = time();





$sql = "SELECT  nipeg,No_sk FROM $tbl_dozir WHERE nipeg ='$nipeg1'";
$cek = mysql_query($sql);
list($nip,$nomor) = mysql_fetch_row($cek);


if(($nip == $nipeg1)&& ($nomor == $no_sk)) {
	 
	 print "
   
      <head>
        <meta http-equiv=Refresh content=\"2; url=carinama.php?session=$session\">
      </head>
      <body>
      <center><h3>SK Nomor $no_sk sudah ada!</h3></center>
      </body>
      
    ";
	}
	else {

foreach ($_POST['dozir'] as $id_dozir)
{
        
}

print "
<html>
<head>
   <meta http-equiv=Refresh content=\"2; url=cariNama.php?session=$session\">
</head>
<body>
  <h3 align='center'> LOADING </h3>
<img src='loading.gif' style='center; padding-left: 500px;'/>
</body>
</html>
";
}
}




?>