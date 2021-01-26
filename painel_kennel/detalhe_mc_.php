<?php

session_start();
require_once("Connections/conexao.php");
//if($_SESSION['login']=='')die("<script>location='index.php';</script>");


$usr=$_GET['usr'];


if($_POST){

$_POST['RG']=$_POST['rg_1'].','.$_POST['rg_2'];

$_post['cpf']=$_POST['cpf_1'].','.$_POST['cpf_2'];

//unset nas novas rg cpf

unset($_POST['rg_1']);
unset($_POST['rg_2']);



unset($_POST['cpf_1']);
unset($_POST['cpf_2']);


$ins='';
$idc=(int)$_POST['id_criador'];
unset($_POST['id_criador']);
foreach($_POST as $key=>$val){
$ins.=" , ".addslashes($key)."='".addslashes($val)."'";
}
$ins=substr($ins,2);


//if($idc!=21834)mysql_query('UPDATE criadores SET '.$ins.' where id_criador='.$idc." and id_credenciado=".$_SESSION['id']);


}

$sql = "SELECT * FROM criadores_b where id_criador=$usr and id_credenciado='0' ORDER BY id_criador DESC ";
$query = mysql_query($sql) or die(mysql_error());
$linha=mysql_fetch_assoc($query);
if(mysql_num_rows($query)<1)die();

$cepe=$linha['cpf'];
$cepe=explode(',',$cepe);


$linha['cpf_1']=$cepe[0];

$linha['cpf_2']=$cepe[1];
unset($linha['cpf']);

$rg=$linha['RG'];
$rg=explode(',',$rg);




$linha['rg_1']=$rg[0];

$linha['rg_2']=$rg[1];

unset($linha['RG']);
?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle - NEOWARE" /> 
<meta name="Description" content="Painel de Controle - NEOWARE"/> 

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle  .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php //include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php //include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Detalhes MC - <?php
	


?>
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
$('.dcredenciado:eq(6) td label').text('Site');


$('.dcredenciado:eq(30) td label').text('Nome Canil');


$('.dcredenciado:gt(30)').each(function(index, ele){});
$('.dcredenciado:eq(25)').hide();
$('.dcredenciado:eq(15)').hide();
$('.dcredenciado:eq(16)').hide();
$('.dcredenciado:eq(17)').hide();
$('.dcredenciado:eq(18)').hide();
</script>
</body>
</html>
