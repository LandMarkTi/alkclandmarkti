<?php
session_start();
require_once("Connections/conexao.php");
require_once("mini.php");
$tipo_banner = $_POST['tipo_banner'];
$link = $_POST['link'];

//Pegando os dados da foto enviada
$fotonome = $_FILES['foto']['name'];
$fototipo = $_FILES['foto']['type'];
$fototamanho = $_FILES['foto']['size'];
$fototemp = $_FILES['foto']['tmp_name'];
move_uploaded_file($fototemp,'../site/images/banner/original/'.$fotonome);

//$mini = new PicMini();
//Mini
//$mini -> load("../site/images/banner/original/$fotonome");
//if($tipo_banner == 0)$mini -> resize(990,288); else $mini -> resize(175,400); 
//$mini -> save("../images/banner/$fotonome");

$sql = "INSERT INTO banner (idBanner,tipoBanner,link,foto) VALUES (NULL,'$_SESSION[id]','$link','http://www.megapedigree.com.br/site/images/banner/original/$fotonome')";
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
<title>::. Painel de Controle - NEOWARE .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Adicionado com Sucesso
          	<div style="float:right; margin-left:4px;"><a class="botao" href="listagem_banner.php"><img src="images/botoes/listar_todos.png" border="0" title="Listar Todos"></a></div>
            <div style="float:right;"><a class="botao" href="cadastrar_banner.php"><img src="images/botoes/novo.png" border="0" title="Cadastrar Novo"></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <img src="images/efetuado_com_sucesso.png">
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
