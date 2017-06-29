<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

if(isset($_POST[s1]))
{
	if(!empty($_POST[price]))
	{
		$PriceInfo = explode("|", $_POST[price]);

		$ExpDate = mktime(0,0,0,date(m) + $PriceInfo[0],date(d),date(Y));
		$PriorityLevel = $PriceInfo[1];
		$offers = $PriceInfo[2];		
	}
	else
	{
		$PriceInfo = explode("|", $_POST[xPrice]);
		
		$ExpDate = mktime(0,0,0,$_POST[emonth], $_POST[eday], $_POST[eyear]);
		$PriorityLevel = $PriceInfo[0];
		$offers = $PriceInfo[1];
	}

	
	$NewLogo = $_FILES[LogoImage][name];

	if(!empty($NewLogo))
	{
		$NewLogoName = $t."_".$NewLogo;
		copy($_FILES[LogoImage][tmp_name], "../fotos_anuncios/".$NewLogoName);
	}
	else
	{
		$NewLogoName = $_POST[OldLogo];
	}

	if(!empty($_FILES[rim][name][0]))
	{
		while(list($key,$value) = each($_FILES[rim][name]))
		{
			if(!empty($value))
			{
				$NewImageName = $t."_".$value;
				copy($_FILES[rim][tmp_name][$key], "../fotos_anuncios/".$NewImageName);

				$MyImages[] = $NewImageName;
			}
		}

		if(!empty($MyImages))
		{
			$ImageStr = implode("|", $MyImages);
		}

		if(!empty($_POST[OldResumeImages]))
		{
			$ResumeImages = $_POST[OldResumeImages]."|".$ImageStr;
		}
		else
		{
			$ResumeImages = $ImageStr;
		}
	}
	else
	{
		$ResumeImages = $_POST[OldResumeImages];
	}

	if(!empty($_POST[NewPassword]))
	{
		$password = "password = '$_POST[NewPassword]', ";
	}
	else
	{
		$password = "";
	}

	$q1 = "update re2_agents set 
					$password 
					FirstName = '$_POST[FirstName]',
					LastName = '$_POST[LastName]',
					resume = '$_POST[resume]',
					phone = '$_POST[Phone]',
					cellular = '$_POST[cellular]',				
					pager = '$_POST[pager]',
					ResumeImages = '$ResumeImages',
					email = '$_POST[Email]',
					logo = '$NewLogoName',
					ExpDate = '$ExpDate',
					PriorityLevel = '$PriorityLevel',
					offers = '$offers',
					news = '$_POST[updates]'
					
					where AgentID = '$_GET[AgentID]' ";


		mysql_query($q1);

		header("location:ViewUser.php?AgentID=$_GET[AgentID]");
		exit();
}

include_once("LeftStyles.php");


//get the info
$q1 = "select * from re2_agents where AgentID = '$_GET[AgentID]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);
?>

<script>
		function CheckRegister() {

			if(document.RegForm.NewPassword.value != "" && document.RegForm.NewPassword.value != "" && document.RegForm.NewPassword.value != document.RegForm.NewPassword2.value)
			{
				window.alert('Digite e confirme sua senha novamente!');
				document.RegForm.NewPassword.value="";
				document.RegForm.NewPassword2.value="";
				document.RegForm.NewPassword.focus();
				return false;
			}

			if(document.RegForm.FirstName.value=="")
			{
				window.alert('Digite seu nome, por favor!');
				document.RegForm.FirstName.focus();
				return false;
			}

			if(document.RegForm.LastName.value=="")
			{
				window.alert('Digite seu sobrenome, por favor!');
				document.RegForm.LastName.focus();
				return false;
			}

			if(document.RegForm.Email.value=="")
			{
				window.alert('Digite seu endereço de e-mail, por favor!');
				document.RegForm.Email.focus();
				return false;
			}

			if(document.RegForm.Phone.value=="")
			{
				window.alert('Digite seu telefone, por favor!');
				document.RegForm.Phone.focus();
				return false;
			}


		}
</script>

<form method="post" onsubmit="return CheckRegister();" name="RegForm" enctype="multipart/form-data">
<table align=center>
<caption align=center><font face=verdana size=2><b>Editar usuário</b></font><br><?=$RegisterError?></caption>
<tr>
  <td>Nome de usu&aacute;rio:</td>
	<td><?=$a1[username]?></td>
</tr>

<tr>
  <td>Nova Senha:</td>
	<td><input type=password name=NewPassword></td>
</tr>

<tr>
  <td>Confirmar senha:</td>
	<td><input type=password name=NewPassword2></td>
</tr>

<tr>
  <td>Nome:</td>
	<td><input type=text name=FirstName value="<?=$a1[FirstName]?>"></td>
</tr>

<tr>
  <td>Sobrenome:</td>
	<td><input type=text name=LastName value="<?=$a1[LastName]?>"></td>
</tr>

<tr>
  <td valign=top>Logotipo:</td>
	<td>
		<?
		if(!empty($a1[logo]))
		{
			echo "<center><img src=\"../fotos_anuncios/$a1[logo]\"><br><a class=RedLink href=\"DeleteLogo.php?id=$a1[AgentID]&file=$a1[logo]\">Deletar este logotipo</a></center>";

			echo "<input type=hidden name=OldLogo value=\"$a1[logo]\">";
		}
		else
		{
			echo "<input type=file name=\"LogoImage\" size=35>";
		}
		?>
		
	</td>
</tr>

<tr>
  <td valign=top>Informa&ccedil;&otilde;es:</td>
	<td><textarea cols=45 rows=6 name=resume><?=$a1[resume]?></textarea></td>
</tr>

<tr>
  <td>Endere&ccedil;o de e-mail:</td>
	<td><input type=text name=Email value="<?=$a1[email]?>"></td>
</tr>

<tr>
  <td>Telefone:</td>
	<td><input type=text name=Phone value="<?=$a1[phone]?>"></td>
</tr>

<tr>
  <td>Celular:</td>
	<td><input type=text name=cellular value="<?=$a1[cellular]?>"></td>
</tr>

<tr>
  <td>Pager:</td>
	<td><input type=text name=pager value="<?=$a1[pager]?>"></td>
</tr>

<tr>
  <td valign=top>Fotos:</td>
	<td><center>
		<?
		if(!empty($a1[ResumeImages]))
		{
			echo "<input type=hidden name=OldResumeImages value=\"$a1[ResumeImages]\">\n\n";
			$OldImages = explode("|", $a1[ResumeImages]);

			while(list(,$v2) = each($OldImages))
			{
				echo "<img src=\"../fotos_anuncios/$v2\"><br><a class=RedLink href=\"DeleteImage.php?id=$a1[AgentID]&file=$v2\">Deletar esta foto</a><br><br>\n\t";

				$i++;
			}

			if($i < '5')
			{
				for($p = '1'; $p <= (5 - $i); $p++)
				{
					echo "<input type=file name=\"rim[]\" size=35><br>\n\t";
				}

			}

		}
		else
		{
		?>
		<input type=file name="rim[]" size=35><br>		
		<input type=file name="rim[]" size=35><br>
		<input type=file name="rim[]" size=35><br>
		<input type=file name="rim[]" size=35><br>
		<input type=file name="rim[]" size=35><br>
		<?
		}
		?>
	</td>
</tr>

<tr>
  <td>Receber newsletter?</td>
	<td>
		<select name=updates>
			<option value="y" <? if($a1[news] == "y") { echo "selected"; } ?>>Sim</option>
			<option value="n" <? if($a1[news] == "n") { echo "selected"; } ?>>Não</option>
		</select>	
	</td>
</tr>

<tr>
  <td>N&iacute;vel atual do pacote :</td>
	<td>
	<?

	if($a1[PriorityLevel] == '0')
	{
		echo "normal";
	}
	else
	{
		echo "premium";
	}

	echo ", $a1[offers] anúncios";
	?>
	</td>
</tr>

<tr>
  <td>Expira Dia:</td>
	<td>
		<? //date('d/M/Y', $a1[ExpDate])?>
		<select name=eday>
			<?
			for($i = '1'; $i <= '31'; $i++)
			{
				if($i == date('d', $a1[ExpDate]))
				{
					echo "<option value=\"$i\" selected>$i</option>\n\t";
				}
				else
				{
					echo "<option value=\"$i\">$i</option>\n\t";
				}
			}
			?>
		</select>
			
			&nbsp;&nbsp;

		<select name=emonth>
			<?
			for($i = '1'; $i <= '12'; $i++)
			{
				$m = date('M', mktime(0,0,0,$i,date(d),date(Y)));
				if($i == date('m', $a1[ExpDate]))
				{
					echo "<option value=\"$i\" selected>$m</option>\n\t";
				}
				else
				{
					echo "<option value=\"$i\">$m</option>\n\t";
				}
			}
			?>
		</select>

			&nbsp;&nbsp;

		<select name=eyear>
			<?
			for($i = date(Y); $i <= (date(Y) + 3); $i++)
			{
				if($i == date('Y', $a1[ExpDate]))
				{
					echo "<option value=\"$i\" selected>$i</option>\n\t";
				}
				else
				{
					echo "<option value=\"$i\">$i</option>\n\t";
				}
			}
			?>
		</select>




		<input type=hidden name=xPrice value="<?=$a1[PriorityLevel]?>|<?=$a1[offers]?>">
	</td>
</tr>

<tr>
  <td>Novo n&iacute;vel do pacote:</td>
	<td>
	<?
	//get the prices
	$q2 = "select * from re2_prices order by PackageName";
	$r2 = mysql_query($q2) or die(mysql_error());

	echo "<select name=price>\n\t<option value=\"\"></option>\n\t";

	while($a2 = mysql_fetch_array($r2))
	{
		if($a2[PriorityLevel] == '0')
		{
			$MyPriority = "normal";
		}
		else
		{
			$MyPriority = "premium";
		}

		echo "<option value=\"$a2[Duration]|$a2[PriorityLevel]|$a2[offers]\">$a2[PackageName] ($a2[Duration] meses, $MyPriority, $a2[offers] anúncios)</option>\n\t";
	}

	echo "</select>";
	?>
	</td>
</tr>

<tr>
	<td colspan=2 align=center>
		<input type=submit name=s1 value="Salvar">
	</td>
</tr>

</table>
</form>