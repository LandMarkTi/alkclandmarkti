<?php
session_start();
if ($_SESSION['login'] == '') die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

$rg = (int)$_GET['rgc'];
$sql = "select * from rgc where id=" . $rg;

//$qcr=mysql_query('SELECT * FROM  criadores  where id_criador in (select id_criador from aprovados where 1) AND id_credenciado = '.$_SESSION['id'].' order by nome ');

$sqlpe = "select * from pedigreeexterno p, criadores c where p.id_criador = c.id_criador and id = " . $_GET['idpe'];
$querype = mysql_query($sqlpe);
$solicitacao = mysql_fetch_assoc($querype);


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
	<link type="text/css" href="jquery/jqueryui/css/redmond/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="jquery/jqueryui/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="jquery/jqueryui/js/jquery-ui-1.8.21.custom.min.js"></script>
	<script type="text/javascript" src="jquery/clone/reCopy.js"></script>
	<script type="text/javascript" src="jquery/jqueryui/development-bundle/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

	<script type="text/javascript">
		$(function() {
			// Datepicker
			$('#dataInicial').datepicker({
				inline: true,
				dateFormat: "dd/mm/yy",
				changeYear: true,
				altField: "#dataInicialEpoch",
				altFormat: "@"
			});
			$("#dataInicial").datepicker($.datepicker.regional["pt-BR"]);
			// Datepicker
			$('#dataFinalx').datepicker({
				inline: true,
				dateFormat: "dd/mm/yy",
				altField: "#dataFinalEpoch",
				altFormat: "@"
			});
			$("#dataFinalx").datepicker($.datepicker.regional["pt-BR"]);
			$('#dataFinal').val("<?php echo date('d/m/Y'); ?>");
			$('#dataFinalEpoch').val("<?php echo time(); ?>000");
			$('#dataInicialEpoch').val("<?php echo time(); ?>000");
		});
	</script>
	<!--Editor de Texto -->
	<!-- TinyMCE -->
	<script type="text/javascript" src="jquery/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			mode: "textareas",
			theme: "simple"
		});
	</script>
	<!-- /TinyMCE -->
	<script type="text/javascript">
		$(document).ready(function() {

			$("select[name=categoria]").change(function() {
				$("select[name=subcategoria]").html('<option value="0">Carregando...</option>');

				$.post("subcategoria_j.php", {
						categ: $(this).val()
					},
					function(valor) {
						//alert(valor);
						$("select[name=subcategoria]").html(valor);
					}
				);

			});

			$("select[name=subcategoria]").change(function() {

				//var r=$(this).val();
				$.post("subsubcategoria_j.php", {
						subcateg: $(this).val()
					},
					function(valor) {
						//alert(valor);
						$("select[name=cor]").html(valor);
						$('.ccc').each(function(ind, ele) {
							$(ele).after('<select class="ccc forms" name="c[]" style="height: 42px;">' + valor + '</select><select class="var vv2 forms" name="var[]" style="height: 42px;"><option value="">Variedade..</option></select>').remove();
						});
					}
				);


				$.post("subsubcategoria_p.php", {
						subcateg: $(this).val()
					},
					function(valor) {
						//alert(valor);
						$("input[name=pais]").val(valor);

					});
				$("#subcategoria").click(function() {
					return false;
				}).unbind().attr('readonly', 'readonly');
				$("#subcategoria").css('cursor', 'not-allowed').css('pointer-events', 'none');
			});

		});
	</script>
	<script type="text/javascript">
		$(function() {
			var removeLink = ' <a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"><img src="images/icons/excluir.png" /></a>';
			$('a.add').relCopy({
				append: removeLink
			});
			$('.parent').val('digite o nome..');

		});
	</script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">

	<?php include "header.php"; ?>

	<div id="internas_full">
		<div id="internas_margem_full">
			<?php include "menu_esquerdo.php"; ?>
			<div id="internas_box">
				<div id="internas_principal">
					<div class="arial_branco20" id="internas_titulo" style="color:white">Pedigree Outra Entidade
						<div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior"></a></div>
					</div>
					<div style="width:750px;">
						<div style="margin:10px">
							&nbsp;
							<form method="post" class="pedform" onsubmit="return false;" id="tform" enctype="multipart/form-data">
								<table width="100%" border="0" cellspacing="6" cellpadding="0">

									<tr style="display:none;">
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Nome ninhada:</label></td>
										<td><input name="id_credenciado" type="hidden" value="<?= $_SESSION['id'] ?>"><input name="tituloAposta" type="text" class="forms" id="tituloAposta" size="65" value="-" /></td>
									</tr>
									<tr style="display:none">
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Microchip:</label></td>
										<td><input name="microchip" type="text" class="forms" id="tituloAposta" size="65" /></td>
									</tr>

									<tr>
										<td align="right"><label for="subcategoria" class="arial_cinza2_12">Raça:</label></td>
										<td>
											<select name="subcategoria" id="subcategoria" class="forms" style="height: 42px;" required>
												<option>Selecione uma Raça.</option>
												<?php
												$sqlcateg = "SELECT * FROM subcategoria where idSubcategoria not in(346,347,348,355,380,351,352) $fraca ORDER BY nomeSubcategoria ASC";
												$querycateg = mysql_query($sqlcateg) or die(mysql_error());
												while ($linhacateg = mysql_fetch_array($querycateg)) {
													echo "<option value='$linhacateg[idSubcategoria]'>$linhacateg[nomeSubcategoria]</option>";
												}
												?>
											</select>
										</td>
									</tr>

									<tr style="display:none">
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Cor:</label></td>
										<td><input name="cor" value="cor" class="forms"></td>
									</tr>
									<tr>
										<td align="right"><label for="dataInicial" class="arial_cinza2_12">Data Nascimento:</label></td>
										<td><input name="dataInicial" type="text" class="forms" id="dataInicial" size="65" placeholder="00/00/00" autocomplete="off" onkeydown="return false;" required />
											<input type="hidden" name="dataInicialEpoch" id="dataInicialEpoch">
										</td>
									</tr>



									<tr style="display:none">
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Sexo:</label></td>
										<td><input name="sexo" type="text" class="forms" size="65" value="fem" /></td>
									</tr>


									<tr>
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">País de Origem:</label></td>
										<td><input name="pais" type="text" class="forms" size="65" required /></td>
									</tr>

									<tr style="display:none">
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Registro :</label></td>
										<td><input name="registro" type="text" class="forms" value="<?php echo 'RGE 1' . $fped['id_ped']; ?>" size="65" /></td>
									</tr>


									<tr>
										<td align="right"><label for="dataInicial" class="arial_cinza2_12">Data Emissão:</label></td>
										<td><input name="dataFinal" type="text" class="forms" id="dataFinal" size="65" readonly onkeydown="return false;" required />
											<input type="hidden" name="dataFinalEpoch" id="dataFinalEpoch">
										</td>
									</tr>

									<tr style="display:none">
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Ninhada:</label></td>
										<td><input name="ninhada_no" type="text" class="forms" value="***" size="65" /></td>
									</tr>


									<tr style="display:none">
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Amigo:</label></td>
										<td><input name="amigo" type="text" class="forms" size="65" value="***" /></td>
									</tr>

									<tr>
										<td align="right"><label for="criador" class="arial_cinza2_12">Agregar em:</label></td>
										<td>
											<input type="text" class="forms" size="65" value="<?= $solicitacao['nome'] ?>" readonly />
											<input type="hidden" name="criador" value="<?= $solicitacao['id_criador'] ?>" />
										</td>
									</tr>
									<tr>
										<td align="right"><label for="canil" class="arial_cinza2_12">Criador Externo:</label></td>
										<td><input name="criador_ex" type="text" class="forms" size="65" value="<?= $solicitacao['nome'] ?>" readonly /></td>
									</tr>
									<tr>
										<td align="right"><label for="canil" class="arial_cinza2_12">Canil:</label></td>
										<td><input name="cani" type="text" class="forms" size="65" value="<?= $solicitacao['nome_completo'] ?>" readonly /></td>
									</tr>
									<tr style="display:none">
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">foto:</label></td>
										<td><input name="fotox" type="file" class="forms" size="65" /></td>
									</tr>


									<tr>
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Proprietário:</label></td>
										<td><input name="proprietario" type="text" class="forms" size="65" value="<?= $solicitacao['nome'] ?>" readonly /></td>
									</tr>


									<tr>
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Endereço:</label></td>
										<td><input name="endereço" type="text" class="forms" size="65" value="<?= $solicitacao['End_residencial'] ?>, <?= $solicitacao['bairro'] ?>, <?= $solicitacao['cidade'] ?>, <?= $solicitacao['estado'] ?>, <?= $solicitacao['cep'] ?>" readonly /></td>
									</tr>

									<tr>
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Nome do Animal:
												<div style="display:none"><input name="n[]" size="1" id="Masc" value=" 0"><input name="n[]" id="Fêmea" size="1" value=" 0">
													<input name="n[]" size="1" id="Masc2" value=" 0"><input name="n[]" id="Fêmea2" size="1" value=" 0">
												</div>
											</label></td>
										<td>
											<input name="nomecachorro" maxlength="50" class="forms" size="65" value="<?= $solicitacao['nomecachorro'] ?>" readonly><br>
										</td>
									</tr>
									<tr>
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Microchip:</label></td>
										<td>
											<input name="m[]" size="65" class="forms">
										</td>
									</tr>

									<tr>
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Sexo:</label></td>
										<td>
											<select name="s[]" class="forms" id="ativa2" style="height: 42px;">
												<option value="">selecione..</option>
												<option value="Masc">Macho</option>
												<option value="Fêmea">Fêmea</option>
											</select>
											<input value="cor.." class="ccc " name="c[]" size="25" style="display:none">
										</td>
									</tr>

									<tr>
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Declaração</label></td>
										<td>&nbsp;
											<a href="pedigreeexterno_declaracao.php?id=<?= $solicitacao['id'] ?>" target="_blank">Declaração</a>
											<input type="hidden" name="idsolicitacao" value="<?= $solicitacao['id'] ?>" />
										</td>
									</tr>

									<tr>
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Documento do Requisitante</label></td>
										<td>&nbsp;<a href="/painel_criador_alkc/documentoupload/<?= $solicitacao['documento'] ?>" target="_blank">Documento</a></td>
									</tr>

									<tr>
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Pedigree Origem</label></td>
										<td>&nbsp;<a href="/painel_criador_alkc/pedigreeanexo/<?= $solicitacao['pedigreeanexo'] ?>" target="_blank">Pedigree</a></td>
									</tr>

									<tr>
										<td align="right" colspan="2">
											<div class="wrapper">
												<div class="wp1">
													<div class="g11">
														<input class="parent" name="p[]"><br><br>
													</div>
													<div class="g12">
														<input class="parent" name="p[]"><br><br>
													</div>

												</div>
												<div class="wp2">
													<div class="g21">
														<input class="parent" name="p[]">
													</div>
													<div class="g22">
														<input class="parent" name="p[]">
													</div>
													<div class="g23">
														<input class="parent" name="p[]">
													</div>
													<div class="g24">
														<input class="parent" name="p[]">
													</div>

												</div>
												<div class="wp3">
													<div class="g31">
														<input class="parent" name="p[]">
													</div>
													<div class="g32">
														<input class="parent" name="p[]">
													</div>
													<div class="g33">
														<input class="parent" name="p[]">
													</div>
													<div class="g34">
														<input class="parent" name="p[]">
													</div>
													<div class="g35">
														<input class="parent" name="p[]">
													</div>
													<div class="g36">
														<input class="parent" name="p[]">
													</div>
													<div class="g37">
														<input class="parent" name="p[]">
													</div>
													<div class="g38">
														<input class="parent" name="p[]">
													</div>
												</div>
												<div class="wp4">
													<div class="g41">
														<input class="parent" name="p[]"><br><input class="parent" name="p[]">
													</div>
													<div class="g42">
														<input class="parent" name="p[]"><br><input class="parent" name="p[]">
													</div>
													<div class="g43">
														<input class="parent" name="p[]"><br><input class="parent" name="p[]">
													</div>
													<div class="g44">
														<input class="parent" name="p[]"><br><input class="parent" name="p[]">
													</div>
													<div class="g45">
														<input class="parent" name="p[]"><br><input class="parent" name="p[]">
													</div>
													<div class="g46">
														<input class="parent" name="p[]"><br><input class="parent" name="p[]">
													</div>
													<div class="g47">
														<input class="parent" name="p[]"><br><input class="parent" name="p[]">
													</div>
													<div class="g48">
														<input class="parent" name="p[]"><br><input class="parent" name="p[]">
													</div>
												</div>

											</div>





									</tr>

									<tr style="display:none">
										<td align="right"><label for="tituloAposta" class="arial_cinza2_12">Obs:</label></td>
										<td>
											<textarea name="obs" id="regras" cols="45" rows="5" class="forms"></textarea>
										</td>
									</tr>


									<tr>
										<td>
											<span class="btn" onclick="mandar();" style="background-color: #30859a;color: white;">ENVIAR PARA APROVA&Ccedil;&Atilde;O</span>
										</td>
									</tr>


								</table>
							</form>


						</div>
					</div>
				</div>
			</div>
			<div id="internas_box">
				<div id="internas_principal">
					<div class="arial_branco20" id="internas_titulo" style="color:white">Reprovação
					</div>
					<form action="pedigreeexterno_reprovacao.php" method="POST">
						<div>
							<label for="motivo" class="arial_cinza2_12">Motivo da Reprovação</label>
							<input id="motivo" name="motivo" type="text" class="forms" size="80" required />&nbsp;&nbsp;<input type="submit" class="btn btn-danger btn-sm" value="Reprovar" />
							<input type="hidden" name="idsolicitacao" value="<?= $solicitacao['id'] ?>" />
						</div>
						<div>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include "footer.php"; ?>

	<script>
		$('input[size="13"]').click(function() {

			$(this).next().show('800').css('display', 'inline');

		});


		$('input[size="13"]').blur(function() {

			if ($(this).val() == '') {
				alert('um campo ficou em branco');
			}

		});
		$('select[name="s\\[\\]"]').blur(function() {
			var M = 0;
			var F = 0;
			$('select[name="s\\[\\]"]').each(function() {
				if ($(this).val() == 'Masc') {
					M += 1;
				} else {
					if ($(this).val() == 'Fêmea') F += 1;
				}
			})
			$('#Masc').val(M);
			$('#Fêmea').val(F);
			$('#Masc2').val(M);
			$('#Fêmea2').val(F);

		});

		//$('.wrappern input').click(function(){$(this).val('');});

		$('input').bind('click', function(e) {
			var txt = e.target.value;
			if (txt == 'digite o nome..' || txt == 'Nome Filhote' || txt == 'Nome Pedigree') e.target.value = '';
		});

		$('input').bind("keydown", function(e) {


			var code = e.keyCode || e.which;
			if (code == 13) {
				e.preventDefault();
				return false;
			}
		});

		$('input[class=parent]').bind("keypress", function(e) {

			var txt = e.target.value;
			//alert(txt.length);
			//if(txt.length>50){alert('Limite de digitação alcançado!');return false;}

		});

		$('input[size="13"]').bind("keypress", function(e) {

			var txt = e.target.value;
			//alert(txt.length);
			//if(txt.length>50){alert('Limite de digitação alcançado!');return false;}

		});


		$('#nc option').click(function(ev) {
			$('input[name=cani]').val(ev.currentTarget.title)
		});

		/*
		$.get( "post_progenitores.php?id=<?php echo $_SESSION['cid']; ?>&pt=1&r="+Math.random(), function( data ) {
		  $('#pai1').html( data );
		});
		$.get( "post_progenitores.php?id=<?php echo $_SESSION['cid']; ?>&pt=2&r="+Math.random(), function( data ) {
		  $('#pai2').html( data );
		});
		*/

		$('input[name="n\\[\\]"]:gt(4)').attr('readonly', 'readonly').unbind();

		$('input[name="n\\[\\]"]:gt(4)').css('color', 'gray');

		$('#ativa2').change(function() {

			var rac = $('#subcategoria').val();
			//alert(rac);

			if (rac == 287 || rac == 346 || rac == 347 || rac == 348) {
				$('.vv2').html('<option>Pelo Curto</option><option>Pelo Duro</option><option>Pelo Longo</option><option>Miniatura Pelo Curto</option><option>Miniatura Pelo Longo</option><option>Miniatura Pelo Duro</option><option>Standard Pelo Curto</option><option>Standard Pelo Longo</option><option>Standard Pelo Duro</option><option>Kaninchen Pelo Curto</option><option>Kaninchen Pelo Longo</option><option>Kaninchen Pelo Duro</option>');
			}

			if (rac == 297 || rac == 363 || rac == 364) {
				$('.vv2').html('<option>Pelado</option><option>Pelo Longo</option>');
			}

			if (rac == 210 || rac == 355 || rac == 380) {
				$('.vv2').html('<option value=" ">Sem variedade</option><option>Anão</option><option>Pequeno</option><option>Médio</option>');
			}

			if (rac == 298) {
				$('.vv2').html('<option>Pelo curto</option><option>Pelo Longo</option>');
			}

		});
	</script>
	<style>
		.forms select {
			height: 40px;
		}

		#gs {
			display: none
		}

		button {
			position: relative;
		}

		.parent {
			width: 95%;
			background-color: rgb(233, 234, 237);
			border: 0px solid;
			border-bottom: 1px solid;
			color: #5d5c5c;
			margin-left: 0px;
			position: relative;
			top: 4px;
			left: -6px;
			font-size: 10px;
		}

		.tit_grid {
			width: 25%
		}

		.wrapper {
			position: relative;
			float: left;
			left: -6px;
			width: 990px;
			background-color: transparent;
			padding-top: 6px;
		}

		.wp1 {
			position: relative;
			float: left;
			left: 5px;
			width: 20%
		}

		.wp1 div {
			width: 100%;
			margin-bottom: 10px;
		}

		.g11 {
			height: 190px;
			background-color: rgb(233, 234, 237);

		}

		.g12 {
			height: 190px;
			background-color: rgb(233, 234, 237);

		}

		.g13 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g14 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g15 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g16 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g17 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g18 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.wp2 {
			position: relative;
			float: left;
			left: 15px;
			width: 23%;
		}

		.wp2 div {
			width: 100%;
			margin-bottom: 10px;
		}

		.g21 {
			height: 90px;
			background-color: rgb(233, 234, 237);

		}

		.g22 {
			height: 90px;
			background-color: rgb(233, 234, 237);

		}

		.g23 {
			height: 90px;
			background-color: rgb(233, 234, 237);

		}

		.g24 {
			height: 90px;
			background-color: rgb(233, 234, 237);

		}

		.g25 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g26 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g27 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g28 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.wp3 {
			position: relative;
			float: left;
			left: 25px;
			width: 25%;
		}

		.wp3 div {
			width: 100%;
			margin-bottom: 10px;
		}

		.g31 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g32 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g33 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g34 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g35 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g36 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g37 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g38 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.wp4 {
			position: relative;
			float: left;
			left: 35px;
			width: 25%;
		}

		.wp4 div {
			width: 100%;
			margin-bottom: 10px;
		}

		.g41 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g42 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g43 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g44 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g45 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g46 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g47 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g48 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.wp5 {
			position: relative;
			float: left;
			left: 45px;
			width: 40px;
		}

		.wp5 div {
			width: 100%;
			margin-bottom: 10px;
		}

		.g51 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g52 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g53 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g54 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g55 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g56 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g57 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g58 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.wp6 {
			position: relative;
			float: left;
			left: 55px;
			width: 40px;
		}

		.wp6 div {
			width: 100%;
			margin-bottom: 10px;
		}

		.g61 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g62 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g63 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g64 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g65 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g66 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g67 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g68 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.wp7 {
			position: relative;
			float: left;
			left: 65px;
			width: 40px;
		}

		.wp7 div {
			width: 100%;
			margin-bottom: 10px;
		}

		.g71 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g72 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g73 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g74 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g75 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g76 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g77 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g78 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.wp8 {
			position: relative;
			float: left;
			left: 75px;
			width: 40px;
		}

		.wp8 div {
			width: 100%;
			margin-bottom: 10px;
		}

		.g81 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g82 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g83 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g84 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g85 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g86 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g87 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g88 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.wp9 {
			position: relative;
			float: left;
			left: 85px;
			width: 40px;
		}

		.wp9 div {
			width: 100%;
			margin-bottom: 10px;
		}

		.g91 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g92 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g93 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g94 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g95 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g96 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g97 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g98 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.wp10 {
			position: relative;
			float: left;
			left: 95px;
			width: 40px;
		}

		.wp10 div {
			width: 100%;
			margin-bottom: 10px;
		}

		.g101 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g102 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g103 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g104 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g105 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g106 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g107 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g108 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.wp11 {
			position: relative;
			float: left;
			left: 105px;
			width: 40px;
		}

		.wp11 div {
			width: 100%;
			margin-bottom: 10px;
		}

		.g111 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g112 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g113 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g114 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g115 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g116 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g117 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g118 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.wp12 {
			position: relative;
			float: left;
			left: 115px;
			width: 40px;
		}

		.wp12 div {
			width: 100%;
			margin-bottom: 10px;
		}

		.g121 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g122 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g123 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g124 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g125 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g126 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g127 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}

		.g128 {
			height: 40px;
			background-color: rgb(233, 234, 237);

		}


		/*ninhada*/

		.wrappern {
			position: relative;
			left: 0px;
			float: left;
			width: 614px;
			background-color: #fff;
			color: #999;
			font-size: 14px;
			padding: 3px;
			padding-top: 24px;
			padding-bottom: 24px;

		}

		.wrappern input {
			border: 0px solid white;
			border-bottom: 1px solid #5d5c5c;
			background-color: rgb(233, 234, 237);
			color: #5d5c5c;
			font-size: 14px;
			6px;
			margin-left: 4px;
			display: inline
		}

		.nwp1 {
			position: relative;
			float: left;
			left: 2px;
			width: 95px;

		}

		.nwp1 div {
			width: 100%;
			margin-bottom: 4px;
		}

		.ng11 {
			height: 35px;
			background-color: rgb(233, 234, 237);

		}

		.ng12 {
			height: 55px;
			background-color: rgb(233, 234, 237);

		}

		.ng13 {
			height: 47px;
			background-color: rgb(233, 234, 237);

		}

		.ng13 input {
			padding-top: 10px;
			4px;
			font-size: 11px
		}

		.ng14 {
			height: 55px;
			background-color: rgb(233, 234, 237);

		}

		.ng15 {
			height: 47px;
			background-color: rgb(233, 234, 237);

		}

		.ng15 input {
			padding-top: 10px;
			4px;
			font-size: 11px
		}

		.nwp2 {
			position: relative;
			float: left;
			left: 6px;
			width: 124px;
		}

		.nwp2 div {
			width: 100%;
			margin-bottom: 4px;
		}

		.ng21 {
			height: 35px;
			background-color: rgb(233, 234, 237);

		}

		.ng22 {
			height: 106px;
			background-color: rgb(233, 234, 237);

		}

		.ng23 {
			height: 106px;
			background-color: rgb(233, 234, 237);

		}

		.ng24 {
			height: 124px;
			background-color: rgb(233, 234, 237);

		}

		.ng25 {
			height: 124px;
			background-color: rgb(233, 234, 237);

		}

		.nwp3 {
			position: relative;
			float: left;
			left: 10px;
			width: 124px;
		}

		.nwp3 div {
			width: 100%;
			margin-bottom: 4px;
		}

		.ng31 {
			height: 35px;
			background-color: rgb(233, 234, 237);

		}

		.ng32 {
			height: 106px;
			background-color: rgb(233, 234, 237);

		}

		.ng33 {
			height: 106px;
			background-color: rgb(233, 234, 237);

		}

		.ng34 {
			height: 124px;
			background-color: rgb(233, 234, 237);

		}

		.ng35 {
			height: 124px;
			background-color: rgb(233, 234, 237);

		}

		.nwp4 {
			position: relative;
			float: left;
			left: 14px;
			width: 124px;
		}

		.nwp4 div {
			width: 100%;
			margin-bottom: 4px;
		}

		.ng41 {
			height: 35px;
			background-color: rgb(233, 234, 237);

		}

		.ng42 {
			height: 106px;
			background-color: rgb(233, 234, 237);

		}

		.ng43 {
			height: 106px;
			background-color: rgb(233, 234, 237);

		}

		.ng44 {
			height: 124px;
			background-color: rgb(233, 234, 237);

		}

		.ng45 {
			height: 124px;
			background-color: rgb(233, 234, 237);

		}

		.nwp5 {
			position: relative;
			float: left;
			left: 18px;
			width: 124px;
		}

		.nwp5 div {
			width: 100%;
			margin-bottom: 4px;
		}

		.ng51 {
			height: 35px;
			background-color: rgb(233, 234, 237);

		}

		.ng52 {
			height: 106px;
			background-color: rgb(233, 234, 237);

		}

		.ng53 {
			height: 106px;
			background-color: rgb(233, 234, 237);

		}

		.ng54 {
			height: 124px;
			background-color: rgb(233, 234, 237);

		}

		.ng55 {
			height: 124px;
			background-color: rgb(233, 234, 237);

		}
	</style>

	<script>
		function mandar() {
			var jqxhr = $.post("<?php if ($_SESSION['id'] == 17) echo 'sucesso_pedigree_ext_ou_direto.php';
								else echo 'sucesso_pedigree_ext_ou3.php'; ?>", $("#tform").serialize(), function() {})
				.done(function(data) {
					alert("pedigree enviado para aprovação!");
					location = '<?php if ($_SESSION['id'] == 17) {
									echo 'index_principal.php';
								} else {
									echo 'sucesso_pedigree_re.php';
								} ?>?id=' + data;
				})
				.fail(function() {
					alert("Tente novamente");
				})
				.always(function() {
					//alert( "finished" );
				});
		}
	</script>
</body>

</html>