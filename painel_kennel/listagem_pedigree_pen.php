<?php
session_start();
if ($_SESSION['login'] == '') die("<script>location='index.php';</script>");
if (!isset($_SESSION['id'])) die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$off = 0;

$and = '';

if (isset($_GET['off'])) $off = (int)10 * $_GET['off'];
//if(isset($_GET['p']))$p=(int)$_GET['p']*100;
if (isset($_GET['chave']) && is_null($_GET['chave']) == false && $_GET['chave'] != '') {


	$cod_reg = strpos($_GET['chave'], '/');
	if ($cod_reg === false) {

		$cod_reg = strpos($_GET['chave'], '-');
		if ($cod_reg === false) $cod_reg = strpos($_GET['chave'], ' ');
	}

	$parte_reg = substr($_GET['chave'], $cod_reg + 1, 10);
	/*
if(strlen($parte_reg)>=7&& substr($_GET['chave'],0,3)!='RGE')$bchave=substr($_GET['chave'],0,-2); else $bchave=substr($_GET['chave'],0,-1);
*/

	$bchave = substr($_GET['chave'], 0, -1);

	$bs = '&chave=' . $_GET['chave'];
	$and = ' and (registro = \'' . $bchave . '\' OR ninhada like \'%' . $_GET['chave'] . '%\') ';
} //OR ninhada like \'%'.$_GET['chave'].'%\'
//nucleo

$nuc = addslashes($_GET['nuc']);

$rac = (int)$_GET['rac'];

if (isset($_GET['nuc']) && is_null($_GET['nuc']) == false && $_GET['nuc'] != '-' && $_GET['nuc'] != '') $and .= " and pedigree.id_criador in( SELECT id_criador FROM `criadores` WHERE `id_credenciado` =$nuc)";
$bs .= "&nuc=" . $_GET['nuc'];

if (isset($_GET['rac']) && is_null($_GET['rac']) == false && $_GET['rac'] != '-' && $_GET['rac'] != '') $and .= " and id_raca = '$rac' ";
$bs .= "&rac=" . $_GET['rac'];


$di = $_GET['di'];
$df = $_GET['df'];

$di = $di / 1000;
$df = $df / 1000;

//mostra todos ou nao.
$zero = " 0 ";
//if($_SESSION['id']==17)$zero=" 1 ";

//if($_SESSION['id']==75)$start=' id_ped >=55648 and ';

if (isset($_GET['di']) && is_null($_GET['di']) == false && $di > 0) {


	$sub = $df - $di;
	if ($sub > 5270400) {
		$df = $di + 5270400;
	}
	$bs .= "&di=$_GET[di]&df=$_GET[df]";
	$and .= " and emissao BETWEEN " . $di . ' and ' . $df . " ";
} else {

	if (is_null($_GET['chave']) == true || $_GET['chave'] == '') $and .= " and emissao BETWEEN " . (time() - 3000610) . ' and ' . (time()) . " ";
}

$limite = ' 50 ';
if ($_SESSION['id'] == 102) $limite = ' 50 ';
if (!isset($_GET['inicio'])) {

	//pega tudo e depois separa o que está sem serre

	//$sql = "SELECT  pedigree.id_ped,registro,id_raca,nasc,ninhada,pedigree.nome as nc,emissao,subcategoria.nomeSubcategoria,GROUP_CONCAT( DISTINCT ped_serie_a.id_filhote) as idf  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria left join ped_serie_a ON ped_serie_a.id_ped=pedigree.id_ped   WHERE (  $zero or criadores.id_credenciado=" . $_SESSION['id'] . '  ) ' . $and . ' group by id_ped order by id_ped desc limit ' . $limite;

	$sql = 'SELECT  pedigree.id_ped,registro,id_raca,nasc,ninhada,pedigree.nome as nc,emissao,subcategoria.nomeSubcategoria, ped_serie_a.id_filhote as idf , ped_serie_a.tipo_serie FROM  pedigree JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria left join ped_serie_a ON ped_serie_a.id_ped=pedigree.id_ped WHERE (0 or criadores.id_credenciado=' . $_SESSION['id'] . '  ) ' . $and . ' order by emissao desc';
	$query = mysql_query($sql) or die(mysql_error());

	//Pegando tudo pg

	//$sql2 = 'SELECT  count(*) as cpn  FROM pedigree JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria left join pagtos on pedigree.id_ped=pagtos.id_criador left join  registro_anterior using(id_ped)  WHERE ($zero or criadores.id_credenciado=' . $_SESSION['id'] . ' or id_cadastro_nucleo=' . $_SESSION['id'] . ') ' . $and . '  ';
	//$qn=mysql_query($sql2);
	//$cpn=mysql_fetch_assoc($qn);
	//$cpn = 111; //=$cpn['cpn'];

	/*
$q_rank="SELECT COUNT( * ) AS peds, s.nomeSubcategoria ,
(SELECT count(*) FROM `pedigree` pd join criadores using(id_criador) join credenciado cc using (id_credenciado) where pd.id_raca=pp.id_raca group by pd.id_raca) as cad
FROM  `pedigree` pp
JOIN subcategoria s ON id_raca =  `idSubcategoria` 
JOIN ped_vias2 ON pp.id_ped = id_user 
WHERE 1 
GROUP BY nomeSubcategoria 
ORDER BY  `peds` DESC ";
$qrr=mysql_query($q_rank)or die(mysql_error());


$t_imp=0;
while($linha=mysql_fetch_array($qrr)){$t_imp+=$linha[0]; }

*/
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
		<style>table tbody tr.checked {
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

					<form method="post" action="#" id="frm-filtro">
						<p>

						</p>
					</form>
				</div>

				<div id="internas_principal">
					<div class="arial_branco20" id="internas_titulo">Lista de Pedigree


					</div>
					<div>
						<form id="frm_resultados" method="get" name="opts">
							<div id="example_filter" class="dataTables_filter"><label>Procurar:<input type="search" onclick="$('.pgg').val(0);" name="chave" value="<?php if (isset($_GET['chave'])) echo $_GET['chave']; ?>" placeholder="nome ou registro"></label>

								Data:
								<input id="dataInicial" placeholder="a partir de?" style="width: 80px;">
								<input id="dataFinal" placeholder="até quando?" style="width: 80px;">
								<select name="rac" style="width: 120px;" onclick="$('.pgg').val(0);">
									<option value="-">Raça..</option>
									<?php
									$q_sub = mysql_query('SELECT * FROM `subcategoria` where 1');

									while ($f_sub = mysql_fetch_assoc($q_sub)) {

										echo '<option value="' . $f_sub['idSubcategoria'] . '">' . $f_sub['nomeSubcategoria'] . '</option>';
									}


									?>
								</select>
								<select name="nuc" style="width: 120px;display:none" onclick="$('.pgg').val(0);">
									<option value="<?= $_SESSION['id']; ?>">Apropriado em..</option>

								</select>
								<input id="dataInicialEpoch" type="hidden" name="di">
								<input id="dataFinalEpoch" type="hidden" name="df">
								<input type="submit" value="Buscar">
							</div>
							<table cellspacing="0" id='example' width="100%">
								<thead>
									<tr>
										<th width="101">Registro</th>
										<th width="201">Raça </th>
										<th width="201">Nome</th>
										<th width="101">Tipo</th>
										<th width="101">Impresso</th>
										<th width="101">Data </th>
										<th width="67">Opções</th>
									</tr>
								</thead>
								<tbody>

									<?php

									$ini = (int)$_GET['p'];

									$atual = 0;
									$falta = 20;

									while ($linha = mysql_fetch_array($query)) {
										$nn = explode(';', $linha['ninhada']);
										$i = 4;
										$j = 4;
										$ai = explode(',', $linha['idf']);
										$registros = 0;


										while ($j < 19) {
											if ($nn[$j] != 'Nome Filhote') {
												$registros++;
											}
											$j++;
										}

										$sqlcimp = "select count(*) as total from ped_print where id_ped = " . $linha['id_ped'];
										$qcimp = mysql_query($sqlcimp);
										$rcimp = mysql_fetch_assoc($qcimp);

										if ($registros > $rcimp['total']) {
											while ($i < 19) {
												$atual++;
												if ($nn[$i] != 'Nome Filhote' && (in_array($i, $ai) === false || is_null($linha['idf']) == true)) {
													$ini--;

													if ($ini < 0) {

														if ($falta > 0) {
															$falta--;

															$sqlpimp = "select * from ped_print where id_ped = " . $linha['id_ped'] . " and id_f = " . $i;
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
																	<?php if ($rpimp != null && $rpimp['id_perm'] > 0) {
																		echo 'Sim';
																	} else {
																		echo 'Não';
																	} ?>
																</td>
																<td><?php echo date("d/m/Y", $linha['emissao']); ?></td>
																<td valign="middle"><a target="_new" href="reparar_pedigree.php?id=<?php echo $linha['id_ped']; ?>&f=<?= ($i - 4) ?>"><img src="./images/icons/visualizar.png" title="Visualizar" alt="Visualizar" border="0" /></a><a target="_new" href="pedcode.php?id_ped=<?php echo $linha['id_ped']; ?>&id_filhote=<?= $i ?>"><img style="max-width:20px" src="./images/icons/Note-icon.png"></a>
																</td>
															</tr>
									<?php
														}
													}
												}
												$i++;
											}
										}
									}
									?>
								</tbody>
							</table>

							<!--
							<div style="margin-top:17px;float:left" class="pg">
								<?php
								/*
								$p = 0;

								if (isset($_GET['p'])) $p = $_GET['p'];
								$i = 0;
								while ($i < 10) { */
								?>
									<span>
										<a href="listagem_pedigree_pen.php?<?php //echo 'off=0&p=' . ($i * 20) . $bs; 
																			?>"><?= 1 + $i ?></a>
									</span>
								<?php
								/*
								$i++;
								}
								*/
								?>


								<script>
									////cdn.datatables.net/plug-ins/e9421181788/i18n/Portuguese.json
								</script>



								<input class="pgg" name="p" value="<?= (int)$_GET['p'] ?>" type="hidden">
								<input class="pgg" name="off" value="<?= (int)$_GET['off'] ?>" type="hidden">
							-->

						</form>
					</div>

				</div>

			</div>
		</div>
		<?php include "footer.php"; ?>
</body>

</html>