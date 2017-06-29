<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

unlink("../fotos_anuncios/$_GET[file]");

$q1 = "update re2_agents set logo = '' where AgentID = '$_GET[id]' ";
mysql_query($q1) or die(mysql_error());

header("location:$_SERVER[HTTP_REFERER]");

EXIT();

?>