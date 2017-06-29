<?php
		  require_once("configuracao_mysql.php");
require_once("includes.php");
?>
<style type="text/css">
<!--
.style6 {color: #000000}
body {
	background-color: #FFFFFF;
}
-->
</style>

<TR>
  <TD> 
    <div align="center">
      <div align="center">      </div>
      <div align="left"></div>
    </div>
    <div align="center">
      <p>&nbsp;</p>
      <table width="453" border="0">
        <tr>
          <td width="447"><?php
if (!$nome || !$email || !$assunto || !$mensagem) {
  echo "<DIV align=center><p align=center><font face=Verdana size=3 color=#003366><B>Alguma coisa está faltando, preencha todos os campos corretamente.</B><br><br><br>";
  echo "<a href=\"javascript:history.back(1)\">Voltar</a>";
 }else{
 echo "
                    <tr> 
                      <TD height=22 colspan=3> <p align=center><font face=Verdana size=1>Obrigado 
                          <font color=#FF0000><b>$nome</b></font>,</font> 
                      </TD>
                    </tr>
                    <TR> 
                      <TD height=22 colspan=3> <p align=center><font face=Verdana size=1>as 
                          suas informações foram enviadas com sucesso. Em 
                          breve entraremos em contato com a sua resposta.</font> </TD>
                    </TR>
                  
                    <tr> 
                      </TD>
                    </tr>";
 $mens = "<font size=2 face=Verdana><p align=center>AnimaBusca<br><br></p></font>";
 $mens .= "<font size=1 face=Verdana><b>Nome:</b> $nome</font><br><br>";
 $mens .= "<font size=1 face=Verdana><b>E-mail:</b> $email</font><br>";
 $mens .= "<font size=1 face=Verdana><b>Assunto:</b> $assunto</font><br>";
 $mens .= "<font size=1 face=Verdana><b>Mensagem:</b> $mensagem</font><br><br>";

/*
//send an email to the admin
		$to = $aset[ContactEmail];
		$subject = "FALE CONOSCO";
		$message = "Um cliente selecionou um pacote no site e pediu a ativação de sua conta\nVeja os detalhes:\n\n";
		$message .= "Nome de usuário: $a1[username]\nNome real: $a1[FirstName] $a1[LastName]\nPacote selecionado: $a2[PackageName] $a2[PriorityName], $a2[Duration] meses, $a2[offers] anúncios\n\n";

		$headers = "MIME-Version: 1.0\n"; 
		$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
		$headers .= "Content-Transfer-Encoding: 8bit\n"; 
		$headers .= "From: $_SERVER[HTTP_HOST] <$aset[ContactEmail]>\n"; 
		$headers .= "X-Priority: 1\n"; 
		$headers .= "X-MSMail-Priority: High\n"; 
		$headers .= "X-Mailer: PHP/" . phpversion()."\n"; 

		mail($to, $subject, $message, $headers);		*/


 $headers = "MIME-Version: 1.0\r\n";
 $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
 $headers .= "From: $email";
 //$headers .= "From: 'Atendimento'\r\n";
 		$to = $aset[ContactEmail];
	mail($to, $assunto, $mens, $headers);	
  
echo "                    <TR> 
                      <TD height=13> </TD>
                      <TD></TD>
                      <TD></TD>
                    </TR>
                    <TR>
                      <TD height=12></TD>
                      <TD></TD>
                    </TR>";
					}
					?>
					</td>
        </tr>
      </table>
      <p style="background-color: #FFFFFF">&nbsp;</p>
    </div>
    <p align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <b> 
    </b></font></p>
  </TD>
</TR>