<?php
session_start();
if(!isset($_SESSION['login']))die('login');
if($_SESSION['login']=='sergio@sobraci.org'){} else die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$id =$_POST['id'];
$cota=$_POST['cota'];
$tel = $_POST['tel'];
$end=addslashes($_POST['end']);
$s='';

$contato=$_POST['contato'];

if($_POST['senha']!=''){



$s="update credenciado set senha='".$_POST['senha']."' where id_credenciado=$id ";
$que = mysql_query($s) or die(mysql_error());

}


$s2="update credenciado set contato='$contato' where id_credenciado=$id ";
$que2 = mysql_query($s2) or die(mysql_error());


if($_POST){


if(!isset($_POST['lock']))die();

$fp = fopen('ps.txt', 'a');
	fwrite($fp, "\nreparar ".time()."\n");
	fwrite($fp, "\n".print_r($_POST,true)."\n");
	
fclose($fp);

$sql = "UPDATE dados_credenciado SET tel='$tel', endereco='$end',cota=$cota WHERE id_dados='$id'";
$query = mysql_query($sql) or die(mysql_error());


$nn=time();

$fotonome = $_FILES['icone']['name'];
$fototipo = $_FILES['icone']['type'];
$fototamanho = $_FILES['icone']['size'];
$fototemp = $_FILES['icone']['tmp_name'];
move_uploaded_file($fototemp,'../site/images/logo_credenciados/'.$nn.'.jpg');



$sql2 = "UPDATE dados_credenciado SET foto='".$nn.".jpg' WHERE id_dados='$id'";
if($fotonome!='')$query2 = mysql_query($sql2) or die(mysql_error());

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
            <div style="float:right; margin-left:4px;display:none"><a class="botao" href="listagem_categoria.php"><img src="images/botoes/listar_todos.png" border="0" title="Listar Todos"></a></div>
            <div style="float:right;display:none"><a class="botao" href="cadastrar_categoria.php" style="display:none"><img src="images/botoes/novo.png" border="0" title="Cadastrar Novo"></a></div>
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
