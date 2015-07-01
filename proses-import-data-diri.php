<?php
// menggunakan class phpExcelReader
include "excel_reader2.php";
include "inc/function.inc.php";
include "inc/tools.inc.php";
$dbuser = "root";                       /* database user */
$dbpass = "";                       /* database password */
$dbname = "dbsipeg";                     /* database name */
$dbhost = "localhost";               /* database server location */
$secexpire = "900";                      /* session expire time, in second */

$tabel = "dozir";


mysql_connect($dbhost, $dbuser,$dbpass);
mysql_select_db($dbname); 

// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);
// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;


//data lama harus di delete terlebih dahulu
//$query =mysql_query( "DELETE from $tabel");
  
// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
for ($i=2; $i<=$baris; $i++)
{
echo $i;
  // membaca data nama (kolom ke-1)
  $nip = $data->val($i, 1);
  // membaca data nip (kolom ke-2)
  $id_dozir = $data->val($i, 2);
  $id_dozir="0".$id_dozir;
  // membaca data jabatan (kolom ke-3)
  $keterangan = $data->val($i, 3);
   // membaca data tgl masuk (kolom ke-4)
  $nama_file = $data->val($i, 4);
   // membaca data tgl capeg (kolom ke-5)
  $no_sk = $data->val($i, 5);
   // membaca data tgl tetap (kolom ke-6)
  $tgl_sk = $data->val($i, 6);
  $tanggal_sk = tgl2Eng($tgl_sk); 	
	$time = time();
	$tgl_entry=date("Y/m/d");

print "$nip,$id_dozir,$keterangan,$nama_file,$no_sk,$tanggal_sk";

   // setelah data dibaca, sisipkan ke dalam tabel bio01 pegawai
  $query = "INSERT INTO  $tabel (nipeg,time,id_dozir,keterangan,namafile, no_sk,tgl_sk,tgl_entry) VALUES ('$nip','$time','$id_dozir',' $keterangan','$nama_file', '$no_sk','$tanggal_sk','$tgl_entry')";
  $hasil = mysql_query($query);
 echo mysql_error();
  // jika proses insert data sukses, maka counter $sukses bertambah
 // jika gagal, maka counter $gagal yang bertambah
  
  if ($hasil) $sukses++;
else
{
echo "Baris Gagal di ".$baris;
$gagal++;

}
}

?>