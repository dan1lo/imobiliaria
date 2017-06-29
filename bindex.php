<?
#########################################################
#Copyright © e-Mobiliária. Todos os direitos reservados.#
#########################################################
#                                                       #
#  Programa        : e-Mobiliária PHP                   #
#  Autor           : Moisés Bach B.                     #
#  E-mail          : moisbach@gmail.com                 #
#  Versão          : 2.5                                #
#  Modificado em   : 09/12/2005                         #
#  Copyright ©     : e-Mobiliária                       #
#                 WWW.ANIMABUSCA.COM/IMOBILIARIA        #
#########################################################
#ESTE SCRIPT NÃO PODE SER COPIADO SEM AUTORIZAÇÃO PRÉVIA#
#########################################################

require_once("configuracao_mysql.php");
require_once("includes.php");

require_once("acesso.php");

//get the banners
$q1 = "select * from re2_banners where ClientID = '$_SESSION[AgentID]' ";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) == '0')
{
	require_once("templates/HeaderTemplate.php");
	require_once("templates/NoBannerIndex.php");
	require_once("templates/FooterTemplate.php");
	exit();
}

while($a1 = mysql_fetch_array($r1))
{
	$btable .= "<tr>\n\t<td><a href=\"estatisticas_banner.php?BannerID=$a1[BannerID]&file=$a1[BannerFile]\"><img src=\"info.jpg\" border=0 width=15 height=15></a></td>\n\t<td><a class=BlueLink  href=\"banners/$a1[BannerFile]\" target=_blank>$a1[BannerFile]</a></td>\n\t";

	//get the total clicks
	$q2 = "select sum(clicks) as myclicks, sum(impressions) as myimpres from re2_stats where BannerID = '$a1[BannerID]' ";
	$r2 = mysql_query($q2) or die(mysql_error());
	$a2 = mysql_fetch_array($r2);

	$btable .= "<td align=center>$a2[myimpres]</td>\n\t<td align=center>$a2[myclicks]</td>\n\t";

	if($a2[myimpres] > '0')
	{
		$rato = number_format(($a2[myclicks]/$a2[myimpres]) * 100, 2, ",", ".");
	}
	else
	{
		$rato = '0.00';
	}

	$btable .= "<td align=right bgcolor=dddddd>$rato %</td>\n</tr>\n\n";
}

//get the templates
require_once("templates/HeaderTemplate.php");
require_once("templates/BannerIndex.php");
require_once("templates/FooterTemplate.php");


?>


