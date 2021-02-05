<?php
session_start();
if ($_SESSION['login'] == '') die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

$datetoday = new DateTime();
$dateoneyear = $datetoday->sub(new DateInterval('P1Y'));
$tsoneyear = $dateoneyear->getTimestamp();

$pedigreeslista = array();

$sql = "SELECT  *,pedigree.nome as nc  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria left join pagtos on pedigree.id_ped=pagtos.id_criador  WHERE pedigree.id_ped> 71636 and pedigree.id_criador=$_SESSION[cid] and nasc <= $tsoneyear order by id_ped desc";
$query = mysql_query($sql) or die('e1');

while ($linha = mysql_fetch_array($query)) {
    $nn = explode(';', $linha['ninhada']);
    $ss = explode(';', $linha['sexo'], 30);
    $i = 4;
    while ($i < 19) {
        if ($nn[$i] != 'Nome Filhote' && $ss[$i - 4] == 'Masc') {
            $sqlp = 'select ativo from padreadoresmatrizes where id_ped = ' . $linha['id_ped'] . ' and id_filhote = ' . ($i - 4);
            $qrp = mysql_query($sqlp);
            $ativo = mysql_fetch_assoc($qrp);
            $rativo = '';
            $vativo = '';
            if ($ativo['ativo'] == null) {
                $rativo = "Não";
                $vativo = "-";
            } else if ($ativo['ativo'] == 1) {
                $rativo = "Sim";
                $vativo = "1";
            } else {
                $rativo = "Inativo";
                $vativo = "0";
            }

            if (($_POST['registro'] != '') && (substr($_POST['registro'], -1) != $i - 4)) {
                continue;
            };
            if (($_POST['nome'] != '') && (strpos($nn[$i], $_POST['nome']) != true)) {
                continue;
            };

            $pedigree = array("id_ped" => $linha['id_ped'], "id_f" => $i, "nomeSubcategoria" => $linha['nomeSubcategoria'], "nomecachorro" => $nn[$i], "registro" => $linha['registro'], "emissao" => $linha['emissao'], "ativo" => $rativo, "vativo" => $vativo);
            array_push($pedigreeslista, $pedigree);
        }
        $i++;
    }
}

$sqlt = "SELECT  *,pedigree.nome as nc  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria join adiciona_filhote using(id_ped)  WHERE adiciona_filhote.id_criador=$_SESSION[cid] and nasc <= $tsoneyear";
$queryt = mysql_query($sqlt) or die('e2');

while ($linhat = mysql_fetch_array($queryt)) {
    $i = $linhat['id_filhote'];
    $nn = explode(';', $linhat['ninhada']);
    $ss = explode(';', $linhat['sexo'], 30);

    if ($ss[$i - 4] == 'Masc') {
        $sqlp = 'select ativo from padreadoresmatrizes where id_ped = ' . $linhat['id_ped'] . ' and id_filhote = ' . ($i - 4);
        $qrp = mysql_query($sqlp);
        $ativo = mysql_fetch_assoc($qrp);
        $rativo = '';
        $vativo = '';
        if ($ativo['ativo'] == null) {
            $rativo = "Não";
            $vativo = "-";
        } else if ($ativo['ativo'] == 1) {
            $rativo = "Sim";
            $vativo = "1";
        } else {
            $rativo = "Inativo";
            $vativo = "0";
        }

        if (($_POST['registro'] != '') && (substr($_POST['registro'], -1) != $i - 4)) {
            continue;
        };
        if (($_POST['nome'] != '') && (strpos($nn[$i], $_POST['nome']) != true)) {
            continue;
        };

        $pedigree = array("id_ped" => $linhat['id_ped'], "id_f" => $i, "nomeSubcategoria" => $linhat['nomeSubcategoria'], "nomecachorro" => $nn[$i], "registro" => $linhat['registro'], "emissao" => $linhat['emissao'], "ativo" => $rativo, "vativo" => $vativo);
        array_push($pedigreeslista, $pedigree);
    }
}

$sqltcd = "SELECT  *,pedigree.nome as nc  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria join transferenciacanil using(id_ped)  WHERE transferenciacanil.id_criador_destino=$_SESSION[cid] and nasc <= $tsoneyear";
$querytcd = mysql_query($sqltcd) or die('e3');

while ($linhatcd = mysql_fetch_array($querytcd)) {
    $i = $linhatcd['id_filhote'];
    $nn = explode(';', $linhatcd['ninhada']);
    $ss = explode(';', $linhatcd['sexo'], 30);

    if ($ss[$i - 4] == 'Masc') {
        $sqlp = 'select ativo from padreadoresmatrizes where id_ped = ' . $linhatcd['id_ped'] . ' and id_filhote = ' . ($i - 4);
        $qrp = mysql_query($sqlp);
        $ativo = mysql_fetch_assoc($qrp);
        $rativo = '';
        $vativo = '';
        if ($ativo['ativo'] == null) {
            $rativo = "Não";
            $vativo = "-";
        } else if ($ativo['ativo'] == 1) {
            $rativo = "Sim";
            $vativo = "1";
        } else {
            $rativo = "Inativo";
            $vativo = "0";
        }

        if (($_POST['registro'] != '') && (substr($_POST['registro'], -1) != $i - 4)) {
            continue;
        };
        if (($_POST['nome'] != '') && (strpos($nn[$i], $_POST['nome']) != true)) {
            continue;
        };

        $pedigree = array("id_ped" => $linhatcd['id_ped'], "id_f" => $i, "nomeSubcategoria" => $linhatcd['nomeSubcategoria'], "nomecachorro" => $nn[$i], "registro" => $linhatcd['registro'], "emissao" => $linhatcd['emissao'], "ativo" => $rativo, "vativo" => $vativo);
        array_push($pedigreeslista, $pedigree);
    }
}

$sqltco = "SELECT  *,pedigree.nome as nc  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria join transferenciacanil using(id_ped)  WHERE transferenciacanil.id_criador_origem=$_SESSION[cid] and nasc <= $tsoneyear";
$querytco = mysql_query($sqltco) or die('e4');

while ($linhatco = mysql_fetch_array($querytco)) {
    $i = $linhatco['id_filhote'];

    foreach ($pedigreeslista as $key => $value) {
        if ($value['id_ped'] == $linhatco['id_ped'] && $value['id_f'] == $i) {
            unset($arr[$key]);
        }
    }
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
    <title>::. Painel de Controle .::</title>
    <script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
    <script src="jquery/alerta/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="jquery/alerta/jquery-ui.css" type="text/css" />
    <script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>
    <script type="text/javascript">
        //$(function() {
        $(document).ready(function() {
            $("#yesno").easyconfirm({
                locale: {
                    title: 'Deseja realmente deletar?',
                    button: ['Não', 'Sim']
                }
            });
            $("#yesno").click(function() {
                return false;
                var files = '';
                $(".cinput:checked").each(function() {
                    files = files + '' + this.value + '-';
                });
                $.post("deletar_varios_ped.php", {
                        id: files
                    },
                    function(retorno) {
                        //$("#check").html(retorno);
                        //alert(retorno);
                        document.location.reload();
                    }
                );
                //alert("Deletado com sucesso!");

                //location="teste.php";
            });

        });

        function ConfirmaExclusao(id) {
            return false;
            $("#yesno" + id).easyconfirm({
                locale: {
                    title: 'Deseja realmente deletar?',
                    button: ['Não', 'Sim']
                }
            });
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



    <script src="jquery/tabela/jquery.tablesorter.min.js"></script>
    <script src="jquery/tabela/jquery.tablesorter.pager.js"></script>
    <link rel="stylesheet" href="jquery/tabela/custom.css" media="screen" />


    <style>
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

        table tbody tr:hover>td:nth-child(odd),
        tr:hover>td:nth-child(even) {
            background: #549ABE !important;
            color: #FFF !important;
        }

        .aviso {
            width: 100%;
            font-size: 18px;
        }
    </style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
    <?php //include "header_l.php"; 
    ?>
    <?php include "header.php"; ?>

    <div class="container">
        <br />
        <div class="row">
            <!-- <?php //include "menu_esquerdo.php"; 
                    ?> -->
            <div>
                <div class="arial_branco20" id="internas_titulo">Lista de Padreadores</div>
                <div class="card">
                    <div class="card-header text-white bg-secondary">
                        <h5 class="card-title">Pesquisa</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="#" id="frm-filtro">
                            <p>
                                <input name="pesquisar" id="pesquisar" type="text" value="Buscar" onBlur="if(this.value=='') {this.value='Buscar';}" onFocus="if(this.value=='Buscar') {this.value='';}" class="forms">
                            </p>
                        </form>
                    </div>

                </div>

                <div class="table-responsive-sm">
                    <form id="frm_resultados" action="#" method="post" name="opts">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Raça </th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Registro</th>
                                    <th scope="col">Data </th>
                                    <th scope="col">Ativo</th>
                                    <th scope="col">Opções</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($pedigreeslista as $pedigree) { ?>

                                    <tr>
                                        <td><?= $pedigree['nomeSubcategoria'] ?></td>
                                        <td><?= $pedigree['nomecachorro']; ?></td>
                                        <td><?= $pedigree['registro'] . '' . ($pedigree['id_f'] - 4); ?></td>
                                        <td><?= date("d/m/Y", $pedigree['emissao']); ?></td>
                                        <td><?=$pedigree['ativo']?></td>
                                        <td style="text-align:center">
                                            <?php
                                            if ($pedigree['vativo'] == "-") {
                                            ?>

                                                <a href="padreadores_novo.php?id_ped=<?php echo $pedigree['id_ped']; ?>&id_filhote=<?= ($pedigree['id_f'] - 4) ?>" title="Ativar Padreador">
                                                    <i class="far fa-plus-square" style="font-size:15px"></i>
                                                </a>
                                            <?php
                                            } else if ($pedigree['vativo'] == "1") {
                                            ?>
                                                <a href="padreadores_desativar.php?id_ped=<?php echo $pedigree['id_ped']; ?>&id_filhote=<?= ($pedigree['id_f'] - 4) ?>" title="Desativar Padreador">
                                                    <i class="fas fa-ban" style="font-size:15px;color:red"></i>
                                                </a>
                                            <?php

                                            } else if ($pedigree['vativo'] == "0") {
                                            ?>
                                                <a href="padreadores_ativar.php?id_ped=<?php echo $pedigree['id_ped']; ?>&id_filhote=<?= ($pedigree['id_f'] - 4) ?>" title="Ativar Padreador">
                                                    <i class="far fa-plus-square" style="font-size:15px"></i>
                                                </a>
                                            <?php
                                            } ?>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                        </table>

                        <div style="margin-top: 17px;float: left;margin-bottom: 10px;margin-left: 5px;" class="pg">
                            <?php
                            $p = 0;

                            if (isset($_GET['p'])) $p = $_GET['p'];
                            $i = 0;
                            while ($i < 10 && ($i * 20 < $cpn)) { ?>
                                <span>
                                    <a class="bord1" href="padreadores.php?<?php echo 'off=' . $i . '&p=' . $p . $bs; ?>"><?= 1 + $i + $p * 10 ?></a>
                                </span>
                            <?php $i++;
                            } ?>

                            <?php if ($i == 10 && (isset($_GET['chave']) == false)) { ?> <span><a href="padreadores.php?<?php echo 'off=0&p=' . ($p + 1) . $bs; ?>">ver +</a></span><?php } ?>
                        </div> <br>
                        <div style="margin-top:17px;margin-right:17px;float:right"><?php if (!isset($_GET['chave'])) { ?><?php echo $t_imp;
                                                                                                                        } ?></div><br><br>


                        <script>
                            $(function() {

                                $('table > tbody > tr:odd').addClass('odd');



                                $('form').submit(function(e) {
                                    e.preventDefault();
                                });

                                $('#pesquisar').keydown(function() {
                                    var encontrou = false;
                                    var termo = $(this).val().toLowerCase();
                                    $('table > tbody > tr').each(function() {
                                        $(this).find('td').each(function() {
                                            if ($(this).text().toLowerCase().indexOf(termo) > -1) encontrou = true;
                                        });
                                        if (!encontrou) $(this).hide();
                                        else $(this).show();
                                        encontrou = false;
                                    });
                                });


                            });
                        </script>
                        <input class="pgg" name="p" value="<?= (int)$_GET['p'] ?>" type="hidden">
                        <input class="pgg" name="off" value="<?= (int)$_GET['off'] ?>" type="hidden">
                        <style>
                            .bord1 {
                                font-size: 19px;
                                color: black;
                                background-color: whitesmoke;
                                text-decoration: none;
                                border: 2px solid #30859a;
                                padding: 3px;
                            }
                        </style>
                    </form>
                </div>



            </div>
        </div>
        <?php include "footer.php"; ?>
</body>

</html>