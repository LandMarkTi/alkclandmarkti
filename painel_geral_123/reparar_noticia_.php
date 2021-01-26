<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");


if($_POST){

$id=(int)$_POST['id'];
$tit=$_POST['titulo'];
$bloco=addslashes($_POST['bloco']);

$f='';
if($_FILES){
$fotonome = $_FILES["foto"]["name"];
$fototipo = $_FILES['foto']['type'];
$fototamanho = $_FILES['foto']['size'];
$fototemp = $_FILES["foto"]["tmp_name"];
move_uploaded_file($fototemp,'../site/images/banner/original/'.rawurlencode($fotonome));
$f=",foto= '/images/banner/original/".rawurlencode($fotonome)."'";
}

if($id==0){mysql_query("insert into conteudoindex values('','$tit','9','/images/banner/original/$fotonome','$bloco')");die("<script>alert('Dados Enviados!');location='index_principal.php';</script>");}
else {mysql_query("update conteudoindex set titulo='$tit' ,texto='$bloco' $f where id='$id' ")or die('Erro'); die("<script>alert('Dados Enviados!');location='index_principal.php';</script>");}



}
if(isset($_GET['id'])){
$id=$_GET['id'];
$dados=mysql_query("select * from conteudoindex where id=".$id)or die();
$linha=mysql_fetch_array($dados);
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
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle - NEOWARE .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<link type="text/css" href="jquery/jqueryui/css/redmond/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="jquery/jqueryui/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jquery/jqueryui/js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript" src="jquery/clone/reCopy.js"></script>

<script type="text/javascript">

</script>
<!--Editor de Texto -->
<!-- TinyMCE -->
<script type="text/javascript" src="jquery/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<!-- /TinyMCE -->
<script type="text/javascript">
      
      
</script>
<script type="text/javascript">
$(function(){
  var removeLink = ' <a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"><img src="images/icons/excluir.png" /></a>';
$('a.add').relCopy({ append: removeLink});	
});
</script>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<form  method="post" enctype="multipart/form-data">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Nova notícia
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            &nbsp;
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr>
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Titulo :</label></td>
    				<td><input name="titulo" value="<?php echo $linha['titulo'];?>" type="text" class="forms" id="tituloAposta" size="65" required="required"/></td>
			  </tr>
                <tr>
    				<td rowspan="2" align="right"><label for="tituloAposta" class="arial_cinza2_12" >Foto :</label></td>
    				<td><input name="foto" value="<?php echo $linha['foto'];?>" type="file" class="forms" id="tituloAposta" size="65" required="required"/>                    </td>
   				</tr>
                <tr>
                  <td> <div style="
    border: 1px solid #B9BDC1;  color: #999;  background-color: white; width: 326px; height: 33px; border-radius:7px; 
"><img src="../site/images/alerta.png" align="left" style="margin:2px;">Obs.: As imagens devem ter no máximo 500kb e o tamanho exato deve ser 280 x 219 pixels </div></td>
                </tr>
                              <tr>
    				<td  align="right"><label for="tituloAposta" class="arial_cinza2_12" >Atual :</label></td>
    				<td><img src="../site<?php echo $linha['foto'];?>" width="280px" height="219px" />                    </td>
   				</tr>
              
              <tr>
    				<td align="right"><label for="descricao" class="arial_cinza2_12" >texto:</label></td>
    				<td><input type="hidden" name ='id' value="<?php echo $linha['id'];?>">
   				    <textarea name="bloco" id="descricao" cols="67" rows="10" class="forms"><?php echo htmlentities($linha['texto'],ENT_QUOTES);?></textarea></td>
			  </tr>
              
             <tr>
    				<td align="right"><label for="descricao" class="arial_cinza2_12" ><input type="submit" value="enviar"></label></td>
    				</tr>
             
			</table>
           </div>
            </div>
         </div>
         
         
         
         
        </div>
    </div>
    
  </div>
</div>
<?php include "footer.php";?>
  </form>
</body>
</html>
