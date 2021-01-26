<?php
require_once("Connections/conexao.php");
$prop = addslashes($_POST['prop']);
$end = addslashes($_POST['end']);
$idped=(int)$_POST['id_ped'];
$idf=(int)$_POST['id_f'];
$cep=addslashes($_POST['cep']);
$tel=addslashes($_POST['tel']);
$cpf=addslashes($_POST['cpf']);
$email=addslashes($_POST['email']);

$q1=mysql_query("delete from pedigre_trocados where id_ped=$idped and id_f=$idf ");

$sql = "INSERT INTO pedigre_trocados (id_ped,id_f,proprietario,endereco,cep_t,tel_t,cpf_t,email_t) VALUES ($idped,$idf,'$prop','$end','$cep','$tel','$cpf','$email')";
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
