<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$id = $_POST['id'];
$tituloAposta = $_POST['tituloAposta'];
$dataInicialEpoch = $_POST['dataInicialEpoch'] / 1000;
$dataFinalEpoch = $_POST['dataFinalEpoch'] / 1000;
$categoria = $_POST['categoria'];
$subcategoria = $_POST['subcategoria'];
$subsubcategoria = $_POST['subsubcategoria'];
$valorAposta = $_POST['valorAposta'];
$descricao = $_POST['descricao'];
$regras = $_POST['regras'];
$status = $_POST['status'];

$valoraposta = $_POST['valorAposta'];
$valoraposta=str_replace(',','',$valoraposta);
$valoraposta=str_replace('.','',$valoraposta);
$valoraposta=(int)$valoraposta;

$sql = "UPDATE aposta SET tituloAposta='$tituloAposta', dataInicial='$dataInicialEpoch', dataFinal='$dataFinalEpoch', idCategoria='$categoria', idSubCategoria='$subcategoria', idSubSubCategoria='$subsubcategoria', valorAposta='$valoraposta', descricao='$descricao', regras='$regras', status = '$status' WHERE idAposta='$id'";
$query = mysql_query($sql) or die(mysql_error());

//Pegando os dados das opções e inserindo no banco de daod

if($_POST['opcao'][0] != 0){
foreach($_POST['opcao'] as $opcao){
	$sqlop = "INSERT INTO opcoesaposta (id,idAposta,opcao) VALUES (NULL,'$id','$opcao')";
	$queryop = mysql_query($sqlop) or die(mysql_error());
}
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
            <div style="float:right; margin-left:4px;"><a class="botao" href="listagem_aposta.php"><img src="images/botoes/listar_todos.png" border="0" title="Listar Todos"></a></div>
            <div style="float:right;"><a class="botao" href="cadastrar_aposta.php"><img src="images/botoes/novo.png" border="0" title="Cadastrar Novo"></a></div>
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
