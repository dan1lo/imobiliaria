<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

if(isset($_POST[s1]))
{
	$np2 = trim($_POST[np]);

	if(!empty($np2))
	{
		$q1 = "update re2_types set TypeName = '$np2' where TypeID = '$_GET[id]' ";
		mysql_query($q1);

		if(mysql_error())
		{
			echo "<center><font color=red face=verdana size=2><b>The property type <font color=black>$np2</font> already exists!</font><br>";
		}
		else
		{
			header("location:ptypes.php");
			exit();
		}
	}
}

include_once("LeftStyles.php");

//get the Property Type info
$q1 = "select * from re2_types where TypeID = '$_GET[id]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);


?>

<br><br>

<script>

function NewType() {

	if(document.f1.np.value=="")
	{
		alert('Digite o novo tipo de propriedade, por favor!!');
		document.f1.np.focus();
		return false;
	}

}

</script>

<form method=post onsubmit="return NewType();" name=f1>
<table align=center width=350>
<tr>
	<td>Novo tipo de propriedade:</td>
	<td><input type=text name=np value="<?=$a1[TypeName]?>"></td>
	<td><input type=submit name=s1 value="Enviar"></td>
</tr>

</table>
</form>

