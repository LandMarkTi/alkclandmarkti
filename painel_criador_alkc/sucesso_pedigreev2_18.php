<?php
session_start();
require_once("Connections/conexao.php");

$ocriador=(int)$_SESSION['cid'];

if($ocriador<1)die("<script>location='index.php';</script>");

$qc=mysql_query('SELECT * FROM  criadores where id_criador='.$_SESSION['cid'].' ');
$fc=mysql_fetch_assoc($qc);

$q2=mysql_query('select * from credenciado join dados_credenciado ON id_credenciado=id_dados where id_credenciado='.$fc['id_credenciado']);
$fr=mysql_fetch_assoc($q2);


//teste nasc

$p1=(int)$_POST['pe1'];

$p2=(int)$_POST['pe2'];

$d1=(int)$_POST['d1'];

$d2=(int)$_POST['d2'];

$idm=(int)$_POST['idm'];

$raca=(int)$_POST['subcategoria'];

$datanasc = $_POST['dataInicialEpoch'] / 1000;

$b_fem=mysql_query("select * from femeas where raca=$raca and p2= $p2 and id_criador=".$_SESSION['cid']." and data >".($datanasc-15555000));
$nf=(int)mysql_num_rows($b_fem);

if($nf>=1)die('<script>alert(\'detectamos registro de ninhada inferior a 6 meses com a mesma femea.Solicite o cancelamento para continuar.\');location=\'index_principal.php\';</script>'); 

$vdd=$datanasc-31556926;
$emm="select * from pedigree where id_ped=".$idm." and nasc >$vdd";
$b_mm=mysql_query($emm) or die($emm);

$nmm=(int)mysql_num_rows($b_mm);

if($nmm>=1)die('<script>alert(\'Detectamos que a femea não tem idade permitida para registro de ninhadas.\');location=\'index_principal.php\';</script>'); 

//retirada da cobertura
$sqldel="delete from adiciona_filhote where id_migra > '599' and id_ped='".$d1."' and id_criador='".$criador_id."'  ";
$sqldel2="delete from adiciona_filhote where id_migra > '599' and id_ped='".$d2."' and id_criador='".$criador_id."' ";
mysql_query($sqldel) or die('add1');
mysql_query($sqldel2) or die('add2');



$nomecao = addslashes($_POST['tituloAposta']);
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

//mc

$micro=addslashes(implode(';',$_POST["m"]));

//var se houver

if(isset($_POST['var'])){

$cs2='';
$variedade=$_POST['var'];
$cores=$_POST["c"];
while($iv=array_pop($variedade)){$cs2=array_pop($cores).'*'.$iv.';'.$cs2;}

$cs=substr($cs2,0,-1);
}


//dividindo no 10 -final

$cs2=implode(';',array_slice(explode(';',$cs), 10)).';;;;;;;;;;';

$ss2=implode(';',array_slice(explode(';',$ss), 10)).';;;;;;;;;;';

$micro2=implode(';',array_slice(explode(';',$micro), 10)).';;;;;;;;;;';

$nsf=array_slice(explode(';',$ns), 14);

$ct=array_slice(explode(';',$ns), 0,4);

//$ns2=array_merge($ct,$nsf);

$ns2='0;0;0;0;'.implode(';',$nsf).';Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote';
//print_r($ss2);
//die();
//cortar ns, add +6 e zerar ns2 
$ns_trim=implode(';',array_slice(explode(';',$ns), 0,14)).';Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote';

$sql = "INSERT INTO pedigree VALUES('',$_SESSION[cid],'$nomecao','$micro',$raca,'$var',$datanasc,'$sex','$pais','$registro',$dataEmissao,'$ninhada_no','$amigo','$criador','$proprietario','$end','$ns_trim','$ss','$cs','$ps','$obs')";

//die($sql);
$query = mysql_query($sql) or die('sq1');

$last_id = (int)mysql_insert_id($conexao);

//$registro=$fr['sigla'].($fr['id_dados']-8).'-'.(30600+$last_id);//antigo limite :mt_rand(302000, 306000)

$registro='RG/'.$fr['sigla'].'/19/'.($last_id-60003);

mysql_query("update  pedigree set registro='$registro' where id_ped=".$last_id);

//depois do 10 se precisar

if($ns2!='0;0;0;0;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote;Nome Filhote'){

$sql2 = "INSERT INTO pedigree VALUES('',$_SESSION[cid],'$nomecao','$micro2',$raca,'$var',$datanasc,'$sex','$pais','$registro',$dataEmissao,'$ninhada_no','$amigo','$criador','$proprietario','$end','$ns2','$ss2','$cs2','$ps','$obs')";

//die($sql);
$query2 = mysql_query($sql2) or die('sq2');

$last_id2 = (int)mysql_insert_id($conexao);

//$registro=$fr['sigla'].($fr['id_dados']-8).'-'.(30600+$last_id);//antigo limite :mt_rand(302000, 306000)

$registro='RG/'.$fr['sigla'].'/18/'.($last_id2-60003);

mysql_query("update  pedigree set registro='$registro' where id_ped=".$last_id2);

}else $last_id2=0;
//caso não precise do segundo, setar lastid2 como 0 e blockear insert


//permissoes



$ck=$_POST['perm'];

$vper=array();
$vper['Sem Transferência']=1;
$vper['Com Transferência']=2;
foreach($ck as $k => $v){

if($k<10){
		mysql_query("insert into ped_print values ('',$last_id,".($k+4).",$_SESSION[cid],$vper[$v])");

	} else mysql_query("insert into ped_print values ('',$last_id2,".($k+4-10).",$_SESSION[cid],$vper[$v])");

}

//verificar os depois de 10




$p2=(int)$_POST['p2'];
if($raca!=287)mysql_query("INSERT INTO `femeas` (`id_f`, `id_criador`, `p2`, `raca`, `data`) VALUES ('', '".$_SESSION['cid']."', '$p2', '$raca', '".$datanasc."');");

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
<title>::. Painel de Controle .::</title>
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
<!-- -->
<?php include "footer.php";?>
</body>
</html>
