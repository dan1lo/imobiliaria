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
require_once("includes.php");

if($_SESSION[AccountStatus] == "pending")
{
	header("location:inativo.php");
	exit();
}

//get the user offers
$q1 = "select * from re2_listings where AgentID = '$_SESSION[AgentID]' order by DateAdded desc ";
$r1 = mysql_query($q1) or die(mysql_error());
$rows = mysql_num_rows($r1);

if($rows > '0')
{
	$ListingTable .= "<table align=center width=510 border=1 bordercolor=black frame=hsides rules=rows cellspacing=0>\n";

	while($a1 = mysql_fetch_array($r1))
	{
		$ListingTable .= "<tr onMouseOver=\"this.style.background='EFB8B8'; this.style.cursor='hand'\" onMouseOut=\"this.style.background='white'\" onClick=\"window.open('anuncio.php?id=$a1[ListingID]', '_top')\">\n\t";
		
		if($a1[PriorityLevel] > '1')
		{
			//get the priority level name
			$qp = "select PriorityName from re2_priority where PriorityLevel = '$a1[PriorityLevel]' ";
			$rp = mysql_query($qp) or die(mysql_error());
			$ap = mysql_fetch_array($rp);

			$sub = "<span class=RedLink><sup>$ap[0]</sup></span>";
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
		$ListingTable .= "<td width=80>$a1[rooms] quarto(s), $a1[bathrooms] banheiro(s)";

		$MyPrice = number_format($a1[Price], 2, ",", ".");

		$ListingTable .= "</td>\n\t<td align=center width=100><b>R$ $MyPrice</td>\n";
		$ListingTable .= "</tr>\n";

	}

	$ListingTable .= "</table>";
}

if($rows < $_SESSION[MaxOffers])
{
	$NewOffer = "<font face=verdana size=2>Clique <a class=RedLink href=\"anunciar.php\">AQUI</a> para cadastrar uma nova propriedade.</font>";
}
else
{
	$NewOffer = "<span class=RedLink>Se você quiser anunciar terá que atualizar sua conta comprando um de nossos pacotes de anúncios.<br>Clique <a class=BlackLink href=\"precos.php\">AQUI</a> para continuar.</span>";
}

require_once("templates/HeaderTemplate.php");
require_once("templates/ManageListingsTemplate.php");	
require_once("templates/FooterTemplate.php");

?>

