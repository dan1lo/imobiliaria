<form method=post action="entrar.php" name=lform onsubmit="return CheckLogin();">
<table align=center width=300>
<caption align=center>
    <font face=verdana size=2><b><img src="images/sair.gif" width="37" height="37">Tela de entrada para membros </b></font><br>
    <?=$error?></caption>
<tr>
	<td align=right>Nome de usu&aacute;rio:</td>
	<td><input type=text name=us></td>
</tr>

<tr>
	<td align=right>Senha:</td>
	<td><input type=password name=ps></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><input type=submit name=s1 value="Entrar"></td>
</tr>

<tr>
	<td colspan=2 style="padding-top:20" align=center><a class=BlackLink href="lembrar_senha.php">Perdeu sua senha? Clique aqui. </a></td>
</tr>

</table>
</form>