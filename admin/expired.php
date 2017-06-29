<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");
include_once("LeftStyles.php");


?>

<br>
<center>
	<form method=get>
	Selecione a quantidade de dias para expirar: 

		<select name=days>
			<?
			for($i = '1'; $i <= '365'; $i++)
			{
				if($_GET[days] == $i)
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

		<input type=submit name=s1 value="Go!">

		</form>
</center>

<?

if(isset($_GET[s1]))
{
	$exp1 = mktime(0,0,0,date(m), date(d) + $_GET[days], date(Y));
	$exp2 = mktime(23,59,59,date(m), date(d) + $_GET[days], date(Y));
	$q1 = "select *, from_unixtime(DatePosted, '%b-%d-%Y') as dp, from_unixtime(DateExpired, '%b-%d-%Y') as de from coupons_listings where DateExpired between '$exp1' and '$exp2' ";
	$r1 = mysql_query($q1) or die(mysql_error());

	if(mysql_num_rows($r1) == '0')
	{
		echo "<br><br><center>Nada encontrado.</center>";
		exit();
	}

	?>
	<table align=center width=650 cellspacing=0>
	<tr style="background-color:#336699; font-family:verdana; font-size:11; font-weight:bold; color:white">
		<td width=450>Título e descrição</td>
		<td width=100 align=center>Cadastrado em</td>
		<td width=100 align=center>Expira dia</td>
	</tr>

	<?
	$col = "white";

	while($a1 = mysql_fetch_array($r1))
	{
		if($col == "white")
		{
			$col = "dddddd";
		}
		else
		{
			$col = "white";
		}

		if($a1[PriorityLevel] == '5')
		{
			$pri = "<sup><font color=\"#000099\" size=2 face=verdana>$a1[PriorityName]</font></sup>";
		}
		else
		{
			$pri = "";
		}

		$desc = substr($a1[Description], 0, 30);

		echo "<tr bgcolor=$col>\n\t<td><a class=BlackLink href=\"view.php?BusinessID=$a1[BusinessID]\">$a1[Title]</a> $pri - $desc</td>\n\t<td align=center>$a1[dp]</td>\n\t<td align=center>$a1[de]</td>\n</tr>\n ";
	}
	
	echo "</table>\n\n";
}
?>