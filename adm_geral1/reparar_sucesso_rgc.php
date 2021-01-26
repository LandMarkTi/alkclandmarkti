<?php
session_start();
if($_SESSION['login']!='sergio@sobraci.org')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$nome = addslashes($_POST['nome']);
$rg = addslashes($_POST['rg']);
$cpf = addslashes($_POST['cpf']);
$endereco = addslashes($_POST['endereco']);
$bairro = addslashes($_POST['bairro']);
$cidade = addslashes($_POST['cidade']);   
$estado = addslashes($_POST['estado']);
$cep = addslashes($_POST['cep']);
$tel_res = addslashes($_POST['tel_res']);
$tel_com = addslashes($_POST['tel_com']);
$celular = addslashes($_POST['celular']);
$email = addslashes($_POST['email']);   
$nome_cao = addslashes($_POST['nome_cao']);
$microchip = addslashes($_POST['microchip']);
$qrcode = addslashes($_POST['qrcode']);
$nascimento = implode("-",array_reverse(explode("/",$_POST['nascimento'])));
$raca = addslashes($_POST['raca']);
$sexo = addslashes($_POST['sexo']);
$cor = addslashes($_POST['cor']);
$pai = addslashes($_POST['pai']);
$mae = addslashes($_POST['mae']);
$id_ped = addslashes($_POST['id_ped']);

//print_r($_POST);

$sql = "update rgc set nome='$nome',rg='$rg', cpf='$cpf', endereco='$endereco', bairro='$bairro', cidade='$cidade', estado='$estado', cep='$cep', tel_res='$tel_res', tel_com='$tel_com', celular='$celular', email='$email', nome_cao='$nome_cao', microchip='$microchip', nascimento='$nascimento', raca='$raca', sexo='$sexo', cor='$cor', pai='$pai', mae='$mae', qrcode='$qrcode'  where id = '$id_ped' ";                  
$query = mysql_query($sql) or die (mysql_error());
//echo $sql;						
$fotonome = $_FILES['foto']['name'];
$fototipo = $_FILES['foto']['type'];
$fototamanho = $_FILES['foto']["size"];
$fototemp = $_FILES['foto']['tmp_name'];
$foto = "../rgc/".$fotonome;									

if($fotonome!=""){
	$sql = "update rgc set foto='$foto' where id='$id_ped'";
	$query = mysql_query($sql) or die (mysql_error());
	move_uploaded_file($fototemp,'../rgc/'.$fotonome);
}

if(isset($_POST['pago'])){
$sql = "update rgc set pago='0' where id='$id_ped'";
$query = mysql_query($sql) or die (mysql_error());

$mensagemHTML = '<html>
<body><br><br>
Dados RGC sobraci 
<br>
Nome: ' . $nome . '<br>
Telefone: '. $tel_res . '<br>
Email: '. $email . '<br>
RG Pet :'.$id_ped.'<br> 
<br><br>

Obrigado pelo cadastro,para consultar a sua carteirinha, use o link abaixo:
<br>
http://www.sobraci.org/c/'.$qrcode.'/

</body></html>
';

$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "From: naoresponda@megapedigree.com\n"; // remetente
$headers .= "Return-Path: contato@megapedigree.com\n"; // return-path
$envio = mail($email, "Envio RGC ".date('d/m/Y'), "$mensagemHTML", $headers,'-rcontato@megapedigree.com');

}else{
$sql = "update rgc set pago='1' where id='$id_ped'";
$query = mysql_query($sql) or die (mysql_error());	
}

$sql = "update qrcode set qrcode='$qrcode' where id_ped = '$id_ped'";
$query = mysql_query($sql) or die (mysql_error());
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
<title><?php echo $titulo; ?></title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Atualizado com Sucesso
            <div style="float:right; margin-left:4px;"><a class="botao" href="listagem_rgc.php"><img src="images/botoes/listar_todos.png" border="0" title="Listar Todos"></a></div>
            
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
          <img src="images/atualizado_com_sucesso.png">
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
