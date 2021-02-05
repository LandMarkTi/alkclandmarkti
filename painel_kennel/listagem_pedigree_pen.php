<?php
session_start();
if ($_SESSION['login'] == '') die("<script>location='index.php';</script>");
if (!isset($_SESSION['id'])) die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

$nuc = addslashes($_GET['nuc']);

if (isset($_GET['nuc']) && is_null($_GET['nuc']) == false && $_GET['nuc'] != '0') $and .= " and pedigree.id_criador  =$nuc ";
$bs .= "&nuc=" . $_GET['nuc'];

$di = $_GET['di'];
$df = $_GET['df'];

$di = $di / 1000;
$df = $df / 1000;

//mostra todos ou nao.
$zero = "0";
if (isset($_GET['di']) && is_null($_GET['di']) == false && $di > 0) {
	$sub = $df - $di;
	if ($sub > 5270400) {
		$df = $di + 5270400;
	}
	$bs .= "&di=$_GET[di]&df=$_GET[df]";
	$and .= " and nasc BETWEEN " . $di . ' and ' . $df . " ";
} else {

	if (is_null($_GET['chave']) == true || $_GET['chave'] == '') $and .= " and nasc BETWEEN " . (time() - 3000610) . ' and ' . (time()) . " ";
}

$pedigreelista = array();

if (!isset($_GET['inicio'])) {
	//$sql = 'SELECT pedigree.id_ped, registro, id_raca, nasc, ninhada, pedigree.nome as nc, emissao, subcategoria.nomeSubcategoria, ped_serie_a.id_filhote as idf,ped_serie_a.tipo_serie FROM pedigree JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria left join ped_serie_a ON ped_serie_a.id_ped=pedigree.id_ped WHERE (0 or criadores.id_credenciado=' . $_SESSION['id'] . '  ) ' . $and . ' order by emissao desc';
	$sql = 'select count(A.id_ped) as total, A.id_ped, A.nome_completo, A.nasc, A.ninhada from (SELECT pedigree.id_ped, criadores.nome_completo,nasc, ninhada FROM pedigree JOIN criadores ON pedigree.id_criador = criadores.id_criador left join ped_serie_a ON ped_serie_a.id_ped=pedigree.id_ped WHERE (0 or criadores.id_credenciado=' . $_SESSION['id'] . ')  ' . $and . ' group by id_ped, id_filhote) as A group by A.id_ped order by A.nasc desc';
	//$sql = 'select A.id_ped, A.nome_completo, A.nasc, A.ninhada, count(A.id_ped) as total from (SELECT pedigree.id_ped, count(pedigree.id_ped) as total, criadores.nome_completo, pedigree.nasc, pedigree.ninhada, ped_serie_a.id_filhote FROM pedigree JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria left join ped_serie_a ON ped_serie_a.id_ped=pedigree.id_ped WHERE (0 or criadores.id_credenciado=' . $_SESSION['id'] . '  ) group by ped_serie_a.id_filhote) as A group by A.id_ped order by A.nasc desc';
	$query = mysql_query($sql) or die(mysql_error());

	while ($linha = mysql_fetch_array($query)) {

		$sqlcimp = "select count(1) as total from ped_vias2 where id_user = " . $linha['id_ped'];
		$qcimp = mysql_query($sqlcimp);
		$rcimp = mysql_fetch_assoc($qcimp);

		if ((int)$linha['total'] > (int)$rcimp['total']) {
			$pedigree = array("id_ped" => $linha['id_ped'], "criador" => $linha['nome_completo'], "ninhada" => date("d/m/Y", $linha['nasc']), "pendentes" => $linha['total'] . '/' . $rcimp['total']);
			array_push($pedigreelista, $pedigree);
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
	<link type="text/css" href="jquery/jqueryui/css/redmond/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="jquery/jqueryui/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="jquery/jqueryui/js/jquery-ui-1.8.21.custom.min.js"></script>
	<script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>
	<script type="text/javascript" src="jquery/jqueryui/development-bundle/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>
	<script src="https://kit.fontawesome.com/4e8c94a071.js" crossorigin="anonymous"></script>

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

				<div id="internas_principal">
					<div class="arial_branco20" id="internas_titulo">Lista de Pedigrees Pendentes</div>
					<div>
						<div>
							<form id="frm_resultados" method="get" name="opts">
								<div id="example_filter" class="dataTables_filter">
									Data:
									<input id="dataInicial" placeholder="a partir de?" style="width: 80px;">
									<input id="dataFinal" placeholder="até quando?" style="width: 80px;">
									<select name="nuc" style="width: 120px" onclick="$('.pgg').val(0);">
										<option value="0">Criador..</option>
										<?php

										$sql_nuc = "SELECT id_criador, trim(nome_completo) as nome_completo FROM `criadores` where id_credenciado = " . $_SESSION['id'] . " and nome_completo != '' order by nome_completo";

										$q_nuc = mysql_query($sql_nuc);

										while ($op_n = mysql_fetch_assoc($q_nuc)) echo '<option value="' . $op_n['id_criador'] . '">' . $op_n['nome_completo'] . '</option>'

										?>
									</select>
									<input id="dataInicialEpoch" type="hidden" name="di">
									<input id="dataFinalEpoch" type="hidden" name="df">
									<input type="submit" value="Buscar">
								</div>
							</form>
						</div>


						<table cellspacing="0" id='example'>

							<thead>
								<tr>
									<th>Ninhada</th>
									<th>Criador</th>
									<th>Reg/Imp</th>
									<th>Ação</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($pedigreelista as $pedigree) { ?>
									<tr>
										<td><?= $pedigree['ninhada'] ?></td>
										<td><?= $pedigree['criador'] ?></td>
										<td><?= $pedigree['pendentes'] ?></td>
										<td><a href="listagem_pedigree_pen_acao.php?id_ped=<?= $pedigree['id_ped'] ?>" title="Ver Pendências"><i class="far fa-eye" style="font-size:15px;color:black"></i></a></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "footer.php"; ?>
</body>

</html>