<?
require_once("configuracao_mysql.php");

if(isset($_POST[s1]))
{
	if(!empty($_POST[cat]))
	{
		$CatInfo = explode("|", $_POST[cat]);

		$c = $CatInfo[0];
		
		if($CatInfo[1] > '0')
		{
			$s = $CatInfo[1];
		}
	}

	if(!empty($_POST[search_country]))
	{
		$search_country = $_POST[search_country];
	}

	if(!empty($_POST[search_state]))
	{
		$state = $_POST[search_state];
	}

	if(!empty($_POST[search_city]))
	{
		$search_city = $_POST[search_city];
	}

	if(!empty($_POST[search_PropertyType]))
	{
		$search_PropertyType = $_POST[search_PropertyType];
	}

	if(!empty($_POST[MinPrice]))
	{
		$MinPrice = $_POST[MinPrice];
	}

	if(!empty($_POST[MaxPrice]))
	{
		$MaxPrice = $_POST[MaxPrice];
	}

	if(!empty($_POST[MinRooms]))
	{
		$rooms1 = $_POST[MinRooms];
	}

	if(!empty($_POST[MaxRooms]))
	{
		$rooms2 = $_POST[MaxRooms];
	}

	if(!empty($_POST[MinBath]))
	{
		$bath1 = $_POST[MinBath];
	}

	if(!empty($_POST[MaxBath]))
	{
		$bath2 = $_POST[MaxBath];
	}

	if(!empty($_POST[AgentID]))
	{
		$agent = $_POST[AgentID];
	}

	if(!empty($_POST[old]))
	{
		$before = $_POST[old];
	}

	if(!empty($_POST[NearSchool]))
	{
		$school = $_POST[NearSchool];
	}

	if(!empty($_POST[NearTransit]))
	{
		$transit = $_POST[NearTransit];
	}

	if(!empty($_POST[NearPark]))
	{
		$park = $_POST[NearPark];
	}

	if(!empty($_POST[OceanView]))
	{
		$ocean_view = $_POST[OceanView];
	}

	if(!empty($_POST[LakeView]))
	{
		$lake_view = $_POST[LakeView];
	}

	if(!empty($_POST[MountainView]))
	{
		$mountain_view = $_POST[MountainView];
	}

	if(!empty($_POST[OceanWaterfront]))
	{
		$ocean_waterfront = $_POST[OceanWaterfront];
	}

	if(!empty($_POST[LakeWaterfront]))
	{
		$lake_waterfront = $_POST[LakeWaterfront];
	}

	if(!empty($_POST[RiverWaterfront]))
	{
		$river_waterfront = $_POST[RiverWaterfront];
	}

	$url = "buscador.php?c=$c&s=$s&search_country=$_POST[search_country]&search_state=$_POST[search_state]&search_city=$_POST[search_city]&search_PropertyType=$_POST[search_PropertyType]&MaxPrice=$MaxPrice&MinPrice=$MinPrice&rooms1=$rooms1&rooms2=$rooms2&bath1=$bath1&bath2=$bath2&AgentID=$agent&before=$before&school=$school&transit=$transit&park=$park&ocean_view=$ocean_view&lake_view=$lake_view&mountain_view=$mountain_view&ocean_waterfront=$ocean_waterfront&lake_waterfront=$lake_waterfront&river_waterfront=$river_waterfront";

	header("location:$url");
	exit();
}

require_once("includes.php");
/*
//create the category menu
$CategoryMenu = "<select name=cat>\n\t<option value=\"\"></option>\n\t";

$q1 = "select * from re2_categories order by CategoryName";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) > '0')
{
	while($a1 = mysql_fetch_array($r1))
	{
		$CategoryMenu .= "<option value=\"$a1[CategoryID]|0\">$a1[CategoryName]</option>\n\t";

		//get the subcategories
		$q2 = "select * from re2_subcategories where CategoryID = '$a1[CategoryID]' order by SubcategoryName ";
		$r2 = mysql_query($q2) or die(mysql_error());
	
		while($a2 = mysql_fetch_array($r2))
		{
			$CategoryMenu .= "<option value=\"$a1[CategoryID]|$a2[SubcategoryID]\">$a1[CategoryName] - $a2[SubcategoryName]</option>\n\t";
		}

	}
}

$CategoryMenu .= "</select>\n";

*/
//create the state menu
$StateMenu = "<select name=search_state>\n\t<option value=\"\">Todos os Estados</option>\n\t";

$q1 = "select distinct state from re2_listings order by state";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) > '0')
{
	while($a1 = mysql_fetch_array($r1))
	{
		$StateMenu .= "<option value=\"$a1[state]\">$a1[state]</option>\n\t";
	}
}

$StateMenu .= "</select>\n";

//create the city menu
$CityMenu = "<select name=search_city>\n\t<option value=\"\">Todas as Cidades</option>\n\t";

$q1 = "select distinct city from re2_listings order by city";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) > '0')
{
	while($a1 = mysql_fetch_array($r1))
	{
		$CityMenu .= "<option value=\"$a1[city]\">$a1[city]</option>\n\t";
	}
}

$CityMenu .= "</select>\n";


//create the country menu
$CountryMenu = "<select name=search_country>\n\t<option value=\"\">Todos os países</option>\n\t";

$q1 = "select distinct country from re2_listings order by country";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) > '0')
{
	while($a1 = mysql_fetch_array($r1))
	{
		$CountryMenu .= "<option value=\"$a1[country]\">$a1[country]</option>\n\t";
	}
}

$CountryMenu .= "</select>\n";

//create the PropertyType menu
$TypeMenu = "<select name=search_PropertyType>\n\t<option value=\"\">Todos os tipos</option>\n\t";

$q1 = "select distinct PropertyType from re2_listings order by PropertyType";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) > '0')
{
	while($a1 = mysql_fetch_array($r1))
	{
		$TypeMenu .= "<option value=\"$a1[PropertyType]\">$a1[PropertyType]</option>\n\t";
	}
}

$TypeMenu .= "</select>\n";


//create the Price Minimum menu
$MinPrice = "<select name=MinPrice>\n\t<option value=\"\">Mínimo</option>\n\t";

$q1 = "select distinct Price from re2_listings WHERE CategoryID=3 order by Price asc";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) > '0')
{
	while($a1 = mysql_fetch_array($r1))
	{
		$prices .= "<option value=\"$a1[Price]\">R$ $a1[Price]</option>\n\t";
	}
}

$MinPrice .= $prices."</select>\n";


//create the max price menu
$MaxPrice = "<select name=MaxPrice>\n\t<option value=\"\">Máximo</option>\n\t";
$MaxPrice .= $prices."</select>\n";

//bedrooms
$MinBed = "<select name=MinRooms>\n\t<option value=\"\">Mínimo</option>\n\t";

for($i = '0'; $i <= '20'; $i++)
{
	$bed .= "<option value=\"$i\">$i</option>\n\t";
}

$MinBed .= $bed."</select>\n";

$MaxBed = "<select name=MaxRooms>\n\t<option value=\"\">Máximo</option>\n\t";
$MaxBed .= $bed."</select>\n";

//bathrooms
$MinBath = "<select name=MinBath>\n\t<option value=\"\">Mínimo</option>\n\t";

for($i = '0'; $i <= '10'; $i++)
{
	$bath .= "<option value=\"$i\">$i</option>\n\t";
}

$MinBath .= $bath."</select>\n";

$MaxBath = "<select name=MaxBath>\n\t<option value=\"\">Máximo</option>\n\t";
$MaxBath .= $bath."</select>\n";

//agents menu
$q1 = "select AgentID, FirstName, LastName from re2_agents order by FirstName, LastName";
$r1 = mysql_query($q1) or die(mysql_error());

$AgentsMenu = "<select name=AgentID>\n\t<option value=\"\">Todos os agentes</option>\n\t";

if(mysql_num_rows($r1) > '0')
{
	while($a1 = mysql_fetch_array($r1))
	{
		$AgentsMenu .= "<option value=\"$a1[AgentID]\">$a1[FirstName] $a1[LastName]</option>\n\t";
	}
}

$AgentsMenu .= "</select>\n";


?>