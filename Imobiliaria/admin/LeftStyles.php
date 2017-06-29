<?
/*
function ptypes($x) {

	$qt = "select * from re2_types order by TypeName";
	$rt = mysql_query($qt) or die(mysql_error());

	if(mysql_num_rows($rt) > '0')
	{
		$SelectType = "<select name=PropertyType>\n\t<option value=\"\">\n\t";

		while($at = mysql_fetch_array($rt))
		{
			if(!empty($x))
			{
				if($at[TypeName] == $x)
				{
					$SelectType .= "<option value=\"$at[TypeName]\" selected>$at[TypeName]</option>\n\t";
				}
				else
				{
					$SelectType .= "<option value=\"$at[TypeName]\">$at[TypeName]</option>\n\t";
				}
			}
			else
			{
				$SelectType .= "<option value=\"$at[TypeName]\">$at[TypeName]</option>\n\t";
			}
		}

		$SelectType .= "</select>";
	}

	return $SelectType;

}
*/
?>
	
	<html>
	<head>
		<title>Painel de administração</title>

		<style>
			body {background-color:white; font-family:verdana; font-size:11}
			td {font-family:verdana; font-size:11}
			
			input, select, textarea {border-width:1; border-color:black;font-family:verdana; font-size:11}

			.sub {background-color:#336699; font-family:verdana; color:white; font-size:11; font-weight:bold; border-width:1; border-color:black}

			.TableHead {background-color:#336699; font-family:verdana; color:white; font-size:11; font-weight:bold;}

			.RedLink {font-family:verdana; color:red; font-size:11; font-weight:bold; text-decoration:none}
			a.RedLink:hover {text-decoration:underline}

			.GreenLink {font-family:verdana; color:green; font-size:11; font-weight:bold; text-decoration:none}
			a.GreenLink:hover {text-decoration:underline}

			.BlackLink {font-family:verdana; color:black; font-size:11; font-weight:bold; text-decoration:none}
			a.BlackLink:hover {text-decoration:underline}

		</style>

	<script>

		function CheckOffer() {

			if(document.PostForm.AgentID.value=="")
			{
				alert('Selecione um agente!');
				document.PostForm.AgentID.focus();
				return false;
			}

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

	<body>