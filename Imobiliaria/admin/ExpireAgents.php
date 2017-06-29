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

		<input type=submit name=s1 value="Enviar!">

		</form>
</center>


<?

if(isset($_GET[s1]))
{
	$exp1 = mktime(0,0,0,date(m), date(d) + $_GET[days], date(Y));
	$exp2 = mktime(23,59,59,date(m), date(d) + $_GET[days], date(Y));
	$q1 = "select *, from_unixtime(RegDate, '%b-%d-%Y') as dp, from_unixtime(ExpDate, '%b-%d-%Y') as de from re2_agents where ExpDate between '$exp1' and '$exp2' ";
	$r1 = mysql_query($q1) or die(mysql_error());

	if(mysql_num_rows($r1) == '0')
	{
		echo "<br><br><center>Nada encontrado.</center>";
		exit();
	}

	?>
	<table align=center width=450 cellspacing=0>
	<tr style="background-color:#336699; font-family:verdana; font-size:11; font-weight:bold; color:white">
		<td width=250>Nomes</td>
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

		echo "<tr bgcolor=$col>\n\t<td><a class=BlackLink href=\"ViewUser.php?AgentID=$a1[AgentID]\">$a1[FirstName] $a1[LastName]</a></td>\n\t<td align=center>$a1[dp]</td>\n\t<td align=center>$a1[de]</td>\n</tr>\n ";
	}
	
	echo "</table>\n\n";
}
?>