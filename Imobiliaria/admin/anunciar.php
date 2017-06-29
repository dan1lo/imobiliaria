<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");
require_once("LeftStyles.php");
require_once("../includes.php");

//get the agents
$q1 = "select * from re2_agents order by FirstName, LastName";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) > '0')
{
	$SelectAgent = "<select name=AgentID>\n\t<option value=\"\"></option>";

	while($a1 = mysql_fetch_array($r1))
	{
		$SelectAgent .= "<option value=\"$a1[AgentID]\">$a1[FirstName] $a1[LastName]</option>\n\t";
	}

	$SelectAgent .= "</select>";
}
else
{
	echo "<br><br><center><font face=verdana size=2 color=red><b>Você não pode adicionar agentes!</b></font></center>";

	exit();
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
<caption align=center>
<font color=black face=verdana size=2><b>Cadastrar nova propriedade </b></font>
</caption>

<tr>
	<td align=right>Agente:</td>
	<td><?=$SelectAgent?></td>
</tr>

<tr>
	<td align=right>Categoria:</td>
	<td><?=$SelectCategory?></td>
</tr>

<tr>
	<td align=right>Endere&ccedil;o:</td>
	<td><input type=text name=address></td>
</tr>

<tr>
	<td align=right>Cidade:</td>
	<td><input type=text name=city></td>
</tr>

<tr>
	<td align=right>Estado:</td>
	<td><input type=text name=state></td>
</tr>

<tr>
	<td align=right>Pa&iacute;s:</td>
	<td><?=$SelectCountry?></td>
</tr>

<tr>
	<td align=right valign=top>Breve descri&ccedil;&atilde;o:</td>
	<td><textarea cols=40 rows=4 name=ShortDesc></textarea></td>
</tr>

<tr>
	<td align=right valign=top>Descri&ccedil;&atilde;o detalhada:</td>
	<td><textarea cols=40 rows=4 name=DetailedDesc></textarea></td>
</tr>

<tr>
	<td align=right>Pre&ccedil;o:</td>
	<td><input type=text name=Price> 
	  <font face=verdana size=1 color=red><B>formato: 25000.00</b></font> </td>
</tr>

<tr>
	<td align=right valign=top>Informa&ccedil;&otilde;es sobre a vizinhan&ccedil;a:</td>
	<td><textarea cols=40 rows=4 name=neighbourhood></textarea></td>
</tr>

<tr>
	<td align=right>Tipo de propriedade:</td>
	<td><?=ptypes("0");?></td>
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
	<td align=right>Garagem:</td>
	<td>
		<select name=garage>
			<option value=""></option>
			<option value="1">1 carro</option>
			<option value="2">2 carros</option>
			<option value="3">3 carros</option>
			<option value="4">4 carros</option>
			<option value="5">5 carros</option>
		</select>
	</td>
</tr>

<tr>
	<td align=right>Tamanho da casa (em m2):</td>
	<td><input type=text name=SquareMeters> 
	  <font face=verdana size=1 color=red><B>formato: 350.00</b></font> </td>
</tr>

<tr>
	<td align=right>Tamanho do lote (em m2):</td>
	<td><input type=text name=LotSize> 
	  <font face=verdana size=1 color=red><B>formato: 1250.00</b></font> </td>
</tr>

<tr>
	<td align=right>Idade da resid&ecirc;ncia:</td>
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
	<td align=right valign=top>Fotos:</td>
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
  <td align=right>Tem lareira ou churrasqueira?</td>
  <td>
    <input type=radio name=fireplace value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=fireplace value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>Pr&oacute;ximo a escola?</td>
  <td>
    <input type=radio name=NearSchool value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=NearSchool value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>Pr&oacute;ximo do tr&acirc;nsito?</td>
  <td>
    <input type=radio name=NearTransit value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=NearTransit value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>Pr&oacute;ximo a parque ou pra&ccedil;a? </td>
  <td>
    <input type=radio name=NearPark value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=NearPark value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>Vista para o mar? </td>
  <td>
    <input type=radio name=OceanView value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=OceanView value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>Vista para um lago? </td>
  <td>
    <input type=radio name=LakeView value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=LakeView value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>Vista para uma montanha? </td>
  <td>
    <input type=radio name=MountainView value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=MountainView value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>De frente para o mar? </td>
  <td>
    <input type=radio name=OceanWaterfront value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=OceanWaterfront value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>De frente para um lago? </td>
  <td>
    <input type=radio name=LakeWaterfront value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=LakeWaterfront value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>De frente para um rio? </td>
  <td>
    <input type=radio name=RiverWaterfront value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=RiverWaterfront value="n" checked>
    n&atilde;o </td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><input type=submit name=s1 value="Cadastrar"></td>
</tr>

</table>
</form>

