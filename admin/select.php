<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");
require_once("LeftStyles.php");
require_once("../includes.php");

//get the offers
$q1 = "select ListingID from re2_listings order by ListingID";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) > '0')
{
	echo "<center><form method=get action=\"$_GET[action].php\">\n";
	echo "Selecione uma oferta para $_GET[action]: <select name=id>\n\t<option value=\"\"></option>\n\t";

	while($a1 = mysql_fetch_array($r1))
	{
		echo  "<option value=\"$a1[ListingID]\">$a1[ListingID]</option>\n\t";
	}

	echo  "</select>\n";

	echo "<input type=submit name=s1 value=\"Enviar\"></form></center>";
}
else
{
	echo "<br><br><center><font face=verdana size=2 color=red><b>Nenhum anúncio encontrado!</b></font></center>";
}
