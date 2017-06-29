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

	if($_POST[secret_code] == $aset[sp_secret_code])
	{
			$GetInfo = explode("|", $_POST[transaction_ref]);
			$_SESSION[AdvertiserID] = $GetInfo[0];
			$PriceID = $GetInfo[1];

			//get the price details
			$q1 = "select * from re2_prices where PriceID = '$PriceID' ";
			$r1 = mysql_query($q1) or die(mysql_error());
			$a1 = mysql_fetch_array($r1);

			//update the advertiser's record/credits
			$aexp =  mktime(0,0,0,date(m) + $a1[Duration],date(d),date(Y));

			$_SESSION[AgentID] = "";

			$q2 = "update re2_agents set ExpDate = '$aexp', AccountStatus = 'active', PriorityLevel = '$a1[PriorityLevel]', offers = '$a1[offers]' where AgentID = '$GetInfo[0]' ";
			mysql_query($q2) or die(mysql_error());

	}
	else
	{
		echo "You can not cheat the system!";
	}
?>