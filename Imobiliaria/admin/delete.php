<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");
require_once("../includes.php");

//get the details
$q1 = "select * from re2_listings where ListingID = '$_GET[id]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

if(!empty($a1[image]))
{
	//update the database
	$OldImages = explode("|", $a1[image]);

	while(list(,$v) = each($OldImages))
	{
		unlink("../fotos_anuncios/$v");
	}
}

$q2 = "delete from re2_listings where ListingID = '$_GET[id]' ";
mysql_query($q2) or die(mysql_error());

header("location:select.php?action=edit");
exit();

?>