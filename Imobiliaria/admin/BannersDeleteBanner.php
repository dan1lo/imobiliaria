<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

if(!empty($_GET[BannerFile]) && !empty($_GET[BannerID]))
{
	$q1 = "delete from re2_banners where BannerID = '$_GET[BannerID]' ";
	mysql_query($q1) or die(mysql_error());

	$q1 = "delete from re2_stats where BannerID = '$_GET[BannerID]' ";
	mysql_query($q1) or die(mysql_error());

	unlink("../banners/$_GET[BannerFile]");

}

header("location:$_SERVER[HTTP_REFERER]");

exit();
?>