<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

include_once("LeftStyles.php");

?>

<script>
	function CheckNewPrice() {

		if(document.f1.NewPackageName.value=="")
		{
			window.alert('Digite o novo nome do pacote, por favor!');
			document.f1.NewPackageName.focus();
			return false;
		}

		if(document.f1.NewPrice.value=="")
		{
			window.alert('Digite o novo preço do pacote, por favor!');
			document.f1.NewPrice.focus();
			return false;
		}

		if(document.f1.NewDuration.value=="")
		{
			window.alert('Escolha a nova duração do pacote, por favor!!');
			document.f1.NewDuration.focus();
			return false;
		}

		if(document.f1.NewLevel.value=="")
		{
			window.alert('Escolha o novo nível de prioridade, por favor!');
			document.f1.NewLevel.focus();
			return false;
		}

		if(document.f1.NewQty.value=="")
		{
			window.alert('Digite o quandidade de anúncios, por favor!');
			document.f1.NewQty.focus();
			return false;
		}

	}

	function CheckDelete() {

		if(confirm('Você tem certeza que deseja deletar este pacote?'))
		{
			return true;
		}
		else
		{
			return false;
		}

	}

</script>

<form method=post name=f1 onsubmit="return CheckNewPrice()">

<table align=center>
<tr>
	<td colspan=2 align=center class=TableHead>Criar novo pacote</td>
</tr>

<tr>
  <td>Nome do pacote:</td>
	<td><input type=text name=PackageName maxlength=50></td>
</tr>


<tr>
  <td>Pre&ccedil;o:</td>
	<td><input type=text name=NewPrice size=6 maxlength=6></td>
</tr>

<tr>
  <td>Dura&ccedil;&atilde;o:</td>
	<td>
		<select name=nDuration>
			<option value=""></option>
			<?
			for($i = '1'; $i <= '12'; $i++)
			{
				echo "<option value=\"$i\">$i</option>\n";
			}
			?>
		</select> meses
	</td>
</tr>

<tr>
  <td>N&iacute;vel de prioridade:</td>
	<td>
		<select name="pLevel">
			<option value=""></option>
			<?
			//create the Priority level select menu
			$q1 = "select * from re2_priority order by PriorityLevel asc ";
			$r1 = mysql_query($q1) or die(mysql_error());
			while($a1 = mysql_fetch_array($r1))
			{
				echo "<option value=\"$a1[PriorityLevel]\">$a1[PriorityLevel] - $a1[PriorityName]</option>\n\t";
			}
			?>
		</select>	
	</td>
</tr>
<tr>
  <td>Tipo de pre&ccedil;o:</td>
  <td><select name="pType" id="pType">
      <option value="Imob." selected>Imobili&aacute;ria</option>
      <option value="Privado">Agente Privado</option>
  </select></td>
</tr>

<tr>
  <td>Quantidade de an&uacute;ncios:</td>
	<td><input type=text name=cQty size=6></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><input type=submit name=s1 value=Salvar class=sub></td>
</tr>

</table>

</form>

<?

if(isset($_POST[s1]))
{
	$q1 = "insert into re2_prices set
					PackageName = '$_POST[PackageName]',
					PriceValue = '$_POST[NewPrice]',
					Duration = '$_POST[nDuration]',
					PriorityLevel = '$_POST[pLevel]',
					PriceType = '$_POST[pType]',
					offers = '$_POST[cQty]' ";
	mysql_query($q1) or die(mysql_error());
}

//show prices
$q1 = "select * from re2_prices, re2_priority where re2_prices.PriorityLevel = re2_priority.PriorityLevel order by re2_prices.PriorityLevel desc";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) == '0')
{
	exit();
}

?>

<table align=center width=650 cellspacing=0 bordercolor=black frame=below>
<tr>
	<td  class=TableHead width=200>Nome do pacote</td>
	<td class=TableHead>Nível de prioridade</td>
	<td class=TableHead align=center>Duração</td>
	
	<td class=TableHead align=right>Anúncios</td>
	<td class=TableHead align=right>Preço</td>
	<td class=TableHead align=right>Tipo de preço</td>
	<td class=TableHead align=right>Controle</td>

<?
while($a1 = mysql_fetch_array($r1))
{
	$MyPrice = number_format($a1[PriceValue], 2, ".", "");

	if($a1[Duration] > '1')
	{
		$MyDuration = $a1[Duration]." meses";
	}
	else
	{
		$MyDuration = $a1[Duration]." mês";
	}

	echo "<tr>\n\t<td>$a1[PackageName]</td>\n\t<td>$a1[PriorityName]</td>\n\t<td align=center>$MyDuration</td>\n\t<td align=right>$a1[offers]</td>\n\t<td align=right>$MyPrice</td>\n\t<td align=center><a class=GreenLink href=\"PriceEdit.php?PriceID=$a1[PriceID]\">editar</a> | <a class=RedLink href=\"PriceDelete.php?PriceID=$a1[PriceID]\" onclick=\"return CheckDelete();\">deletar</a></td>\n</tr>\n\n ";
}

echo "</table>\n\n<br><br>";
?>