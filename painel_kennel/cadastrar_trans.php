<?php
session_start();
require_once("Connections/conexao.php");
if($_SESSION['login']=='')die("<script>location='index.php';</script>");
$idped=(int)$_GET['id_ped'];
$idf=(int)$_GET['id_f'];


$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$idped;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);

$nloop=explode(';', $linha_ped['ninhada']);
$micro=explode(';', $linha_ped['nº microchip']);

$mic=$micro[$idf-4];

$nome=$nloop[$idf];

$dif_nasc=time()-$linha_ped['nasc'];

$yy=date("Y",$dif_nasc);

$YY=$yy-1970;

$mm=date("m",$dif_nasc);

if($YY<1)$val='70.80';

if($YY>=1&&$YY<=8)$val='59.47';

if($YY>8)$val='idade';


//bloqueio sem vias

$q_serie=mysql_query("select * from ped_serie_a where id_ped=$idped and id_filhote=".($idf)." ");
$nss=mysql_num_rows($q_serie);
if($nss<1)die("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>alert('Falta imprimir a 1ª via do pedigree/tarjeta.');location='index_principal.php';</script>");



//bloqueio sem permissão id_ped sem o -

$jhb=mysql_query("select * from ped_print where id_ped='".$idped."' and id_f= '".($idf)."' order by id_perm desc limit 1") or die('ee2');
$lp=mysql_fetch_assoc($jhb);
$nrx=mysql_num_rows($jhb);

if ($nrx>=1 and $lp['tipo_perm']==1)die("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>alert('Pedigree Bloqueado.');location='index_principal.php';</script>");



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
    	  <div class="arial_branco20" id="internas_titulo">Nova transferência 
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form action="sucesso_trans_h4p2.php" method="post">
			<table width="100%" border="0" cellspacing="6" cellpadding="0" >
            
  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Novo Proprietário</label><input type="hidden"></td>
    				<td><input style="width: 490px;" name ="nome" type="text" class="forms" id="login"  required="required"/></td>
			  </tr>
                          <tr>
    				<td align="right"><label for="cpf" class="arial_cinza2_12" >CPF</label></td>
    				<td><input style="width: 490px;" data-mask="999.999.999-99" name ="cpf" type="text" class="forms"  id="cepe" required="required" /></td>
			  </tr>

			  <tr>
    				<td align="right"><label for="data_nascimento" class="arial_cinza2_12" >Data de Nascimento</label></td>
    				<td><input style="width: 490px;" name ="data_nascimento" type="date" class="forms"  required="required" /></td>
			  </tr>


			  <tr>
    				<td align="right"><label for="sexo" class="arial_cinza2_12" >Sexo</label></td>
    				<td><select name="sexo" class=""><option>selecione..</option><option>Masculino</option><option>Feminino</option></select></td>
			  </tr>


			  <tr style="display:none" class="adr">
    				<td align="right"><label for="endereco" class="arial_cinza2_12" >Endereço</label></td>
    				<td><input style="width: 490px;" name ="endereco" type="text" class="forms"  required="required" /></td>
			  </tr>

	  		<tr style="display:none" class="adr">
    				<td align="right"><label for="número" class="arial_cinza2_12" >Número</label></td>
    				<td><input style="width: 490px;" name ="número" type="text" class="forms"  required="required" /></td>
			  </tr>

  			<tr style="display:none" class="adr">
    				<td align="right"><label for="complemento" class="arial_cinza2_12" >Complemento</label></td>
    				<td><input style="width: 490px;" name ="complemento" type="text" class="forms"   /></td>
			  </tr>

  			<tr style="display:none" class="adr">
    				<td align="right"><label for="bairro" class="arial_cinza2_12" >Bairro</label></td>
    				<td><input style="width: 490px;" name ="bairro" type="text" class="forms"  required="required" /></td>
			  </tr>

			<tr style="display:none" class="adr">
    				<td align="right"><label for="cidade" class="arial_cinza2_12" >Cidade</label></td>
    				<td><input style="width: 490px;" name ="cidade" type="text" class="forms"  required="required" /></td>
			  </tr>
			<tr style="display:none" class="adr">
    				<td align="right"><label for="estado" class="arial_cinza2_12" >Estado</label></td>
    				<td><input style="width: 490px;" name ="estado" type="text" class="forms"  required="required" /></td>
			  </tr>

			<tr>
    				<td align="right"><label for="cep" class="arial_cinza2_12" >CEP</label></td>
    				<td><input style="width: 490px;" id="cep" name ="cep" type="text" class="forms"  required="required" onblur="getEndereco();"/></td>
			  </tr>
			<tr>
    				<td align="right"><label for="telefone" class="arial_cinza2_12" >Telefone</label></td>
    				<td><input style="width: 490px;" name ="telefone" type="text" class="forms"   /></td>
			  </tr>
			<tr>
    				<td align="right"><label for="celular" class="arial_cinza2_12" >Celular</label></td>
    				<td><input style="width: 490px;" name ="celular" type="text" class="forms"  required="required" /></td>
			  </tr>
	         	 <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Email</label></td>
    				<td><input style="width: 490px;" name ="el"  class="forms"  required="required" /><input type="hidden"  name="id_ped" value="<?php echo $idped;?>"><input type="hidden"  name="idf" value="<?php echo ($idf);?>"></td>
			  </tr>
  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" ></label></td>
    				<td><b>Dados do Cão:</b></td>
			  </tr>
  			  <tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Nome do cão</label></td>
    				<td><input style="width: 490px;" name ="nome_cao" type="text" value="<?=$nome?>" class="forms" id="cc"  required="required" <?php if($_SESSION['id']<>87) echo 'readonly';?>/></td>
			  </tr>
	  		<tr>
    				<td align="right"><label for="name" class="arial_cinza2_12" >Microchip</label></td>
    				<td><input style="width: 490px;" name ="mic" type="text" value="<?=$mic?>" class="forms" id="ccm"  /></td>
			  </tr>

	  		<tr>
    				<td align="right"><label for="s_atual" class="arial_cinza2_12" >Nº de Série do documento anterior</label></td>
    				<td><input style="width: 490px;" name ="s_atual" type="text" value="" class="forms" id="sm" placeholder="Está no canto direito inferior da folha" required="required"/></td>
			  </tr>
	  		<tr>
    				<td align="right"><label for="s_atual" class="arial_cinza2_12" >Nº de Série da transferência</label></td>
    				<td><input style="width: 490px;" name ="s_novo" type="text" value="" class="forms" id="sn" placeholder="reserve uma folha para imprimir o documento" required="required"/></td>
			  </tr>
              
             

          <tr>
                <td align="right">&nbsp;</td>
                <td>
 <br><input name="pc" type="hidden" value="<?=$val?>" ><input type="submit"><br>
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
