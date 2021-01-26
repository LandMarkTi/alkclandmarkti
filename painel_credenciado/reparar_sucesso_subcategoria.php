<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$id = (int)$_POST['id'];
$categoria = $_POST['categoria'];
$subcategoria = $_POST['subcategoria'];

if(!isset($_POST['lock']))die();

$fp = fopen('ps.txt', 'a');
	fwrite($fp, "\nreparar ".time()."\n");
	fwrite($fp, "\n".print_r($_POST,true)."\n");
	
fclose($fp);
//testar..
$regra = addslashes(str_replace("'",'&#039;',$_POST['regra']));
$conteudo=addslashes(str_replace('"','&quot;',$_POST['conteudo']));
$pelagem=implode($_POST['opcao'],";");

$pais_raca = $_POST['pais_raca'];

$f="";
if($_FILES["foto"]["name"] !=''){
$fotonome = $_FILES['foto']['name'];
$fototipo = $_FILES["foto"]["type"];
$fototamanho = $_FILES["foto"]["size"];
$fototemp = $_FILES["foto"]["tmp_name"];
move_uploaded_file($fototemp,'../site/images/banner/original/'.rawurlencode($fotonome));
$f=",foto='http://megapedigree.com/site/images/banner/original/".rawurlencode($fotonome)."' ";

}

$sql = "UPDATE subcategoria SET idCategoria='$categoria',regrasublocal='$regra',pelagem='$pelagem',conteudo='$conteudo', pais_raca='$pais_raca' $f WHERE idSubcategoria='$id'";
$query = mysql_query($sql) or die(mysql_error());

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
<title><?php echo $titulo; ?></title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Atualizado com Sucesso
            <div style="float:right; margin-left:4px;"><a class="botao" href="listagem_subcategoria.php"><img src="images/botoes/listar_todos.png" border="0" title="Listar Todos"></a></div>
            <div style="float:right;"><a class="botao" href="cadastrar_subcategoria.php"><img src="images/botoes/novo.png" border="0" title="Cadastrar Novo"></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
          <img src="images/atualizado_com_sucesso.png">
         </div>
            </div>
         </div>
         
        </div>
    </div>
    
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
