<LINK href="arquivo_de_estilos.css" type=text/css rel=stylesheet>

<script>
	function CheckFriend() {

		if(document.f5.YourName.value=="")
		{
			alert('Digite seu nome, por favor.');
			document.f5.YourName.focus();
			return false;
		}

		if(document.f5.YourEmail.value=="")
		{
			alert('Digite seu e-mail, por favor.');
			document.f5.YourEmail.focus();
			return false;
		}

		if(document.f5.FriendsName.value=="")
		{
			alert('Digite o nome do seu amigo por favor.');
			document.f5.FriendsName.focus();
			return false;
		}

		if(document.f5.FriendsEmail.value=="")
		{
			alert('Digite o endereço de e-mail de seu amigo, por favor.');
			document.f5.FriendsEmail.focus();
			return false;
		}

	}
</script>

<form method=post onsubmit="return CheckFriend();" name=f5>
<table align=center width=480>
<caption align=center><h5><b>Envie este anúncio para um amigo!</b></h5></caption>

<tr>
	<td><font size=1 face=verdana><b>Seu nome:</b></font><br><input type=text name=YourName size=30 class=mtext></td>

	<td><font size=1 face=verdana><b>Seu e-mail:</b></font><br><input type=text name=YourEmail size=30 class=mtext></td>
</tr>

<tr>
	<td><font size=1 face=verdana><b>Nome do seu amigo:</b></font><br><input type=text name=FriendsName size=30 class=mtext></td>

	<td><font size=1 face=verdana><b>E-mail do seu amigo:</b></font><br><input type=text name=FriendsEmail size=30 class=mtext></td>
</tr>

<tr>
	<td colspan=2 align=left>
		<font size=1 face=verdana><b>Seus comentários:</b></font><br>
		<textarea name=comments rows=4 cols=49></textarea>
	</td>
</tr>

<tr>
	<td align=right>
		<br>
		<input type=hidden name=MyRef value="<?=$ListingID?>">
		<input type=submit name=s1 value=Enviar class=sub1>
	</td>
	<td>&nbsp;</td>
</tr>
</table>
</form>