

<form method=POST action="busca_avancada.php">

<table align=center width=500>
<caption align=center><font size=2><b>Busca avançada</b></font></caption>

<tr>
	<td>Pre&ccedil;o:</td>
	<td><?=$MinPrice?></td>
	<td><?=$MaxPrice?></td>
	<td align=right><div align="left">Pr&oacute;ximo a escola?</div></td>
	<td><input name=NearSchool type=checkbox value="y"></td>
</tr>

<tr>
	<td>Quartos:</td>
	<td><?=$MinBed?></td>
	<td><?=$MaxBed?></td>
	<td align=right><div align="left">Pr&oacute;ximo do tr&acirc;nsito?</div></td>
	<td><input name=NearTransit type=checkbox value="y"></td>
</tr>

<tr>
	<td>Banheiros:</td>
	<td><?=$MinBath?></td>
	<td><?=$MaxBath?></td>
	<td align=right><div align="left">Pr&oacute;ximo a parque ou pra&ccedil;a? </div></td>
	<td><input name=NearPark type=checkbox value="y"></td>
</tr>

<tr>
	<td>Tipo de propriedade:</td>
	<td colspan=2><?=$TypeMenu?></td>
	<td align=right><div align="left">Vista para o mar? </div></td>
	<td><input name=OceanView type=checkbox value="y"></td>
</tr>

<tr>
	<td>Anunciado por :</td>
	<td colspan=2><?=$AgentsMenu?></td>
	<td align=right><div align="left">Vista para um lago? </div></td>
	<td><input name=LakeView type=checkbox value="y"></td>
</tr>

<tr>
	<td>Mostrar an&uacute;ncio:</td>
	<td colspan=2>
		<select name=old>
			<option value="">Todos os anúncios</option>
			<option value="1 day">1 dia atrás</option>
			<option value="2 days">2 dias atrás</option>
			<option value="3 days">3 dias atrás</option>
			<option value="1 week">1 semana atrás</option>
			<option value="1 month">1 mês atrás</option>
		</select>	
	</td>
	<td align=right><div align="left">Vista para uma montanha? </div></td>
	<td><input name=MountainView type=checkbox value="y"></td>
</tr>


<tr>
	<td>Cidade:</td>
	<td colspan=2><?=$CityMenu?></td>
	<td align=right><div align="left">De frente para o mar? </div></td>
	<td><input name=OceanWaterfront type=checkbox value="y"></td>
</tr>


<tr>
	<td>Estado:</td>
	<td colspan=2><?=$StateMenu?></td>
	<td align=right><div align="left">De frente para um lago? </div></td>
	<td><input name=LakeWaterfront type=checkbox value="y"></td>
</tr>

<tr>
	<td>Pa&iacute;s:</td>
	<td colspan=2><?=$CountryMenu?></td>
	<td align=right><div align="left">De frente para um rio? </div></td>
	<td><input name=RiverWaterfront type=checkbox value="y"></td>
</tr>

<tr>
	<td colspan=2>&nbsp;</td>
	<td colspan=3><input type=submit name=s1 value="Procurar anúncios"></td>
</tr>

</table>

</form>