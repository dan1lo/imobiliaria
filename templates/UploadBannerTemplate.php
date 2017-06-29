<script>
	function CheckBanner() {

		if(document.f1.NewBanner.value=="")
		{
			window.alert('Selecione o arquivo do banner e clique em Enviar!');
			return false;
		}

		if(document.f1.BannerURL.value=="" || document.f1.BannerURL.value.length <= "11")
		{
			window.alert('Digite o endereço (url) para onde será redirecionado o link do banner !');
			document.f1.BannerURL.focus();
			document.f1.BannerURL.value="http://"
			return false;
		}

		if(document.f1.BannerType.value=="")
		{
			window.alert('Digite o tipo do banner, por favor!');
			document.f1.BannerType.focus();
			return false;
		}

	}
</script>

<br>
<form method=post enctype="multipart/form-data" name=f1 onsubmit="return CheckBanner();">
<table align=center>
<caption align=center><b>Adicionar um novo banner</b><br><?=$error?></caption>
<tr>
	<td>Arquivo:</td>
	<td><input type=file name=NewBanner size=30></td>
</tr>

<tr>
	<td>Descrição:</td>
	<td><input type=text name=BannerAlt size=41></td>
</tr>

<tr>
	<td>Endereço(url) linkado no banner:</td>
	<td><input type=text name=BannerURL size=41 value="http://"></td>
</tr>

<tr>
	<td>Tipo de banner:</td>
	<td>
		<select name=BannerType>
          <option value="468x60" selected>468 x 60 pixels</option>
        </select>
	</td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><input type=submit name=s1 value="Enviar"></td>
</tr>
</table>
</form>

<br><br>


<script>
	function ConfirmDelete() {
	
		if(confirm('Você tem certeza que deseja deletar este banner?'))
		{
			return true;
		}
		else
		{
			return false;
		}

	}
</script>

<?=$ShowBanners?>