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

if(isset($_POST[s1]))
{
	if(!empty($_FILES[images][name][0]))
	{
		while(list($key,$value) = each($_FILES[images][name]))
		{
			if(!empty($value))
			{
				$NewImageName = $t."_offer_".$value;
				copy($_FILES[images][tmp_name][$key], "fotos_anuncios/".$NewImageName);

				$MyImages[] = $NewImageName;
			}
		}

		if(!empty($MyImages))
		{
			$ImageStr = implode("|", $MyImages);

			if(!empty($_POST[OldImages]))
			{
				$ImageStr = $ImageStr."|".$_POST[OldImages];
			}
		}

	}
	else
	{
		$ImageStr = $_POST[OldImages];
	}

	$catInfo = explode("|", $_POST[SelectCategory]);
	$CategoryID = $catInfo[0];
	$SubcategoryID = $catInfo[1];

	$q1 = "update re2_listings set 
					CategoryID = '$CategoryID',
					SubcategoryID = '$SubcategoryID',
					address = '$_POST[address]',
					city = '$_POST[city]',
					state = '$_POST[state]',
					country = '$_POST[country]',
					ShortDesc = '$_POST[ShortDesc]',
					DetailedDesc = '$_POST[DetailedDesc]',
					Price = '$_POST[Price]',
					PropertyType = '$_POST[PropertyType]',
					neighbourhood = '$_POST[neighbourhood]',
					rooms = '$_POST[rooms]',
					bathrooms = '$_POST[bathrooms]',
					fireplace = '$_POST[fireplace]',
					garage = '$_POST[garage]',
					SquareMeters = '$_POST[SquareMeters]',
					LotSize = '$_POST[LotSize]',
					HomeAge = '$_POST[HomeAge]',
					NearSchool = '$_POST[NearSchool]',
					NearTransit = '$_POST[NearTransit]',
					NearPark = '$_POST[NearPark]',
					OceanView = '$_POST[OceanView]',
					LakeView = '$_POST[LakeView]',
					MountainView = '$_POST[MountainView]',
					OceanWaterfront = '$_POST[OceanWaterfront]',
					LakeWaterfront = '$_POST[LakeWaterfront]',
					RiverWaterfront = '$_POST[RiverWaterfront]',
					image = '$ImageStr'

					where ListingID = '$_GET[id]' and AgentID = '$_SESSION[AgentID]' ";

	mysql_query($q1);

	header("location:anuncio.php?id=$_GET[id]");
	exit();
}

$qp = "select * from re2_listings where ListingID = '$_GET[id]' and AgentID = '$_SESSION[AgentID]' ";
$rp = mysql_query($qp) or die(mysql_error());

if(mysql_num_rows($rp) == '0')
{
	header("location:$_SERVER[HTTP_REFERER]");
	exit();
}

$ap = mysql_fetch_array($rp);

//get the categories
$q1 = "select * from re2_categories order by CategoryName";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) > '0')
{
	$SelectCategory = "<select name=SelectCategory>\n\t<option value=\"\"></option>\n\t";

	while($a1 = mysql_fetch_array($r1))
	{
		//get the subcategories
		$q2 = "select * from re2_subcategories where CategoryID = '$a1[CategoryID]' order by SubcategoryName ";
		$r2 = mysql_query($q2) or die(mysql_error());

		if(mysql_num_rows($r2) > '0')
		{
			while($a2 = mysql_fetch_array($r2))
			{
				if($ap[CategoryID] == $a1[CategoryID] && $ap[SubcategoryID] == $a2[SubcategoryID])
				{
					$SelectCategory .= "<option value=\"$a1[CategoryID]|$a2[SubcategoryID]\" selected>$a1[CategoryName] - $a2[SubcategoryName]</option>\n";
				}
				else
				{
					$SelectCategory .= "<option value=\"$a1[CategoryID]|$a2[SubcategoryID]\">$a1[CategoryName] - $a2[SubcategoryName]</option>\n";
				}
			}
		}

	}

	$SelectCategory .= "</select>\n";
}

$countries = array('Afghanistan', 'Albania', 'American Samoa', 'Andorra', 'Antigua', 'Argentina', 'Armenia', 'Australia', 'Austria', 'Azerbaijan', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Bolivia', 'Bosnia-Herzegovina', 'BRASIL', 'Brunei Darussalam', 'Bulgaria', 'Cambodia', 'Canada', 'Chile', 'China', 'Colombia', 'Costa Rica', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic', 'Denmark', 'Ecuador', 'Egypt', 'El Salvador', 'Estonia', 'Falkland Islands', 'Fiji', 'Finland', 'France', 'French Guyana', 'Georgia', 'Germany', 'Gibraltar', 'Greece', 'Greenland', 'Grenada', 'Guatemala', 'Honduras', 'Hong Kong', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel', 'Italy', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Malaysia', 'Maldives', 'Malta', 'Mauritius', 'Mexico', 'Mongolia', 'Morocco', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'North Korea', 'Norway', 'Oman', 'Pakistan', 'Panama', 'Paraguay', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Puerto Rico', 'Qatar', 'Romania', 'Russian Federation', 'Saudi Arabia', 'Singapore', 'Slovak Republic', 'Slovenia', 'South Africa', 'South Korea', 'Spain', 'Sri Lanka', 'Sweden', 'Switzerland', 'Syria', 'Taiwan', 'Thailand', 'Tunisia', 'Turkey', 'Turkmenistan', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay', 'Uzbekistan', 'Venezuela', 'Vietnam', 'Yemen', 'Yugoslavia', 'Zimbabwe');

$SelectCountry = "<select name=country>\n\t<option value=\"\"></option>\n\t";

while(list(,$v) = each($countries))
{
	if($ap[country] == $v)
	{
		$SelectCountry .= "<option value=\"$v\" selected>$v</option>\n\t";
	}
	else
	{
		$SelectCountry .= "<option value=\"$v\">$v</option>\n\t";
	}
}

$SelectCountry .= "</select>";

//create "Select rooms"
$SelectRooms = "<select name=rooms>\n\t<option value=\"\"></option>\n\t";

for($r = '1'; $r <= '10'; $r++)
{
	if($ap[rooms] == $r)
	{
		$SelectRooms .= "<option value=\"$r\" selected>$r</option>\n\t";
	}
	else
	{
		$SelectRooms .= "<option value=\"$r\">$r</option>\n\t";
	}
}

$SelectRooms .= "</select>\n";

//create "Select Banheiros"
$SelectBathrooms = "<select name=bathrooms>\n\t<option value=\"\"></option>\n\t";

for($r = '1'; $r <= '10'; $r++)
{
	if($ap[bathrooms] == $r)
	{
		$SelectBathrooms .= "<option value=\"$r\" selected>$r</option>\n\t";
	}
	else
	{
		$SelectBathrooms .= "<option value=\"$r\">$r</option>\n\t";
	}
}

$SelectBathrooms .= "</select>\n";

//create "Select Garage"
$SelectGarage = "<select name=garage>\n\t<option value=\"\"></option>\n\t";

for($r = '1'; $r <= '5'; $r++)
{
	if($ap[garage] == $r)
	{
		$SelectGarage .= "<option value=\"$r\" selected>$r</option>\n\t";
	}
	else
	{
		$SelectGarage .= "<option value=\"$r\">$r</option>\n\t";
	}
}

$SelectGarage .= "</select>\n";

//fireplace
if($ap[fireplace] == 'y')
{
	$fire1 = "checked";
}
else
{
	$fire2 = "checked";
}

//school
if($ap[NearSchool] == 'y')
{
	$school1 = "checked";
}
else
{
	$school2 = "checked";
}

//transit
if($ap[NearTransit] == 'y')
{
	$transit1 = "checked";
}
else
{
	$transit2 = "checked";
}

//park
if($ap[NearPark] == 'y')
{
	$park1 = "checked";
}
else
{
	$park2 = "checked";
}

//Ocean View
if($ap[OceanView] == 'y')
{
	$OceanView1 = "checked";
}
else
{
	$OceanView2 = "checked";
}

//Lake View
if($ap[LakeView] == 'y')
{
	$LakeView1 = "checked";
}
else
{
	$LakeView2 = "checked";
}

//Mountain View
if($ap[MountainView] == 'y')
{
	$MountainView1 = "checked";
}
else
{
	$MountainView2 = "checked";
}

//Ocean Waterfront
if($ap[OceanWaterfront] == 'y')
{
	$OceanWaterfront1 = "checked";
}
else
{
	$OceanWaterfront2 = "checked";
}

//Ocean Waterfront
if($ap[LakeWaterfront] == 'y')
{
	$LakeWaterfront1 = "checked";
}
else
{
	$LakeWaterfront2 = "checked";
}

//Ocean Waterfront
if($ap[RiverWaterfront] == 'y')
{
	$RiverWaterfront1 = "checked";
}
else
{
	$RiverWaterfront2 = "checked";
}


$images = "<table width=270 cellspacing=0 cellpadding=0 align=left><tr>";

if(!empty($ap[image]))
{
	$MyImages = explode("|", $ap[image]);

	while(list(,$vi) = each($MyImages))
	{
		$images .= "<td align=center style=\"padding-bottom:15\"><img src=\"fotos_anuncios/$vi\" width=50 height=50><br><a class=RedLink href=\"deletar_foto.php?id=$ap[ListingID]&file=$vi\">Deletar</a></td>";

		$mi++;
	}
}

	$images .= "</tr>\n";

for($im2 = '1'; $im2 <= (10 - $mi); $im2++)
{
	$images .= "<tr>\n\t<td colspan=3><input type=file name=\"images[]\"></td>\n</tr>\n";
}

$images .= "</table>";

require_once("templates/HeaderTemplate.php");
require_once("templates/EditOfferTemplate.php");	
require_once("templates/FooterTemplate.php");

?>

