<?
require_once("../configuracao_mysql.php");
?>
<html>
<head>
<title>Painel de administração</title>

<style>
	a.Nav {font-size:11; font-family:verdana; color:black; text-decoration:none; font-weight:bold }
	a.Nav:hover {text-decoration:underline}

	a.EditLink {font-size:11; font-family:verdana; color:green; text-decoration:none; font-weight:bold }
	a.EditLink:hover {text-decoration:underline}

	a.DeleteLink {font-size:11; font-family:verdana; color:red; text-decoration:none; font-weight:bold }
	a.DeleteLink:hover {text-decoration:underline}

	input, textarea {border-width:1px; border-color:black; font-size:12; font-family:verdana}
	select {font-family:verdana; font-size:12}

	.TableHead {background-color:#336699; font-family:verdana; font-size:11; color:white; font-weight:bold }

	.merror {color:#990000; font-family:verdana; font-size:10; font-weight:bold}
</style>

</head>

<body bgcolor=white topmargin=0 leftmargin=0>

