<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

if(!empty($_GET[username]))
{
	$q1 = "update re2_agents set news = 'n' where username = '$_GET[username]' ";
	mysql_query($q1) or die(mysql_error());
}

header("location:MailSubscribers.php");
exit();

?>