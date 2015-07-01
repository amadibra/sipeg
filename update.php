<?php
include "inc/config.inc.php";
include "inc/function.inc.php";
include "inc/tools.inc.php";


		$nipeg = $select_result['nipeg'] ;
		$id_dozir = $select_result['id_dozir'] ;
		$keterangan = $select_result['keterangan'] ;
		$namafile = $select_result['namafile'] ;
		$no_sk = $select_result['no_sk'] ;
		$tgl_sk = $select_result['tgl_sk'] ;
		

$query_update = "update tbl_dozir set nipeg = '$nipeg', id_dozir = '$id_dozir',
				 keterangan = '$keterangan', namafile = '$namafile', No_sk = '$no_sk', 
				 tgl_sk = '$tgl_sk'";



$update = mysql_query($query_update);

if($update)
	{
	include("redirectview.php");
	}

else
	{
	echo "Gagal update ... ";
	echo "<META HTTP-EQUIV=Refresh CONTENT='2; URL=lihatdata.php'>";
	}