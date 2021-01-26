<?php
session_start();
require_once("Connections/conexao.php");

$ocriador=(int)$_SESSION['cid'];

if($ocriador<1)die("<script>location='index.php';</script>");

$qc=mysql_query('SELECT * FROM  criadores where id_criador='.$_SESSION['cid'].' ');
$fc=mysql_fetch_assoc($qc);

$q2=mysql_query('select * from credenciado join dados_credenciado ON id_credenciado=id_dados where id_credenciado='.$fc['id_credenciado']);
$fr=mysql_fetch_assoc($q2);


$nomecao = addslashes($_POST['tituloAposta']);
$micro=addslashes(implode(';',$_POST["m"]));
$raca=(int)$_POST['subcategoria'];
$datanasc = $_POST['dataInicialEpoch'] / 1000;
$sex=$_POST['sexo'];
$dataEmissao = $_POST['dataFinalEpoch'] / 1000;
$var=addslashes($_POST['variedade']);
$pais=addslashes($_POST['pais']);


$registro='_';//$fr['sigla'].($fr['id_dados']-8).'-'.(30600+$last_id);//antigo limite :mt_rand(302000, 306000)
$ninhada_no=$_POST['ninhada_no'];
$amigo=addslashes($_POST['amigo']);
$criador=addslashes($_POST['criador']);


//foto!!!
$proprietario=addslashes($_POST['proprietario']);
$end=addslashes($_POST['endereço']);
//$bloco=$_POST['bloco_ninhada'];

//parentes
$p=$_POST["p[]"];
$ps=addslashes(implode(';',$_POST["p"]));

//ninhada
$ns=addslashes(implode(';',$_POST["n"]));

$obs=$_POST['obs'];

//sexo


$ss=implode(';',$_POST["s"]);

//cores
$cs=addslashes(implode(';',$_POST["c"]));


//$sql="ALTER TABLE `pedigree` ADD `$key` VARCHAR( 150 ) NOT NULL ;";

//perm



$sql = "INSERT INTO pedigree VALUES('',$_SESSION[cid],'$nomecao','$micro',$raca,'$var',$datanasc,'$sex','$pais','$registro',$dataEmissao,'$ninhada_no','$amigo','$criador','$proprietario','$end','$ns','$ss','$cs','$ps','$obs')";

//die($sql);
$query = mysql_query($sql) or die($sql);

$last_id = (int)mysql_insert_id($conexao);

//$registro=$fr['sigla'].($fr['id_dados']-8).'-'.(30600+$last_id);//antigo limite :mt_rand(302000, 306000)

$registro='RG/'.$fr['sigla'].'/16/'.($last_id-60003);

mysql_query("update  pedigree set registro='$registro' where id_ped=".$last_id);

mysql_query("update somatoria set ped_normal=ped_normal+1 where 1");



$ck=$_POST['perm'];

$vper=array();
$vper['Sem Transferência']=1;
$vper['Com Transferência']=2;
foreach($ck as $k => $v){if($k<10)mysql_query("insert into ped_print values ('',$last_id,".($k+4).",$_SESSION[cid],$vper[$v])");}


$p2=(int)$_POST['p2'];
mysql_query("INSERT INTO `femeas` (`id_f`, `id_criador`, `p2`, `raca`, `data`) VALUES ('', '".$_SESSION['cid']."', '$p2', '$raca', '".time()."');");

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
          	<div style="float:right; margin-left:4px;"><a class="botao" href="listagem_pedigree.php"><img src="images/botoes/listar_todos.png" border="0" title="Listar Todos"></a></div>
            <div style="float:right;"><a class="botao" href="adicionar_pedigree_pre.php"><img src="images/botoes/novo.png" border="0" title="Cadastrar Novo"></a></div>
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
<!-- <?=$sq?>-->
<?php include "footer.php";?>
</body>
</html>
