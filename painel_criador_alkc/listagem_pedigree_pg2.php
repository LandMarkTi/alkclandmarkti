<?php
session_start();
if ($_SESSION['login'] == '') die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

if ($_POST['pesquisar'] == "1") {

	//if (isset($_GET['off'])) $off = (int)20 * $_GET['off'];
	//if (isset($_GET['p'])) $p = (int)$_GET['p'] * 200;
	$pedigreeslista = array();

	$sql = "SELECT  *,pedigree.nome as nc  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria left join pagtos on pedigree.id_ped=pagtos.id_criador  WHERE pedigree.id_ped> 71636 and pedigree.id_criador=$_SESSION[cid]";
	if ($_POST['subcategoria'] != "0") $sql .= " and pedigree.id_raca = " . $_POST['subcategoria'];
	if ($_POST['datainicial'] != "") {
		$datei = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['datainicial'] . '00:00:00');
		$sql .= " and pedigree.emissao >= " . $datei->getTimestamp();
	}

	if ($_POST['datafinal'] != "") {
		$datef = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['datafinal'] . '23:59:59');
		$sql .= " and pedigree.emissao <= " . $datef->getTimestamp();
	}
	if ($_POST['registro'] != "") $sql .= " and pedigree.registro = '" . substr($_POST['registro'], 0, -1) . "'";

	$sql .= " order by id_ped";
	//$sql .= " order by id_ped desc limit " . ($off + $p) . ", 20 ";
	$query = mysql_query($sql) or die('e1');

	while ($linha = mysql_fetch_array($query)) {
		$nn = explode(';', $linha['ninhada']);
		$i = 4;
		while ($i < 19) {
			if ($nn[$i] != 'Nome Filhote') {

				if (($_POST['registro'] != '') && (substr($_POST['registro'], -1) != $i - 4)) {
					continue;
				};
				if (($_POST['nome'] != '') && (strpos($nn[$i], $_POST['nome']) != true)) {
					continue;
				};

				$pedigree = array("id_ped" => $linha['id_ped'], "id_f" => $i, "nomeSubcategoria" => $linha['nomeSubcategoria'], "nomecachorro" => $nn[$i], "registro" => $linha['registro'], "emissao" => $linha['emissao']);
				array_push($pedigreeslista, $pedigree);
			}
			$i++;
		}
	}

	//Pegando o TOTAL DE REGISTROS da table ADM
	$nnp = mysql_num_rows($query);

	/*
	$sql2 = "SELECT  count(*) as cpn  FROM  `pedigree` JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria  WHERE  id_ped > 71636";
	if ($_POST['subcategoria'] != "0") $sql2 .= " and pedigree.id_raca = " . $_POST['subcategoria'];
	if ($_POST['datainicial'] != "") {
		$datei = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['datainicial'] . '00:00:00');
		$sql2 .= " and pedigree.emissao >= " . $datei->getTimestamp();
	}

	if ($_POST['datafinal'] != "") {
		$datef = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['datafinal'] . '23:59:59');
		$sql2 .= " and pedigree.emissao <= " . $datef->getTimestamp();
	}
	if ($_POST['registro'] != "") $sql2 .= " and pedigree.registro = '" . substr($_POST['registro'], 0, -1) . "'";
	$sql2 .= " and pedigree.id_criador= $_SESSION[cid]";
	$qn = mysql_query($sql2);
	$cpn = mysql_fetch_assoc($qn);
	$cpn = $cpn['cpn'];
	*/

	$sqlt = "SELECT  *,pedigree.nome as nc  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria join adiciona_filhote using(id_ped)  WHERE adiciona_filhote.id_criador=$_SESSION[cid]";
	if ($_POST['subcategoria'] != "0") $sqlt .= " and pedigree.id_raca = " . $_POST['subcategoria'];
	if ($_POST['datainicial'] != "") {
		$datei = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['datainicial'] . '00:00:00');
		$sqlt .= " and pedigree.emissao >= " . $datei->getTimestamp();
	}

	if ($_POST['datafinal'] != "") {
		$datef = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['datafinal'] . '23:59:59');
		$sqlt .= " and pedigree.emissao <= " . $datef->getTimestamp();
	}
	if ($_POST['registro'] != "") $sqlt .= " and pedigree.registro = '" . substr($_POST['registro'], 0, -1) . "'";
	$queryt = mysql_query($sqlt) or die('e2');

	while ($linhat = mysql_fetch_array($queryt)) {
		$i = $linhat['id_filhote'];
		$nn = explode(';', $linhat['ninhada']);

		if ($nn[$i] != 'Nome Filhote') {

			if (($_POST['registro'] != '') && (substr($_POST['registro'], -1) != $i - 4)) {
				continue;
			};
			if (($_POST['nome'] != '') && (strpos($nn[$i], $_POST['nome']) != true)) {
				continue;
			};

			$pedigree = array("id_ped" => $linhat['id_ped'], "id_f" => $i, "nomeSubcategoria" => $linhat['nomeSubcategoria'], "nomecachorro" => $nn[$i], "registro" => $linhat['registro'], "emissao" => $linhat['emissao']);
			array_push($pedigreeslista, $pedigree);
		}
	}

	$sqltcd = "SELECT  *,pedigree.nome as nc  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria join transferenciacanil using(id_ped) WHERE transferenciacanil.id_criador_destino=$_SESSION[cid]";
	if ($_POST['subcategoria'] != "0") $sqltcd .= " and pedigree.id_raca = " . $_POST['subcategoria'];
	if ($_POST['datainicial'] != "") {
		$datei = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['datainicial'] . '00:00:00');
		$sqltcd .= " and pedigree.emissao >= " . $datei->getTimestamp();
	}

	if ($_POST['datafinal'] != "") {
		$datef = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['datafinal'] . '23:59:59');
		$sqltcd .= " and pedigree.emissao <= " . $datef->getTimestamp();
	}
	if ($_POST['registro'] != "") $sqltcd .= " and pedigree.registro = '" . substr($_POST['registro'], 0, -1) . "'";
	$querytcd = mysql_query($sqltcd) or die('e3');

	while ($linhatcd = mysql_fetch_array($querytcd)) {
		$i = $linhatcd['id_filhote'];
		$nn = explode(';', $linhatcd['ninhada']);

		if ($nn[$i] != 'Nome Filhote') {

			if (($_POST['registro'] != '') && (substr($_POST['registro'], -1) != $i - 4)) {
				continue;
			};
			if (($_POST['nome'] != '') && (strpos($nn[$i], $_POST['nome']) != true)) {
				continue;
			};

			$pedigree = array("id_ped" => $linhatcd['id_ped'], "id_f" => $i, "nomeSubcategoria" => $linhatcd['nomeSubcategoria'], "nomecachorro" => $nn[$i], "registro" => $linhatcd['registro'], "emissao" => $linhatcd['emissao']);
			array_push($pedigreeslista, $pedigree);
		}
	}

	$sqltco = "SELECT  *,pedigree.nome as nc  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria join transferenciacanil using(id_ped) WHERE transferenciacanil.id_criador_origem=$_SESSION[cid]";
	if ($_POST['subcategoria'] != "0") $sqltco .= " and pedigree.id_raca = " . $_POST['subcategoria'];
	if ($_POST['datainicial'] != "") {
		$datei = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['datainicial'] . '00:00:00');
		$sqltco .= " and pedigree.emissao >= " . $datei->getTimestamp();
	}

	if ($_POST['datafinal'] != "") {
		$datef = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['datafinal'] . '23:59:59');
		$sqltco .= " and pedigree.emissao <= " . $datef->getTimestamp();
	}
	if ($_POST['registro'] != "") $sqltco .= " and pedigree.registro = '" . substr($_POST['registro'], 0, -1) . "'";
	$querytco = mysql_query($sqltco) or die('e4');

	while ($linhatco = mysql_fetch_array($querytco)) {
		$i = $linhatco['id_filhote'];

		foreach ($pedigreeslista as $key => $value) {
			if ($value['id_ped'] == $linhatco['id_ped'] && $value['id_f'] == $i) {
				unset($arr[$key]);
			}
		}
	}

	/*
	$nnt = mysql_num_rows($queryt);
	$nn += (int)$nnt;
	$v_p = array('Não', 'Não', 'Sim');*/
}

$sqlcateg = "SELECT distinct(id_raca),nomeSubcategoria FROM pedigree join subcategoria on id_raca=idSubcategoria where id_criador=$_SESSION[cid]  union SELECT distinct(id_raca),nomeSubcategoria FROM pedigree join subcategoria on id_raca=idSubcategoria where id_ped in (select id_ped from adiciona_filhote where id_criador=$_SESSION[cid])  ORDER BY nomeSubcategoria ASC";
$querycateg = mysql_query($sqlcateg) or die(mysql_error());

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>::. Painel de Controle .::</title>
</head>

<body>
	<!-- 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg"> 
-->
	<?php include "header.php"; ?>
	<script type="text/javascript">
		//$(function() {
		$(document).ready(function() {
			$(function() {
				$("#datainicial").datepicker($.datepicker.regional["pt-BR"]);
				$("#datainicial").mask('00/00/0000');
				$("#datafinal").datepicker($.datepicker.regional["pt-BR"]);
				$("#datafinal").mask('00/00/0000');
			});
		});
	</script>
	<style>
		table tbody tr:hover>td:nth-child(odd),
		tr:hover>td:nth-child(even) {
			background: #549ABE !important;
			color: #FFF !important;
		}
	</style>

	<div class="container">
		<div>
			<!-- <?php //include "menu_esquerdo.php"; 
					?> -->
			<br />
			<div class="row">
				<div>
					<div class="arial_branco20" id="internas_titulo">Lista de Pedigree</div>
					<div class="card">
						<div class="card-header text-white bg-secondary">
							<h5 class="card-title">Pesquisa</h5>
						</div>
						<div class="card-body">
							<form method="post" action="listagem_pedigree_pg2.php" id="formpesquisa" class="row g-3">

								<div class="col-md-3">
									<label for="subcategoria" class="form-label">Raça</label>
									<select name="subcategoria" id="subcategoria" class="form-select form-select-sm">
										<option value="0">Selecione</option>
										<?php
										while ($linhacateg = mysql_fetch_array($querycateg)) { ?>
											<option value='<?= $linhacateg['id_raca'] ?>' <?php if ($_POST['subcategoria'] == $linhacateg['id_raca']) { ?>selected<?php } ?>><?= $linhacateg['nomeSubcategoria'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-3">
									<label for="nome" class="form-label">Registro</label>
									<input type="text" class="form-control form-control-sm" id="registro" name="registro" placeholder="Registro" <?php if ($_POST['registro'] != '') { ?>value="<?= $_POST['registro'] ?>" <?php } ?>>
								</div>
								<div class="col-md-2">
									<label for="datainicial" class="form-label">Data Inicial</label>
									<input type="text" class="form-control form-control-sm" id="datainicial" name="datainicial" <?php if ($_POST['datainicial'] != '') { ?>value="<?= $_POST['datainicial'] ?>" <?php } ?>>
								</div>
								<div class="col-md-2">
									<label for="datafinal" class="form-label">Data Final</label>
									<input type="text" class="form-control form-control-sm" id="datafinal" name="datafinal" <?php if ($_POST['datafinal'] != '') { ?>value="<?= $_POST['datafinal'] ?>" <?php } ?>>
								</div>
								<div class="col-md-2">
									<label for="btnform" class="form-label">&nbsp;</label>
									<input type="submit" id="btnform" class="btn btn-primary btn-sm" value="Pesquisar" />
								</div>
								<input type="hidden" name="pesquisar" value="1" />
							</form>
							<br />
						</div>
					</div>

					<?php if ($_POST['pesquisar'] == "1") { ?>
						<div class="table-responsive-sm">
							<table class="table table-striped table-sm">
								<thead>
									<tr>
										<th scope="col">Raça </th>
										<th scope="col">Nome</th>
										<th scope="col">Registro</th>
										<th scope="col">Transferência<br>Habilitada</th>

										<th scope="col">Data </th>
										<th scope="col" style="display:none">Reservado </th>
										<th scope="col">Opções</th>
									</tr>
								</thead>
								<tbody>

								<?php foreach($pedigreeslista as $pedigree) { ?>

									<tr>
										<td scope="row"><?=$pedigree['nomeSubcategoria'] ?></td>
										<td scope="row"><?=$pedigree['nomecachorro']; ?></td>
										<td scope="row"><?= $pedigree['registro'] . '' . ($pedigree['id_f'] - 4); ?></td>
										<td scope="row">
											<?php
											if ($nr >= 1) {
												echo $v_p[$lp['tipo_perm']];
											} else {
												echo '';
											}

											?><img src="images/icons/atualizar.png" style="cursor:pointer" onclick="location='transferencia.php?id_ped=<?= $pedigree['id_ped'] ?>&id_f=<?= $pedigree['id_f'] ?>';"></td>
										<td scope="row"><?=date("d/m/Y", $pedigree['emissao']); ?></td>

										<td scope="row">
											<a href="../painel_kennel/pedcode.php?id_ped=<?php echo $pedigree['id_ped']; ?>&id_filhote=<?= $pedigree['id_f'] ?>&bt=2" title="Visualizar Registro" target="_blank"><i class="far fa-eye" style="font-size:15px;color:orange"></i></a>
											<!--
													<span title="Consultar Laudos/exames" onclick="location='ver_laudos.php?id_ped=<?php echo $linha['id_ped']; ?>&id_f=<?php echo $i; ?>';">
														<i class="far fa-file-alt" style="font-size:15px"></i>
													</span>
													-->
											<a href="ver_laudos.php?id_ped=<?php echo $pedigree['id_ped']; ?>&id_f=<?= $pedigree['id_f'] ?>" title="Consultar Laudos/exames"><i class="far fa-file-alt" style="font-size:15px;color:gray"></i></a>
											<!--
													<span title="Solicitar DNA" onclick="location='dna.php?id_ped=<?php echo $linha['id_ped']; ?>&id_f=<?php echo $i; ?>';">
														<i class="fas fa-dna" style="font-size:15px"></i>
													</span> -->
											<a href="dna.php?id_ped=<?php echo $pedigree['id_ped']; ?>&id_f=<?= $pedigree['id_f'] ?>" title="Solicitar DNA"><i class="fas fa-dna" style="font-size:15px;color:black"></i></a>
											<!--a href="pre_trans.php?id_ped=<?= $linha['id_ped'] ?>&id_f=<?= $i ?>" style="text-decoration:none;font-weight: bold;color:black;padding:4px"> T </a-->
											<!-- <a href="../painel_kennel/cobertura_conf.php?id_ped=<?php echo $linha['id_ped']; ?>&id_f=<?= ($i) ?>"><img src="images/icons/cob2.png?dd=s" title="Cobertura" alt="Visualizar" border="0" /></a> -->
											<a href="add_vacina.php?id_ped=<?php echo $pedigree['id_ped']; ?>&id_f=<?= $pedigree['id_f'] ?>" title="Registrar Vacina"><i class="fas fa-syringe" style="font-size:15px;color:red"></i></a>
										</td>
									</tr>

									<?php } ?>

								</tbody>
							</table>
							<!--
							<div style="margin-top: 17px;float: left;margin-bottom: 10px;margin-left: 5px;" class="pg">
								<?php
								/*
								$p = 0;

								if (isset($_GET['p'])) $p = $_GET['p'];
								$i = 0;
								while ($i < 10 && ($i * 20 < $cpn)) { 
									*/
								?>
									<span>
										<a class="btn btn-outline-primary btn-sm" href="listagem_pedigree_pg2.php?<?php echo 'off=' . $i . '&p=' . $p . $bs; ?>"><?= 1 + $i + $p * 10 ?></a>
									</span>
								<?php
								/*
								$i++;
								} 
								*/
								?>

								<?php
								/*
								if ($i == 10 && (isset($_GET['chave']) == false)) { 
									*/
								?> <span><a class="btn btn-outline-primary btn-sm" href="listagem_pedigree_pg2.php?<?php
																													/*
								echo 'off=0&p=' . ($p + 1) . $bs; 
*/
																													?>">ver +</a></span><?php
																																		/*
								 } 
								 */
																																		?>
							</div> <br>
							<div style="margin-top:17px;margin-right:17px;float:right">
								<?php
								/*
								if (!isset($_GET['chave'])) {
									echo $t_imp;
								} 
								*/
								?>
							</div>
							<input class="pgg" name="p" value="<?= (int)$_GET['p'] ?>" type="hidden">
							<input class="pgg" name="off" value="<?= (int)$_GET['off'] ?>" type="hidden"> -->
						</div>
					<?php } ?>
				</div>

			</div>
		</div>
		<?php include "footer.php"; ?>
</body>

</html>