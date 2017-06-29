<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

include_once("LeftStyles.php");


//get the unapproved users list
$q1 = "select * from re2_agents where AccountStatus = 'pending'  order by RegDate desc ";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) == '0')
{
	echo "<br><br><center><font color=red size=2 face=verdana><b>Não existem agentes pendentes no momento</b></font></center>";
	exit();
}

?>

<br>

<table align=center width=300 cellspacing=0>
<caption align=center><b>Agentes com contas pendentes</b></caption>
<tr>
	<td class=TableHead width=200>Nome</td>
	<td class=TableHead width=100 align=center>Data de cadastro</td>
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

	$MyDate = date('d M Y', $a1[RegDate]);
	

	echo "<tr bgcolor=$col>\n\t<td><a class=BlackLink href=\"ViewUser.php?AgentID=$a1[AgentID]\">$a1[FirstName] $a1[LastName]</a></td>\n\t<td align=center>$MyDate</td>\n</tr>\n";
}

echo "</table>\n\n<br><br>\n\n";

?>