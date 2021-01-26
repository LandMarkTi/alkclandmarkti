<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");



if($_POST){




$id_ped=(int)$_SESSION['cid'];
$id_f=(int)$_POST['reg'];

$reg=$id_f;

$mc=addslashes(strip_tags($_POST['mc']));


$email=addslashes(strip_tags($_POST['email']));

$tel=addslashes(strip_tags($_POST['tel']));

$cel=addslashes(strip_tags($_POST['cel']));

$resp=addslashes(strip_tags($_POST['resp']));

$end=addslashes(strip_tags($_POST['end']));

$vcp=addslashes(strip_tags($_POST['vcp']));

$cep=addslashes(strip_tags($_POST['cep']));

if(isset($_POST['leitor'])==TRUE)$leitor='
Pedido com 1 leitor de Microchip
';

$mensagemHTML = "
Alerta do sistema ALKC:


Nova solicitação de microchip !

Quantidade:  $reg

$leitor

Responsável: $resp

CPF: $vcp

Email $email

Telefone: $tel

Celular: $cel

Endereço : $end

Cep : $cep

";






//$pp=mysql_query("UPDATE pedigree set  `nº microchip`='$m' where id_ped=".$id_ped) or die('echip');



$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: contato@megapedigree.com\n"; // remetente
$headers .= "Return-Path: info@petweball.com.br\n"; // return-path
//$envio = mail("debora@neoware.com.br", "$assunto", "$mensagemHTML", $headers);
$envio = mail('gerencial@anilhascapri.com.br', "Novo Pedido Alkc", "$mensagemHTML", $headers,'-rcontato@megapedigree.com');
//$envio = mail('suporte@alkc.com.br', "Novo Pedido Alkc", "$mensagemHTML", $headers,'-rcontato@megapedigree.com');

$qi=mysql_query("insert into chip_pedido values ('', $id_ped, $id_f , ".time().", 0, '$email', '$tel', '$resp','$end','$cel','$vcp','$cep')");
die("<meta http-equiv='Content-Type' content='text/html; charset=utf-8'><script>alert('Solicitação enviada, aguarde o contato.');location='index_principal.php';</script>");



}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle  .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Solicitar Microchip :
          	
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;"><form action="#" method="post" >
			<table width="100%" border="0" cellspacing="6" cellpadding="0"><input type="hidden" name="id_ped" value="<?=$id_ped;?>"><input type="hidden" name="id_f" value="<?=$id_f;?>">
			
   <?php  

$qcr=mysql_query("select * from criadores where id_criador=".$_SESSION['cid']);

$lcr=mysql_fetch_assoc($qcr);

//tipo




if(0){//trim($mc[$id_f-4])==''

echo "Microchip não encontrado!";

} else {
?>




 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Quantidade:</label></td>
    				<td><input type="number" id="qtd" name="reg" value="1"> R$ 15,00 cada</td>
		</tr>  
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Valor:</label></td>
    				<td ><input value="15" id="mult" readonly></td>
		</tr> 

              <tr style="display:none">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Leitor :</label></td>
    				<td ><input type="checkbox" value="add" name="leitor"> Adicionar o leitor de Microchip Por R$ 650,00 (Promocional)</td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Dados para contato:</label></td>
    				<td></td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Responsável:</label></td>
    				<td><input name="resp" value="<?=$lp['criador']?>"></td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >CPF:</label></td>
    				<td><input name="vcp" id="cepe" value="" placeholder="000.000.000-00" required></td>
		</tr>  
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Telefone: </label></td>
    				<td><input name="tel" value="<?=$lcr['ddd'].' '.$lcr['fone_res']?>"></td>
		</tr> 

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Celular: </label></td>
    				<td><input name="cel" value="<?=$lcr['ddd'].' '.$lcr['fone_com']?>"></td>
		</tr> 
 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Email:</label></td>
    				<td><input name="email" value="<?=$lcr['email']?>"></td>
		</tr> 

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Endereço:</label></td>
    				<td><input name="end" value=" "></td>
		</tr>    



              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Cep:</label></td>
    				<td><input name="cep" value="" placeholder="00000-000"><br>Frete a combinar,dependendo da localização.<br></td>
		</tr>    

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>

                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td><input type="submit" name="enviar" value="voltar" onclick="location='index_principal.php';return false;"><input type="submit"  value="Enviar"></td>
		</tr>    
  
 <?php }?>
</table></form>
         </div>
            </div>
         </div>
         
        </div>
    </div>
    <script>$('#qtd').change(function(){var qt=this.value;$('#mult').val(qt*15);});
	$('#qtd').keyup(function(){var qt=this.value;$('#mult').val(qt*15);});


function vc(str){
    str = str.replace('.','');
    str = str.replace('.','');
    str = str.replace('-','');
 
    cpf = str;
    var numeros, digitos, soma, i, resultado, digitos_iguais;
    digitos_iguais = 1;
    if (cpf.length < 11)
        return false;
    for (i = 0; i < cpf.length - 1; i++)
        if (cpf.charAt(i) != cpf.charAt(i + 1)){
            digitos_iguais = 0;
            break;
        }
    if (!digitos_iguais){
        numeros = cpf.substring(0,9);
        digitos = cpf.substring(9);
        soma = 0;
        for (i = 10; i > 1; i--)
            soma += numeros.charAt(10 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0)){alert('CPF é Obrigatório!');return false;}
        numeros = cpf.substring(0,10);
        soma = 0;
        for (i = 11; i > 1; i--)
            soma += numeros.charAt(11 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1)){alert('CPF é Obrigatório!');return false;}
        return true;
    }
    else{alert('CPF é Obrigatório!');return false;}
}
$('#cepe').blur(function(){
var cepe=$('#cepe').val();
//cepe=cepe.replace('.','');
//cepe=cepe.replace('-','');
if (vc(cepe)==false)$('#cepe').val('');

});

	</script>
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
