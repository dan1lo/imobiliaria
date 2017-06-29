<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

if(isset($_POST[s1]))
{
	$q1 = "insert into re2_subcategories set 
					CategoryID = '$_POST[CategoriesList]',
					SubcategoryName = '$_POST[SubName]' ";
	mysql_query($q1) or die(mysql_error());

	header("location:categories.php");
	exit();
}

include_once("LeftStyles.php");

//first we need to select a category

//get the categories
$q1 = "select * from re2_categories order by CategoryName";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) == '0')
{
	echo "<br><center><font color=red face=verdana size=2><b>Não existem categorias!</b></font>";
	exit();
}
else
{
	$SelectCategory = "<select name=CategoriesList>\n\t<option value=\"\"></option>\n\t";
	while($a1 = mysql_fetch_array($r1))
	{
		$SelectCategory .= "<option value=\"$a1[CategoryID]\">$a1[CategoryName]</option>\n\t";
	}
	$SelectCategory .= "</select>";

	?>

	<script>

		function CheckNewSubcategory() {

			if(document.f1.CategoriesList.value=="")
			{
				window.alert('Select a category!');
				document.f1.CategoriesList.focus();
				return false;
			}

			if(document.f1.SubName.value=="")
			{
				window.alert('Enter the subcategory name!');
				document.f1.SubName.focus();
				return false;
			}
		}

	</script>

	<br><br>
	<form method=post name=f1 onsubmit="return CheckNewSubcategory();">
	<table align=center>
	<tr>
		<td colspan=2 align=center class=TableHead>Adicionar uma sub-categoria</td>
	</tr>

	<tr>
		<td>Selecione a categoria:</td>
		<td><?=$SelectCategory?></td>
	</tr>

	<tr>
		<td>Nome da sub-categoria:</td>
		<td><input type=text name=SubName></td>
	</tr>

	<tr>
		<td>&nbsp;</td>
		<td><input type=submit name=s1 value="Salvar" class=sub></td>
	</tr>

	</table>
	</form>

	<?
}
?>