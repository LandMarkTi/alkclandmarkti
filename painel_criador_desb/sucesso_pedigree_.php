<?php
session_start();
require_once("Connections/conexao.php");
$nomecao = $_POST['tituloAposta'];
$micro=$_POST['microchip'];
$raca=$_POST['subcategoria'];
$datanasc = $_POST['dataInicialEpoch'] / 1000;
$sex=$_POST['sexo'];
$dataEmissao = $_POST['dataFinalEpoch'] / 1000;
$var=$_POST['variedade'];
$pais=$_POST['pais'];
$registro=$_POST['registro'];
$ninhada_no=$_POST['ninhada_no'];
$amigo=$_POST['amigo'];
$criador=$_POST['criador'];
//foto!!!
$proprietario=$_POST['proprietario'];
$end=$_POST['endereço'];
//$bloco=$_POST['bloco_ninhada'];

//parentes
$p=$_POST["p[]"];
$ps=implode(';',$_POST["p"]);

//ninhada
$ns=implode(';',$_POST["n"]);

$obs=$_POST['obs'];

//sexo


$ss=implode(';',$_POST["s"]);

//cores
$cs=implode(';',$_POST["c"]);


//$sql="ALTER TABLE `pedigree` ADD `$key` VARCHAR( 150 ) NOT NULL ;";


$sql = "INSERT INTO pedigree VALUES('',$_SESSION[id],'$nomecao','$micro',$raca,'$var',$datanasc,'$sex','$pais','$registro',$dataEmissao,'$ninhada_no','$amigo','$criador','$proprietario','$end','$ns','$ss','$cs','$ps','$obs')";

//die($sql);
$query = mysql_query($sql) or die($sql);

//Pegando o ID da aposta que acabo de ser cadastrada
//$ultimo_id = mysql_insert_id($conexao);

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
