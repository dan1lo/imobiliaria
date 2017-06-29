<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

if(!empty($_GET[MailDate]))
{
	$q1 = "delete from re2_mail_archive where MailDate = '$_GET[MailDate]' ";
	mysql_query($q1) or die(mysql_error());
}

header("location:MailArchive.php");
exit();

?>