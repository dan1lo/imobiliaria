<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

if(isset($_POST[s1]) && !empty($_POST[NewCategory]))
{
	$q1 = "update re2_categories set CategoryName = '$_POST[NewCategory]' where CategoryID = '$_POST[CategoryID]' ";
	mysql_query($q1) or die("<br><center><font color=red face=verdana size=2><b>Dublicate Category name!</b></font><br><a class=RedLink href=\"CategoriesEdit.php?CategoryID=$_POST[CategoryID]\">go back</a></center><br>");

	header("location:categories.php");
	exit();
}

include_once("LeftStyles.php");

//get the category info
$q1 = "select * from re2_categories where CategoryID = '$_GET[CategoryID]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

?>

<script>
	function CheckEditCategory() {

		if(document.f1.NewCategory.value=="")
		{
			window.alert('Digite o novo nome da categoria, por favor!');
			document.f1.NewCategory.focus();
			return false;
		}

	}

</script>

<br><br>
<form method=post onsubmit="return CheckEditCategory();" name=f1>

<table align=center>
<tr>
	<td colspan=2 align=center class=TableHead>Editar Categoria</td>
</tr>

<tr>
	<td>Antigo nome da categoria:</td>
	<td><?=$a1[CategoryName]?></td>
</tr>

<tr>
	<td>Novo nome da categoria:</td>
	<td><input type=text name=NewCategory size=35></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td>
		<input type=hidden name=CategoryID value="<?=$_GET[CategoryID]?>">
		<input type=submit name=s1 value=Salvar class=sub>
	</td>
</tr>

</table>

</form>