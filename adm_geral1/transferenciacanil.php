<?php
session_start();
if ($_SESSION['login'] == '') die("<script>location='index.php';</script>");
require_once("Connections/conexao.php");

//Verifica se o Pedigree já foi transferido
$sqlpt = "select id_criador_destino from transferenciacanil where id_ped = " . $_GET['id_ped'] . " and id_filhote = " . $_GET['id_filhote'];
$qpt = mysql_query($sqlpt);
$rpt = mysql_fetch_assoc($qpt);

$sqlpedigree = "select * from pedigree where id_ped = " . $_GET['id_ped'];
$qpedigree = mysql_query($sqlpedigree);
$rpedigree = mysql_fetch_assoc($qpedigree);
$idfilhote = ($_GET['id_filhote'] - 4);

$idcanilorig = 0;
$tipotransf = 0;

if ($rpt != null && $rpt['id_criador_destino']) {
    $tipotransf = 1;
    $idcanilorig = $rpt['id_criador_destino'];
} else {
    $tipotransf = 0;
    $idcanilorig = $rpedigree['id_criador'];
}

$sqlcanilorig = "select * from criadores where id_criador = " . $idcanilorig;
$qcanilorig = mysql_query($sqlcanilorig);
$rcanilorig = mysql_fetch_assoc($qcanilorig);
$nomecanilorig = $rcanilorig['nome_completo'];

$sql1 = "select distinct(id_criador),id_adm from aprovados where id_adm>85";
$qr1 = mysql_query($sql1);
$set = '';
while ($s = mysql_fetch_assoc($qr1)) {
    $set .= $s['id_criador'] . ',';
}

$sqlcanildest = "SELECT * FROM criadores join aprovados using (id_criador) where  id_criador in ($set 0) and id_credenciado>85 and id_criador>'21634' and id_criador != " . $idcanilorig . " and trim(nome_completo) != '' order by trim(nome_completo) asc";
$qcanildest = mysql_query($sqlcanildest);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Keywords" content="Painel de Controle " />
    <meta name="Description" content="Painel de Controle " />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
    <link rel="stylesheet" type="text/css" href="css/style_internas.css" />
    <link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
    <link rel="shortcut icon" href="favicon.png" />
    <title>::. Painel de Controle .::</title>
    <script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
    <script src="jquery/alerta/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="jquery/alerta/jquery-ui.css" type="text/css" />
    <script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>
    <script src="https://kit.fontawesome.com/4e8c94a071.js" crossorigin="anonymous"></script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
    <?php include "header.php"; ?>

    <div id="internas_full">
        <div id="internas_margem_full">
            <?php include "menu_esquerdo.php"; ?>
            <div id="internas_box">

                <div id="internas_principal">
                    <div class="arial_branco20" id="internas_titulo">
                        Transferência de Canil
                        <div style="float:right; margin-left:10px;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior"></a></div>
                    </div>
                    <div style="width:750px;">
                        <div style="margin:10px; margin-top:50px;">
                            <form action="transferenciacanil_submit.php" method="post">
                                <table width="100%" border="0" cellspacing="6" cellpadding="0">
                                    <tr>
                                        <td>
                                            <label for="registro" class="arial_cinza2_12">Registro</label>
                                        </td>
                                        <td>
                                            <input name="idregistro" type="text" class="forms" id="registro" size="65" readonly value="<?= $rpedigree['registro'] . $idfilhote ?>" />
                                            <input type="hidden" name="id_ped" value="<?= $rpedigree['id_ped'] ?>" />
                                            <input type="hidden" name="id_filhote" value="<?= $_GET['id_filhote'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="canilorigem" class="arial_cinza2_12">Canil Origem</label>
                                        </td>
                                        <td>
                                            <input name="nomecanilorigem" type="text" class="forms" id="canilorigem" size="65" readonly value="<?= $nomecanilorig ?>" />
                                            <input type="hidden" name="idcanilorig" value="<?= $idcanilorig ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="canildestino" class="arial_cinza2_12">Canil Destino</label>
                                        </td>
                                        <td>
                                            <select name="idcanildest" class="forms" style="width:300px;height:40px">
                                                <?php
                                                while ($rcanildest = mysql_fetch_array($qcanildest)) { ?>
                                                    <option value="<?= $rcanildest['id_criador'] ?>"><?= $rcanildest['nome_completo'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <input type="hidden" name="tipotransf" value="<?= $tipotransf ?>" />
                                        <td align="right"><input type="submit" value="Enviar" /></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>