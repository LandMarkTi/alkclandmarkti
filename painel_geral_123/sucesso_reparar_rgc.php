<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

$id = $_POST['id_ped'];


if(isset($_POST["pago"])) {
	$pago = 1;
         }  else  {
	$pago = 0;
         }

$endereco=addslashes($_POST["endereco"]);
print_r($_POST);
$qrcode=addslashes($_POST['qrcode']);

$sql = "update rgc set pago = '$pago',endereco='$endereco',qrcode='$qrcode'  where id = '$id' ";
$query = mysql_query($sql) or die (mysql_error());

if($query){
$resultado = "alert('Status do RGC alterado');";
echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=listagem_rgc.php'>";		
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle - NEOWARE" /> 
<meta name="Description" content="Painel de Controle - NEOWARE"/> 
<meta name="copyright" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle - NEOWARE .::</title>

<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="stylesheet" href="jquery/modal/reveal.css">
<link rel="stylesheet" href="jquery/alerta/jquery-ui.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="jquery/galeria/highslide/highslide.css" />
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<script src="jquery/alerta/jquery-ui.min.js"></script>
<script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>
<script type="text/javascript" src="jquery/clone/reCopy.js"></script>
<script type="text/javascript" src="jquery/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<script type="text/javascript">
$(function(){
  var removeLink = ' <a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"><img src="images/icons/excluir.png" /></a>';
$('a.add').relCopy({ append: removeLink});	
});
</script>
<script type="text/javascript">
	//$(function() {
	$(document).ready(function(){	
			$("#yesno").easyconfirm({locale: { title: 'Deseja realmente deletar esta sub-categoria?', button: ['Não','Sim']}});
			$("#yesno").click(function() {
				$.post("deletar_subcategoria.php",
					{id: <?php echo $_GET['id']; ?>},
	   				 function(retorno){
						//$("#resultado").html(retorno);
						window.location="listagem_subcategoria.php";
        			 } 
        		);
		});	
	});
</script>
<style>
#emailForm input{
	width: 420px;
	height: 22px;
	background-color: white;
	border: solid 1px #CCC;	
}
</style>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
   	  <div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">RGC          
            <div style="float:right; margin-left:10px;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior" ></a></div>
          <div style="float:right; margin-right:10px;"></div>          
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
         
         <form method="post" action="sucesso_reparar_rgc.php" name="emailForm" id="emailForm" enctype="multipart/form-data" style="margin-left: 143px;margin-top: 69px;">
<H1 >Formulário RGC</h1>
Nome completo: <br>
                <input type="text" name="nome" id="nome" size="30" value="<?php echo $linha['nome'];?>" disabled >
                <br>
                RG:<br>
                <input type="text" name="rg" id="rg" size="30" value="<?php echo $linha['rg'];?>" disabled >                
                <br>
                CPF:<br>
                <input type="text" name="cpf" id="cpf" size="30" value="<?php echo $linha['cpf'];?>" disabled >                                
                <br>
                Endereço:<br>
                <input type="text" name="endereco" id="endereco" size="30" value="<?php echo $linha['endereco'];?>" disabled >                                                
                <br>
                Bairro:<br>
                <input type="text" name="bairro" id="bairro" size="30" value="<?php echo $linha['bairro'];?>" disabled >   <br>                                                             
               Cidade:<br>
                <input type="text" name="cidade" id="cidade" size="30" value="<?php echo $linha['cidade'];?>" disabled ><br>
				Estado:<br>
                <input type="text" name="estado" id="estado" size="30" value="<?php echo $linha['estado'];?>" disabled >
<br>
CEP:<br>
                <input type="text" name="cep" id="cep" size="30" value="<?php echo $linha['cep'];?>" disabled >                
<br>
Telefone residencial: 
                <br>
                <input type="text" name="tel_res" id="tel_res" size="30" value="<?php echo $linha['tel_res'];?>" disabled >                                
<br>
Telefone Telefone comercial:
                <br>
                <input type="text" name="tel_com" id="tel_com" size="30" value="<?php echo $linha['tel_com'];?>" disabled >                                                
<br>
Celular:<br>
                <input type="text" name="celular" id="celular" size="30" value="<?php echo $linha['celular'];?>" disabled >                                                                
<br> E-mail:  <br>
                <input type="text" name="email" id="email" size="30" value="<?php echo $linha['email'];?>" disabled >
<br>
<?php 
if ($linha['foto']!='rgc/'){
echo "Foto do cão: 
                <br>
<a href='".$linha['foto']."' target='_blank'><img src='".$linha['foto']."' width='280' height='216'></a>";

	
}
?>
Nome do cão:
                <br>
                <input type="text" name="nome_cao" id="nome_cao" size="30" value="<?php echo $linha['nome_cao'];?>" disabled >
<br>
  Microchip: 
                <br>
                <input type="text" name="microchip" id="microchip" size="30" value="<?php echo $linha['microchip'];?>" disabled >
<br>

  Data de Nascimento: 
                <br>
                <input type="text" name="nascimento" id="nascimento" size="30" value="<?php echo $linha['nascimento'];?>" disabled >                
<br>
  Raça: 
                <br>
                <input type="text" name="raca" id="raca" size="30" value="<?php echo $linha['raca'];?>" disabled >                                
<br>
  Sexo: 
                <br>
                <input type="text" name="sexo" id="sexo" size="30" value="<?php echo $linha['sexo'];?>" disabled >                                
<br>
  Cor: 
                <br>
                <input type="text" name="cor" id="cor" size="30" value="<?php echo $linha['cor'];?>" disabled ><br>                                                
<br>
  Nome do Pai: 
                <br>
                <input type="text" name="pai" id="pai" size="30" value="<?php echo $linha['pai'];?>" disabled >
<br>
  Nome da Mãe: 
                <br>
                <input type="text" name="mae" id="mae" size="30" value="<?php echo $linha['mae'];?>" disabled ><br>
                Pago <input name="pago" type="checkbox" value="1"><br>
                <input name="enviar" type="submit" value="Enviar RGC">
		<br><br><br><br>
                </form>
                
            
           </div>
        </div>
         </div>
    </div>   
    </div> 
  </div>
</div>
<!--script>
var l='lock';
$('#subz').append('<input type="hidden" name="'+l+'" value="'+Math.random()+'">');
</script-->

<script>

var x='in';
	$('#mae').append('<'+x+'put type="hidden" name="blockme" value="'+Math.random()+'">');	
	
<?php echo $resultado;?></script>

<?php include "footer.php";?>
</body>
</html>
