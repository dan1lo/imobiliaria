<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

//get the prices
$q2 = "select * from re2_prices, re2_priority where re2_prices.PriorityLevel = re2_priority.PriorityID order by re2_prices.PackageName";
$r2 = mysql_query($q2) or die(mysql_error());

if(mysql_num_rows($r2) == '0')
{
	echo "<br><br><font face=verdana color=red size=2><b>Você tem que configurar os preços primeiro!</b></font></center>";
	exit();
}

$sprices = "<select name=price>\n";

while($a2 = mysql_fetch_array($r2))
{
	$sprices .= "<option value=\"$a2[Duration]|$a2[PriorityLevel]|$a2[offers]\">$a2[PackageName] ($a2[Duration] meses, $a2[PriorityName], $a2[offers] anúncios)</option>\n\t";
}

$sprices .= "</select>";

if(isset($_POST[s1]))
{

	$PriceInfo = explode("|", $_POST[price]);

	$ExpDate = mktime(0,0,0,date(m) + $PriceInfo[0],date(d), date(Y));

	$NewLogo = $_FILES[LogoImage][name];

	if(!empty($NewLogo))
	{
		$NewLogoName = $t."_".$NewLogo;
		copy($_FILES[LogoImage][tmp_name], "../fotos_anuncios/".$NewLogoName);
	}

	if(!empty($_FILES[rim]))
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
	}	

	$q1 = "insert into re2_agents set 
					username = '$_POST[NewUsername]',
					password = '$_POST[NewPassword]',
					FirstName = '$_POST[FirstName]',
					LastName = '$_POST[LastName]',
					resume = '$_POST[resume]',
					phone = '$_POST[Phone]',
					cellular = '$_POST[cellular]',				
					pager = '$_POST[pager]',
					ResumeImages = '$ImageStr',
					email = '$_POST[Email]',
					logo = '$NewLogoName',
					RegDate = '$t',
					ExpDate = '$ExpDate',
					AccountStatus = 'active',
					PriorityLevel = '$PriceInfo[1]',
					offers = '$PriceInfo[2]',
					news = '$_POST[updates]' ";


	mysql_query($q1);

	if(mysql_error())
	{
		$RegisterError = "<center><font color=red>O nome <b>$_POST[NewUsername]</b> já está sendo usado!<br>Por favor, selecione outro!</font>";
	}
	else
	{
		$last = mysql_insert_id();
		header("location:ViewUser.php?AgentID=$last");
		exit();
	}
}

include_once("LeftStyles.php");

?>

<script>
		function CheckRegister() {

			if(document.RegForm.NewUsername.value=="")
			{
				window.alert('Digite o nome de usuário, por favor!');
				document.RegForm.NewUsername.focus();
				return false;
			}

			if(document.RegForm.NewPassword.value=="")
			{
				window.alert('Digite a senha, por favor!');
				document.RegForm.NewPassword.focus();
				return false;
			}

			if(document.RegForm.NewPassword2.value=="")
			{
				window.alert('Confirme a senha, por favor!');
				document.RegForm.NewPassword2.focus();
				return false;
			}

			if(document.RegForm.NewPassword.value != "" && document.RegForm.NewPassword.value != "" && document.RegForm.NewPassword.value != document.RegForm.NewPassword2.value)
			{
				window.alert('Digite e confirme a senha novamente!');
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
				window.alert('Informe seu e-mail, por favor!');
				document.RegForm.Email.focus();
				return false;
			}

			if(document.RegForm.Phone.value=="")
			{
				window.alert('Informe seu telefone, por favor!');
				document.RegForm.Phone.focus();
				return false;
			}


		}
</script>

<form method="post" onsubmit="return CheckRegister();" name="RegForm" enctype="multipart/form-data">
<table align=center>
<caption align=center>
<font face=verdana size=2><b>Cadastrar novo agente</b></font><br><?=$RegisterError?></caption>
<tr>
  <td>Nome de usu&aacute;rio:</td>
	<td><input type=text name=NewUsername></td>
</tr>

<tr>
  <td>Senha:</td>
	<td><input type=password name=NewPassword></td>
</tr>

<tr>
  <td>Confirmar senha:</td>
	<td><input type=password name=NewPassword2></td>
</tr>

<tr>
  <td>Nome:</td>
	<td><input type=text name=FirstName></td>
</tr>

<tr>
  <td>Sobrenome:</td>
	<td><input type=text name=LastName></td>
</tr>

<tr>
  <td valign=top>Logotipo:</td>
	<td><input type=file name="LogoImage" size=35></td>
</tr>

<tr>
  <td valign=top>Informa&ccedil;&otilde;es:</td>
	<td><textarea cols=45 rows=6 name=resume></textarea></td>
</tr>

<tr>
  <td>Endere&ccedil;o de e-mail:</td>
	<td><input type=text name=Email></td>
</tr>

<tr>
  <td>Telefone:</td>
	<td><input type=text name=Phone></td>
</tr>

<tr>
  <td>Celular:</td>
	<td><input type=text name=cellular></td>
</tr>

<tr>
  <td>Pager:</td>
	<td><input type=text name=pager></td>
</tr>

<tr>
  <td valign=top>Fotos:</td>
	<td>
		<input type=file name="rim[]" size=35><br>
		<input type=file name="rim[]" size=35><br>
		<input type=file name="rim[]" size=35><br>
		<input type=file name="rim[]" size=35><br>
		<input type=file name="rim[]" size=35><br>
	</td>
</tr>

<tr>
  <td>Receber newsletter?</td>
	<td>
		<select name=updates>
			<option value="y">Sim</option>
			<option value="n">Não</option>
		</select>	
	</td>
</tr>

<tr>
  <td>Pacote:</td>
	<td>
		<?=$sprices?>
	</td>
</tr>

<tr>
	<td colspan=2 align=center>
		<input type=submit name=s1 value="Salvar">
	</td>
</tr>

</table>
</form>