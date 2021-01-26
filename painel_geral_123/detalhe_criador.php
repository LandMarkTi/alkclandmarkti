<?php

session_start();
require_once("Connections/conexao.php");
if($_SESSION['login']!='sergio@sobraci.org'){
$fp = fopen('controle_adm.txt', 'a');
	fwrite($fp, "\ninvasor ".$_SERVER['REMOTE_ADDR'].' '.time()."\n");
	fwrite($fp, "\n".print_r($_SESSION,true)."\n");
	
fclose($fp);
die("<script>location='index.php';</script>");
}


$usr=$_GET['usr'];


if($_POST){
$ins='';
$idc=$_POST['id_criador'];
unset($_POST['id_criador']);
foreach($_POST as $key=>$val){
$ins.=" , ".$key."='".addslashes($val)."'";
}
$ins=substr($ins,2);
mysql_query('UPDATE criadores SET '.$ins.' where id_criador='.$idc);
}

$sql = "SELECT * FROM criadores where id_criador=$usr ORDER BY id_criador DESC ";
$query = mysql_query($sql) or die(mysql_error());
$linha=mysql_fetch_assoc($query);


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
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Detalhes Criador - <?php
	$qr_nucleo="SELECT * FROM credenciado where id_credenciado=".$linha['id_credenciado'];
	$query_nucleo=mysql_query($qr_nucleo);
	$ln=mysql_fetch_assoc($query_nucleo);
	echo $ln['nome'];

?><small ><upper><a href="tr_nuc.php?id=<?=$usr?>" style="color:white">(alterar)</a></upper></small>
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form method="post" >
			<table width="100%" border="0"  cellspacing="6" cellpadding="0">
            <?php foreach($linha as $key=>$val){?>
  			  <tr class ="dcredenciado">
    				<td align="right"><label for="nome" class="arial_cinza2_12" ><?php echo str_replace("_"," ",$key);?></label></td>
    				<td><input name="<?php echo $key;?>" type="text" class="forms" id="nome" size="45" value="<?php echo $val;?>"/></td>
			  </tr>
			  <?php }

?>
              
              <tr>
                <td align="right">&nbsp;</td>
                <td>
                <input type="submit"   class="button" value="Atualizar" /> 
                </td>            
              </tr>
              
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
$('.dcredenciado:eq(0)').hide();
$('.dcredenciado:eq(1)').hide();

$('.dcredenciado:eq(3) td label').text('1º titular');
$('.dcredenciado:eq(4) td label').text('2º titular');

//$('.dcredenciado:eq(2)').hide();

</script>
</body>
</html>
