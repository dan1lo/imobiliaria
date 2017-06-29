<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

include_once("LeftStyles.php");

if(isset($_POST[s1]))
{
	$q1 = "update re2_prices set 
					PackageName = '$_POST[NewPackageName]',
					PriceValue = '$_POST[NewPrice]',
					Duration = '$_POST[NewDuration]',
					PriorityLevel = '$_POST[NewLevel]',
					PriceType = '$_POST[NewType]',
					offers = '$_POST[NewQty]'

					where PriceID = '$_POST[PriceID]' ";	
	mysql_query($q1) or die(mysql_error());
}


//get the price info
$q1 = "select * from re2_prices, re2_priority where re2_prices.PriceID = '$_GET[PriceID]' and re2_prices.PriorityLevel = re2_priority.PriorityLevel ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);
?>

<script>
	function CheckEditPrice() {

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


</script>

<form method=post name=f1 onsubmit="return CheckEditPrice()">


<table align=center>
<tr>
  <td colspan=2 align=center class=TableHead>Pre&ccedil;o antigo </td>
  <td colspan=2 align=center class=TableHead>Informe o novo pre&ccedil;o </td>
	</tr>

<tr>
  <td align=right><span class="TableHead">Nome antigo</span>:</td>
	<td><?=$a1[PackageName]?></td>

	<td align=right>Novo Nome:</td>
	<td><input name=NewPackageName type=text value=" <?=$a1[PackageName]?>" maxlength=50></td>
</tr>

<tr>
  <td align=right><span class="TableHead">Pre&ccedil;o antigo</span>:</td>
	<td><?=$a1[PriceValue]?></td>

	<td align=right>Novo Pre&ccedil;o:</td>
	<td><input type=text value=" <?=$a1[PriceValue]?>" name=NewPrice size=6 maxlength=6 ></td>
</tr>

<tr>
  <td align=right><span class="TableHead">Antiga dura&ccedil;&atilde;o</span>:</td>
	<td>
	<?
	if($a1[Duration] > '1')
	{
		$MyDuration = $a1[Duration]." meses";
	}
	else
	{
		$MyDuration = $a1[Duration]." mês";
	}

	echo $MyDuration;

	?>
	
	</td>

	<td align=right>Nova Dura&ccedil;&atilde;o:</td>
	<td>
      <select name=NewDuration>
        <option value="1"></option>
        <?
			for($i = '1'; $i <= '12'; $i++)
			{
				echo "<option value=\"$i\">$i</option>\n";
			}
			?>
      </select>
  meses </td>
</tr>


<tr>
  <td align=right><span class="TableHead">Antiga Prioridade</span>:</td>
	<td><?=$a1[PriorityName]?></td>

	<td align=right>Nova Prioridade:</td>
	<td>
		<select name="NewLevel">
			<option value=""></option>
	<?
	$qp = "select * from re2_priority order by PriorityLevel asc";
	$rp = mysql_query($qp) or die(mysql_error());

	while($ap = mysql_fetch_array($rp))
	{
		echo "<option value=\"$ap[PriorityLevel]\">$ap[PriorityLevel] - $ap[PriorityName]</option>\n\t";
	}


	?>
		</select>
	</td>
	
	</td>
</tr>


<tr>
  <td align=right><span class="TableHead">Antigo tipo de pre&ccedil;o</span>:</td>
  <td>
    <?=$a1[PriceType]?>
  </td>
  <td align=right>Novo tipo de pre&ccedil;o:</td>
  <td><select name="NewType" id="NewType">
      <option value="Imob." selected>Imobili&aacute;ria</option>
      <option value="Privado">Agente Privado</option>
  </select></td>
  </tr>
<tr>
  <td align=right><span class="TableHead">Antiga quantidade de an&uacute;ncios</span>:</td>
	<td><?=$a1[offers]?></td>

	<td align=right>Nova quantidade de an&uacute;ncios:</td>
	<td><input type=text name=NewQty size=6 value=<?=$a1[offers]?>></td>
</tr>


<tr>
	<td colspan=4 align=center>
		<input type=hidden name=PriceID value="<?=$_GET[PriceID]?>">
		<input type=submit name=s1 value=Salvar class=sub>
	</td>
</tr>

</table>

</form>

<br><br>

<center>
	<a class=RedLink href="SettingsPrices.php">Voltar</a>
</center>