<?
#########################################################
#Copyright © e-Mobiliária. Todos os direitos reservados.#
#########################################################
#                                                       #
#  Programa        : e-Mobiliária PHP                   #
#  Autor           : Moisés Bach B.                     #
#  E-mail          : moisbach@gmail.com                 #
#  Versão          : 2.5                                #
#  Modificado em   : 09/12/2005                         #
#  Copyright ©     : e-Mobiliária                       #
#                 WWW.ANIMABUSCA.COM/IMOBILIARIA        #
#########################################################
#ESTE SCRIPT NÃO PODE SER COPIADO SEM AUTORIZAÇÃO PRÉVIA#
#########################################################

require_once("configuracao_mysql.php");

if(isset($_POST[s1]))
{
	if(!empty($_FILES[images][name][0]))
	{
		while(list($key,$value) = each($_FILES[images][name]))
		{
			if(!empty($value))
			{
				$NewImageName = $t."_offer_".$value;
				copy($_FILES[images][tmp_name][$key], "fotos_anuncios/".$NewImageName);

				$MyImages[] = $NewImageName;
			}
		}

		if(!empty($MyImages))
		{
			$ImageStr = implode("|", $MyImages);
		}

	}

	$catInfo = explode("|", $_POST[SelectCategory]);
	$CategoryID = $catInfo[0];
	$SubcategoryID = $catInfo[1];

	$q1 = "insert into re2_listings set 
					AgentID = '$_SESSION[AgentID]',
					CategoryID = '$CategoryID',
					SubcategoryID = '$SubcategoryID',
					address = '$_POST[address]',
					city = '$_POST[city]',
					state = '$_POST[state]',
					country = '$_POST[country]',
					ShortDesc = '$_POST[ShortDesc]',
					DetailedDesc = '$_POST[DetailedDesc]',
					neighbourhood = '$_POST[neighbourhood]',
					Price = '$_POST[Price]',
					PropertyType = '$_POST[PropertyType]',
					rooms = '$_POST[rooms]',
					bathrooms = '$_POST[bathrooms]',
					fireplace = '$_POST[fireplace]',
					garage = '$_POST[garage]',
					SquareMeters = '$_POST[SquareMeters]',
					LotSize = '$_POST[LotSize]',
					HomeAge = '$_POST[HomeAge]',
					NearSchool = '$_POST[NearSchool]',
					NearTransit = '$_POST[NearTransit]',
					NearPark = '$_POST[NearPark]',
					OceanView = '$_POST[OceanView]',
					LakeView = '$_POST[LakeView]',
					MountainView = '$_POST[MountainView]',
					OceanWaterfront = '$_POST[OceanWaterfront]',
					LakeWaterfront = '$_POST[LakeWaterfront]',
					RiverWaterfront = '$_POST[RiverWaterfront]',
					image = '$ImageStr',
					DateAdded = '$t' ";

	mysql_query($q1);

}

header("location:controle.php");
exit();

?>