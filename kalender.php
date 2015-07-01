<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<style type="text/css">
*
{
    font-family: Arial, Helvetica, sans-serif;
    font-size: 10pt;
    margin:0;
    padding:0;
   
}
.dt_init
{
    background-color: #99ffff;
}

.sabtu
{
    background-color: #f8ebbd;
}

.minggu
{
    background-color: #fce1ed;
}

</style>
    <title>Tanggal</title>
</head>
<body>
<form method="POST" name="myform">
<?php
$a_bulan['01']="Januari";
$a_bulan['02']="Februari";
$a_bulan['03']="Maret";
$a_bulan['04']="April";
$a_bulan['05']="Mei";
$a_bulan['06']="Juni";
$a_bulan['07']="Juli";
$a_bulan['08']="Agustus";
$a_bulan['09']="September";
$a_bulan['10']="Oktober";
$a_bulan['11']="November";
$a_bulan['12']="Desember";

$balik=$_GET['balik'];
if ($balik=="")
{
    $balik=$_POST['balik'];
}

echo "<script language=\"javascript\">
function balikin(nilai)
{
    opener.document.$balik.value=nilai;
    self.close();
}
</script>";

$balik_format=$_GET['balik'];
$balik_format=$_GET['balik_format'];
if ($balik_format=="")
{
    $balik_format=$_POST['balik_fomat'];
}


$tgl_init=$_GET['tgl_init'];
if ($tgl_init=="")
{
    $tgl_init=$_POST['tgl_init'];
    if ($tgl_init=="")
    {
          if ($balik_format=="dd-mm-YYYY")
          {
               $tgl_init=date("d-m-Y",time());
        }
        else
        {
               $tgl_init=date("Y-m-d",time());
        }
    }
}

$bulan_tampil=$_POST['bulan_tampil'];
if ($bulan_tampil=="")
{
    if ($balik_format=="dd-mm-YYYY")
     {
           list ($temp,$bulan_tampil,$tahun_tampil)=explode("-",$tgl_init);
    }
    else
    {
           list ($tahun_tampil,$bulan_tampil,$temp)=explode("-",$tgl_init);
    }
}
if ($tahun_tampil=="")
{
    $tahun_tampil=$_POST['tahun_tampil'];
}
/*if ($tahun_tampil=="")
{
    $tahun_tampil=date("Y",time());   
}
*/
$tot_tanggal=date("t",strtotime("$tahun_tampil-$bulan_tampil-01"));
$day_first=date("N",strtotime("$tahun_tampil-$bulan_tampil-01"));

echo "\n<select name=\"bulan_tampil\" onChange=\"document.myform.submit()\">";
for ($b=1;$b<=12;$b++)
{
    if ($b<10)
    {
       $bs="0$b";
    }
    else
    {
       $bs="$b";      
    }
   
   
    if ($bs==$bulan_tampil)
    {
       $selected="selected=\"selected\"";
    }
    else
    {
       $selected="";
    }
    echo "\n <option value=\"$bs\" $selected>".$a_bulan[$bs]."</option>";
}
echo "\n</select>";

echo "\n<select name=\"tahun_tampil\" onChange=\"document.myform.submit()\">";
$thn_start=$tahun_tampil-50;
$thn_end=$tahun_tampil+50;
for ($t=$thn_start;$t<=$thn_end;$t++)
{
    if ($t==$tahun_tampil)
    {
       $selected="selected=\"selected\"";
    }
    else
    {
       $selected="";
    }
    echo "\n <option value=\"$t\" $selected>$t</option>";
}

echo "\n</select>";
echo "\n <input type=\"hidden\" name=\"tgl_init\" value=\"$tgl_init\">";
echo "\n <input type=\"hidden\" name=\"balik\" value=\"$balik\">";
echo "\n <input type=\"hidden\" name=\"balik_format\" value=\"$balik_format\">";

echo "<div>".$a_bulan[$bulan_tampil]." $tahun_tampil </div>";
echo "<table border=\"1\">";
echo "<tr>
<td>Sen</td>
<td>Sel</td>
<td>Rab</td>
<td>Kam</td>
<td>Jum</td>
<td class=\"sabtu\">Sab</td>
<td  class=\"minggu\">Ming</td>
</tr>
";
echo "<tr>";
$w=1;
for ($a=1;$a<$day_first;$a++)
{
    echo "<td></td>";
    $w++;
}

for ($d=1;$d<=$tot_tanggal;$d++)
{
    if ($w==1)
    {
       echo "
       <tr>";
    }
    if ($d<10)
    {
       $ds="0$d";
    }
    else
    {
       $ds="$d";
    }
   
    if ($w==6)
    {
       $class="class=\"sabtu\"";
    }
    else if ($w==7)
    {
       $class="class=\"minggu\"";
    }
    else
    {
       $class="";
    }

    if ($balik_format=="dd-mm-YYYY")
    {
        $nilai="$ds-$bulan_tampil-$tahun_tampil";
    }
    else
    {
        $nilai="$tahun_tampil-$bulan_tampil-$ds";
    }

    if ($tgl_init==$nilai)
    {
       $class="class=\"dt_init\"";
    }

    echo "<td $class align=\"center\"> <a href=\"javascript:balikin('$nilai');\">$d</a></td>";
    $w++;
    if ($w==8)
    {
       $w=1;
       echo "
       </tr>";
    }
}
while ($w>1 && $w<8)
{
    echo "<td></td>";
    $w++;
    if ($w==8)
    {
       echo "
       </tr>";
    }
}
   

echo "</table>";
?>   
</form>
</body>
</html> 