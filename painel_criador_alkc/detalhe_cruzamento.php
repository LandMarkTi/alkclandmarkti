<?php
session_start();
require_once("Connections/conexao.php");
if($_SESSION['login']=='')die("<script>location='index.php';</script>");
$idcop=(int)$_GET['id_cop'];



$sql1= "SELECT  *,(select registro from pedigree where id_ped=id_pai) as regpai,(select registro from pedigree where id_ped=id_mae) as regmae FROM  acasalamento JOIN subcategoria ON acasalamento.id_raca=subcategoria.idSubcategoria   WHERE id_cop='$idcop' and acasalamento.id_criador=$_SESSION[cid]";
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);

$nloop=explode(';', $linha_ped['ninhada']);
$micro=explode(';', $linha_ped['nº microchip']);

$mic=$micro[$idf-4];






?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
	<script src="../site/js/jquery.maskedinput.js"></script>
	<!--script src="../site/cep.js"></script-->
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>
<style>
select {    padding: 5px;
    height: 42px;
    margin: 10px;}
</style>
<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Detalhes
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form action="adicionar_pedigree_s.php" method="get">
			<table width="100%" border="0" cellspacing="6" cellpadding="0" >
            
  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Pai</label></td>
    				<td><input style="width: 490px;" name ="nome" type="text" class="forms" id="login"  value="<?=$linha_ped['regpai'].($linha_ped['f_pai']-4);?>"/></td>
			  </tr>

            
  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Mãe</label></td>
    				<td><input style="width: 490px;" name ="nome" type="text" class="forms" id="login"  value="<?=$linha_ped['regmae'].($linha_ped['f_mae']-4);?>"/></td>
			  </tr>

  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Tentativas</label></td>
    				<td><input style="width: 490px;" name ="nome" type="text" class="forms" id="login"  value="<?=$linha_ped['tentativas'];?>"/></td>
			  </tr>

			  <tr>
    				<td align="right"><label for="data_nascimento" class="arial_cinza2_12" >Data Sucesso</label></td>
    				<td><input style="width: 490px;" name ="data_nascimento"  class="forms"  value="<?if($linha_ped['dt_sucesso']>0)echo date('d/m/Y',$linha_ped['dt_sucesso']);?>" readonly="readonly"/></td>
			  </tr>


			  <tr>
    				<td align="right"><label for="data_nascimento" class="arial_cinza2_12" >Detalhes</label></td>
    				<td><input style="width: 490px;" name ="detalhes"  class="forms"  value="<?=$linha_ped['detalhes']?>" /></td>
			  </tr>

<input type="hidden" name="p1" value="<?=$linha_ped['p1'];?>">
		

<input type="hidden" name="p2" value="<?=$linha_ped['p2'];?>">
		
              

<input type="hidden" name="r" value="<?=$linha_ped['id_raca'];?>">
		             

          <tr>
                <td align="right">&nbsp;</td>
                <td>
 <br><input type="submit" value="Cadastrar Ninhada" onclick="return $('input:lt(5)').remove();"> <br>

 <br><input type="submit" value="Salvar Dados" onclick="return false;"> <br>
                </td>            
              </tr>
              
			</table>
  			</form>
           </div>
            </div>
         </div>
         
        </div>
    </div>
    <script>
   $("input[name=cpf]").mask("999.999.999-99");
   //$("input[name=data_nascimento]").mask("99/99/9999");
   $("input[name=cep]").mask("99999-999");
$('input[name=telefone]').mask("(99) 9999-9999?");
$('input[name=celular]').mask("(99) 9999-99999")


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
if (vc(cepe)==false)$('#cepe').val('').focus();

});

$('.adr').show();
</script>     </div>
</div>
<?php include "footer.php";?>
</body>
</html>
