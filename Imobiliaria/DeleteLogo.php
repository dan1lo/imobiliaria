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

$q1 = "select logo from re2_agents where AgentID = '$_SESSION[AgentID]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

if(!empty($a1[logo]))
{
	unlink("fotos_anuncios/".$a1[logo]);

	$q2 = "update re2_agents set logo = '' where AgentID = '$_SESSION[AgentID]' ";
	mysql_query($q2) or die(mysql_error());
}

header("location:sobre_mim.php?id=$_SESSION[AgentID]");

exit();

?>