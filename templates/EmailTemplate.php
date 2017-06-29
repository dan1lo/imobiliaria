	<script>
	function CheckMail() {

		if(document.je.u_name.value=="")
		{
			alert('Digite seu nome, por favor.');
			document.je.u_name.focus();
			return false;
		}

		if(document.je.u_email.value=="")
		{
			alert('Digite seu e-mail, por favor.');
			document.je.u_email.focus();
			return false;
		}

		if(document.je.subject.value=="")
		{
			alert('Enter the subject, please!');
			document.je.subject.focus();
			return false;
		}

		if(document.je.message.value=="")
		{
			alert('Digite uma mensagem, por favor.');
			document.je.message.focus();
			return false;
		}

	}
</script>

<br><br>
	<form method=post onsubmit="return CheckMail();" name=je>
	<table width=340 align=center border=0>
	<caption align=center>
	<span style="font-size:11; font-family:verdana; color:black; font-weight:bold"><img src="images/correio.gif" width="22" height="19"> Use este formul&aacute;rio para entrar em contato 
	<?=$AgentName?></span>
	</caption>

	<tr>
		<td>Nome:</td>
		<td><input type=text name="u_name" size=42 class="mtext"></td>
	</tr>

	<tr>
		<td>E-mail:</td>
		<td><input type=text name=u_email size=42 class="mtext"></td>
	</tr>

	<tr>
		<td>Assunto:</td>
		<td><input type=text name=subject size=42 class="mtext" value="<?=$SubjectLine?>"></td>
	</tr>

	<tr>
		<td valign=top>Mensagem:</td>
		<td><textarea rows=6 cols=41 name=message class="mtext"><?=$_POST[message]?></textarea></td>
	</tr>

	<tr>
		<td>&nbsp;</td>

		<td>
			<input type=submit name=s1 value="Enviar" class="sub1">
		</td>
	</tr>

	</table>
	</form>