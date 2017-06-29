<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

if(!empty($_GET[id]))
{
	mysql_query("delete from re2_types where TypeID = '$_GET[id]' ") or die(mysql_error());
}

header("location:ptypes.php");

exit();

?>