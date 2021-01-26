<?php
session_start();
require_once("Connections/conexao.php");
if(!isset($_SESSION['id']))die("<script>location='index.php';</script>");
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

$idped=(int)$_POST['id_ped'];
$idf=(int)$_POST['idf'];

$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$idped;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);

$nloop=explode(';', $linha_ped['ninhada']);
$micro=explode(';', $linha_ped['nº microchip']);

$sx=explode(';', $linha_ped['sexo']);

$sex=$sx[$idf];

$nasc_pet=$linha_ped['nasc'];

$nome=$nloop[$idf];

$reg=$linha_ped['registro'].$idf;

$q1=mysql_query("delete from pedigre_trocados where id_ped=$idped and id_f=$idf ");

$prop = addslashes(strip_tags($_POST['nome']));
$nome_cao = addslashes(strip_tags($_POST['nome_cao']));//
$nome_cao =str_replace(";","",$nome_cao);

$mic = addslashes(strip_tags($_POST['mic']));//
$mic =str_replace(";","",$mic);

$end = addslashes(strip_tags($_POST['endereco'])).' '.addslashes(strip_tags($_POST['número'])).', '.addslashes(strip_tags($_POST['cidade'])).' '.addslashes(strip_tags($_POST['estado']));
$cep=addslashes(strip_tags($_POST['cep']));
$tel=addslashes(strip_tags($_POST['telefone']));
$cpf=addslashes(strip_tags($_POST['cpf']));
$email=addslashes(strip_tags($_POST['el']));

$pc=addslashes(strip_tags($_POST['pc']));
//tirando var do ped e montando o campo do comprador

unset($_POST['nome_cao']);

unset($_POST['mic']);

unset($_POST['id_ped']);

unset($_POST['idf']);

unset($_POST['pc']);

unset($_POST['s_atual']);

unset($_POST['s_novo']);

$idfb=$idf;//+4


$pss=strrev($idped).str_pad($idfb,2,"0",STR_PAD_LEFT);

//id adicionado para operações de gerenciamento
$sql = "INSERT INTO pedigre_trocados (id_ped,id_f,proprietario,endereco,cep_t,tel_t,cpf_t,email_t,nome_cao,mic) VALUES ($idped,$idfb,'$prop','$end','$cep','$tel','$cpf','$email','$nome_cao','$mic')";
$query = mysql_query($sql) or die(mysql_error());

//login prop


$sql = "INSERT INTO pedigre_trocados_capa (id_ped,id_f,proprietario,endereco,cep_t,tel_t,cpf_t,email_t,nome_cao,mic,rastreio,dt_trans) VALUES ($idped,$idfb,'$prop','$end','$cep','$tel','$cpf','$email','$nome_cao','$mic','".md5($pss)."','1')";
$query = mysql_query($sql) or die(mysql_error());


$idi=$_SESSION['id'];


$msg='dados do cliente:
';

foreach($_POST as $k=>$v){

$msg.='

'.$k.' : '.htmlspecialchars($v,ENT_QUOTES);

}

$b64=base64_encode($msg);
//var_dump($_POST);

$p64="
nome $nome_cao 

microchip $mic

valor $pc

";

$p64=base64_encode($p64);


$cidade=trim(mb_strtoupper(addslashes($_POST['cidade']),'UTF-8'));
//echo $p64;
//PET LIGHT
mysql_query("insert into form_health values('','$b64','$p64','".time()."','$pc',$idi,'$cidade','')");


$vet_cid=array("BELO HORIZONTE","COTIA","FERRAZ DE VASCONCELOS","GUARUJÁ","GUARULHOS","MAUÁ","MOGI DAS CRUZES","NITERÓI","OSASCO","POÁ","PRAIA GRANDE","SANTANA DE PARNAÍBA","SANTO ANDRÉ","SANTOS","SÃO BERNARDO DO CAMPO","SÃO CAETANO DO SUL","SÃO PAULO","SAO PAULO","TABOÃO DA SERRA","VARGEM GRANDE PAULISTA","BARUERI");


$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$idped;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);


$nloop=explode(';', $linha_ped['ninhada']);
$micro=explode(';', $linha_ped['nº microchip']);

$micro[$idf-4]=$mic;

$nloop[$idf]=$nome_cao;


$m=addslashes(strip_tags(implode(';',$micro)));

$n=addslashes(strip_tags(implode(';',$nloop)));

mysql_query("UPDATE pedigree set ninhada='$n', `nº microchip`='$m' where id_ped=".$idped) or die('e2');


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle -" /> 
<meta name="Description" content="Painel de Controle "/> 

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

          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <img src="images/efetuado_com_sucesso.png">
         </div>
	<?php if(in_array($cidade,$vet_cid)){


$lkk="http://conveniosaudepet.com.br/integra_transf.php?du=$b64&ped=$p64&val=$pc&n=$nasc_pet&sx=macho";

$msg="<br>Parabéns, você ganhou a primeira mensalidade do melhor plano de saúde Pet.<br><br>Clique no banner para ativar!<br>

<a href='$lkk'><img alt='Ativar' src='http://megapedigree.com/site/images/banner/BANNER_TRANSF_alkc.png'></a>
<br><br>
Para entrar na área do proprietário, utilize os dados abaixo:
<br><br>
Login :".trim(strip_tags($_POST['email']))."<br><br>

Senha :".$pss."<br><br>

<br><br>
Acesso:
<br><br>
<a href='http://alkc.org.br/area-do-proprietario'>http://alkc.org.br/area-do-proprietario</a>

<br><br>
Enviado pelo sistema ALKC<br><br>
";

$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "From: Convenio Saude Pet <comercial@conveniosaudepet.com.br>\n"; // remetente
$headers .= "Return-Path: diagnosticando <contato@conveniosaudepet.com.br>\n"; // return-path
if($pc!='idade')$envio = mail(trim($_POST['email']), "ative o Plano de saude Pet" , "$msg", $headers,'-rcomercial@conveniosaudepet.com.br');


     }?>
            </div>
         </div>
         
        </div>
    </div>
    
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>
