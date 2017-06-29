<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");
require_once("../includes.php");

if(isset($_POST[s1]))
{
	if(!empty($_FILES[images][name][0]))
	{
		while(list($key,$value) = each($_FILES[images][name]))
		{
			if(!empty($value))
			{
				$NewImageName = $t."_offer_".$value;
				copy($_FILES[images][tmp_name][$key], "../fotos_anuncios/".$NewImageName);

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
					AgentID = '$_POST[AgentID]',
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

					where ListingID = '$_GET[id]' ";

	mysql_query($q1) or die(mysql_error());

	header("location:anuncio.php?id=$_GET[id]");
	exit();
}

include_once("LeftStyles.php");

$qp = "select * from re2_listings where ListingID = '$_GET[id]' ";
$rp = mysql_query($qp) or die(mysql_error());

if(mysql_num_rows($rp) == '0')
{
	header("location:$_SERVER[HTTP_REFERER]");
	exit();
}

$ap = mysql_fetch_array($rp);


//get the agent list
$q1 = "select * from re2_agents order by FirstName, LastName";
$r1 = mysql_query($q1) or die(mysql_error());

$SelectAgent = "<select name=AgentID>\n\t";
while($a1 = mysql_fetch_array($r1))
{
	if($a1[AgentID] == $ap[AgentID])
	{
		$SelectAgent .= "<option value=\"$a1[AgentID]\" selected>$a1[FirstName] $a1[LastName]</option>\n\t";
	}
	else
	{
		$SelectAgent .= "<option value=\"$a1[AgentID]\">$a1[FirstName] $a1[LastName]</option>\n\t";
	}
}
$SelectAgent .= "</select>\n";


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

//create "Select Bathrooms"
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
		$images .= "<td align=center style=\"padding-bottom:15\"><img src=\"../fotos_anuncios/$vi\" width=50 height=50><br><a class=RedLink href=\"deletar_foto.php?id=$ap[ListingID]&file=$vi\">delete</a></td>";

		$mi++;
	}
}

	$images .= "</tr>\n";

for($im2 = '1'; $im2 <= (10 - $mi); $im2++)
{
	$images .= "<tr>\n\t<td colspan=3><input type=file name=\"images[]\"></td>\n</tr>\n";
}

$images .= "</table>";

?>

<form method=post enctype="multipart/form-data" name=PostForm onsubmit="return CheckOffer();">
<table align=center width=400>
<caption align=center><font color=black face=verdana size=2><b>Editar anúncio</b></font></caption>

<tr>
	<td align=right>Selecione o agente:</td>
	<td><?=$SelectAgent?></td>
</tr>

<tr>
	<td width=130 align=right>Categoria:</td>
	<td width=270><?=$SelectCategory?></td>
</tr>

<tr>
	<td align=right>Endereço:</td>
	<td><input type=text name=address value="<?=$ap[address]?>"></td>
</tr>

<tr>
	<td align=right>Cidade:</td>
	<td><input type=text name=city value="<?=$ap[city]?>"></td>
</tr>

<tr>
	<td align=right>Estado:</td>
	<td><input type=text name=state value="<?=$ap[state]?>"></td>
</tr>

<tr>
	<td align=right>País:</td>
	<td><?=$SelectCountry?></td>
</tr>

<tr>
	<td align=right valign=top>Breve descrição:</td>
	<td><textarea cols=40 rows=4 name=ShortDesc><?=$ap[ShortDesc]?></textarea></td>
</tr>

<tr>
	<td align=right valign=top>Descrição detalhada:</td>
	<td><textarea cols=40 rows=4 name=DetailedDesc><?=$ap[DetailedDesc]?></textarea></td>
</tr>

<tr>
	<td align=right>Preço:</td>
	<td><input type=text name=Price value="<?=$ap[Price]?>"> <font face=verdana size=1 color=red><B>formato: 25000.00</b></font> </td>
</tr>

<tr>
	<td align=right valign=top>Informações sobre a vizinhança:</td>
	<td><textarea cols=40 rows=4 name=neighbourhood><?=$ap[neighbourhood]?></textarea></td>
</tr>

<tr>
	<td align=right>Tipo de propriedade:</td>
	<td><?=ptypes($ap[PropertyType]);?> <!-- <?=$ap[ProperyType]?> --></td>
</tr>

<tr>
	<td align=right>Quartos:</td>
	<td><?=$SelectRooms?></td>
</tr>

<tr>
	<td align=right>Banheiros:</td>
	<td><?=$SelectBathrooms?></td>
</tr>

<tr>
	<td align=right>Garagens:</td>
	<td><?=$SelectGarage?></td>
</tr>

<tr>
	<td align=right>Tamanho da casa (em m2):</td>
	<td><input type=text name=SquareMeters value="<?=$ap[SquareMeters]?>"> <font face=verdana size=1 color=red><B>formato: 350.00</b></font> </td>
</tr>

<tr>
	<td align=right>Tamanho do lote (em m2):</td>
	<td><input type=text name=LotSize value="<?=$ap[LotSize]?>"> <font face=verdana size=1 color=red><B>formato: 1250.00</b></font> </td>
</tr>

<tr>
	<td align=right>Idade da residência:</td>
	<td>
		<select name=HomeAge>
			<option value=""></option>
			<?
			for($i = '1'; $i <= '250'; $i++)
			{
				if($ap[HomeAge] == $i)
				{
					echo "<option value=\"$i\" selected>$i</option>\n\t";
				}
				else
				{
					echo "<option value=\"$i\">$i</option>\n\t";
				}
			}
			?>
		</select>
	</td>
</tr>

<tr>
	<td align=right valign=top>Fotos:</td>
	<td><?=$images?></td>
</tr>

<tr>
	<td align=right>Tem lareira ou churrasqueira:</td>
	<td>
		<input type=radio name=fireplace value="y" <?=$fire1?>>sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=fireplace value="n" <?=$fire2?>>não
	</td>
</tr>

<tr>
	<td align=right>Pr&oacute;ximo a escola:</td>
	<td>
		<input type=radio name=NearSchool value="y" <?=$school1?>>sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=NearSchool value="n" <?=$school2?>>não
	</td>
</tr>

<tr>
	<td align=right>Pr&oacute;ximo do tr&acirc;nsito:</td>
	<td>
		<input type=radio name=NearTransit value="y" <?=$transit1?>>sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=NearTransit value="n" <?=$transit2?>>não
	</td>
</tr>

<tr>
	<td align=right>Pr&oacute;ximo a parque ou pra&ccedil;a:</td>
	<td>
		<input type=radio name=NearPark value="y" <?=$park1?>>sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=NearPark value="n" <?=$park2?>>não
	</td>
</tr>

<tr>
	<td align=right>Vista para o mar:</td>
	<td>
		<input type=radio name=OceanView value="y" <?=$OceanView1?>>sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=OceanView value="n" <?=$OceanView2?>>não
	</td>
</tr>

<tr>
	<td align=right>Vista para um lago:</td>
	<td>
		<input type=radio name=LakeView value="y" <?=$LakeView1?>>sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=LakeView value="n" <?=$LakeView2?>>não
	</td>
</tr>

<tr>
	<td align=right>Vista para uma montanha:</td>
	<td>
		<input type=radio name=MountainView value="y" <?=$MountainView1?>>sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=MountainView value="n" <?=$MountainView2?>>não
	</td>
</tr>

<tr>
	<td align=right>De frente para o mar:</td>
	<td>
		<input type=radio name=OceanWaterfront value="y" <?=$OceanWaterfront1?>>sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=OceanWaterfront value="n" <?=$OceanWaterfront2?>>não
	</td>
</tr>

<tr>
	<td align=right>De frente para um lago:</td>
	<td>
		<input type=radio name=LakeWaterfront value="y" <?=$LakeWaterfront1?>>sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=LakeWaterfront value="n" <?=$LakeWaterfront2?>>não
	</td>
</tr>

<tr>
	<td align=right>De frente para um rio:</td>
	<td>
		<input type=radio name=RiverWaterfront value="y" <?=$RiverWaterfront1?>>sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=RiverWaterfront value="n" <?=$RiverWaterfront2?>>não

	</td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td>
		<input type=hidden name=OldImages value="<?=$ap[image]?>">
		<input type=submit name=s1 value="Editar">
	</td>
</tr>

</table>
</form>