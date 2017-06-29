<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

include_once("LeftStyles.php");

//get the newsletter subscribers list
$q1 = "select * from re2_agents where news = 'y' ";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) == '0')
{
	echo "<br><center><fonr color=red face=verdana size=2><b>Não existem assinantes da lista de e-mails!</b></font></center>";
	exit();
}

?>

<script>

	function DeleteSubscriber(username, email) {

		if(confirm('Você tem certeza que deseja deletar da lista\n\no usuário: ' + username + ' \ne-mail: '+ email +' ?'))
		{
			return true;
		}
		else
		{
			return false;
		}

	}

</script>

<br>

<center>
	Para deletar um agente da lista de e-mail clique em deletar.
</center>

<br>

<table align=center width=500 cellspacing=0 bordercolor=black frame=below>
<tr class=TableHead>
	<td width=120>Nome de usu&aacute;rio </td>
	<td align=center width=300>E-mail</td>
	<td align=center width=80>Controle</td>
</tr>

<?
while($a1 = mysql_fetch_array($r1))
{
	echo "<tr>\n\t<td>$a1[username]</td>\n\t<td align=center>$a1[email]</td>\n<td align=center><a href=\"MailDeleteSubscriber.php?username=$a1[username]\" class=RedLink onclick=\"return DeleteSubscriber('$a1[username]', '$a1[email]');\">Deletar</a></td>\n</tr>\n\n";
}	
?>


</table>

<br><br>