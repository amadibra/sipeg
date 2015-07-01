<?
$dbuser = "root";                       /* database user */
$dbpass = "";                       /* database password */
$dbname = "dbsipeg";                     /* database name */
$dbhost = "localhost";               /* database server location */
$secexpire = "900";                      /* session expire time, in second */

$koneksi=mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname,$koneksi);


session_start();
session_register("nipeg1");
$action = strtolower($_POST['action']);
$id_dozir = $_REQUEST['id_dozir'];
$namafile=$_REQUEST['namafile'];

if ($action == "hapus")
{
echo "Anda memilih aksi delete pada record $id_dozir untuk pegawai dengan NIP $nipeg1 dan Namafile $namafile <br/>";

 // membaca nama file yang akan dihapus berdasarkan id
    $query   = "SELECT * FROM tbl_dozir WHERE namafile = '$namafile' && nipeg='$nipeg1' && id_dozir='$id_dozir'";
    $hasil   = mysql_query($query);
    $data    = mysql_fetch_array($hasil);
    
$delete = "DELETE from tbl_dozir where nipeg='$nipeg1' && id_dozir='$id_dozir' && namafile='$namafile'";
$delete_query = mysql_query($delete);

// menghapus file dalam folder sesuai namanya
    unlink("dozir/".$namaFile);
    echo "File telah dihapus";
	
if ($delete_query) echo "Record $namafile berhasil dihapus!<br><META HTTP-EQUIV=Refresh CONTENT='2; >";
else echo "Gagal menghapus record<br><META HTTP-EQUIV=Refresh CONTENT='2;>";
}
else 
{

$select = "select * from tbl_dozir where id_dozir = '$id_dozir' && nipeg='$nipeg1'";
$select_query = mysql_query($select);
while($select_result = mysql_fetch_row($select_query))
	{
		$nipeg = $select_result['nipeg'] ;
		$id_dozir = $select_result['id_dozir'] ;
		$keterangan = $select_result['keterangan'] ;
		$namafile = $select_result['namafile'] ;
		$no_sk = $select_result['no_sk'] ;
		$tgl_sk = $select_result['tgl_sk'] ;
		
?>

<form action="update.php" method="POST">
<table border='1' width='35%' cellpadding='2'  cellspacing='2' align='center' bgcolor="#FFCC33">
<caption>
<h2>Edit Dozir Pegawai</h2>
</caption>
<input type="hidden" name="nipeg" size="30" value="<? echo $nipeg1 ; ?>" maxlength="50"/>

<tr>
  <td><strong>NIPEG</strong></td>
  <td><input type=\"text\" name=\"nipeg1\" size=\"30\" id=\"nipeg\" disabled=\"disabled\" maxlength=\"9\" "<? echo $nipeg1 ; ?>"></td>
</tr>

<tr><td><strong>id_dozir</strong></td><td><input type="text" name="id_dozir" value="<? echo $id_dozir ; ?>" size="30" maxlength="50"/></td></tr>
 <td><strong>File Dozir</strong></td><td><input type=file name=dozir size=30 maxlength=50/></td></tr>
  
  <tr>
  <td><strong>Nomor</strong></td><td><input type=text name=no_sk size=40 maxlength=50/></td></tr>
	 
<tr>

<tr>
  <td><strong>Tanggal</strong></td>
  <td>
  <?
  //menampilkan pilihan combobox untuk tanggal
 
   echo "<select name=\"tgl\">";
   for ($tgl=1; $tgl<=31; $tgl++)
  {
       if ($tgl == $tanggal) echo "<option value=\"
                                  ".$tgl."\" selected>".$tgl.
                                "</option>";
       else echo "<option value=\"".$tgl."\">".$tgl."</item>";
  }
   echo "</select>";

   // menampilkan pilihan combobox untuk bulan
 
   echo "<select name=\"bln\">";
 for ($bln=1; $bln<=12; $bln++)
   {
       if ($bln == $bulan) echo "<option value=\"
                                 ".$bln."\" selected>".$bln.
                                 "</option>";
       else echo "<option value=\"".$bln."\">".$bln."</option>";
   }
   echo "</select>";
 
   // menampilkan pilihan combobox untuk tahun

  
   echo "<select name=\"thn\">";
   for ($thn=1950; $thn<=2020; $thn++)
   {
       if ($thn == $tahun) echo "<option value=\"
                                ".$thn."\" selected>".$thn.
                                "</option>";
       else echo "<option value=\"".$thn."\">".$thn."</option>";
   }
   echo "</select>"; 
   
 
$_SESSION['nipeg1'] = $nipeg1;
     
  
  ?>  </td></tr>
  
<tr>
  <td><strong>Keterangan</strong></td><td><input type=text name=keterangan size=40 maxlength=100/></td></tr>
<tr><td></td><td><input type="submit" name="kirim" value="Update!"/></td></tr>
</table>
</form>

<?
	}
}
?>