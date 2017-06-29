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

	$date_now = time();

	$this_ip = $_SERVER[REMOTE_ADDR];

//record the click
$q1 = "insert into re2_stats set 
				BannerID = '$_GET[BannerID]',
				clicks = '1',
				mydate = '$date_now',
				ip = '$this_ip' ";
mysql_query($q1) or die(mysql_error());

//get the BannerURL
$q2 = "select BannerURL from re2_banners where BannerID = '$_GET[BannerID]' ";
$r2 = mysql_query($q2) or die(mysql_error());
$a2 = mysql_fetch_array($r2);

header("location:$a2[BannerURL]");


?>