<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

include_once("LeftStyles.php");


//get the newsletter archive
$q1 = "select*, from_unixtime(MailDate, '%b - %d - %Y') as MyDate from re2_mail_archive order by MailDate desc";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) == '0')
{
	echo "<br><center><font color=red face=verdana size=2><b>O arquivo de e-mails está vazio!</b></font></center>";
	exit();
}

?>

<script>

	function DeleteMailArchive() {

		if(confirm('Você tem certeza que deseja deletar esta newsletter?'))
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

<table align=center width=500 cellspacing=0>
<caption>
Arquivo de Newsletter enviadas 
</caption>
<tr class=TableHead>
	<td width=300>Assunto</td>
	<td width=150 align=center>Data</td>
	<td width=50 align=center>Controle</td>
</tr>

<?

while($a1 = mysql_fetch_array($r1))
{
	echo "<tr>\n\t<td><a class=BlackLink href=\"MailViewArchive.php?MailDate=$a1[MailDate]\">$a1[subject]</a></td>\n\t<td align=center>$a1[MyDate]</td>\n\t<td align=center><a href=\"MailDeleteArchive.php?MailDate=$a1[MailDate]\" class=RedLink onclick=\"return DeleteMailArchive();\">Deletar</a></td></tr>\n";
}

?>

</table>