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

$BannerType = "468x60";

$qsb = "select BannerID from re2_banners where BannerType = '468x60' ";

$rsb = mysql_query($qsb) or die(mysql_error());

if(mysql_num_rows($rsb) > '0')
{
	while($asb = mysql_fetch_array($rsb))
	{
		$NewBannersArray[] = $asb[BannerID];
	}

	$DisplayBannerID = array_rand($NewBannersArray);

	$BannerID = $NewBannersArray[$DisplayBannerID];

	//get the selected banner info
	$qsb2 = "select * from re2_banners where BannerID = '$BannerID' ";
	$rsb2 = mysql_query($qsb2) or die(mysql_error());
	$asb2 = mysql_fetch_array($rsb2);

	echo "<A href=\"cliques.php?BannerID=$BannerID\" target=_blank><img src=\"banners/$asb2[BannerFile]\" alt=\"$asb2[BannerAlt]\" border=0></a>";


	$date_now = time();

	$this_ip = $_SERVER[REMOTE_ADDR];

	$qsb3 = "insert into re2_stats set 
					BannerID = '$BannerID',
					impressions = '1',
					mydate = '$date_now',
					ip = '$this_ip' ";

	mysql_query($qsb3) or die(mysql_error());
}

?>