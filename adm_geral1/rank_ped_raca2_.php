<?php

session_start();
require_once("Connections/conexao.php");


$usr=$_GET['usr'];




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
<title>::. Painel de Controle - .::</title>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
    	  <div class="arial_branco20" id="internas_titulo">Resumo Pedigree por Raça
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form method="post" >
			<table width="100%" border="1"  cellspacing="6" cellpadding="0"><tr><td>Raça</td><td>Ninhadas</td><td>Impressos</td></tr>
            <?php

$q_rank="SELECT SUM( CEIL( SUBSTR( ninhada, 1, 1 ) ) ) AS macho, SUM( CEIL( SUBSTR( ninhada, 3, 1 ) ) ) AS femea,pedigree.id_criador,nomeSubcategoria FROM `pedigree` JOIN criadores ON pedigree.id_criador = criadores.id_criador join credenciado c using (id_credenciado) JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria  
WHERE pedigree.id_criador>17178 
GROUP BY nomeSubcategoria 
ORDER BY  id_raca";
$qr=mysql_query($q_rank)or die(mysql_error());

$total=0;

while($linha=mysql_fetch_assoc($qr)){echo '<tr><td>'.$linha['nomeSubcategoria'].'</td><td>'.$linha['macho'].'</td><td>'.$linha['femea'].'</td></tr>';$total+=$linha['macho']+$linha['femea']; }

echo '<tr><td>Total</td><td colspan="2">'.$total.'</td><tr>';
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
