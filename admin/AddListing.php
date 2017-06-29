<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

include_once("LeftStyles.php");

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
		}

	}

	$catInfo = explode("|", $_POST[SelectCategory]);
	$CategoryID = $catInfo[0];
	$SubcategoryID = $catInfo[1];

	$q1 = "insert into re2_listings set 
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
					image = '$ImageStr',
					DateAdded = '$t' ";

	mysql_query($q1);

	$last = mysql_insert_id();

	echo "<br><br><center>Your listing was added successfully!<br>Click <a class=RedLink href=\"../anuncio.php?id=$last\">here</a> to see the result.</center>";

}


//get the agent list
$q1 = "select * from re2_agents order by FirstName, LastName";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) == '0')
{
	echo "<center><br><br>There are not registered agents, yet!";

	exit();
}
else
{
	$SelectAgent = "<select name=AgentID>\n\t";
	while($a1 = mysql_fetch_array($r1))
	{
		$SelectAgent .= "<option value=\"$a1[AgentID]\">$a1[FirstName] $a1[LastName]</option>\n\t";
	}
	$SelectAgent .= "</select>\n";
}

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
				$SelectCategory .= "<option value=\"$a1[CategoryID]|$a2[SubcategoryID]\">$a1[CategoryName] - $a2[SubcategoryName]</option>\n";
			}
		}

	}

	$SelectCategory .= "</select>\n";
}

$countries = array('Afghanistan', 'Albania', 'American Samoa', 'Andorra', 'Antigua', 'Argentina', 'Armenia', 'Australia', 'Austria', 'Azerbaijan', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Bolivia', 'Bosnia-Herzegovina', 'BRASIL', 'Brunei Darussalam', 'Bulgaria', 'Cambodia', 'Canada', 'Chile', 'China', 'Colombia', 'Costa Rica', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic', 'Denmark', 'Ecuador', 'Egypt', 'El Salvador', 'Estonia', 'Falkland Islands', 'Fiji', 'Finland', 'France', 'French Guyana', 'Georgia', 'Germany', 'Gibraltar', 'Greece', 'Greenland', 'Grenada', 'Guatemala', 'Honduras', 'Hong Kong', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel', 'Italy', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Malaysia', 'Maldives', 'Malta', 'Mauritius', 'Mexico', 'Mongolia', 'Morocco', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'North Korea', 'Norway', 'Oman', 'Pakistan', 'Panama', 'Paraguay', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Puerto Rico', 'Qatar', 'Romania', 'Russian Federation', 'Saudi Arabia', 'Singapore', 'Slovak Republic', 'Slovenia', 'South Africa', 'South Korea', 'Spain', 'Sri Lanka', 'Sweden', 'Switzerland', 'Syria', 'Taiwan', 'Thailand', 'Tunisia', 'Turkey', 'Turkmenistan', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay', 'Uzbekistan', 'Venezuela', 'Vietnam', 'Yemen', 'Yugoslavia', 'Zimbabwe');

$SelectCountry = "<select name=country>\n\t<option value=\"\"></option>\n\t";

while(list(,$v) = each($countries))
{
	$SelectCountry .= "<option value=\"$v\">$v</option>\n\t";
}

$SelectCountry .= "</select>";

?>

<form method=post action="anunciar2.php" enctype="multipart/form-data" name=PostForm onsubmit="return CheckOffer();">
<table align=center width=400>
<caption align=center><font color=black face=verdana size=2><b>Novo anúncio</b></font></caption>

<tr>
	<td align=right>Select Agent:</td>
	<td><?=$SelectAgent?></td>
</tr>

<tr>
	<td align=right>Category:</td>
	<td><?=$SelectCategory?></td>
</tr>

<tr>
	<td align=right>Address:</td>
	<td><input type=text name=address></td>
</tr>

<tr>
	<td align=right>City:</td>
	<td><input type=text name=city></td>
</tr>

<tr>
	<td align=right>State:</td>
	<td><input type=text name=state></td>
</tr>

<tr>
	<td align=right>Country:</td>
	<td><?=$SelectCountry?></td>
</tr>

<tr>
	<td align=right valign=top>Short description:</td>
	<td><textarea cols=40 rows=4 name=ShortDesc></textarea></td>
</tr>

<tr>
	<td align=right valign=top>Detailed description:</td>
	<td><textarea cols=40 rows=4 name=DetailedDesc></textarea></td>
</tr>

<tr>
	<td align=right>Price:</td>
	<td><input type=text name=Price> <font face=verdana size=1 color=red><B>format: 25000.00</b></font> </td>
</tr>

<tr>
	<td align=right>Propery type:</td>
	<td>
		<select name=PropertyType>
			<option value=""></option>
			<option value="home">home</option>
			<option value="appartment">appartment</option>
			<option value="condo">condo</option>
		</select>
	</td>
</tr>

<tr>
	<td align=right>Quartos:</td>
	<td>
		<select name=rooms>
			<option value=""></option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
		</select>
	</td>
</tr>

<tr>
	<td align=right>Banheiros:</td>
	<td>
		<select name=bathrooms>
			<option value=""></option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
		</select>
	</td>
</tr>

<tr>
	<td align=right>Garage:</td>
	<td>
		<select name=garage>
			<option value=""></option>
			<option value="1">1 car</option>
			<option value="2">2 cars</option>
			<option value="3">3 cars</option>
			<option value="4">4 cars</option>
			<option value="5">5 cars</option>
		</select>
	</td>
</tr>

<tr>
	<td align=right>Squire meters:</td>
	<td><input type=text name=SquareMeters> <font face=verdana size=1 color=red><B>format: 350.00</b></font> </td>
</tr>

<tr>
	<td align=right>Lot size:</td>
	<td><input type=text name=LotSize> <font face=verdana size=1 color=red><B>format: 1250.00</b></font> </td>
</tr>

<tr>
	<td align=right>Age of home:</td>
	<td>
		<select name=HomeAge>
			<option value=""></option>
			<?
			for($i = '1'; $i <= '250'; $i++)
			{
				echo "<option value=\"$i\">$i</option>\n\t";
			}
			?>
		</select>
	</td>
</tr>

<tr>
	<td align=right valign=top>Images:</td>
	<td>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
	</td>
</tr>

<tr>
	<td align=right>Tem lareira ou churrasqueira:</td>
	<td>
		<input type=radio name=fireplace value="y">yes &nbsp;&nbsp;&nbsp;
		<input type=radio name=fireplace value="n" checked>no
	</td>
</tr>

<tr>
	<td align=right>Pr&oacute;ximo a escola:</td>
	<td>
		<input type=radio name=NearSchool value="y">yes &nbsp;&nbsp;&nbsp;
		<input type=radio name=NearSchool value="n" checked>no
	</td>
</tr>

<tr>
	<td align=right>Pr&oacute;ximo do tr&acirc;nsito:</td>
	<td>
		<input type=radio name=NearTransit value="y">yes &nbsp;&nbsp;&nbsp;
		<input type=radio name=NearTransit value="n" checked>no
	</td>
</tr>

<tr>
	<td align=right>Pr&oacute;ximo a parque ou pra&ccedil;a:</td>
	<td>
		<input type=radio name=NearPark value="y">yes &nbsp;&nbsp;&nbsp;
		<input type=radio name=NearPark value="n" checked>no
	</td>
</tr>

<tr>
	<td align=right>Vista para o mar:</td>
	<td>
		<input type=radio name=OceanView value="y">yes &nbsp;&nbsp;&nbsp;
		<input type=radio name=OceanView value="n" checked>no
	</td>
</tr>

<tr>
	<td align=right>Vista para um lago:</td>
	<td>
		<input type=radio name=LakeView value="y">yes &nbsp;&nbsp;&nbsp;
		<input type=radio name=LakeView value="n" checked>no
	</td>
</tr>

<tr>
	<td align=right>Vista para uma montanha:</td>
	<td>
		<input type=radio name=MountainView value="y">yes &nbsp;&nbsp;&nbsp;
		<input type=radio name=MountainView value="n" checked>no
	</td>
</tr>

<tr>
	<td align=right>De frente para o mar:</td>
	<td>
		<input type=radio name=OceanWaterfront value="y">yes &nbsp;&nbsp;&nbsp;
		<input type=radio name=OceanWaterfront value="n" checked>no
	</td>
</tr>

<tr>
	<td align=right>De frente para um lago:</td>
	<td>
		<input type=radio name=LakeWaterfront value="y">yes &nbsp;&nbsp;&nbsp;
		<input type=radio name=LakeWaterfront value="n" checked>no
	</td>
</tr>

<tr>
	<td align=right>De frente para um rio:</td>
	<td>
		<input type=radio name=RiverWaterfront value="y">yes &nbsp;&nbsp;&nbsp;
		<input type=radio name=RiverWaterfront value="n" checked>no
	</td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><input type=submit name=s1 value="Submit"></td>
</tr>

</table>
</form>