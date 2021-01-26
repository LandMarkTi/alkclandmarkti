<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");



if($_POST){




$id_ped=(int)$_SESSION['cid'];



$nome=addslashes(strip_tags($_POST['resp']));


$email=addslashes(strip_tags($_POST['email']));

$cpj=addslashes(strip_tags($_POST['cpj']));

$rg=addslashes(strip_tags($_POST['rg']));

$tel_fixo=addslashes(strip_tags($_POST['tel']));

$cel=addslashes(strip_tags($_POST['cel']));

$adr=addslashes(strip_tags($_POST['adr']));

$racas=addslashes(strip_tags($_POST['racas']));

$estado=addslashes(strip_tags($_POST['estado']));


$cidade=addslashes(strip_tags($_POST['cidade']));


$kg_a=(int)$_POST['kga'];


$kg_f=(int)$_POST['kgf'];


$padrinhadores=(int)$_POST['padrinhadores'];

$matrizes=(int)$_POST['matrizes'];

$obs=addslashes(strip_tags($_POST['obs']));

$time=time();

$qr_i="INSERT INTO `pur_pedido`  VALUES ('', '$id_ped', '$nome', '$email', '$cpj', '$rg', '$tel_fixo', '$cel', '$adr', '$estado','$cidade', '$racas', '$kg_a', '$kg_f', '$padrinhadores', '$matrizes', '$time', '-1');";


$r=mysql_query($qr_i);







//$pp=mysql_query("UPDATE pedigree set  `nº microchip`='$m' where id_ped=".$id_ped) or die('echip');



$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: contato@megapedigree.com\n"; // remetente
$headers .= "Return-Path: info@petweball.com.br\n"; // return-path
$dt=date("d/m/Y");
$envio = mail('rodrigo.braite@akron-gsp.com.br', "Projeto criador", "Novo cadastro no painel ALKC $dt ", $headers,'-rcontato@megapedigree.com');
//$envio = mail('suporte@alkc.com.br', "Novo Pedido Alkc", "$mensagemHTML", $headers,'-rcontato@megapedigree.com');

//$qi=mysql_query("insert into chip_pedido values ('', $id_ped, $id_f , ".time().", 0, '$email', '$tel', '$resp','$end','$cel','$vcp','$cep')");
die("<meta http-equiv='Content-Type' content='text/html; charset=utf-8'><script>alert('Solicitação enviada.');location='index_principal.php';</script>");



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
    	<div id="internas_principal" style="border: 1px solid #ea078d;background-color:darkslateblue">
    	  <div class="arial_branco20" id="internas_titulo" style="background-color: #ea078d;">&nbsp;&nbsp;Projeto Criador :
          	<img src="euk3.png" style="float:right;height:26px">
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;"><form action="#" method="post" >
			<table width="100%" border="0" cellspacing="6" cellpadding="0"><input type="hidden" name="id_ped" value="<?=$id_ped;?>"><input type="hidden" name="id_f" value="<?=$id_f;?>">
			
   <?php  

$qcr=mysql_query("select * from criadores where id_criador=".$_SESSION['cid']);

$lcr=mysql_fetch_assoc($qcr);

//tipo

$cpf=explode(',',$lcr['cpf']);
$cpf=$cpf['0'];

$rg=explode(',',$lcr['RG']);
$rg=$rg['0'];

if(0){//trim($mc[$id_f-4])==''

echo "Microchip não encontrado!";

} else {
?>



              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td><br></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12 bigg" >Criador:</label></td>
    				<td><input name="resp" value="<?=$lcr['nome']?>" class=" bigg czzz"required></td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12 bigg" >Email:</label></td>
    				<td><input name="email" value="<?=$lcr['email']?>" class=" bigg czzz"required></td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12 bigg" >CPF/CNPJ:</label></td>
    				<td><input name="cpj" value="<?=$cpf?>" class=" bigg czzz"required></td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12 bigg" >RG:</label></td>
    				<td><input name="rg" value="<?=$rg?>" class=" bigg czzz" ></td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12 bigg" >Tel. Fixo:</label></td>
    				<td><input name="tel" value="<?=$lcr['fone_res']?>" class=" bigg czzz" required></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12 bigg" >Celular:</label></td>
    				<td><input name="cel" value="<?=$lcr['fone_com']?>" class=" bigg czzz" required></td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12 bigg" >Endereço:</label></td>
    				<td><input name="adr" value="<?=$lcr['End_residencial']?>" class=" bigg czzz" required></td>
		</tr> <input name="estado" type="hidden" value="<?=$lcr['estado']?>"><input name="cidade" type="hidden" value="<?=$lcr['cidade']?>">



              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12 bigg" >Raças:</label></td>
    				<td><textarea name="racas" cols="20" rows="3" style="font-size: 18px;color: gray;"></textarea></td>
		</tr>  
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12 bigg" >Consumo no mês:</label></td>
    				<td > </td>
		</tr> 
 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12 bigg" >Adulto</label></td>
    				<td > <input type="number" placeholder="KG" name="kga" class=" bigg czzz" required></td>
		</tr> 
 
 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12 bigg" >Filhote</label></td>
    				<td > <input type="number" placeholder="KG" name="kgf" class=" bigg czzz" required></td>
		</tr> 
 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12 bigg" >Padreadores:</label></td>
    				<td><input name="padrinhadores" type="number" class=" bigg czzz" required></td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12 bigg" >Matrizes:</label></td>
    				<td><input name="matrizes" type="number" value="" class=" bigg czzz" required></td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12 bigg" >Obs:</label></td>
    				<td><textarea name="obs" cols="20" rows="6" style="font-size: 18px;color: darkgray;"></textarea></td>
		</tr>  
             

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>

                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td><!--input type="submit" name="enviar" value="voltar" onclick="location='index_principal.php';return false;" class="btss"--> <input type="submit"  value="Enviar" class="btss" style="margin-left:96px"></td>
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
<style>
.bigg{font-size: 18px;padding: 3px;color: white;}
.czzz{color: gray;}




.btss{
padding: 12px;
    color: white;
    background-color: #ea078d;
    border: 1px solid;

}
</style>
</body>
</html>
