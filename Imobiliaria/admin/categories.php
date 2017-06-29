<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

//get the categories
$q1 = "select * from re2_categories order by CategoryName";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) == '0')
{
	echo "<br><center><font color=red face=verdana size=2><b>Não existem categorias!</b></font>";
	exit();
}

include_once("LeftStyles.php");

?>

<script>
	function ConfirmDeleteCategory(CategoryName) {

		if(confirm('Você tem certeza que deseja deletar a categoria ' + CategoryName + '?'))
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	function ConfirmDeleteSubcategory(SubcategoryName) {

		if(confirm('Você tem certeza que deseja deletar a sub-categoria ' + SubcategoryName + '?'))
		{
			return true;
		}
		else
		{
			return false;
		}

	}
</script>

<br><br>
<table align=center width=450 cellspacing=0 cellpadding=0>
<tr>
	<td width=300 class=TableHead>Categorias e Sub-categorias</td>
	<td align=center width=50 class=TableHead>Anúncios</td>
	<td align=center width=100 class=TableHead>Controle</td>
</tr>


<?

	while($a1 = mysql_fetch_array($r1))
	{
		echo "<tr>\n\t<td width=300>$a1[CategoryName]</td>\n\t";

		//get the category listings
		$q2 = "select count(*) from re2_listings where CategoryID = '$a1[CategoryID]' ";
		$r2 = mysql_query($q2) or die(mysql_error());
		$a2 = mysql_fetch_array($r2);

		echo "<td align=center width=50>$a2[0]</td>\n\t<td align=center width=150><a class=GreenLink href=\"CategoriesEdit.php?CategoryID=$a1[CategoryID]\">Editar</a> | <a class=RedLink href=\"CategoriesDelete.php?CategoryID=$a1[CategoryID]&n=$a2[0]\" onclick=\"return ConfirmDeleteCategory('$a1[CategoryName]');\">Deletar</a></td>\n</tr>\n";

		//get the subcategories
		$q3 = "select * from re2_subcategories where CategoryID = '$a1[CategoryID]' order by SubcategoryName ";
		$r3 = mysql_query($q3) or die(mysql_error());
		
		if(mysql_num_rows($r3) > '0')
		{
			while($a3 = mysql_fetch_array($r3))
			{
				echo "<tr>\n\t<td style=\"padding-left:20\" width=300>$a3[SubcategoryName]</td>";

				//get the subcategory listings
				$q4 = "select count(*) from re2_listings where SubcategoryID = '$a3[SubcategoryID]' ";
				$r4 = mysql_query($q4) or die(mysql_error());
				$a4 = mysql_fetch_array($r4);

				echo "<td align=center width=50>$a4[0]</td>\n\t";
				echo "<td align=center width=150><a class=GreenLink href=\"SubcategoriesEdit.php?SubcategoryID=$a3[SubcategoryID]&CategoryName=$a1[CategoryName]\">Editar</a> | <a class=RedLink href=\"SubcategoriesDelete.php?SubcategoryID=$a3[SubcategoryID]&n=$a4[0]\" onclick=\"return ConfirmDeleteSubcategory('$a3[SubcategoryName]');\">Deletar</a></td>\n</tr>\n";
			}

		}

		echo "<tr>\n\t<td colspan=3><hr size=2 color=black width=450></td>\n</tr>\n";
	}

	echo "</table>\n\n<br><br>";
?>