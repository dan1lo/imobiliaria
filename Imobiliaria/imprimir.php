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

$q1 = "select * from re2_agents, re2_listings where re2_listings.ListingID = '$_GET[id]' and re2_listings.AgentID = re2_agents.AgentID ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

	$Image1 = "ver_anuncio2.gif";

	$desc = nl2br($a1[DetailedDesc]);

	$MyPrice = number_format($a1[Price], 2, ",", ".");

	$ShowInfo = "<table border=0 align=center width=\"100%\">\n\t<tr>\n\t<td width=\"60%\"><font size=3 face=verdana color=black><b>$a1[city], $a1[state], $a1[country]</b></font><br><font size=2 face=verdana color=black>$a1[address]</font></td>\n\t<td width=\"40%\" valign=top align=center><font size=2 face=verdana><B>Preço: R$ $MyPrice</td>\n</tr>\n\n<tr>\n\t<td valign=top><br><b>Imóvel ID: $a1[ListingID]</b><br><br>$desc<br><br><font size=2 face=verdana color=black><b>$a1[rooms] quarto(s), $a1[bathrooms] banheiro(s), $a1[garage] garagem(ns)</font><br><br>Vizinhança:</b> $a1[neighbourhood]<br><br><b>Tamanho da residência: $a1[SquareMeters] m2<br>Tamanho do lote: $a1[LotSize] m2<br>Idade: $a1[HomeAge] anos<br>";

	if($a1[fireplace] == 'y')
	{
		$ShowInfo .= ">>Tem lareira ou churrasqueira<br>\n";
	}

	if($a1[NearSchool] == 'y')
	{
		$ShowInfo .= ">>Pr&oacute;ximo a escola<br>\n";
	}

	if($a1[NearTransit] == 'y')
	{
		$ShowInfo .= ">>Pr&oacute;ximo do tr&acirc;nsito<br>\n";
	}

	if($a1[NearPark] == 'y')
	{
		$ShowInfo .= ">>Pr&oacute;ximo a parque ou pra&ccedil;a<br>\n";
	}

	if($a1[OceanView] == 'y')
	{
		$ShowInfo .= ">>Vista para o mar<br>\n";
	}

	if($a1[LakeView] == 'y')
	{
		$ShowInfo .= ">>Vista para um lago<br>\n";
	}

	if($a1[MountainView] == 'y')
	{
		$ShowInfo .= ">>Vista para uma montanha<br>\n";
	}

	if($a1[OceanWaterfront] == 'y')
	{
		$ShowInfo .= ">>De frente para o mar<br>\n";
	}

	if($a1[LakeWaterfront] == 'y')
	{
		$ShowInfo .= ">>De frente para um lago<br>\n";
	}

	if($a1[RiverWaterfront] == 'y')
	{
		$ShowInfo .= ">>De frente para um rio<br>\n";
	}

	if(!empty($a1[image]))
	{
		$im_array = explode("|", $a1[image]);

		$FirstImage = "<img src=\"fotos_anuncios/$im_array[0]\" width=100 height=100>";
	}

	$ShowInfo .= "</td>\n\t<td align=center valign=top>$FirstImage<br><br>Para Maiores informações ligue para<br><b> $a1[FirstName] $a1[LastName]<br>$a1[phone]</b><br>ou clique <a class=RedLink href=\"contato.php?AgentID=$a1[AgentID]&ListingID=$a1[ListingID]\">AQUI</a> para enviar um e-mail.<br><br><a class=BlueLink href=\"buscador.php?AgentID=$a1[AgentID]\" title=\"Mais propriedades deste agente\">Mais propriedades deste agente</a><br><br><center>";
	
	if(!empty($a1[logo]))
	{
		$ShowInfo .= "<a href=\"sobre_mim.php?id=$a1[AgentID]\" title=\"Ver informações deste agente!\"><img src=\"fotos_anuncios/$a1[logo]\" border=0></a>";
	}
	else
	{
		$ShowInfo .= "<a class=BlackLink href=\"sobre_mim.php?id=$a1[AgentID]\" title=\"Ver informações deste agente!\">$a1[FirstName] $a1[LastName]: Ver perfil</a>";
	}

	$ShowInfo .= "</center></td>\n</tr>";
	
	if($a1[AgentID] == $_SESSION[AgentID])
	{
		$ShowInfo .= "<tr>\n\t<td colspan=3 align=center><a class=RedLink href=\"editar.php?id=$a1[ListingID]\">editar</a> | <a class=RedLink href=\"deletar.php?id=$a1[ListingID]\">Deletar</a></td>\n</tr>\n\n";
	}
	
	$ShowInfo .= "\n</table>";

$MyAddress = str_replace(" ", "+", $a1[address]);
$MyAddress = str_replace(",", "", $MyAddress);

$Image2 = "ver_fotos.gif";
$Image3 = "<a target=_blank  href=\"http://www.mapquest.com/maps/map.adp?city=$a1[city]&state=$a1[state]&address=$MyAddress&country=$a1[country]&zoom=5\"><img src=\"minhas_imagens/mapa.gif\" border=0></a>";

$ListingID = $a1[ListingID];

require_once("templates/PrintHeaderTemplate.php");
require_once("templates/PrintTemplate.php");	
require_once("templates/PrintFooterTemplate.php");

?>