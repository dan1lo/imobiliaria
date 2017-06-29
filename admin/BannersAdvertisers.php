<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");
include_once("LeftStyles.php");
require_once("BannersNav.php");
?>

<br>

<?
//get the advertiseres list
$q1 = "select * from re2_agents order by AgentID ";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) > '0')
{
	?>
		<table align=center width=350 cellspacing=0>
		<tr class=TableHead>
			<td width=250>Nome</td>
			<td width=50 align=center>Banners</td>
			<td width=50 align=center>Cliques</td>
		</tr>

	<?

	$col = "white";

	while($a1 = mysql_fetch_array($r1))
	{
		if($col == "white")
		{
			$col = "#dddddd";
		}
		else
		{
			$col = "white";
		}

		//get the banners
		$q2 = "select BannerID from re2_banners where ClientID = '$a1[AgentID]' ";
		$r2 = mysql_query($q2) or die(mysql_error());
		$banners = mysql_num_rows($r2);
		$a2 = mysql_fetch_array($r2);

		if($banners > '0')
		{
			$mybanners = implode("', '", $a2);

			$mystr = "'$mybanners'";

			//get the clicks
			$q3 = "select count(*) from re2_stats where BannerID in ($mystr) ";
			$r3 = mysql_query($q3) or die(mysql_error());
			$a3 = mysql_fetch_array($r3);

			$clicks = $a3[0];
		}
		else
		{
			$clicks = '0';
		}

		echo "<tr bgcolor=$col>\n\t<td>$a1[FirstName] $a1[LastName]</td>\n\t<td align=center>$banners</td>\n\t<td align=center>$clicks</td>\n</tr>\n\n";

	}

	echo "</table>\n\n<br>";
}

?>