<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");


if(!empty($_GET[PriceID]))
{
	$q1 = "delete from re2_prices where PriceID = '$_GET[PriceID]' ";
	mysql_query($q1) or die(mysql_error());
}

header("location:SettingsPrices.php");

?>