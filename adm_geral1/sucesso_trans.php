<?php
require_once("Connections/conexao.php");
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

$prop = addslashes($_POST['prop']);
$nome_cao = addslashes($_POST['nome_cao']);
$mic = addslashes($_POST['mic']);
$end = addslashes($_POST['end']);
$idped=(int)$_POST['id_ped'];
$idf=(int)$_POST['id_f'];
$cep=addslashes($_POST['cep']);
$tel=addslashes($_POST['tel']);
$cpf=addslashes($_POST['cpf']);
$email=addslashes($_POST['email']);

$q1=mysql_query("delete from pedigre_trocados where id_ped=$idped and id_f=$idf ");

$sql = "INSERT INTO pedigre_trocados (id_ped,id_f,proprietario,endereco,cep_t,tel_t,cpf_t,email_t,nome_cao,mic) VALUES ($idped,$idf,'$prop','$end','$cep','$tel','$cpf','$email','$nome_cao','$mic')";
$query = mysql_query($sql) or die(mysql_error());


$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$idped;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);


$nloop=explode(';', $linha_ped['ninhada']);
$micro=explode(';', $linha_ped['nº microchip']);

$micro[$idf-4]=$mic;

$nloop[$idf]=$nome_cao;

$m=addslashes(implode(';',$micro));

$n=addslashes(implode(';',$nloop));

mysql_query("UPDATE pedigree set ninhada='$n', `nº microchip`='$m' where id_ped=".$idped) or die('e2');



//conv_pet

$msg='dados do cliente:
';


$_POST['proprietario']=$_POST['prop'];

unset($_POST['prop']);

$_POST['endereço']=$_POST['end'];

unset($_POST['end']);

$_POST['microchip']=$_POST['mic'];

unset($_POST['mic']);

$pc='77.88';
foreach($_POST as $k=>$v){

$msg.='

'.$k.' : '.htmlspecialchars($v,ENT_QUOTES);

}

$b64=base64_encode($msg);
//var_dump($_POST);

$p64="
nome ".htmlspecialchars($_POST['nome_cao'])." 

microchip ".htmlspecialchars($_POST['mic'])."

valor ".$pc."

";

$p64=base64_encode($p64);

$db=$msg;

$lkk="http://conveniosaudepet.com.br/integra_transf.php?du=$b64&ped=$p64&val=$pc&n=$nasc_pet&sx=macho";

$msg="<br><br>Obrigado pela transferência do seu pet, aproveite essa promoção por tempo limitado:<br>

Estamos disponibilizando o primeiro mês grátis para o convênio health4pet,para agendar uma visita,<br><br>

entre no link abaixo:<br><br>

<a href='$lkk'>ativar!</a>



<br><br>";//so enviar, mas temos o botão na tela env pagto

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
