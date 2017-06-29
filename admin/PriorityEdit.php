<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

include_once("LeftStyles.php");

if(isset($_POST[s1]))
{
	$q1 = "update re2_priority set 
					PriorityName = '$_POST[NewName]',
					PriorityLevel = '$_POST[NewLevel]'
					
					where PriorityID = '$_POST[PriorityID]' ";

	mysql_query($q1) or die("<br><center><font face=verdana color=red size=2><b>Nome ou nível de prioridade já existentes!</b></font><br><a href=\"PriorityEdit.php?PriorityID=$_POST[PriorityID]\" class=RedLink>Voltar</a></center><br>");

}

//get the current values
$q1 = "select * from re2_priority where PriorityID = '$_GET[PriorityID]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

?>

	<script>
		function CheckEditPriority() {

			if(document.f1.NewName.value=="")
			{
				window.alert('Digite o nome da prioridade!');
				document.f1.NewName.focus();
				return false;
			}

			if(document.f1.NewLevel.value=="")
			{
				window.alert('Selecione o valor da prioridade!');
				document.f1.NewLevel.focus();
				return false;
			}

		}


	</script>

	<form method=post name=f1 onsubmit="return CheckEditPriority();">

	<table align=center>
	<tr>
		<td colspan=2 class=TableHead align=center>Editar n&iacute;vel de prioridade</td>
	</tr>

	<tr>
	  <td>Antigo nome do n&iacute;vel de prioridade:</td>
		<td><?=$a1[PriorityName]?></td>
	</tr>

	<tr>
	  <td>Novo nome:</td>
		<td><input type=text name=NewName value="<?=$a1[PriorityName]?>"></td>
	</tr>

	<tr>
	  <td>Antigo valor do n&iacute;vel de prioridade:</td>
		<td><?=$a1[PriorityLevel]?></td>
	</tr>

	<tr>
	  <td>Novo valor:</td>
		<td>
			<select name=NewLevel>
				<option value=""></option>
				<?

				for($y = '1'; $y <= '5'; $y++)
				{
					if($a1[PriorityLevel] == $y)
					{
						echo "<option value=\"$y\" selected>$y</option>";	
					}
					else
					{
						echo "<option value=\"$y\">$y</option>";	
					}
				}

				?>
			</select>
		</td>
	</tr>

	<tr>
		<td>&nbsp;</td>
		<td>
			<input type=hidden name=PriorityID value="<?=$_GET[PriorityID]?>">
			<input type=submit name=s1 value=Salvar class=sub>
		</td>
	</tr>

	</table>

	</form>
