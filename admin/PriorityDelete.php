<?
require_once("../configuracao_mysql.php");

if(!empty($_GET[PriorityID]))
{
	$q1 = "delete from re2_priority where PriorityID = '$_GET[PriorityID]' ";
	mysql_query($q1) or die(mysql_error());
}

header("location:priority.php");

?>