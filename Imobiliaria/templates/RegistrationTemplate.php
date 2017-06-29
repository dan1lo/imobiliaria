

<form method=post action="cadastro.php" enctype="multipart/form-data" name=RegForm onsubmit="return CheckRegister();">
<table align=center width=300>
<caption align=center>
<font face=verdana size=2><b>Formul&aacute;rio de cadastro</b></font><br>
<?=$error?></caption>
<tr>
	<td align=right>Nome de usu&aacute;rio:</td>
	<td><input type=text name=NewUsername value="<?=$_POST[NewUsername]?>"></td>
</tr>

<tr>
	<td align=right>Senha:</td>
	<td><input type=password name=p1></td>
</tr>

<tr>
	<td align=right>Repita a senha :</td>
	<td><input type=password name=p2></td>
</tr>

<tr>
	<td align=right>Nome:</td>
	<td><input type=text name=FirstName value="<?=$_POST[FirstName]?>"></td>
</tr>

<tr>
	<td align=right>Sobrenome:</td>
	<td><input type=text name=LastName value="<?=$_POST[LastName]?>"></td>
</tr>

<tr>
	<td align=right>Telefone:</td>
	<td><input type=text name=phone value="<?=$_POST[phone]?>"></td>
</tr>

<tr>
	<td align=right>E-mail:</td>
	<td><input type=text name=email value="<?=$_POST[email]?>"></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td>
		<input type=hidden name=TipodeConta value="<?=$_GET[TipodeConta]?>">
		<input type=submit name=s1 value="Enviar">
	</td>
</tr>

</table>
</form>