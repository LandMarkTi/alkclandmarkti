<?php

session_start();
require_once("Connections/conexao.php");
if($_SESSION['login']=='')die("<script>location='index.php';</script>");


$id_ped=(int)$_GET['id_ped'];

$idf=(int)$_GET['id_filhote'];



$_SESSION['end_t']=$_SESSION['end_t'].','.$id_ped;
$_SESSION['end_i']=$_SESSION['end_i'].','.$idf;


$v_ped=explode(",",substr($_SESSION['end_t'],1,200));

$v_i=explode(",",substr($_SESSION['end_i'],1,200));


echo '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>Endereços Web</title><body>';

foreach($v_ped as $k => $v){



$eq=mysql_query("select * from pedigre_trocados_capa  where id_ped='".$v_ped[$k]."' and id_f='".$v_i[$k]."' ") or die(mysql_error());
//echo $v;
$feq=mysql_fetch_assoc($eq);

//var_dump($eq);

echo "Nome: ".$feq['proprietario']."<br>
Endereço: ".$feq["endereco"]."<br>
Cep: ".$feq['cep_t']."<br>
";


}
echo '</body></html>';
?>
