<html>
<head>
	<title><?=$aset[SiteTitle]?></title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
	<META NAME="DESCRIPTION" CONTENT="<?=$aset[SiteDescription]?>">
	<META NAME="KEYWORDS" CONTENT="<?=$aset[SiteKeywords]?>">

	<style>
		.BlackLink {font-family:tahoma, verdana, helvetica, arial; font-size:11; color:black; font-weight:bold; text-decoration:none}
		a.BlackLink:hover {text-decoration: underline}
		
		.BlackLinkB {font-family:tahoma, verdana, helvetica, arial; font-size:13; color:black; font-weight:bold; text-decoration:none}
		a.BlackLinkB:hover {text-decoration: underline}

		.BlueLink {font-family:tahoma, verdana, helvetica, arial; font-size:11; color:blue; font-weight:bold; text-decoration:underline}
		a.BlueLink:hover {text-decoration: underline}

		.RedLink {font-family:tahoma, verdana, helvetica, arial; font-size:11; color:red; font-weight:bold; text-decoration:none}
		a.RedLink:hover {text-decoration: underline}

		a.CatLinks {font-family:tahoma, verdana, helvetica, arial; font-size:11; color:white; font-weight:bold; text-decoration:none}
		a.CatLinks:hover {text-decoration:underline}

		a.SubCatLinks {font-family:tahoma, verdana, helvetica, arial; font-size:11; color:#878888; font-weight:normal; text-decoration:none}
		a.SubCatLinks:hover {text-decoration:underline}

		.TitleLinks {font-family:tahoma, verdana, helvetica, arial; font-size:12; color:black; font-weight:bold; text-decoration:none}
		a.TitleLinks:hover {text-decoration:underline}

		.ItemText {font-family:tahoma, verdana, helvetica, arial; font-size:11; color:black; font-weight:regular; text-decoration:none}
	
		body {background-color:white; font-family:tahoma, verdana, helvetica, arial; font-size:11; color:black; font-weight:regular; text-align:left}

		td {font-family:tahoma, verdana, helvetica, arial; font-size:11; font-weight:regular; text-decoration:none}

		.sm {font-family:tahoma, verdana, helvetica, arial; font-size:11}

		input, select, textarea {font-family:tahoma, verdana, helvetica, arial; font-size:11; color:black; border-width:1; border-color:black}

	</style>

	<script language="JavaScript">

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
				window.alert('Digite seu endereço de e-mail');
				document.sfriend.f1.focus();
				return false;
			}

			if(document.sfriend.f2.value=="")
			{
				window.alert('Digite o endereço de e-mail de seu amigo, por favor.');
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
			
			alert("Endereço de e-mail inválido, tente novamente!");
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

	</script>


</head>

<body topmargin=0>
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="19" background="images/l_bg.gif"><img src="images/l_bg.gif" width="10" height="17"></td>
    <td><table width="703" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td><table width="695" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="1" valign="top" background="images/t_bg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td><img src="images/t_spacer.gif" width="450" height="30"></td>
                    </tr>
                    <tr> 
                      <td height="39"><div align="center"> 
                          <table width="368" height="28" border="0" cellpadding="4" cellspacing="0">
                            <tr> 
                              <td><font color="#FFFFFF" size="2"><strong> 
                                <?=$aset[SiteName]?>
                                </strong></font></td>
                            </tr>
                          </table>
                        </div></td>
                    </tr>
                  </table></td>
                <td width="694"><img src="images/house.gif" width="350" height="170"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td><table width="797" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><a href="index.php"><img src="images/home.gif" width="107" height="26" border="0"></a></td>
                <td><a href="busca_avancada.php"><img src="images/search.gif" width="84" height="26" border="0"></a></td>
                <td><a href="entrar.php"><img src="images/login.gif" width="85" height="26" border="0"></a></td>
                <td><a href="cadastrar.php"><img src="images/register.gif" width="89" height="26" border="0"></a></td>
                <td><a href="contato.php"><img src="images/contact.gif" width="120" height="26" border="0"></a></td>
                <td><img src="images/t2.gif" width="315" height="26"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td valign="top" background="images/bg.gif"><table width="790" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="226" valign="top"><table width="100" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td><img src="images/forrent.gif" width="227" height="49"></td>
                    </tr>
                    <tr> 
                      <td><div align="center"> 
                          <?=$Categories?>
                          <br>
                          <?=$RandomProperty?>
                        </div></td>
                    </tr>
                    <tr> 
                      <td><p>&nbsp;</p></td>
                    </tr>
                  </table></td>
                <td width="564" valign="top"><div align="center"> 
                    <table width="491" height="100%" border="0" cellpadding="6" cellspacing="0">
                      <tr> 
                        <td width="479"><div align="center"><img src="images/bottom.gif" width="477" height="96"> 
                          </div></td>
                      </tr>
                      <tr> 
                        <td> <div align="center"> 
                            <?
				include_once("mostrar_banner.php"); 
			?>
                          </div></td>
                      </tr>
                      <tr> 
                        <td height="100%"><div align="center"> 
                            <p>
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							</p>
                          </div></td>
                      </tr>
                    </table>
                    <br>
                  </div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td background="images/bot.gif"><table width="784" border="0" cellspacing="0" cellpadding="6">
              <tr> 
                <td width="235" height="31"><font color="#FFFFFF"><strong>Copyright 
                  2005. Powered By <a href="mailto:moisbach@gmail.com">MoisBach</a>
                  </strong></font></td>
                <td width="525"><a href="index.php" class="CatLinks">Principal</a> 
                  | <a href="busca_avancada.php" class="CatLinks">Busca avançada</a> | <a href="entrar.php" class="CatLinks">Entrar</a> 
                  | <a href="cadastrar.php" class="CatLinks">Cadastro</a> | <a href="contato.php" class="CatLinks">Contato 
                  </a> | <a href="controle.php" class="CatLinks">Controle</a> 
                  | <a href="condicoes.php" class="CatLinks">Condições de uso</a></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
    <td background="images/r_bg.gif"><img src="images/r_bg.gif" width="10" height="17"></td>
  </tr>
</table>
<p align="center">&nbsp;</p>
</body>

</html>