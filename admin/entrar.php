<? ob_start();
require_once("../configuracao_mysql.php");

if(isset($_POST[s2]))
{
	$MyUsername1 = strip_tags($_POST[username1]);
	$MyPassword1 = strip_tags($_POST[password1]);
	
	if(empty($MyUsername1) || empty($MyPassword1))
	{
		$MyError = "<center><font color=red size=2 face=verdana><b>Informe seu nome de usuário e senha para entrar!</b></font></center>";
	}
	else
	{
		//check the login info if exists
		$q1 = "select * from re2_admin where AdminID = '$MyUsername1' and AdminPass = '$MyPassword1' ";
		$r1 = mysql_query($q1);

		if(!$r1)
		{
			echo mysql_error();
			header("location:error1.php");
			exit();
		}
		else
		{
			if(mysql_num_rows($r1) == '1')
			{
			$a1 = mysql_fetch_array($r1);
			$_SESSION[AdminID] = $MyUsername1;
			$_SESSION[AdminEmail] = $a1[AdminEmail];
			$_SESSION[AdminName] = $a1[AdminName];
			header("location:index.php");
			exit();
			}
		}
	}
}
?>
<html>
<head>
<title>Painel de administração</title>

<style>
	body {font-family:verdana; font-size:12; font-weight:bold; color:black; background-color:white}
	td  {font-family:verdana; font-size:12; font-weight:bold; color:black}
</style>

</head>

<body onload="document.f1.username1.focus();">
<!-- main table start here -->
<table width=761 height=500 align=center  border=0 bordercolor=black cellspacing=0 cellpadding=0>
<tr>
	<td align=center>

			<!-- second table start here -->
			<table width="757" border="0" cellspacing="0" cellpadding="0" height="100%" bgcolor=white>	 
			<tr>
				<td align=center>
					<form method=post action="entrar.php" name=f1>
					<table align=center width=400 border=0 bordercolor=black cellspacing=0 cellpadding=5>
					<caption align=center><?=$MyError?></center>
					<tr>
						
                  <td colspan=2 align=center><img src="admin.gif" width="250" height="71"></td>
					</tr>
					<tr bgcolor=#CCCCCC>
						<td>Nome de usu&aacute;rio : <font size="1">&nbsp;</font></td>
					  <td><input type=text name=username1 maxlength=20></td>
					</tr>

					<tr bgcolor=#CCCCCC>
						<td>Senha: <font size="1">&nbsp;</font></td>
					  <td><input type=password name=password1 maxlength=20></td>
					</tr>
					</table>
			
					<br>

						<center>
							<input type=submit name=s2 value="Entrar" style="background-color:#CCCCCC; font-size:10; color:black; font-family:verdana, arial; font-weight:bold; border-width:1; border-color:black">
						</center>

					</form>
		
			</table>
			<!-- second table end here -->
	</td>
</tr>
</table>

<!-- main table end here -->
