<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

if(isset($_POST[s1]) && !empty($_POST[NewCategory]))
{
	$q1 = "insert into re2_categories set CategoryName = '$_POST[NewCategory]' ";
	mysql_query($q1) or die("<br><center><font color=red face=verdana size=2><b>Dublicate Category name!</b></font><br><a class=RedLink href=\"CategoriesAdd.php\">go back</a></center><br>");

	header("location:categories.php");
	exit();
}

include_once("LeftStyles.php");

?>

<script>
	function CheckNewCategory() {

		if(document.f1.NewCategory.value=="")
		{
			window.alert('Digite o nome da nova categoria, por favor!');
			document.f1.NewCategory.focus();
			return false;
		}

	}

</script>

<br><br>
<form method=post onsubmit="return CheckNewCategory();" name=f1>

<table align=center>
<tr>
	<td colspan=2 align=center class=TableHead>Adicionar Categorias</td>
</tr>

<tr>
	<td>Nome da categoria:</td>
	<td><input type=text name=NewCategory size=35></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><input type=submit name=s1 value=Salvar class=sub></td>
</tr>

</table>

</form>