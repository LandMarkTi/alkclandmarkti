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

$mc=addslashes(strip_tags($_POST['mc']));


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

$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: contato@megapedigree.com\n"; // remetente
$headers .= "Return-Path: info@petweball.com.br\n"; // return-path
//$envio = mail("debora@neoware.com.br", "$assunto", "$mensagemHTML", $headers);
//$envio = mail('dna@alkc.com.br', "Novo DNA", "$mensagemHTML", $headers,'-rcontato@megapedigree.com');


	$fotonome = $_FILES['foto']['name'];
	$fototipo = $_FILES['foto']['type'];
	$fototamanho = $_FILES['foto']['size'];
	$fototemp = $_FILES['foto']['tmp_name'];

if(!empty($fotonome)){
move_uploaded_file($fototemp,'./storeResize/'.$fotonome);
$fotonome=addslashes($fotonome);
$qi=mysql_query("insert foto_laudos values ('','$fotonome', $id_ped, $id_f , 8, '$cr','dna')");
}



$p=mysql_query('update dna_pedido set data_aprovado=0 where id_ped='.$id_ped.' and id_f = '.$id_f.' ;');

if(isset($_POST['ck']))$u=mysql_query('update dna_pedido set data_aprovado='.time().' where id_ped='.$id_ped.' and id_f = '.$id_f.' ');

if(!isset($_POST['ck'])&&isset($_POST['ct']))$u=mysql_query('update dna_pedido set data_aprovado=-1 where id_ped='.$id_ped.' and id_f = '.$id_f.' ');

//update data envio

die("<meta http-equiv='Content-Type' content='text/html; charset=utf-8'><script>alert('Arquivo enviado.');location='index_principal.php';</script>");



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
    	  <div class="arial_branco20" id="internas_titulo">Detalhes do animal :
          	
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;"><form action="#" method="post"  enctype="multipart/form-data" >
			<table width="100%" border="0" cellspacing="6" cellpadding="0"><input type="hidden" name="id_ped" value="<?=$id_ped;?>"><input type="hidden" name="id_f" value="<?=$id_f;?>">
			
   <?php  $qped=mysql_query("select * from dna_pedido join pedigree using(id_ped) where id_ped=$id_ped and id_f=".$id_f);
$nl=mysql_num_rows($qped);

$lp=mysql_fetch_assoc($qped);

$mc=explode(';',$lp['nº microchip']);

$nc=explode(';',$lp['ninhada']);

$qcr=mysql_query("select * from criadores where id_criador=".$lp['id_criador']);

$lcr=mysql_fetch_assoc($qcr);


if(0){

echo "Microchip não encontrado!";

} else {
?>


              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Microchip:</label></td>
    				<td><?=$mc[$id_f-4]?><input name="mc" type="hidden" value="<?=$mc[$id_f-4]?>"></td>
		</tr>  
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Nome: </label></td>
    				<td><?=$nc[$id_f]?></td>
		</tr> 
 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Registro:</label></td>
    				<td><?=$lp['registro'].($id_f-4)?><input type="hidden" name="reg" value="<?=$lp['registro'].($id_f-4)?>"></td>
		</tr>  
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Dados para contato:</label></td>
    				<td></td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Responsável:</label></td>
    				<td><?=$lp['responsavel']?></td>
		</tr>  
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Telefone: </label></td>
    				<td><?=$lp['tel_contato']?></td>
		</tr> 

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Celular: </label></td>
    				<td><?=$lp['tel_contato']?></td>
		</tr> 
 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Email:</label></td>
    				<td><?=$lp['email_contato']?></td>
		</tr> 

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Endereço:</label></td>
    				<td><?=$lp['adr']?></td>
		</tr> 

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Kit enviado:</label></td>
    				<td><input name="ck" type="checkbox" <?php if($lp['data_aprovado']>0)echo 'checked'; ?>></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Contato Efetuado:</label></td>
    				<td><input name="ct" type="checkbox" <?php if($lp['data_aprovado']!=0)echo 'checked'; ?>></td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Resultado:</label></td>
    				<td></td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td><input name="foto" type="file"></td>
		</tr>    
                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td><br><input type="submit" name="enviar" value="voltar" onclick="location='index_principal.php';return false;"><input type="submit"  value="Enviar"></td>
		</tr>    
  
 <?php }?>
</table></form>
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
