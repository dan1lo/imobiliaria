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


require_once("templates/HeaderTemplate.php");
require_once("templates/IndexTemplate.php");

require_once("busca_principal.php");
//	ADVANCED SEARCH

//require_once("busca_avancada.php");
//require_once("templates/AdvancedSearchTemplate.php");

echo "<br>";

//		newest properties

$q1 = "select * from re2_listings, re2_agents, re2_priority where re2_listings.AgentID = re2_agents.AgentID and re2_agents.PriorityLevel = re2_priority.PriorityLevel and re2_agents.AccountStatus = 'active' order by DateAdded desc limit 0,9 ";

$r1 = mysql_query($q1) or die(mysql_error());
$lrows = mysql_num_rows($r1);

if($lrows > '0')
{

	$ListingTable .= "<table align=center width=510 border=1 bordercolor=black frame=hsides rules=rows cellspacing=0>\n";

	while($a1 = mysql_fetch_array($r1))
	{
		$ListingTable .= "<tr onMouseOver=\"this.style.background='EFB8B8'; this.style.cursor='hand'\" onMouseOut=\"this.style.background='white'\" onClick=\"window.open('anuncio.php?id=$a1[ListingID]', '_top')\">\n\t";
		
		if($a1[PriorityLevel] > '1')
		{
			$sub = "<span class=RedLink><sup>$a1[PriorityLevel]</sup></span>";
		}
		else
		{
			$sub = "";
		}

		$ListingTable .= "\n\t<td width=15>";

		if(!empty($a1[image]))
		{
			$ListingTable .= "<img src=\"minhas_imagens/camera.gif\" width=25 height=18>";
		}

		$ListingTable .= "</td>\n\t";

		$ListingTable .= "<td width=305>$a1[city], $a1[state], $a1[address] $sub</td>\n\t";
		$ListingTable .= "<td width=80>$a1[rooms] quarto(s), <br> $a1[bathrooms] banheiro(s) <br>";

		$MyPrice = number_format($a1[Price], 2, ",", ".");

		$ListingTable .= "</td>\n\t<td align=center width=100><b>R$ $MyPrice</td>\n";
		$ListingTable .= "</tr>\n";

	}

	$ListingTable .= "</table>";
}

///////////////////////////////////////////////////////////
/////////////				top 10
///////////////////////////////////////////////////////////
$q1 = "select * from re2_listings, re2_agents, re2_priority where re2_listings.AgentID = re2_agents.AgentID and re2_agents.PriorityLevel = re2_priority.PriorityLevel and re2_agents.AccountStatus = 'active' order by visits desc limit 0,9 ";

$r1 = mysql_query($q1) or die(mysql_error());
$lrows = mysql_num_rows($r1);

if($lrows > '0')
{

	$TopTable .= "<table align=center width=510 border=1 bordercolor=black frame=hsides rules=rows cellspacing=0>\n";

	while($a1 = mysql_fetch_array($r1))
	{
		$TopTable .= "<tr onMouseOver=\"this.style.background='EFB8B8'; this.style.cursor='hand'\" onMouseOut=\"this.style.background='white'\" onClick=\"window.open('anuncio.php?id=$a1[ListingID]', '_top')\">\n\t";
		
		if($a1[PriorityLevel] > '1')
		{
			$sub = "<span class=RedLink><sup>$a1[PriorityName]</sup></span>";
		}
		else
		{
			$sub = "";
		}

		$TopTable .= "\n\t<td width=15>";

		if(!empty($a1[image]))
		{
			$TopTable .= "<img src=\"minhas_imagens/camera.gif\" width=25 height=18>";
		}

		$TopTable .= "</td>\n\t";

		$TopTable .= "<td width=305>$a1[city], $a1[state], $a1[address] $sub</td>\n\t";
		$TopTable .= "<td width=80>$a1[rooms] quarto(s), <br> $a1[bathrooms] banheiro(s) <br>";

		$MyPrice = number_format($a1[Price], 2, ",", ".");

		$TopTable .= "</td>\n\t<td align=center width=100><b>R$ $MyPrice</td>\n";
		$TopTable .= "</tr>\n";

	}

	$TopTable .= "</table>";
}


echo "<br>";

require_once("templates/FooterTemplate.php");

?>

