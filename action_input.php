<?
	
$dbuser = "root";                       /* database user */
$dbpass = "";                       /* database password */
$dbname = "dbsipeg";                     /* database name */
$dbhost = "localhost";               /* database server location */
$secexpire = "900";                      /* session expire time, in second */
 $koneksi=mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname,$koneksi);
    //Kirimkan Variabel
	
    $nipeg      = $_POST['nipeg'];
    $nama       = $_POST['nama'];
    $tes1       = $_POST['tes1'];
	$tes2       = $_POST['tes2'];
	$tes3       = $_POST['tes3'];
    $tes4       = $_POST['tes4'];
	$tes5       = $_POST['tes5'];
	
    
	
     
	
    $input    ="INSERT INTO inputrestitusi(nipeg, nama, tes1, tes2, tes3, tes4, tes5 )
            VALUES ('$nipeg','$nama','$tes1','$tes2','$tes3','$tes4','$tes5' )";
    $query_input =mysql_query($input);
        if ($query_input) {
    //Jika Sukses
  echo "Data Berhasil diinput";
    }
    else {
    //Jika Gagal
    echo "Data Gagal diinput, Silahkan diulangi!";
    }
    //Tutup koneksi engine MySQL
   
?>