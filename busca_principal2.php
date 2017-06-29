<?
$query = array();

if(!empty($_GET[c]))
{
	$query[] = "re2_listings.CategoryID = '$_GET[c]' ";
}

if(!empty($_GET[s]))
{
	$query[] = "re2_listings.SubcategoryID = '$_GET[s]' ";
}

if(!empty($_GET[AgentID]))
{
	$query[] = "re2_listings.AgentID = '$_GET[AgentID]' ";
}

if(!empty($_GET[search_country]))
{
	$query[] = "re2_listings.country = '$_GET[search_country]' ";
}

if(!empty($_GET[search_state]))
{
	$query[] = "re2_listings.state = '$_GET[search_state]' ";
}

if(!empty($_GET[search_city]))
{
	$query[] = "re2_listings.city = '$_GET[search_city]' ";
}

if(!empty($_GET[search_PropertyType]))
{
	$query[] = "re2_listings.PropertyType = '$_GET[search_PropertyType]' ";
}

if(!empty($_GET[MinPrice]))
{
	$query[] = "re2_listings.price >= '$_GET[MinPrice]' ";
}

if(!empty($_GET[MaxPrice]))
{
	$query[] = "re2_listings.price <= '$_GET[MaxPrice]' ";
}

if(!empty($_GET[rooms1]))
{
	$query[] = "re2_listings.rooms >= '$_GET[rooms1]' ";
}

if(!empty($_GET[rooms2]))
{
	$query[] = "re2_listings.rooms <= '$_GET[rooms2]' ";
}

if(!empty($_GET[bath1]))
{
	$query[] = "re2_listings.bathrooms >= '$_GET[bath1]' ";
}

if(!empty($_GET[bath2]))
{
	$query[] = "re2_listings.bathrooms <= '$_GET[bath2]' ";
}

if(!empty($_GET[before]))
{
	$MyDate = strtotime("-$_GET[before]");
	$query[] = "re2_listings.DateAdded >= '$MyDate' ";
}

if(!empty($_GET[school]))
{
	$query[] = "re2_listings.NearSchool = 'y' ";
}

if(!empty($_GET[transit]))
{
	$query[] = "re2_listings.NearTransit = 'y' ";
}

if(!empty($_GET[park]))
{
	$query[] = "re2_listings.NearPark = 'y' ";
}

if(!empty($_GET[ocean_view]))
{
	$query[] = "re2_listings.OceanView = 'y' ";
}

if(!empty($_GET[lake_view]))
{
	$query[] = "re2_listings.LakeView = 'y' ";
}

if(!empty($_GET[mountain_view]))
{
	$query[] = "re2_listings.MountainView = 'y' ";
}

if(!empty($_GET[ocean_waterfront]))
{
	$query[] = "re2_listings.OceanWaterfront = 'y' ";
}

if(!empty($_GET[lake_waterfront]))
{
	$query[] = "re2_listings.LakeWaterfront = 'y' ";
}

if(!empty($_GET[river_waterfront]))
{
	$query[] = "re2_listings.RiverWaterfront = 'y' ";
}

if(!empty($query))
{
	$MyQuery = implode(" and ", $query);

	$MyQuery = "and ".$MyQuery;
}


////////////////////////////////////////////////////////////
//////////		order by

$order = array();

if(!empty($_GET[orderby]))
{
	$MyOrder = explode("|", $_GET[orderby]);

	while(list(,$ov) = each($MyOrder))
	{
		if($ov == "DateAdded")
		{
			$order[] = " re2_listings.DateAdded desc ";
		}
		
		if($ov == "Price")
		{
			$order[] = " re2_listings.Price asc ";
		}
		
		if($ov == "address")
		{
			$order[] = " re2_listings.address asc ";
		}

	}
}
else
{
	if(!empty($_GET[p]))
	{
		$order[] = " re2_listings.Price asc ";
	}

	if(!empty($_GET[r]))
	{
		$order[] = " re2_listings.rooms asc, re2_listings.bathrooms asc, re2_listings.garage asc ";
	}

	if(!empty($_GET[city]))
	{
		$order[] = " re2_listings.city, re2_listings.address, re2_listings.state ";
	}

}


if(count($order) > '0')
{
	$MyOrder = implode(", ", $order);

}

if(empty($MyOrder))
{
	$MyOrder = " order by re2_agents.PriorityLevel desc, re2_listings.DateAdded desc";
}
else
{
	$MyOrder = " order by re2_agents.PriorityLevel desc, $MyOrder";
}


if(!empty($_GET[Start]))
{
	$Start = $_GET[Start];
}
else
{
	$Start = '0';
}

$ByPage = '4';

$q1 = "select * from re2_listings, re2_agents, re2_priority where re2_listings.AgentID = re2_agents.AgentID and re2_agents.PriorityLevel = re2_priority.PriorityLevel and re2_agents.AccountStatus = 'active' $MyQuery $MyOrder limit $Start, $ByPage ";

$qnav = "select * from re2_listings, re2_agents where re2_listings.AgentID = re2_agents.AgentID $MyQuery";

$r1 = mysql_query($q1) or die(mysql_error());
$lrows = mysql_num_rows($r1);

if($lrows > '0')
{
	$ListingTable .= "<table align=center width=530 cellspacing=0>\n";
	$ListingTable .= "<tr>\n<td width=75>&nbsp;</td>\n\t";
		
	$ListingTable .= "</tr>\n</table>\n\n";

	$ListingTable .= "<table align=center width=530 border=0 bordercolor=#336699 rules=rows cellspacing=0>\n";

	while($a1 = mysql_fetch_array($r1))
	{
		$ListingTable .= "<tr style=\"border-width:0; border-color:blue\" onMouseOver=\"this.style.background='#F4F4F4'; this.style.cursor='hand'\" onMouseOut=\"this.style.background='white'\" onClick=\"window.open('anuncio.php?id=$a1[ListingID]', '_top')\">\n\t";
		$ListingTable .= "<td height=60>";

		$ListingTable .= "<table align=center width=\"100%\">\n";
		

		$ListingTable .= "<tr>\n\t<td width=75>";

		if(!empty($a1[image]))
		{
			$images = explode("|", $a1[image]);
			$MyImage = $images[0];

			$ListingTable .= "<img src=\"fotos_anuncios/$MyImage\" width=75 height=60 border=1>";
		}
		else
		{
			$ListingTable .= "<img src=\"no_image.gif\" border=1>";
		}

		$ListingTable .= "</td>\n\t";

		$ListingTable .= "<td width=225 valign=top><b>Imóvel ID: $a1[ListingID]</b><br>$a1[city], $a1[state]<br>$a1[address], $a1[country]</td>\n\t";
		$ListingTable .= "<td width=100 valign=top>$a1[rooms] quarto(s), $a1[bathrooms] banheiro(s)";

		if($a1[garage] > '0')
		{
			$ListingTable .= ", $a1[garage] garagem(ns)";
		}

		$MyPrice = number_format($a1[Price], 2, ".", ",");

		$ListingTable .= "</td>\n\t<td align=center width=100 valign=top><b>R$$MyPrice</td>\n";

		$ListingTable .= "</tr>\n";

		$ListingTable .= "<tr>\n\t<td colspan=4>$a1[ShortDesc]</td>\n</tr>\n";

		$ListingTable .= "</table>\n\n</td>\n</tr>\n\n";

	}

	$ListingTable .= "</table>";

		$rnav = mysql_query($qnav) or die(mysql_error());
		$rows = mysql_num_rows($rnav);

			if($rows > $ByPage)
			{
				$ListingTable .=  "<br><table align=center width=580>";
				$ListingTable .= "<td align=center><font face=verdana size=2> | ";

				$pages = ceil($rows/$ByPage);

				for($i = 0; $i <= ($pages); $i++)
				{
					$PageStart = $ByPage*$i;
	
					$i2 = $i + 1;
	
					if($PageStart == $Start)
					{
						$links[] = " <span class=RedLink>$i2</span>\n\t ";
					}
					elseif($PageStart < $rows)
					{
						$links[] = " <a class=BlackLink href=\"buscador.php?Start=$PageStart&c=$_GET[c]&s=$_GET[s]&AgentID=$_GET[AgentID]&search_city=$_GET[search_city]&search_state=$_GET[search_state]&search_country=$_GET[search_country]&search_PropertyType=$_GET[search_PropertyType]&MinPrice=$_GET[MinPrice]&MaxPrice=$_GET[MaxPrice]&rooms1=$_GET[rooms1]&rooms2=$_GET[rooms2]&bath1=$_GET[bath1]&bath2=$_GET[bath2]&before=$_GET[before]&school=$_GET[school]&transit=$_GET[transit]&park=$_GET[park]&ocean_view=$_GET[ocean_view]&lake_view=$_GET[lake_view]&mountain_view=$_GET[mountain_view]&ocean_waterfront=$_GET[ocean_waterfront]&lake_waterfront=$_GET[lake_waterfront]&river_waterfront=$_GET[river_waterfront]&city=$_GET[city]&p=$_GET[p]&r=$_GET[r]\">$i2</a>\n\t ";	
					}
				}

				$links2 = implode(" | ", $links);
		
				$ListingTable .= $links2;

				$ListingTable .= "| </td>";

				$ListingTable .= "</table><br>\n";

			}
}
else
{
	$ListingTable = "<br><br><center>Nenhum anúncio encontrado!</center>";
}

require_once("templates/HeaderTemplate.php");
require_once("templates/SearchTemplate.php");	
require_once("templates/FooterTemplate.php");

?>