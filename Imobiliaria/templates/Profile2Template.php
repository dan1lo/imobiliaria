

<form method=post action="perfil2.php" name=RegForm onsubmit="return CheckProfile();">
<table align=center width=400>
<caption align=center><font face=verdana size=2><b>Atualizar perfil</b></font><br><?=$error?></caption>

<tr>
  <td align=right>Nome de usu&aacute;rio:</td>
	<td><?=$a1[username]?></td>
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
	<td><input type=text name=FirstName value="<?=$a1[FirstName]?>"></td>
</tr>

<tr>
  <td align=right>Sobrenome:</td>
	<td><input type=text name=LastName value="<?=$a1[LastName]?>"></td>
</tr>

<tr>
  <td align=right>Telefone:</td>
	<td><input type=text name=phone value="<?=$a1[phone]?>"></td>
</tr>

<tr>
	<td align=right>Celular:</td>
	<td><input type=text name=cellular value="<?=$a1[cellular]?>"></td>
</tr>

<tr>
	<td align=right>Pager:</td>
	<td><input type=text name=pager value="<?=$a1[pager]?>"></td>
</tr>

<tr>
	<td align=right>E-mail:</td>
	<td><input type=text name=email value="<?=$a1[email]?>"></td>
</tr>

<tr>
  <td align=right>Receber Newsletter?</td>
	<td>
		<input type=radio name=news value="y" <?=$ch1?>>Sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=news value="n" <?=$ch2?>>Não &nbsp;&nbsp;&nbsp;
	</td>
</tr>

<tr>
  <td align=right>Formato da Newsletter:</td>
	<td>
		<input type=radio name=format value="html" <?=$ch3?>>html &nbsp;&nbsp;&nbsp;
		<input type=radio name=format value="plain" <?=$ch4?>>
		texto&nbsp;&nbsp;&nbsp;
	</td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td>	
		<input type=hidden name=OldImages value="<?=$a1[ResumeImages]?>">
		<input type=hidden name=OldLogo value="<?=$a1[logo]?>">
		<input type=submit name=s1 value="Atualizar">
	</td>
</tr>

</table>
</form>