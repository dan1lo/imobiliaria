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



if(isset($_POST[s1]))
{
	$MyFile = $_FILES[NewBanner][name];
	if(!ereg("gif$", $MyFile) && !ereg("jpg$", $MyFile))
	{
		$error = "<center><font color=red size=2 face=verdana><b>You can upload only image files!</b></font></center>";
	}
	else
	{
		$t = time();
		$BannerName = $t."_".$MyFile;
	
		//upload the new banner
		copy($_FILES[NewBanner][tmp_name], "banners/$BannerName");

		$cats = explode("|", $_POST[ListCategory]);

		//record the banner info
		$q1 = "insert into re2_banners set 
						ClientID = '$_SESSION[AgentID]',
						BannerURL = '$_POST[BannerURL]',
						BannerFile = '$BannerName',
						BannerAlt = '$_POST[BannerAlt]',
						BannerType = '$_POST[BannerType]' ";

		mysql_query($q1) or die(mysql_error());

	}
}



//show the client's banners
$q1 = "select * from re2_banners where ClientID = '$_SESSION[AgentID]' ";
$r1 = mysql_query($q1) or die(mysql_error());
while($a1 = mysql_fetch_array($r1))
{
	$q2 = "select sum(clicks) from re2_stats where BannerID = '$a1[BannerID]' ";
	$r2 = mysql_query($q2) or die(mysql_error());
	$a2 = mysql_fetch_array($r2);

	$ShowBanners .= "<table align=center cellspacing=0 border=0 width=500>";
	$ShowBanners .= "<tr>\n\t<td align=center>\n\t<img src=\"banners/$a1[BannerFile]\" alt=\"$a1[BannerAlt]\" border=1>\n\t</td>\n</tr>\n";
	$ShowBanners .= "<tr>\n\t<td align=right>Cliques:  $a2[0]  (<a class=RedLink href=\"deletar_banner.php?BannerID=$a1[BannerID]\" onclick=\"return ConfirmDelete();\">Deletar</a>)</td>\n</tr>\n</table>\n\n<br><br>\n\n";
}


	require_once("templates/HeaderTemplate.php");
	require_once("templates/UploadBannerTemplate.php");
	require_once("templates/FooterTemplate.php");

?>