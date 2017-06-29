<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

include_once("LeftStyles.php");


//get the banners
$q1 = "select * from re2_banners, re2_agents where re2_banners.ClientID = re2_agents.AgentID";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) == '0')
{
	echo "<br><center><font face=verdana color=red size=2><b>Não existem banners no servidor!</b></font></center>";
	exit(); //we have no banners
}

?>

<table align=center width=500 bordercolor=black frame=below cellspacing=0>
<tr>
	<td class=TableHead align=center>Banner's anunciados</td>
</tr>

<?

while($a1 = mysql_fetch_array($r1))
{
	echo "<tr>\n\t<td align=center><img src=\"../banners/$a1[BannerFile]\" alt=\"$a1[BannerALT]\"><br>Agente: $a1[FirstName] $a1[LastName]<br>Endereço(URL) do banner: <a href=\"$a1[BannerURL]\" target=_blank class=BlackLink>$a1[BannerURL]</a><br>Descrição: $a1[BannerAlt]<br>Tipo de banner: $a1[BannerType]<br><a class=RedLink href=\"BannersDeleteBanner.php?BannerID=$a1[BannerID]&BannerFile=$a1[BannerFile]\">Deletar este banner</a>\n\t</td>\n</tr>\n\n";
}

echo "</table>\n\n<br><br>";

?>