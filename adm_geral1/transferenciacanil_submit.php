<?php

session_start();
if ($_SESSION['login'] == '') die("<script>location='index.php';</script>");
require_once("Connections/conexao.php");

$id_ped = $_POST['id_ped'];
$id_filhote = $_POST['id_filhote'];
$idcanilorig = $_POST['idcanilorig'];
$idcanildest = $_POST['idcanildest'];
$datatransferencia = new DateTime();
$datatransferenciats = $datatransferencia->getTimestamp();

$tipotransf = $_POST['tipotransf'];
$sql = '';

if($tipotransf == 0) {
    $sql = 'insert into transferenciacanil (id_criador_origem, id_criador_destino, id_ped, id_filhote, datatransferencia) values ('.$idcanilorig.','. $idcanildest.','. $id_ped.','. $id_filhote.','. $datatransferenciats.')';
} else {
    $sql = 'update transferenciacanil set id_criador_origem = '.$idcanilorig.', id_criador_destino = '. $idcanildest.', datatransferencia = '. $datatransferenciats.' where id_ped = '. $id_ped.' and id_filhote = '. $id_filhote;
}

$transf = mysql_query($sql);

header('Location:listagem_pedigree2.php?inicio');
?>