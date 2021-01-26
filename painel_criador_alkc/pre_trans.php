<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

$id_ped=(int)$_GET['id_ped'];

$id_f=(int)$_GET['id_f'];


if($_POST){




$id_ped=(int)$_POST['id_ped'];
$id_f=(int)$_POST['id_f'];

$reg=addslashes(strip_tags($_POST['reg']));

$mc=(int)$_POST['mc'];


//if($mc==0)die('microchip incorreto.');
//$mc=addslashes(strip_tags($_POST['mc']));


$email=addslashes(strip_tags($_POST['email']));

$tel=addslashes(strip_tags($_POST['tel']));

$cel=addslashes(strip_tags($_POST['cel']));

$resp=addslashes(strip_tags($_POST['resp']));

$end=addslashes(strip_tags($_POST['end']));

$mensagemHTML = "
Alerta do sistema ALKC:


Nova solicitação de DNA !

Registro:  $reg

Microchip: $mc

Responsável: $resp

Email $email

Telefone: $tel

Celular: $cel

Endereço : $end

";

$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$id_ped;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);



$micro=explode(';', $linha_ped['nº microchip']);

$micro[$id_f-4]=$mc;


$m=addslashes(implode(';',$micro));


//$pp=mysql_query("UPDATE pedigree set  `nº microchip`='$m' where id_ped=".$id_ped) or die('echip');



$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: contato@megapedigree.com\n"; // remetente
$headers .= "Return-Path: info@petweball.com.br\n"; // return-path
//$envio = mail("debora@neoware.com.br", "$assunto", "$mensagemHTML", $headers);
//$envio = mail('dna@alkc.com.br', "Novo DNA", "$mensagemHTML", $headers,'-rcontato@megapedigree.com');

//$qi=mysql_query("insert into dna_pedido values ('', $id_ped, $id_f , ".time().", 0, '$email', '$tel', '$resp','$end','$cel')");
die("<meta http-equiv='Content-Type' content='text/html; charset=utf-8'><script>alert('Solicitação enviada, aguarde o contato.');location='index_principal.php';</script>");



}

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
    	  <div class="arial_branco20" id="internas_titulo">
          	
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">

	<iframe src="../site/pag_trans_criador.php?id_ped=<?=$id_ped?>&id_f=<?=($id_f-4)?>" width="800px" height="1500px" frameborder="0" scrolling="no">
			</iframe>	
         </div>
            </div>
         </div>
         
        </div>
    </div>
    <script>$('#ou').change(function(){});</script>
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
