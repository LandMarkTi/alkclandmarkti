<?php

session_start();
if ($_SESSION['login'] == '') die("<script>location='index.php';</script>");
require_once("Connections/conexao.php");

$sql = "select * from pedigreeexterno p, credenciado c where p.id_credenciado = c.id_credenciado and status < 4 and id_criador = " . $_SESSION['cid'] . " order by datasolicitacao desc";
$sqlqr = mysql_query($sql);
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
    <title>::. Painel de Controle .::</title>
    <script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
    <script src="jquery/alerta/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="jquery/alerta/jquery-ui.css" type="text/css" />
    <script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>
    <script type="text/javascript">


    </script>
    <style>
        table tbody tr:hover>td:nth-child(odd),
        tr:hover>td:nth-child(even) {
            background: #549ABE !important;
            color: #FFF !important;
        }
    </style>

</head>

<body>
    <?php include "header.php"; ?>
    <div class="container">
        <br />
        <div class="row">
            <div>
                <div class="arial_branco20" id="internas_titulo">Lista de Solicitações de Pedigree Externo</div>
                <div class="card">
                    <div class="card-body">
                        <a href="pedigreeexterno_solicitacao.php" class="btn btn-secondary btn-sm">Criar Solicitação</a>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Data</th>
                                <th scope="col">Kennel</th>
                                <th scope="col">Declara&ccedil;&atilde;o</th>
                                <th scope="col">Documento</th>
                                <th scope="col">Pedigree</th>
                                <th scope="col">Situação</th>
                                <th scope="col">Motivo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($solicitacao = mysql_fetch_assoc($sqlqr)) {
                                $situacao = '';
                                switch ($solicitacao['status']) {
                                    case 0:
                                        $situacao = 'Aguardando an&aacute;lise Kennel';
                                        break;
                                    case 1:
                                        $situacao = 'Aguardando an&aacute;lise ALKC';
                                        break;
                                    case 2:
                                        $situacao = 'Reprovada pelo Kennel';
                                        break;
                                    case 3:
                                        $situacao = 'Reprovada pela ALKC';
                                        break;
                                    case 4:
                                        $situacao = 'Conclu&iacute;da';
                                        break;
                                }

                            ?>
                                <tr>
                                    <td><?= date('d/m/Y', $solicitacao['datasolicitacao']) ?></td>
                                    <td><?= $solicitacao['nome'] ?></td>
                                    <td><a href="pedigreeexterno_declaracao.php?id=<?= $solicitacao['id'] ?>" target="_blank">Declaração</a></td>
                                    <td><a href="documentoupload/<?= $solicitacao['documento'] ?>" target="_blank">Documento</a></td>
                                    <td><a href="pedigreeanexo/<?= $solicitacao['pedigreeanexo'] ?>" target="_blank">Pedigree</a></td>
                                    <td><?= $situacao ?></td>
                                    <td><?= $solicitacao['motivo'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>

                </div>


            </div>
        </div>

</body>

</html>