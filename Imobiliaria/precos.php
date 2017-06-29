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

if ($_SESSION['TipodeConta']=="2"){ $qwhere=" and re2_prices.PriceType='Privado'"; }
elseif ($_SESSION['TipodeConta']=="1") { $qwhere=" and re2_prices.PriceType='Imob.'"; }
else { $qwhere=""; }

//get the prices
$q1 = "select * from re2_prices, re2_priority where re2_prices.PriorityLevel = re2_priority.PriorityLevel$qwhere order by PriceValue";
$r1 = mysql_query($q1) or die(mysql_error());

$col = "white";

while($a1 = mysql_fetch_array($r1))
{
	if($col == "white")
	{
		$col = "dddddd";
	}
	else
	{
		$col = "white";
	}

	$Prices .= "<tr bgcolor=$col>\n\t<td align=center>";
	
	if($_GET[SelectedPackage] == $a1[PriceID])
	{
		$Prices .= "<input type=radio name=\"SelectedPackage\" value=\"$a1[PriceID]\" checked>";
	}
	else
	{
		$Prices .= "<input type=radio name=\"SelectedPackage\" value=\"$a1[PriceID]\">";
	}

		
	$Prices .= "</td>\n\t<td>$a1[PackageName] ";

	$Prices .= "<sup><font color=#990000>$a1[PriorityName]</font></sup>";

	if($a1[Duration] == '1')
	{
		$Prices .= ", $a1[Duration] mês,";
	}
	else
	{
		$Prices .= ", $a1[Duration] meses,";
	}
	
	if($a1[offers] == '1')
	{
		$Prices .= " $a1[offers] anúncio</td>\n\t";
	}
	else
	{
		$Prices .= " $a1[offers] anúncios</td>\n\t";
	}

	if($a1[PriceValue] > '0')
	{
		$Prices .= "<td align=right>R$ $a1[PriceValue]</td>\n</tr>\n";
	}
	else
	{
		$Prices .= "<td align=right>Gratuito!</td>\n</tr>\n";
	}
}

if($_GET[e] == '1')
{
	$error = "Selecione um pacote, por favor!";
}
elseif($_GET[e] == '2')
{
	$error = "Selecione uma forma de pagamento, por favor!";
}

if($_GET[PaymentGateway] == "paypal")
{
	$selected1 = "selected";
}
elseif($_GET[PaymentGateway] == "2checkout")
{
	$selected2 = "selected";
}
elseif($_GET[PaymentGateway] == "check")
{
	$selected3 = "selected";
}
elseif($_GET[PaymentGateway] == "stormpay")
{
	$selected4 = "selected";
}

if(ereg("cadastro.php", $_SERVER[HTTP_POST]))
{
	$NewAgentMessage = "<font face=verdana color=black size=2><b>Obrigado por se cadastrar!</b><br><font size=1>Entre no painel de controle para fazer anúncios<br><br>";
}

//get the templates
require_once("templates/HeaderTemplate.php");
require_once("templates/PricesTemplate.php");
require_once("templates/FooterTemplate.php");

?>

