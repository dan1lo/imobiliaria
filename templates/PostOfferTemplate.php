<form method=post action="anunciar2.php" enctype="multipart/form-data" name=PostForm onsubmit="return CheckOffer();">
<table align=center width=400>
<caption align=center>
    <font color=black face=verdana size=2><b>Cadastro de propriedades </b></font> 
    </caption>
<tr>
	<td align=right>Categoria:</td>
	<td><?=$SelectCategory?></td>
</tr>

<tr>
	<td align=right>Endere&ccedil;o:</td>
	<td><input type=text name=address></td>
</tr>

<tr>
	<td align=right>Cidade:</td>
	<td><input type=text name=city></td>
</tr>

<tr>
	  <td align=right>Estado:</td>
	  <td><input type=text name=state></td>
</tr>

<tr>
	<td align=right valign=top>Breve descri&ccedil;&atilde;o:</td>
	<td><textarea cols=40 rows=4 name=ShortDesc></textarea></td>
</tr>

<tr>
	<td align=right valign=top>Descri&ccedil;&atilde;o detalhada:</td>
	<td><textarea cols=40 rows=4 name=DetailedDesc></textarea></td>
</tr>

<tr>
	<td align=right>Pre&ccedil;o:</td>
	<td><input type=text name=Price> 
	<font face=verdana size=1 color=red><B>formato: 25000.00</b></font> </td>
</tr>

<tr>
	<td align=right valign=top>Informa&ccedil;&otilde;es sobre a vizinhan&ccedil;a:</td>
	<td><textarea cols=40 rows=4 name=neighbourhood></textarea></td>
</tr>

<tr>
	<td align=right>Tipo de propriedade:</td>
	<td><?=ptypes("0");?></td>
</tr>

<tr>
	<td align=right>Quartos:</td>
	<td>
		<select name=rooms>
			<option value=""></option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
		</select>
	</td>
</tr>

<tr>
	<td align=right>Banheiros:</td>
	<td>
		<select name=bathrooms>
			<option value=""></option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
		</select>
	</td>
</tr>

<tr>
	<td align=right>Garagem:</td>
	<td>
		<select name=garage>
			<option value=""></option>
			<option value="1">1 carro</option>
			<option value="2">2 carros</option>
			<option value="3">3 carros</option>
			<option value="4">4 carros</option>
			<option value="5">5 carros</option>
		</select>
	</td>
</tr>

<tr>
	  <td align=right>Tamanho da casa (em m2):</td>
	  <td><input type=text name=SquareMeters> 
	  <font face=verdana size=1 color=red><B>formato: 350.00</b></font> </td>
</tr>

<tr>
	<td align=right>Tamanho do lote (em m2):</td>
	<td><input type=text name=LotSize> 
	<font face=verdana size=1 color=red><B>formato: 1250.00</b></font> </td>
</tr>

<tr>
	<td align=right>Idade da resid&ecirc;ncia :</td>
	<td>
		<select name=HomeAge>
			<option value=""></option>
			<?
			for($i = '1'; $i <= '250'; $i++)
			{
				echo "<option value=\"$i\">$i</option>\n\t";
			}
			?>
		</select>
	</td>
</tr>

<tr>
	<td align=right valign=top>Fotos:</td>
	<td>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
		<input type=file name="images[]"><br>
	</td>
</tr>

<tr>
	<td align=right>Tem lareira ou churrasqueira?</td>
	<td>
		<input type=radio name=fireplace value="y">sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=fireplace value="n" checked>não
	</td>
</tr>

<tr>
	<td align=right>Pr&oacute;ximo a escola?</td>
	<td>
		<input type=radio name=NearSchool value="y">sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=NearSchool value="n" checked>não
	</td>
</tr>

<tr>
	<td align=right>Pr&oacute;ximo do tr&acirc;nsito?</td>
	<td>
		<input type=radio name=NearTransit value="y">sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=NearTransit value="n" checked>não
	</td>
</tr>

<tr>
	<td align=right>Pr&oacute;ximo a parque ou pra&ccedil;a? </td>
	<td>
		<input type=radio name=NearPark value="y">sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=NearPark value="n" checked>não
	</td>
</tr>

<tr>
	<td align=right>Vista para o mar? </td>
	<td>
		<input type=radio name=OceanView value="y">sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=OceanView value="n" checked>não
	</td>
</tr>

<tr>
	<td align=right>Vista para um lago? </td>
	<td>
		<input type=radio name=LakeView value="y">sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=LakeView value="n" checked>não
	</td>
</tr>

<tr>
	<td align=right>Vista para uma montanha? </td>
	<td>
		<input type=radio name=MountainView value="y">sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=MountainView value="n" checked>não
	</td>
</tr>

<tr>
	<td align=right>De frente para o mar? </td>
	<td>
		<input type=radio name=OceanWaterfront value="y">sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=OceanWaterfront value="n" checked>não
	</td>
</tr>

<tr>
	<td align=right>De frente para um lago? </td>
	<td>
		<input type=radio name=LakeWaterfront value="y">sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=LakeWaterfront value="n" checked>não
	</td>
</tr>

<tr>
	<td align=right>De frente para um rio? </td>
	<td>
		<input type=radio name=RiverWaterfront value="y">sim &nbsp;&nbsp;&nbsp;
		<input type=radio name=RiverWaterfront value="n" checked>não
	</td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><input type=submit name=s1 value="Cadastrar"></td>
</tr>

</table>
</form>