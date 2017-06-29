<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

//get the details
$q1 = "select * from re2_listings where ListingID = '$_GET[id]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

if(ereg($_GET[file], $a1[image]))
{
	//delete the file
	unlink("../fotos_anuncios/$_GET[file]");

	//update the database
	$OldImages = explode("|", $a1[image]);

	while(list(,$v) = each($OldImages))
	{
		if($v != $_GET[file])
		{
			$NewImages[] = $v;
		}
	}

	if(!empty($NewImages))
	{
		$NewStr = implode("|", $NewImages);
	}

	$q2 = "update re2_listings set image = '$NewStr' where ListingID = '$_GET[id]' ";
	mysql_query($q2) or die(mysql_error());
}

header("location:edit.php?id=$_GET[id]");
exit();

?>