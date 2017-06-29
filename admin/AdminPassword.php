<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

include_once("LeftStyles.php");

if(isset($_POST[s1]))
{
	if(!empty($_POST[username]))
	{
		$q1 = "update re2_admin set AdminID = '$_POST[username]', AdminPass = '$_POST[np1]' where AdminID = '$_SESSION[AdminID]' ";

		$_SESSION[AdminID] = $_POST[username];
	}
	else
	{
		$q1 = "update re2_admin set AdminPass = '$_POST[np1]' where AdminID = '$_SESSION[AdminID]' ";
	}

	mysql_query($q1) or die(mysql_error());

	echo "<br><center>Seu nome de usuário e senha foram alterados com sucesso!</center><br>";
}

?>


<script>
	function CheckPass() {

		if(document.f1.username.value=="")
		{
			window.alert('Digite seu nome de usuário, por favor.');
			document.f1.username.value="<?=$_SESSION[AdminID]?>";
			document.f1.username.focus();
			return false;
		}

		if(document.f1.np1.value=="")
		{
			window.alert('Digite sua senha, por favor.');
			document.f1.np1.focus();
			return false;
		}

		if(document.f1.np2.value=="")
		{
			window.alert('Confirme sua senha, por favor.');
			document.f1.np2.focus();
			return false;
		}

		if(document.f1.np1.value != document.f1.np2.value)
		{
			window.alert('Houve um problema de identificação com sua senha\n\nEntre e confirme sua senha novamente.');
			document.f1.np1.value="";
			document.f1.np2.value="";
			document.f1.np1.focus();
			return false;
		}

	}
</script>

<br><br>

<form method=post name=f1 onsubmit="return CheckPass();">

<table align=center width=285>
<tr>
	<td colspan=2 align=center class=TableHead>Alterar informa&ccedil;&otilde;es do usu&aacute;rio </td>
</tr>

<tr>
	<td>Nome de usu&aacute;rio:</td>
	<td><input type=text name=username value="<?=$_SESSION[AdminID]?>"></td>
</tr>

<tr>
	<td>Nova senha:</td>
	<td><input type=password name=np1></td>
</tr>

<tr>
	<td>Confirmar  senha:</td>
	<td><input type=password name=np2></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><input type=submit name=s1 value=Salvar class=sub></td>
</tr>

</table>

</form>