<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$qc=mysql_query('SELECT * FROM  criadores where id_criador='.$_SESSION['cid'].' ');
$fc=mysql_fetch_assoc($qc);

$criador_id=(int)$_SESSION['cid'];

//if($fc['id_credenciado']!=44)$fraca=' and idSubcategoria NOT IN (160) ';//17=sorocaba

//$_GET['p1']=$_GET['p1']+1;

//$_GET['p2']=$_GET['p2']+1;


$p1=(int)$_GET['p1'];

$p2=(int)$_GET['p2'];

$raca=(int)$_GET['r'];

$r1=(int)$_GET['r1'];

$r2=(int)$_GET['r2'];


$i1=(int)$_GET['I1'];

$i2=(int)$_GET['I2'];

$data=addslashes($_GET['data']);

$strs=substr($data,5,2).' '.substr($data,8,2).' '.substr($data,0,4);

$obs=addslashes($_GET['obs']);

$su=0;
if($_GET['ck']=='ok')$su=mktime(2, 0, 0, substr($data,5,2),substr($data,8,2),substr($data,0,4));



mysql_query("INSERT INTO `acasalamento` (`id_cop`, `id_pai`, `f_pai`, `id_mae`, `f_mae`, `id_raca`, `tentativas`, `tam_tentativas`, `dt_sucesso`, `id_ninhada`,`detalhes`,`id_criador`,`p1`,`p2`) VALUES (NULL, '$i1', '$r1', '$i2', '$r2', '$raca', '$data', '1', '$su', '0','$obs','$criador_id','$p1','$p2');");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle  .::</title>
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
          	<div style="float:right; margin-left:4px;"><a class="botao" href="listar_cruzamento.php"><img src="images/botoes/listar_todos.png" border="0" title="Listar Todos"></a></div>
            <!--div style="float:right;"><a class="botao" href="adicionar_pedigree_pre.php"><img src="images/botoes/novo.png" border="0" title="Cadastrar Novo"></a></div-->
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
