<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

include_once("LeftStyles.php");

if(isset($_POST[s1]))
{
	$q1 = "update re2_admin set AdminName = '$_POST[NewName]', AdminEmail = '$_POST[NewEmail]' where AdminID = '$_SESSION[AdminID]' ";
	mysql_query($q1) or die(mysql_error());

	echo "<br><center>Suas informações foram alteradas com sucesso!</center><br>";
}

//get the admin info
$q1 = "select * from re2_admin where AdminID = '$_SESSION[AdminID]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

?>


<script>
	function CheckInfo() {

		if(document.f1.NewName.value=="")
		{
			window.alert('Digite seu nome, por favor.');
			document.f1.NewName.focus();
			return false;
		}

		if(document.f1.NewEmail.value=="")
		{
			window.alert('Digite seu endereço de e-mail, por favor!');
			document.f1.NewEmail.focus();
			return false;
		}

	}
</script>

<br><br>

<form method=post name=f1 onsubmit="return CheckInfo();">

<table align=center width=285>
<tr>
	<td colspan=2 align=center class=TableHead>Altere suas informações</td>
</tr>

<tr>
	<td>Nome do administrador:</td>
	<td><input type=text name=NewName value="<?=$a1[AdminName]?>"></td>
</tr>

<tr>
	<td>E-mail do administrador:</td>
	<td><input type=text name=NewEmail value="<?=$a1[AdminEmail]?>"></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><input type=submit name=s1 value=Salvar class=sub></td>
</tr>

</table>

</form>