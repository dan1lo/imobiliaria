<html>
<head>
	<title><?=$aset[SiteTitle]?></title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
	<META NAME="DESCRIPTION" CONTENT="<?=$aset[SiteDescription]?>">
	<META NAME="KEYWORDS" CONTENT="<?=$aset[SiteKeywords]?>">

<LINK href="arquivo_de_estilos.css" type=text/css rel=stylesheet>

	<script language="JavaScript">
<!--



function CheckSearch() {

			if(document.f1.what.value=="")
			{
				window.alert('Digite o critério de busca, por favor!');
				document.f1.what.focus();
				return false;
			}

		}

		function CheckFriend() {

			if(document.sfriend.f1.value=="")
			{
				window.alert('Digite seu e-mail, por favor');
				document.sfriend.f1.focus();
				return false;
			}

			if(document.sfriend.f2.value=="")
			{
				window.alert('Digite o endereço de e-mail de seu amigo');
				document.sfriend.f2.focus();
				return false;
			}

		}

		function CheckLogin() {

			if(document.lform.us.value=="")
			{
				window.alert('Digite seu nome de usuário, por favor.');
				document.lform.us.focus();
				return false;
			}

			if(document.lform.ps.value=="")
			{
				window.alert('Digite sua senha, por favor.');
				document.lform.ps.focus();
				return false;
			}

		}

		function CheckForgot() {

			if(document.ForgotForm.u2.value=="")
			{
				window.alert('Digite seu nome de usuário, por favor.');
				document.ForgotForm.u2.focus();
				return false;
			}
		}

		function CheckRegister() {

			if(document.RegForm.NewUsername.value=="")
			{
				window.alert('Digite seu nome de usuário, por favor.');
				document.RegForm.NewUsername.focus();
				return false;
			}

			if(document.RegForm.p1.value=="")
			{
				window.alert('Digite sua senha, por favor.');
				document.RegForm.p1.focus();
				return false;
			}

			if(document.RegForm.p2.value=="")
			{
				window.alert('Confirme sua senha, por favor!');
				document.RegForm.p2.focus();
				return false;
			}

			if(document.RegForm.p1.value != "" && document.RegForm.p2.value != "" && document.RegForm.p1.value != document.RegForm.p2.value)
			{
				window.alert('Digite e confirme sua senha novamente, por favor!');
				document.RegForm.p1.value="";
				document.RegForm.p2.value="";
				document.RegForm.p1.focus();
				return false;
			}

			if(document.RegForm.FirstName.value=="")
			{
				window.alert('Digite seu primeiro nome, por favor.');
				document.RegForm.FirstName.focus();
				return false;
			}

			if(document.RegForm.LastName.value=="")
			{
				window.alert('Digite seu sobrenome, por favor.');
				document.RegForm.LastName.focus();
				return false;
			}

			if(document.RegForm.phone.value=="")
			{
				window.alert('Digite seu telefone, por favor.');
				document.RegForm.phone.focus();
				return false;
			}

			if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.RegForm.email.value))
			{
				return true;
			}
			
			alert("Endereço de e-mail inválido, tente novamente.");
			document.RegForm.email.focus();
			return false;
			

		}

		function CheckProfile() {

			if(document.RegForm.p1.value=="")
			{
				window.alert('Digite sua senha, por favor.');
				document.RegForm.p1.focus();
				return false;
			}

			if(document.RegForm.p2.value=="")
			{
				window.alert('Confirme sua senha, por favor!');
				document.RegForm.p2.focus();
				return false;
			}

			if(document.RegForm.p1.value != "" && document.RegForm.p2.value != "" && document.RegForm.p1.value != document.RegForm.p2.value)
			{
				window.alert('Digite e confirme sua senha novamente, por favor!');
				document.RegForm.p1.value="";
				document.RegForm.p2.value="";
				document.RegForm.p1.focus();
				return false;
			}

			if(document.RegForm.FirstName.value=="")
			{
				window.alert('Digite seu primeiro nome, por favor.');
				document.RegForm.FirstName.focus();
				return false;
			}

			if(document.RegForm.LastName.value=="")
			{
				window.alert('Digite seu sobrenome, por favor.');
				document.RegForm.LastName.focus();
				return false;
			}

			if(document.RegForm.phone.value=="")
			{
				window.alert('Digite seu telefone, por favor.');
				document.RegForm.phone.focus();
				return false;
			}

			if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.RegForm.email.value))
			{
				return true;
			}
			
			alert("Endereço de e-mail inválido, tente novamente.");
			document.RegForm.email.focus();
			return false;

		}

		function CheckOffer() {
	
			if(document.PostForm.SelectCategory.value=="")
			{
				alert('Selecione uma categoria onde quer que aparece o seu anúncio!');
				document.PostForm.SelectCategory.focus();
				return false;
			}

			if(document.PostForm.address.value=="")
			{
				alert('Informe o endereço da propriedade, por favor!');
				document.PostForm.address.focus();
				return false;
			}

			if(document.PostForm.city.value=="")
			{
				alert('Informe a cidade onde está sua propriedade!');
				document.PostForm.city.focus();
				return false;
			}

			if(document.PostForm.state.value=="")
			{
				alert('Informe o estado(UF) onde está sua propriedade!');
				document.PostForm.state.focus();
				return false;
			}

			if(document.PostForm.country.value=="")
			{
				alert('Informe o país onde está sua propriedade!');
				document.PostForm.country.focus();
				return false;
			}

			if(document.PostForm.ShortDesc.value=="")
			{
				alert('Escreva uma breve descrição sobre sua propriedade!');
				document.PostForm.ShortDesc.focus();
				return false;
			}

			if(document.PostForm.DetailedDesc.value=="")
			{
				alert('Escreva uma descrição detalhada sobre sua propriedade!');
				document.PostForm.DetailedDesc.focus();
				return false;
			}

			if(document.PostForm.Price.value=="")
			{
				alert('Informe o preço de sua propriedade!');
				document.PostForm.Price.focus();
				return false;
			}

			if(document.PostForm.PropertyType.value=="")
			{
				alert('Selecione o tipo de propriedade');
				document.PostForm.PropertyType.focus();
				return false;
			}

			if(document.PostForm.rooms.value=="")
			{
				alert('Informe o número de quartos!');
				document.PostForm.rooms.focus();
				return false;
			}

			if(document.PostForm.bathrooms.value=="")
			{
				alert('Informe o número de banheiros!');
				document.PostForm.bathrooms.focus();
				return false;
			}

		}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>


</head>

<body topmargin=0 onLoad="MM_preloadImages('images/menu_home_a.gif','images/menu_pesquisar2.jpg')">
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td height="19" background="images/l_bg.gif"><img src="images/l_bg.gif" width="10" height="17"></td>
    <td><table width="703" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td><TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
            <TBODY>
              <TR>
                <TD width=328 background="images/fundo.jpg"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="780" height="240">
                  <param name="movie" value="logotipo.swf">
                  <param name="quality" value="high">
                  <embed src="logotipo.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="780" height="240"></embed>
                </object></TD>
              </TR>
            </TBODY>
          </TABLE></td>
        </tr><tr>
        </tr>
        <tr> 
          <td valign="top" background="images/bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="167" valign="top"><table width="167" border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td><div align="left"> 
<? require_once("busca_principal.php");?>      
      <form method=POST action="busca_avancada.php">
        
          <div align="left"><img src="images/pesquisar.gif" width="121" height="27">
          </div>
          <table width=100% align=center bgcolor="#F4F4F4">
              <tr>
                <td width="99">                <strong>De</strong>                  <?=$MinPrice?>
                  <br>
                  <strong>At&eacute;</strong>
  <?=$MaxPrice?></td>
                </tr>
              <tr>
                <td><strong>Em:</strong><br>
                  <?=$CityMenu?></td>
                </tr>
              <tr>
                <td height="25">
                  <input type=submit name=s1 value="Buscar"></td>
              </tr>
          </table>
      </form>
					  <?=$Account?>
                          <?=$Categories?>
                      </div></td>
                    </tr>
                    <tr> 
                      <td><p>&nbsp;</p></td>
                    </tr>
                  </table></td>
                <td width="564" valign="top"><div align="center"> 
                    <table width="491" height="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td width="479"><div align="center"></div></td>
                      </tr>

                      <tr> 
                        <td height="100%"><div align="center"> 
                            <p>
							
