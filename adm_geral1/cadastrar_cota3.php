<?php
session_start();
if($_SESSION['login']!='sergio@sobraci.org')die("<script>location='index.php';</script>");
require_once("Connections/conexao.php");
$sql = "SELECT  *  FROM  `credenciado` join dados_credenciado on credenciado.id_credenciado=dados_credenciado.id_dados   WHERE id_credenciado > 85 ";

$query = mysql_query($sql) or die(mysql_error());
$sel='';
while($opt=mysql_fetch_assoc($query))$sel.='<option value="'.$opt['id_credenciado'].'">'.$opt['nome'].'</option>';
$sel.='';

if($_POST){


$sql_list="INSERT INTO `ped_serie_cert` (`id_serie`, `id_credenciado`, `id_ped`, `id_filhote`, `numero_serie`, `tipo_serie`, `status`, `data_add`) VALUES ";


$i=0;

$nucleo=(int)$_POST['nid'];

$serial=(int)$_POST['ini'];
$tipo=(int)$_POST['tipo'];
$tot=(int)$_POST['tot'];
$fim=(int)$_POST['fim'];

while($i<$tot){$sql_list.="(NULL, '$nucleo', '', '', '".($serial+$i)."', '$tipo', 'livre', '0'),";$i++;}

mysql_query(substr($sql_list,0,-1)) or die ('erro servidor');

$alert="alert('dados enviados.');";

}


?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle" /> 
<meta name="Description" content="Painel de Controle"/> 
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Adicionar cota certificado
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form action="cadastrar_cota3.php" method="post">
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr>
    				<td align="right"><label for="nome" class="arial_cinza2_12" >Credenciado</label></td>
    				<td><select name="nid"><option value="">Escolha um kennel...</option><?php echo $sel;?></select></td>
			  </tr>
			  <tr>
    				<td align="right"><label for="nome" class="arial_cinza2_12" >Tipo</label></td>
    				<td><select name="tipo"  class="forms" id="nome"  required="required"/>
				<option value="1">
				Certificado
				</option>

				</select></td>
			  </tr>

			  <tr>
    				<td align="right"><label for="nome" class="arial_cinza2_12" >inicio</label></td>
    				<td><input name="ini" type="number" class="forms" id="ini" size="85" required="required" onblur="$('#tot,#fim').val('');"/></td>
			  </tr>
			  <tr>
    				<td align="right"><label for="nome" class="arial_cinza2_12" >Final</label></td>
    				<td><input name="fim" type="number" class="forms" id="fim" size="85" required="required" onblur="up_valor();"/><button value="ok" onclick="return false">OK</button></td>
			  </tr>
			  <tr>
    				<td align="right"><label for="nome" class="arial_cinza2_12" >Total</label></td>
    				<td><input name="tot" type="number" class="forms" id="tot" size="85" placeholder="automático" readonly/></td>
			  </tr>
              
              <tr>
                <td align="right">&nbsp;</td>
                <td>
                <input type="submit" name="Submit"  class="button" value="Cadastrar"  /> 
                </td>            
              </tr>
              
			</table>
  			</form>
           </div>
            </div>
         </div>
         
        </div>
    </div>
    
  </div>
</div>

<script>
<?=$alert?>
function up_valor(){

var ini=parseInt($('#ini').val());

var fim=parseInt($('#fim').val());

if(fim-ini<0){alert('Erro no intervalo.');$('#tot,#fim,#ini').val('');} else $('#tot').val(fim-ini+1);
}
</script>
<?php include "footer.php";?>
</body>
</html>
