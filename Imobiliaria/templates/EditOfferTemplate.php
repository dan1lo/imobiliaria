<form method=post enctype="multipart/form-data" name=PostForm onsubmit="return CheckOffer();">
<table align=center width=416>
<caption align=center><font color=black face=verdana size=2><b>Novo anúncio</b></font></caption>
<tr>
  <td align=right>Categoria:</td>
	<td width=270><?=$SelectCategory?></td>
</tr>

<tr>
  <td align=right>Endere&ccedil;o:</td>
	<td><input type=text name=address value="<?=$ap[address]?>"></td>
</tr>

<tr>
  <td align=right>Cidade:</td>
	<td><input type=text name=city value="<?=$ap[city]?>"></td>
</tr>

<tr>
  <td align=right>Estado:</td>
	<td><input type=text name=state value="<?=$ap[state]?>"></td>
</tr>

<tr>
  <td align=right>Pa&iacute;s:</td>
	<td><?=$SelectCountry?></td>
</tr>

<tr>
  <td align=right valign=top>Breve descri&ccedil;&atilde;o:</td>
	<td><textarea cols=40 rows=4 name=ShortDesc><?=$ap[ShortDesc]?></textarea></td>
</tr>

<tr>
  <td align=right valign=top>Descri&ccedil;&atilde;o detalhada:</td>
	<td><textarea cols=40 rows=4 name=DetailedDesc><?=$ap[DetailedDesc]?></textarea></td>
</tr>

<tr>
  <td align=right>Pre&ccedil;o:</td>
	<td><input type=text name=Price value="<?=$ap[Price]?>"> 
	<font face=verdana size=1 color=red><B>formato: 25000.00</b></font> </td>
</tr>

<tr>
  <td align=right valign=top>Informa&ccedil;&otilde;es sobre a vizinhan&ccedil;a:</td>
	<td><textarea cols=40 rows=4 name=neighbourhood><?=$ap[neighbourhood]?></textarea></td>
</tr>

<tr>
  <td align=right>Tipo de propriedade:</td>
	<td><?=ptypes($ap[PropertyType]);?></td>
</tr>

<tr>
  <td align=right>Quartos:</td>
	<td><?=$SelectRooms?></td>
</tr>

<tr>
  <td align=right>Banheiros:</td>
	<td><?=$SelectBathrooms?></td>
</tr>

<tr>
  <td align=right>Garagem:</td>
	<td><?=$SelectGarage?></td>
</tr>

<tr>
  <td align=right>Tamanho da casa (em m2):</td>
	<td><input type=text name=SquareMeters value="<?=$ap[SquareMeters]?>"> 
	<font face=verdana size=1 color=red><B>formato: 350.00</b></font> </td>
</tr>

<tr>
  <td align=right>Tamanho do lote (em m2):</td>
	<td><input type=text name=LotSize value="<?=$ap[LotSize]?>"> 
	<font face=verdana size=1 color=red><B>formato: 1250.00</b></font> </td>
</tr>

<tr>
  <td align=right>Idade da resid&ecirc;ncia:</td>
	<td>
		<select name=HomeAge>
			<option value=""></option>
			<?
			for($i = '1'; $i <= '250'; $i++)
			{
				if($ap[HomeAge] == $i)
				{
					echo "<option value=\"$i\" selected>$i</option>\n\t";
				}
				else
				{
					echo "<option value=\"$i\">$i</option>\n\t";
				}
			}
			?>
		</select>
	</td>
</tr>

<tr>
	<td align=right valign=top>Fotos:</td>
	<td><?=$images?></td>
</tr>

<tr>
  <td align=right>Tem lareira ou churrasqueira?</td>
  <td>
    <input type=radio name=fireplace value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=fireplace value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>Pr&oacute;ximo a escola?</td>
  <td>
    <input type=radio name=NearSchool value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=NearSchool value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>Pr&oacute;ximo do tr&acirc;nsito?</td>
  <td>
    <input type=radio name=NearTransit value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=NearTransit value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>Pr&oacute;ximo a parque ou pra&ccedil;a? </td>
  <td>
    <input type=radio name=NearPark value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=NearPark value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>Vista para o mar? </td>
  <td>
    <input type=radio name=OceanView value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=OceanView value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>Vista para um lago? </td>
  <td>
    <input type=radio name=LakeView value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=LakeView value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>Vista para uma montanha? </td>
  <td>
    <input type=radio name=MountainView value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=MountainView value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>De frente para o mar? </td>
  <td>
    <input type=radio name=OceanWaterfront value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=OceanWaterfront value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>De frente para um lago? </td>
  <td>
    <input type=radio name=LakeWaterfront value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=LakeWaterfront value="n" checked>
    n&atilde;o </td>
</tr>
<tr>
  <td align=right>De frente para um rio? </td>
  <td>
    <input type=radio name=RiverWaterfront value="y">
    sim &nbsp;&nbsp;&nbsp;
    <input type=radio name=RiverWaterfront value="n" checked>
    n&atilde;o </td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td>
		<input type=hidden name=OldImages value="<?=$ap[image]?>">
		<input type=submit name=s1 value="Enviar">
	</td>
</tr>

</table>
</form>