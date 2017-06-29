<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

unlink("../fotos_anuncios/$_GET[file]");

//get the old images
$q1 = "select ResumeImages from re2_agents where AgentID = '$_GET[id]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

$OldImages = explode("|", $a1[ResumeImages]);

while(list(,$v) = each($OldImages))
{
	if($v != $_GET[file])
	{
		$NewImages[] = $v;
	}
}

if(!empty($NewImages))
{
	if(count($NewImages) > '1')
	{
		$ImageStr = implode("|", $NewImages);
	}
	else
	{
		$ImageStr = $NewImages[0];
	}
}
else
{
	$ImageStr = "";
}

$q1 = "update re2_agents set ResumeImages = '$ImageStr' where AgentID = '$_GET[id]' ";
mysql_query($q1) or die(mysql_error());

header("location:$_SERVER[HTTP_REFERER]");

EXIT();

?>