<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

include_once("LeftStyles.php");

if(isset($_POST[s1]))
{
	//get the subscribers info
	$q1 = "select * from re2_agents where news = 'y' ";
	$r1 = mysql_query($q1) or die(mysql_error());
	
	while($a1 = mysql_fetch_array($r1))
	{
		$to = $a1[email];
		$subject = $_POST[subject];

		$headers = "MIME-Version: 1.0\n"; 
		$headers .= "Content-type: text/$a1[NewsletterType]; charset=iso-8859-1\n";
		$headers .= "Content-Transfer-Encoding: 8bit\n"; 
		$headers .= "From: $_SERVER[HTTP_HOST] <$aset[ContactEmail]>\n"; 
		$headers .= "X-Priority: 1\n"; 
		$headers .= "X-MSMail-Priority: High\n"; 
		$headers .= "X-Mailer: PHP/" . phpversion()."\n"; 

		if($a1[NewsletterType] == "plain")
		{
			$message = strip_tags($_POST[message]);
			$message .= "\n\n========================\nPara cancelar recebimento de Newsletter, clique neste link:\n";
			$message .= "$site_url/MailDeleteSubscriber.php?id=$a1[AgentID]";
		}
		else
		{
			$message = $_POST[message];
			$message .= "<br><hr width=\"100%\" size=1 color=black>Clique <a href=\"$site_url/MailDeleteSubscriber.php?id=$a1[AgentID]\">AQUI</a> para descadastrar.";
		}

		$message = stripslashes($message);

		mail($to, $subject, $message, $headers);

		$i++;
	}

	//add the message to the mail archive
	$t = time();
	$q1 = "insert into re2_mail_archive set 
					subject = '$_POST[subject]',
					message = '$_POST[message]',
					MailDate = '$t' ";
	mysql_query($q1) or die(mysql_error());

	echo "<center><b>$i emails foram enviado(s)!</b></center><br>";
}


//get the subscribers number
$q1 = "select count(*) from re2_agents where news = 'y' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

if($a1[0] == '0')
{
	echo "<br><center><font face=verdana size=2 color=red><b>Não existem assinantes da lista de e-mails!";
	exit();
}

?>

<script>

	function CheckNews() {

		if(document.f1.subject.value=="")
		{
			window.alert('Digite o assunto da Newsletter.');
			document.f1.subject.focus();
			return false;
		}

		if(document.f1.message.value=="")
		{
			window.alert('Digite o texto da Newsletter.');
			document.f1.message.focus();
			return false;
		}

	}

</script>

<form method=post name=f1 onsubmit="return CheckNews();">
<table align=center width=350>
<caption align=center class=BlackLink>
Existem <?=$a1[0]?> usu&aacute;rios cadastrados na sua lista de e-mails.
</caption>
<tr>
	<td colspan=2 class=TableHead align=center>Enviar Newsletter</td>
</tr>

<tr>
	<td>Assunto:</td>
	<td><input type=text name=subject size=38></td>
</tr>

<tr>
	<td valign=top>Mensagem:</td>
	<td><textarea name=message rows=10 cols=32></textarea></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><input type=submit name=s1 value=Enviar class=sub></td>
</tr>
</table>

</form>