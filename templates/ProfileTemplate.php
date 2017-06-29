

<form method=post action="perfil.php" enctype="multipart/form-data" name=RegForm onsubmit="return CheckProfile();">
<table align=center width=400>
<caption align=center>
<font face=verdana size=2><b>Atualize seu perfil </b></font><br>
<?=$error?></caption>

<tr>
	<td align=right>Nome de usu&aacute;rio:</td>
	<td><?=$a1[username]?></td>
</tr>

<tr>
	<td align=right>Senha:</td>
	<td><input type=password name=p1></td>
</tr>

<tr>
	<td align=right>Repita a senha:</td>
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
	<td align=right>Logotipo:</td>
	<td>
		<?
		if(!empty($a1[logo]))
		{
			echo "<img src=\"fotos_anuncios/$a1[logo]\"><br><a class=RedLink href=\"DeleteLogo.php\">Deletar este logotipo</a>";
		}
		else
		{
			echo "<input type=file name=\"logo\">";
		}
		?>
	</td>
</tr>

<tr>
	<td align=right>Informa&ccedil;&otilde;es:</td>
	<td><textarea cols=40 rows=5 name=resume><?=$a1[resume]?></textarea></td>
</tr>

<tr>
	<td align=right valign=top>Fotos:</td>
	<td>
		<?=$ImageBlock?>
	</td>
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
		<input type=radio name=news value="y" <?=$ch1?>> 
		Sim		&nbsp;&nbsp;&nbsp;
		<input type=radio name=news value="n" <?=$ch2?>>
		N&atilde;o&nbsp;&nbsp;&nbsp;
	</td>
</tr>

<tr>
	<td align=right>Formato da Newsletter:</td>
	<td>
		<input type=radio name=format value="html" <?=$ch3?>>html &nbsp;&nbsp;&nbsp;
		<input type=radio name=format value="plain" <?=$ch4?>>		
		texto &nbsp;&nbsp;&nbsp;
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