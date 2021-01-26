<?php
require_once("Connections/conexao.php");
$id = $_POST['id'];

$fotonome = $_FILES['video']['name'];
$fototipo = $_FILES["video"]["type"];
$fototamanho = $_FILES["video"]["size"];
$fototemp = $_FILES["video"]["tmp_name"];
move_uploaded_file($fototemp,'../site/images/noticia/'.$fotonome);


$legenda = $_POST['legenda'];
	
$sql = "UPDATE galeria SET video = '$fotonome', descricao='$legenda'  WHERE id = '$id'";
//echo $sql;
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
    	  <div class="arial_branco20" id="internas_titulo">Atualizado com Sucesso!
            <div style="float:right; margin-left:4px;"><a class="botao" href="listagem_galeria.php"><img src="images/botoes/listar_todos.png" border="0" title="Listar Todos"></a></div>
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
