<?php

session_start();
require_once("Connections/conexao.php");


$usr=$_GET['usr'];


$vtt=0;

?><!DOCTYPE html>
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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="./plot/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="./plot/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="./plot/plugins/jqplot.donutRenderer.min.js"></script>
<link rel="stylesheet" type="text/css" hrf="./plot/jquery.jqplot.min.css" />
<link rel="stylesheet" type="text/css" hrf="./plot/jquery.jqplot.css" />
 


</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Resumo Pedigree por Núcleo
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form method="post" >
			<table width="100%" border="1"  cellspacing="6" cellpadding="0"><tr><td>Nucleo</td><td>Criadores</td><td>registro<br>padrão</td><td>registro<br>Externo</td><td>Outras<br>Entidades</td><td>Sub-total<br>registros</td></tr>
            <?php

//$q_rank="SELECT count(*) as peds,c.nome FROM `pedigree` pp join criadores using(id_criador) join credenciado c using (id_credenciado) JOIN ped_vias2 ON pp.id_ped = id_user  WHERE 1 group by id_credenciado ORDER BY `peds`  DESC";

$q_rank="SELECT * FROM `credenciado` JOIN dados_credenciado ON id_credenciado = id_dados";

$qr=mysql_query($q_rank);



while($linha=mysql_fetch_assoc($qr)){

//impressos

$cotas="SELECT SUM( CEIL( SUBSTR( ninhada, 1, 1 ) ) ) AS macho, SUM( CEIL( SUBSTR( ninhada, 3, 1 ) ) ) AS femea FROM `pedigree` JOIN criadores ON pedigree.id_criador = criadores.id_criador join credenciado c using (id_credenciado) JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria   WHERE  registro like '".$linha['sigla']."%'";

$qc=mysql_query($cotas);

$nmc=mysql_fetch_assoc($qc);

//ex
$rx="SELECT  SUM( CEIL( SUBSTR( ninhada, 1, 1 ) ) ) AS macho, SUM( CEIL( SUBSTR( ninhada, 3, 1 ) ) ) AS femea  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria join credenciado using(id_credenciado) JOIN registro_anterior USING ( id_ped ) WHERE  id_cadastro_nucleo=".$linha['id_credenciado']." and registro like 'RGE%' and registro not like 'RGEO%'   ";

$rxq=mysql_query($rx) or die (mysql_error());
$fx=mysql_fetch_assoc($rxq);
//outra



$rxo="SELECT  SUM( CEIL( SUBSTR( ninhada, 1, 1 ) ) ) AS macho, SUM( CEIL( SUBSTR( ninhada, 3, 1 ) ) ) AS femea FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria join credenciado using(id_credenciado) JOIN registro_anterior USING ( id_ped ) WHERE  id_cadastro_nucleo=".$linha['id_credenciado']." and registro like 'RGEO%'   ";

$rxoq=mysql_query($rxo) or die (mysql_error());
$fxo=mysql_fetch_assoc($rxoq);



//criadores

$criadores="SELECT count(*) as ct from criadores join aprovados using(id_criador) where id_credenciado=".$linha['id_credenciado'];

$qcriador=mysql_query($criadores);
$fcriador=mysql_fetch_assoc($qcriador);



$ht[]= '<tr ><td>'.$linha['nome'].'</td><td>'.$fcriador['ct'].'</td><td>'.($nmc['macho']+$nmc['femea']).'</td><td>'.($fx['macho']+$fx['femea']).'</td><td>'.($fxo['macho']+$fxo['femea']).'</td><td>'.($fxo['macho']+$fxo['femea']+$fx['macho']+$fx['femea']+$nmc['macho']+$nmc['femea']).'</td></tr>'; 

$cht[]=($nmc['macho']+$nmc['femea']);

$vtt+=$fxo['macho']+$fxo['femea']+$fx['macho']+$fx['femea']+$nmc['macho']+$nmc['femea'];

}


asort($cht);

$cht=array_reverse($cht,true);


foreach($cht as $k=>$v){

	echo $ht[$k];

}


echo '<tr><td colspan="5">'.'Total de registros:'.'</td><td>'.$vtt.'</td></tr>';

//$js=substr($js,0,-1);



?> 
              
             
              
			</table>
  			</form>
           </div>
            </div>
         </div>
         
        </div>
    </div>
    
  </div>
</div>
<?php include "footer.php";?>
<script>



</script>
</body>
</html>
