<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

include_once("LeftStyles.php");

//get the newsletter
$q1 = "select *, from_unixtime(MailDate, '%b - %d - %Y') as MyDate from re2_mail_archive where MailDate = '$_GET[MailDate]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

?>

<br><br>

<table align=center width=400 cellspacing=0 cellpadding=3 border=1 bordercolor=black>
<caption align=center>Newsletter de <?=$a1[MyDate]?></caption>

<tr>
	<td width=80>Assunto:</td>
	<td><?=$a1[subject]?></td>
</tr>

<tr>
	<td valign=top>Conteúdo:</td>
	<td><?=nl2br($a1[message])?></td>
</tr>

</table>

<br><br>

