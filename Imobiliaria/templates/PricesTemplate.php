<br><br>

<form method=get action=pagamento.php name=PricesForm>

<table align=center width=400 cellspacing=0>
<caption align=center>
	<?=$NewAgentMessage?>
	<font face=verdana color=black size=1>Se quiser anunciar, por favor selecione um pacote de anúncios abaixo!</font>

	<br><font color=red size=2 face=verdana><b><?=$error?></b></font>

</caption>

<tr style="background-color:#777777; color:white; font-family:verdana; font-size:11; font-weight:bold">
	<td width=20>&nbsp;</td>
	<td width=270>Pacote</td>
	<td width=100 align=right>Pre&ccedil;o</td>
</tr>

<?=$Prices?>

<tr>
	<td colspan=3 align=center style="padding-top:20">

		Forma de pagamento:

		  <select name=PaymentGateway>
			<option value=""></option>
			<option value="check" selected <?=$selected3?>>Depósito Bancário</option>
			<option value="stormpay" <?=$selected4?>>Stormpay.com</option>
			<option value="2checkout" <?=$selected2?>>2checkout.com</option>
			<option value="paypal" <?=$selected1?>>Paypal.com</option>
		  </select>
		
		<input type=submit name=s1 value=Enviar>
	</td>
</tr>

</table>

</form>

