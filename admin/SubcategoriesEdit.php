<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

if(isset($_POST[s1]))
{
	$q1 = "update re2_subcategories set 
					SubcategoryName = '$_POST[NewSubName]' where SubcategoryID = '$_POST[SubcategoryID]' ";
	mysql_query($q1) or die(mysql_error());

	header("location:categories.php");
	exit();
}

include_once("LeftStyles.php");

//get the ubcategory info
$q1 = "select * from re2_subcategories where SubcategoryID = '$_GET[SubcategoryID]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);
?>

	<script>

		function CheckEditSubcategory() {

			if(document.f1.NewSubName.value=="")
			{
				window.alert('Enter the subcategory new name!');
				document.f1.NewSubName.focus();
				return false;
			}
		}

	</script>

	<br><br>
	<form method=post name=f1 onsubmit="return CheckEditSubcategory();">
	<table align=center>
	<tr>
		<td colspan=2 align=center class=TableHead>Editar Sub-categoria</td>
	</tr>

	<tr>
		<td>Categoria:</td>
		<td><?=$_GET[CategoryName]?></td>
	</tr>

	<tr>
		<td>Antigo nome da sub-categoria:</td>
		<td><?=$a1[SubcategoryName]?></td>
	</tr>

	<tr>
		<td>Novo nome da sub-categoria:</td>
		<td><input type=text name=NewSubName></td>
	</tr>

	<tr>
		<td>&nbsp;</td>
		<td>
			<input type=hidden name=SubcategoryID value="<?=$_GET[SubcategoryID]?>">
			<input type=submit name=s1 value="Salvar" class=sub>
		</td>
	</tr>

	</table>
	</form>

