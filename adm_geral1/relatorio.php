<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$sql = "SELECT * FROM rgc WHERE id='$_GET[id]'";
//$query = mysql_query($sql) or die(mysql_error());
//$linha = mysql_fetch_array($query);

$sql = "SELECT  *  FROM  `credenciado` left join dados_credenciado on credenciado.id_credenciado=dados_credenciado.id_dados   WHERE id_credenciado not in (16,44,68,43,17,15,43,41,109,102,111) and id_credenciado>85 order by nome";


$sel='<option value="102">Kennel Clube Brasil</option>';
$query = mysql_query($sql) or die(mysql_error());
while($opt=mysql_fetch_assoc($query)){
if($opt['id_credenciado']!=92){$sel.='<option value="'.$opt['id_credenciado'].'">'.$opt['nome'].'</option>';} else {$sel.='<option value="92">Kennel Clube Rio de Janeiro</option>';}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle " /> 
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle  .::</title>

<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="stylesheet" href="jquery/modal/reveal.css">
<link rel="stylesheet" href="jquery/alerta/jquery-ui.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="jquery/galeria/highslide/highslide.css" />
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<script src="jquery/alerta/jquery-ui.min.js"></script>
<script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>
<script type="text/javascript" src="jquery/clone/reCopy.js"></script>
<script type="text/javascript" src="jquery/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<script type="text/javascript">
$(function(){
  var removeLink = ' <a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"><img src="images/icons/excluir.png" /></a>';
$('a.add').relCopy({ append: removeLink});	
});
</script>
<script type="text/javascript">
	//$(function() {
	$(document).ready(function(){	
			$("#yesno").easyconfirm({locale: { title: 'Deseja realmente deletar esta sub-categoria?', button: ['Não','Sim']}});
			$("#yesno").click(function() {
				$.post("deletar_subcategoria.php",
					{id: <?php echo $_GET['id']; ?>},
	   				 function(retorno){
						//$("#resultado").html(retorno);
						window.location="listagem_subcategoria.php";
        			 } 
        		);
		});	
	});
</script>
<style>
#emailForm input{
	width: 420px;
	height: 22px;
	background-color: white;
	border: solid 1px #CCC;	
}
</style>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
   	  <div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Relatórios          
            <div style="float:right; margin-left:10px;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior" ></a></div>
          <div style="float:right; margin-right:10px;"></div>          
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
         
         <form method="post" action="sucesso_relatorio.php" name="emailForm" id="emailForm" enctype="multipart/form-data" style="margin-left: 143px;margin-top: 69px;">
<H1 >Relatório dos criadores</h1><br><br>

Kennel: <br>
                <select name="knl"  ><option value='-'>Selecione um Kennel..</option><?=$sel;?></select>
                <br>
Raça: <br>
                <input type="text" name="raca" size="30" value="-" >
                <br>
                Estado:<br>
                <select id="estado" name="estado">
    <option value="-"> - </option>
    <option value="AC">Acre</option>
    <option value="AL">Alagoas</option>
    <option value="AP">Amapá</option>
    <option value="AM">Amazonas</option>
    <option value="BA">Bahia</option>
    <option value="CE">Ceará</option>
    <option value="DF">Distrito Federal</option>
    <option value="ES">Espírito Santo</option>
    <option value="GO">Goiás</option>
    <option value="MA">Maranhão</option>
    <option value="MT">Mato Grosso</option>
    <option value="MS">Mato Grosso do Sul</option>
    <option value="MG">Minas Gerais</option>
    <option value="PA">Pará</option>
    <option value="PB">Paraíba</option>
    <option value="PR">Paraná</option>
    <option value="PE">Pernambuco</option>
    <option value="PI">Piauí</option>
    <option value="RJ">Rio de Janeiro</option>
    <option value="RN">Rio Grande do Norte</option>
    <option value="RS">Rio Grande do Sul</option>
    <option value="RO">Rondônia</option>
    <option value="RR">Roraima</option>
    <option value="SC">Santa Catarina</option>
    <option value="SP">São Paulo</option>
    <option value="SE">Sergipe</option>
    <option value="TO">Tocantins</option>
</select>              
                <br>
		Cidade: <br>
                <input type="text" name="cidade" size="30" value="-" >
                <br>
                <br>
		CEP: <br>
                <input type="text" name="cep" size="30" value="-" >
                <br> 
                Período:<br>
                <input type="date" name="ini" placeholder="Inicio" style="width:180px">&nbsp;&nbsp;&nbsp;&nbsp;Até&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" name="fim" placeholder="Fim" style="width:180px">  
<!-- Até
<select name="ano2">
				<option value="-">-</option>
          <option value="2019">2019</option>
          <option value="2018">2018</option>
          <option value="2017">2017</option>
          <option value="2016">2016</option>
          <option value="2015">2015</option>
          <option value="2014">2014</option>
          <option value="2013">2013</option>
          <option value="2012">2012</option>
          <option value="2011">2011</option>
          <option value="2010">2010</option>
          <option value="2009">2009</option>
          <option value="2008">2008</option>
          <option value="2007">2007</option>
          <option value="2006">2006</option>
          <option value="2005">2005</option>
          <option value="2004">2004</option>
          <option value="2003">2003</option>
          <option value="2002">2002</option>
          <option value="2001">2001</option>
          <option value="2000">2000</option>
          <option value="1999">1999</option>
          <option value="1998">1998</option>
          <option value="1997">1997</option>
          <option value="1996">1996</option>
          <option value="1995">1995</option>
          <option value="1994">1994</option>
          <option value="1993">1993</option>
          <option value="1992">1992</option>
          <option value="1991">1991</option>
          <option value="1990">1990</option>
          <option value="1989">1989</option>
          <option value="1988">1988</option>
          <option value="1987">1987</option>
          <option value="1986">1986</option>
          <option value="1985">1985</option>
          <option value="1984">1984</option>
          <option value="1983">1983</option>
          <option value="1982">1982</option>
          <option value="1981">1981</option>
          <option value="1980">1980</option>
          <option value="1979">1979</option>
          <option value="1978">1978</option>
          <option value="1977">1977</option>
          <option value="1976">1976</option>
          <option value="1975">1975</option>
</select>   -->
                             
                            
                <br><br>

                
                <input name="enviar" type="submit" value="Gerar">
		<br><br><br><br>
                </form>
                
            
           </div>
        </div>
         </div>
    </div>   
    </div> 
  </div>
</div>
<script>
var l='lock';
$('#subz').append('<input type="hidden" name="'+l+'" value="'+Math.random()+'">');
</script>
<?php include "footer.php";?>
</body>
</html>
