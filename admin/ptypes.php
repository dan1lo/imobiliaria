<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");
include_once("LeftStyles.php");

$np2 = trim($_POST[np]);

if(!empty($np2))
{
	
	$q1 = "insert into re2_types set TypeName = '$np2' ";
	mysql_query($q1);

	if(mysql_error())
	{
		echo "<center><font color=red face=verdana size=2><b>O tipo de propriedade <font color=black>$np2</font> já existe!</font><br>";
	}
}

?>

<br><br>

<script>

function NewType() {

	if(document.f1.np.value=="")
	{
		alert('Digite a nova propriedade!');
		document.f1.np.focus();
		return false;
	}

}

</script>

<form method=post onsubmit="return NewType();" name=f1>
<table align=center width=350>
<tr>
	<td>Novo tipo de propriedade:</td>
	<td><input type=text name=np></td>
	<td><input type=submit name=s1 value="Salvar"></td>
</tr>

</table>
</form>

<br><br>

<?
//get the property types from the database
$q1 = "select * from re2_types order by TypeName";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) == '0')
{
	exit();
}

?>


<table align=center width=300 cellspacing=0 cellpadding=0>
<caption align=center>Tipos de propriedades</caption>
<tr>
	<td width=200 class=TableHead>Tipo de propriedade</td>
	<td width=100 class=TableHead align=center>Controle</td>
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

	echo "<tr bgcolor=$col>\n\t<td><b>$a1[TypeName]</b></td>\n\t<td align=center><a href=\"edit_type.php?id=$a1[TypeID]\" class=GreenLink>editar</a> | <a href=\"delete_type.php?id=$a1[TypeID]\" class=RedLink>deletar</a></td>\n</tr>\n\n";
}

echo "</table>";

?>