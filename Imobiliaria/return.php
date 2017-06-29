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

include_once("configuracao_mysql.php");
include_once("includes.php");

if($_POST[credit_card_processed] == 'Y')
{
	$GetInfo = explode("|", $_POST[cart_order_id]);
	//$_SESSION[AdvertiserID] = $GetInfo[0];
	$PriceID = $GetInfo[1];

	//get the price details
	$q1 = "select * from re2_prices where PriceID = '$PriceID' ";
	$r1 = mysql_query($q1) or die(mysql_error());
	$a1 = mysql_fetch_array($r1);

	//update the advertiser's record/credits
	$aexp =  mktime(0,0,0,date(m) + $a1[Duration],date(d),date(Y));

	//$_SESSION[AccountExpireDate] = $aexp;
	//$_SESSION[AccountStatus] = "active";
	//$_SESSION[MaxOffers] = $a1[offers];

	$q2 = "update re2_agents set ExpDate = '$aexp', AccountStatus = 'active', PriorityLevel = '$a1[PriorityLevel]', offers = '$a1[offers]' where AgentID = '$GetInfo[0]' ";
	mysql_query($q2) or die(mysql_error());

	$_SESSION[AgentID] = "";

	header("location:entrar.php");
	exit();
}
else
{
	//get the templates
	require_once("templates/HeaderTemplate.php");
	require_once("templates/ProblemPaymentTemplate.php");
	require_once("templates/FooterTemplate.php");
}

?>