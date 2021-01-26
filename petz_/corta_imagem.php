<?php
include('imagem.class.php');
$arquivo    = $_GET['arquivo'];
$largura    = $_GET['largura'];
$altura        = $_GET['altura'];
$oImg = new imagem($arquivo);
$valida = $oImg->valida();
if ($valida == 'OK') {
    $oImg->redimensiona($largura,$altura,'crop');
    $oImg->grava();
} else {
    die($valida);
}
exit;
?>