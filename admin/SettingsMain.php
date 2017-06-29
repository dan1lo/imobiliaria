<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

include_once("LeftStyles.php");

if(isset($_POST[s1]))
{
	$q1 = "update re2_settings set 
					SiteTitle = '$_POST[SiteTitle]',
					SiteName = '$_POST[SiteName]',
					SiteKeywords = '$_POST[SiteKeywords]',
					SiteDescription = '$_POST[SiteDescription]',
					PayPalEmail = '$_POST[PayPalEmail]',
					SellerID = '$_POST[SellerID]',
					CompanyAddress = '$_POST[CompanyAddress]',
					ContactEmail = '$_POST[ContactEmail]',
					Agreement = '$_POST[Agreement]',
					Parceiros = '$_POST[Parceiros]',
					Clientes = '$_POST[Clientes]',
					sp_payee_email = '$_POST[sp_payee_email]',
					sp_vendor_email = '$_POST[sp_vendor_email]',
					sp_secret_code = '$_POST[sp_secret_code]' ";						

	mysql_query($q1) or die(mysql_error());

	echo "<br><center>Configurações do site atualizadas com sucesso!</center><br>";
}

//get the main site settings
$qset = "select * from re2_settings";
$rset = mysql_query($qset) or die(mysql_error());
$aset = mysql_fetch_array($rset);

?>

<script>
	function CheckSettings() {

		if(document.f1.SiteTitle.value=="")
		{
			window.alert('Digite o título do seu site, por favor.');	
			document.f1.SiteTitle.focus();
			return false;
		}

		if(document.f1.SiteKeywords.value=="")
		{
			window.alert('Digite as palavras-chave do seu site, por favor.');	
			document.f1.SiteKeywords.focus();
			return false;
		}

		if(document.f1.SiteDescription.value=="")
		{
			window.alert('Digite a descrição do seu site, por favor.');	
			document.f1.SiteDescription.focus();
			return false;
		}

		if(document.f1.ContactEmail.value=="")
		{
			window.alert('Digite seu e-mail para contato, por favor.');	
			document.f1.ContactEmail.focus();
			return false;
		}

		if(document.f1.CompanyAddress.value=="")
		{
			window.alert('Digite o endereço de sua companhia, por favor.');	
			document.f1.CompanyAddress.focus();
			return false;
		}

		if(document.f1.Agreement.value=="")
		{
			window.alert('Digite o texto dos termos de uso, por favor.');	
			document.f1.Agreement.focus();
			return false;
		}

	}
</script>


<br><br>

<form method=post name=f1 onsubmit="return CheckSettings();">

  <table align=center>
    <tr> 
      <td colspan=2 class=TableHead align=center> Configurar site </td>
    </tr>
    <tr> 
      <td>T&iacute;tulo do site:</td>
      <td><input type=text name=SiteTitle value="<?=$aset[SiteTitle]?>" size=50></td>
    </tr>
    <tr>
      <td>Nome do site:</td>
      <td><input type=text name=SiteName value="<?=$aset[SiteName]?>" size=50></td>
    </tr>
    <tr> 
      <td>Palavras-chave:</td>
      <td><input type=text name=SiteKeywords value="<?=$aset[SiteKeywords]?>" size=50></td>
    </tr>
    <tr> 
      <td>Descri&ccedil;&atilde;o:</td>
      <td><input type=text name=SiteDescription value="<?=$aset[SiteDescription]?>" size=50></td>
    </tr>
    <tr> 
      <td>E-mail que recebe pagamentos:</td>
      <td><input type=text name=PayPalEmail value="<?=$aset[PayPalEmail]?>" size=50></td>
    </tr>
    <tr> 
      <td>StormPay e-mail de vendas:</td>
      <td><input type=text name=sp_payee_email value="<?=$aset[sp_payee_email]?>" size=46></td>
    </tr>
    <tr> 
      <td>StormPay e-mail de vendedor:</td>
      <td><input type=text name=sp_vendor_email value="<?=$aset[sp_vendor_email]?>" size=46></td>
    </tr>
    <tr> 
      <td>StormPay c&oacute;digo:</td>
      <td><input type=text name=sp_secret_code value="<?=$aset[sp_secret_code]?>" size=46></td>
    </tr>
    <tr> 
      <td>2checkout Vendedor ID:</td>
      <td><input type=text name=SellerID value="<?=$aset[SellerID]?>" size=6 maxlength=5></td>
    </tr>
    <tr> 
      <td>E-mail para contato com o administrador do site:</td>
      <td><input type=text name=ContactEmail value="<?=$aset[ContactEmail]?>" size=50></td>
    </tr>
    <tr> 
      <td valign=top>Conteúdo da página "quem somos":</td>
      <td><textarea name=CompanyAddress rows=4 cols=43><?=$aset[CompanyAddress]?></textarea></td>
    </tr>
    <tr>
      <td valign=top>Conte&uacute;do da p&aacute;gina "parceiros"</td>
      <td><textarea name=Parceiros cols=43 rows=8 id="Parceiros"><?=$aset[Parceiros]?></textarea></td>
    </tr>
    <tr>
      <td valign=top>Conte&uacute;do da p&aacute;gina "clientes"</td>
      <td><textarea name=Clientes cols=43 rows=8 id="Clientes"><?=$aset[Clientes]?></textarea></td>
    </tr>
    <tr> 
      <td valign=top>Condições de uso:</td>
      <td><textarea name=Agreement rows=8 cols=43><?=$aset[Agreement]?></textarea></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td><input type=submit name=s1 value=Salvar class=sub></td>
    </tr>
  </table>

</form>