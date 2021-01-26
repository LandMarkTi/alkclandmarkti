<?php
require_once("Connections/conexao.php");
$tituloAposta = $_POST['tituloAposta'];
$dataInicialEpoch = $_POST['dataInicialEpoch'] / 1000;
$dataFinalEpoch = $_POST['dataFinalEpoch'] / 1000;
$categoria = $_POST['categoria'];
$subcategoria = $_POST['subcategoria'];
$subsubcategoria = $_POST['subsubcategoria'];
$valoraposta = $_POST['valorAposta'];
$valoraposta=str_replace(',','',$valoraposta);
$valoraposta=str_replace('.','',$valoraposta);
$valoraposta=(int)$valoraposta;


$descricao = $_POST['descricao'];
$regras = $_POST['regras'];

//Pegando os dados da foto enviada
$fotonome = $_FILES['foto']['name'];
$fototipo = $_FILES['foto']['type'];
$fototamanho = $_FILES['foto']['size'];
$fototemp = $_FILES['foto']['tmp_name'];
move_uploaded_file($fototemp,'../images/apostas/'.$fotonome);

$sql = "INSERT INTO aposta (idAposta,tituloAposta,fotoAposta,tipoAposta,dataInicial,dataFinal,idCategoria,idSubCategoria,idSubSubCategoria,idUsuario,valorAposta,descricao,regras,status) VALUES 
						   (NULL,'$tituloAposta','$fotonome','1','$dataInicialEpoch','$dataFinalEpoch','$categoria','$subcategoria','$subsubcategoria',16,'$valoraposta','$descricao','$regras','0')";
$query = mysql_query($sql) or die(mysql_error());

//Pegando o ID da aposta que acabo de ser cadastrada
$ultimo_id = mysql_insert_id($conexao);

//Pegando os dados das opções e inserindo no banco de daod
foreach($_POST['opcao'] as $opcao){
	$sqlop = "INSERT INTO opcoesaposta (id,idAposta,opcao) VALUES (NULL,'$ultimo_id','$opcao')";
	$queryop = mysql_query($sqlop) or die(mysql_error());
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

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Adicionado com Sucesso
          	<div style="float:right; margin-left:4px;"><a class="botao" href="listagem_aposta.php"><img src="images/botoes/listar_todos.png" border="0" title="Listar Todos"></a></div>
            <div style="float:right;"><a class="botao" href="cadastrar_aposta.php"><img src="images/botoes/novo.png" border="0" title="Cadastrar Novo"></a></div>
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
