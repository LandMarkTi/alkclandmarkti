<?php

session_start();
if ($_SESSION['login'] == '') die("<script>location='index.php';</script>");
require_once("Connections/conexao.php");

$sqlcr = "select * from criadores where id_criador = " . $_SESSION['cid'];
$querycr = mysql_query($sqlcr);
$dadoscriador = mysql_fetch_assoc($querycr);

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
        <div class="row justify-content-md-center">
            <div class="col col-lg-6">
                <div class="card">
                    <div class="arial_branco20" id="internas_titulo">Solicitação de Pedigree Externo</div>
                    <form action="pedigreeexterno_submit.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome do Cachorro</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Cachorro" required>
                        </div>
                        <div class="mb-3">
                            <label for="registro" class="form-label">Número do Registro Externo</label>
                            <input type="text" class="form-control" id="registro" name="registro" placeholder="Registro" required>
                        </div>
                        <div class="mb-3">
                            <label for="entidade" class="form-label">Nome da Entidade Externa</label>
                            <input type="text" class="form-control" id="entidade" name="entidade" placeholder="Nome da Entidade" required>
                        </div>
                        <div class="mb-3">
                            <label for="documento" class="form-label">Arquivo RG ou CNH Digitalizado</label>
                            <input class="form-control" type="file" id="documento" name="documento" required>
                        </div>
                        <div class="mb-3">
                            <label for="pedigree" class="form-label">Arquivo Pedigree Digitalizado</label>
                            <input class="form-control" type="file" id="pedigree" name="pedigree" required>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="requisicao" required>
                            <label class="form-check-label" for="requisicao">
                                Declaro que eu li e concordo com a <a href="#" class="declaracao">Requisição e Declaração de Inserção de Pedigree de Outra Entidade</a>
                            </label>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="idcriador" value="<?= $_SESSION['cid'] ?>" />
                            <input type="hidden" name="idcredenciado" value="<?= $dadoscriador['id_credenciado'] ?>" />
                            <button type="submit" class="btn btn-primary">Enviar</button>
                            <a href="pedigreeexterno_lista.php" class="btn btn-secondary">Cancelar</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            $('a.declaracao').click(function() {
                var nomecao = $('#nome').val();
                var nomeentidade = $('#entidade').val();
                var registro = $('#registro').val();

                if (nomecao == '' || nomeentidade == '' || registro == '') {
                    alert('Por favor, informe o nome do cachorro, o nome da entidade e o registro');
                    return false;
                } else {

                    window.open('pedigreeexterno_declaracao_pre.php?nomecao=' + nomecao + '&nomeentidade=' + nomeentidade + '&registro=' + registro);
                    return false;
                }

            });

        });
    </script>
</body>

</html>