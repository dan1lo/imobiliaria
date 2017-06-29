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
require_once("acesso.php");

//get the details
$q1 = "select * from re2_listings where ListingID = '$_GET[id]' and AgentID = '$_SESSION[AgentID]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

if(!empty($a1[image]))
{
	//update the database
	$OldImages = explode("|", $a1[image]);

	while(list(,$v) = each($OldImages))
	{
		unlink("fotos_anuncios/$v");
	}
}

$q2 = "delete from re2_listings where ListingID = '$_GET[id]' and AgentID = '$_SESSION[AgentID]' ";
mysql_query($q2) or die(mysql_error());

header("location:controle.php");
exit();

?>