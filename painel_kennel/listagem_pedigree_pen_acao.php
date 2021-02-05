<?php
session_start();
if ($_SESSION['login'] == '') die("<script>location='index.php';</script>");
if (!isset($_SESSION['id'])) die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");


$sql = 'SELECT pedigree.id_ped, registro, id_raca, nasc, ninhada, pedigree.nome as nc, emissao, subcategoria.nomeSubcategoria, ped_serie_a.id_filhote as idf,ped_serie_a.tipo_serie FROM pedigree JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria left join ped_serie_a ON ped_serie_a.id_ped=pedigree.id_ped WHERE (0 or criadores.id_credenciado=' . $_SESSION['id'] . '  ) and pedigree.id_ped = ' . $_GET['id_ped'] . ' group by ped_serie_a.tipo_serie, pedigree.id_ped, ped_serie_a.id_filhote';
$query = mysql_query($sql) or die(mysql_error());

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
    <link type="text/css" href="jquery/jqueryui/css/redmond/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery/jqueryui/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="jquery/jqueryui/js/jquery-ui-1.8.21.custom.min.js"></script>
    <script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>
    <script type="text/javascript" src="jquery/jqueryui/development-bundle/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>
    <script src="https://kit.fontawesome.com/4e8c94a071.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        //$(function() {
        $(document).ready(function() {});

        function ConfirmaExclusao(id) {
            return false;
            //$("#yesno"+id).easyconfirm({locale: { title: 'Deseja realmente deletar?', button: ['Não','Sim']}});
            $("#yesno" + id).click(function() {
                $.post("deletar_ped.php", {
                        id: id
                    },
                    function(retorno) {
                        //$("#resultado").html(retorno);
                        window.location.reload();
                    }
                );
                //alert("Deletado com sucesso! ");

            });

        }
    </script>

    <script type="text/javascript">
        $(function() {
            // Datepicker
            $('#dataInicial').datepicker({
                inline: true,
                dateFormat: "dd/mm/yy",
                altField: "#dataInicialEpoch",
                altFormat: "@",
                beforeShow: function() {
                    $('.pgg').val(0);
                }
            });
            // Datepicker
            $('#dataFinal').datepicker({
                inline: true,
                dateFormat: "dd/mm/yy",
                altField: "#dataFinalEpoch",
                altFormat: "@",
                beforeShow: function() {
                    $('.pgg').val(0);
                }
            });
            $('#dataInicial').datepicker($.datepicker.regional["pt-BR"]);
            $('#dataFinal').datepicker($.datepicker.regional["pt-BR"]);
            $('#dataFinalEpoch').val("<?php echo time(); ?>000");
            //$('#dataInicialEpoch').val("<?php echo time(); ?>000");
        });
    </script>

    <link rel="stylesheet" href="jquery/tabela/custom.css" media="screen" />


    <style>
        table tbody tr:hover>td:nth-child(odd),
        tr:hover>td:nth-child(even) {
            background: #549ABE !important;
            color: #FFF !important;
        }

        table tbody tr.checked {
            background: #549ABE;
            color: #FFF;
        }

        table tbody tr.checked:hover {
            background: #549ABE;
            color: #FFF;
        }

        table tbody tr.unchecked:hover {
            background: #549ABE;
            color: #FFF;
        }

        .aviso {
            width: 100%;
            font-size: 18px;
        }

        #example_length {
            float: right
        }

        #example_info {
            float: right
        }

        #example_paginate {
            cursor: pointer
        }

        .pg span a {
            font-size: 18px;
            text-decoration: none;
            color: black
        }

        .pg {
            margin-left: 10px
        }
    </style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
    <?php include "header.php"; ?>

    <div id="internas_full">
        <div id="internas_margem_full">
            <?php include "menu_esquerdo.php"; ?>
            <div id="internas_box">

                <div id="internas_busca">
                </div>

                <div id="internas_principal">
                    <div class="arial_branco20" id="internas_titulo">Lista de Pedigrees Pendentes<div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior"></a></div>
                    </div>
                    <div>
                        <table cellspacing="0" id='example'>

                            <thead>
                                <tr>
                                    <th>Registro</th>
                                    <th>Raça </th>
                                    <th>Nome</th>
                                    <th>Tipo</th>
                                    <th>Impresso</th>
                                    <th>Data </th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($linha = mysql_fetch_array($query)) {
                                    $nn = explode(';', $linha['ninhada']);
                                    $i = $linha['idf'];
                                    
                                    if ($nn[$i] != 'Nome Filhote') {
                                        $sqlpimp = "select * from ped_vias2 where id_user = " . $linha['id_ped'] . " and i_filhote = " . $i;
                                        $qpimp = mysql_query($sqlpimp);
                                        $rpimp = mysql_fetch_assoc($qpimp);
                                        ?>
                                        <tr>
                                            <td><?php echo $linha['registro'] . '' . ($i - 4); ?></td>
                                            <td><?php echo $linha['nomeSubcategoria']; //. $atual.' '.$falta.' '.$linha['idf'] 
                                                ?></td>
                                            <td><?php echo $nn[$i]; ?></td>
                                            <td><?php if ($linha['tipo_serie'] == 3) {
                                                    echo 'Tarjeta';
                                                } else {
                                                    echo 'Pedigree';
                                                } ?>
                                            </td>
                                            <td>
                                                <?php if ($rpimp == null) {
                                                    echo 'Não';
                                                } else {
                                                    echo 'Sim';
                                                } ?>
                                            </td>
                                            <td><?php echo date("d/m/Y", $linha['emissao']); ?></td>
                                            <td valign="middle"><a href="reparar_pedigree.php?id=<?php echo $linha['id_ped']; ?>&f=<?= ($i - 4) ?>"><img src="./images/icons/visualizar.png" title="Visualizar" alt="Visualizar" border="0" /></a><a target="_new" href="pedcode.php?id_ped=<?php echo $linha['id_ped']; ?>&id_filhote=<?= $i ?>"><img style="max-width:20px" src="./images/icons/Note-icon.png"></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
        <?php include "footer.php"; ?>
</body>

</html>