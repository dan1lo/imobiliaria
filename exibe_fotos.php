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

if(empty($_GET[id]))
{
	header("location:index.php");
	exit();
}

$q1 = "select * from re2_agents, re2_listings where re2_listings.ListingID = '$_GET[id]' and re2_listings.AgentID = re2_agents.AgentID ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

$i = 2;
if(empty($i) || $i == '1')
{
	$Image1 = "ver_anuncio2.gif";

	$desc = nl2br($a1[DetailedDesc]);

	$MyPrice = number_format($a1[Price], 2, ",", ".");

	$ShowInfo = "<table border=0 align=center width=\"100%\">\n\t<tr>\n\t<td width=\"60%\" valign=top><font size=3 face=verdana color=black><b>$a1[city], $a1[state], $a1[country]</b></font><br><font size=2 face=verdana color=black>$a1[address]</font></td>\n\t<td width=\"40%\" valign=top align=center><font size=2 face=verdana><B>Preço: R$ $MyPrice</td>\n</tr>\n\n<tr>\n\t<td valign=top><br><b>Imóvel ID: $a1[ListingID]</b><br><br>$desc<br><br><font size=2 face=verdana color=black><b>$a1[rooms] quarto(s), $a1[bathrooms] banheiro(s), $a1[garage] garagem(ns)</font><br><br>Vizinhança:</b> $a1[neighbourhood]<br><br><b>Tamanho da residência: $a1[SquareMeters] m2<br>Tamanho do lote: $a1[LotSize] m2<br>Idade: $a1[HomeAge] anos<br>";

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

	if($a1[TipodeConta] == '2')
	{
		if(!empty($a1[cellular]))
		{
			$int[] = "Celular: $a1[cellular]";
		}

		if(!empty($a1[pager]))
		{
			$int[] = "Pager: $a1[pager]";
		}

		if(!empty($int))
		{
			$int2 = implode("<br>", $int);

			$int2 = "<br>".$int2;
		}

	}

	$ShowInfo .= "</td>\n\t<td align=center valign=top>$FirstImage<br><br>Para Maiores informações ligue para<br><b> $a1[FirstName] $a1[LastName]<br>Telefone: $a1[phone]$int2</b><br>ou clique <a class=RedLink target=_blank href=\"contato.php?AgentID=$a1[AgentID]&ListingID=$a1[ListingID]\">AQUI</a> para enviar-lhe um e-mail.<br><br>";
	
	if($a1[TipodeConta] == '1')
	{
		$ShowInfo .= "<a class=BlueLink href=\"buscador.php?AgentID=$a1[AgentID]\" title=\"Mais propriedades deste agente\">Mais propriedades deste agente</a><br><br><center>";
	}
	else
	{
		$ShowInfo .= "<a class=BlueLink href=\"buscador.php?AgentID=$a1[AgentID]\" title=\"Mais propriedades de $a1[FirstName] $a1[LastName]\">Mais propriedades de $a1[FirstName] $a1[LastName]</a><br><br><center>";
	}
	
	if($a1[TipodeConta] == '1')
	{
		if(!empty($a1[logo]))
		{
			$ShowInfo .= "<a href=\"sobre_mim.php?id=$a1[AgentID]\" title=\"Ver informações deste agente!\"><img src=\"fotos_anuncios/$a1[logo]\" border=0></a>";
		}
		else
		{
			$ShowInfo .= "<a class=BlackLink href=\"sobre_mim.php?id=$a1[AgentID]\" title=\"Ver informações deste agente!\">$a1[FirstName] $a1[LastName]: Ver perfil</a>";
		}
	}

	$ShowInfo .= "</center></td>\n</tr>";
	
	if($a1[AgentID] == $_SESSION[AgentID])
	{
		$ShowInfo .= "<tr>\n\t<td colspan=3 align=center><a class=RedLink href=\"editar.php?id=$a1[ListingID]\">EDITAR</a> | <a class=RedLink href=\"deletar.php?id=$a1[ListingID]\">DELETAR</a></td>\n</tr>\n\n";
	}
	
	$ShowInfo .= "\n</table>";

}
else
{
	$Image1 = "ver_anuncio.gif";
}

if($i == '2')
{
	$Image2 = "ver_fotos2.gif";

	if(!empty($a1[image]))
	{
		$MyImages = explode("|", $a1[image]);

		$ShowInfo .= "<table valign=top align=center width=\"500\" height=50>\n<tr>\n\t<td align=center valign=top width=\"500\" height=50>";
		
		while(list(,$v) = each($MyImages))
		{
			$ShowInfo .= "<a href=\"fotos_anuncios/$v \" TARGET=\"_blank\"\><img src=\"fotos_anuncios/$v\" width=50 height=50 border=0></a>&nbsp;&nbsp;&nbsp;\n\n\t";
	
		}

		$ShowInfo .= "</table><hr size=1 width=\"95%\" color=#336699><br>";


		if(!empty($f))
		{
			$ShowInfo .= "<center><img src=\"fotos_anuncios/$f\"></center><br>";
		}
		else
		{
			$ShowInfo .= "<center><img src=\"fotos_anuncios/$MyImages[0]\"></center><br>";
		}

	}
	else
	{
		$ShowInfo .= "<br><center><img src=\"sem_foto.gif\"></center>";
	}

}
else
{
	$Image2 = "ver_fotos.gif";
}


$MyAddress = str_replace(" ", "+", $a1[address]);
$MyAddress = str_replace(",", "", $MyAddress);


$ListingID = $a1[ListingID];

require_once("templates/exibe_fotos.php");	

//update the stats
$q1 = "update re2_listings set visits = visits + '1' where ListingID = '$_GET[id]' ";
mysql_query($q1) or die(mysql_error());

?>