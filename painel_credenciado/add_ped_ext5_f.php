<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

$rg=(int)$_GET['rgc'];
$sql = "select * from rgc where id=".$rg;

$query = mysql_query($sql) or die (mysql_error());
$linhadono = mysql_fetch_assoc($query);

$qcr=mysql_query('SELECT * FROM  criadores  where id_criador in (select id_criador from aprovados where 1) order by nome ');

$qped=mysql_query("select *  from pedigree order by id_ped desc limit 1");

$fped=mysql_fetch_assoc($qped);



if($_SESSION['id']!=44&&$_SESSION['id']!=17)$fraca=' and idSubcategoria NOT IN (160) ';

/*
$q2=mysql_query('select * from credenciado join dados_credenciado ON id_credenciado=id_dados where id_credenciado='.$fc['id_credenciado']);
$fr=mysql_fetch_assoc($q2);
*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle - NEOWARE" /> 
<meta name="Description" content="Painel de Controle - NEOWARE"/> 
<meta name="copyright" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle - NEOWARE .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<link type="text/css" href="jquery/jqueryui/css/redmond/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="jquery/jqueryui/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jquery/jqueryui/js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript" src="jquery/clone/reCopy.js"></script>

<script type="text/javascript">
$(function(){
	// Datepicker
	$('#dataInicial').datepicker({
		inline: true,
		dateFormat: "dd/mm/yy",
		altField: "#dataInicialEpoch",
		altFormat: "@"
	});
	// Datepicker
	$('#dataFinalx').datepicker({
		inline: true,
		dateFormat: "dd/mm/yy",
		altField: "#dataFinalEpoch",
		altFormat: "@"
	});
	$('#dataFinal').val( "<?php echo date('d/m/Y');?>" );
	$('#dataFinalEpoch').val("<?php echo time();?>000");
	$('#dataInicialEpoch').val("<?php echo time();?>000");
});
</script>
<!--Editor de Texto -->
<!-- TinyMCE -->
<script type="text/javascript" src="jquery/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<!-- /TinyMCE -->
<script type="text/javascript">
      
      $(document).ready(function(){
         
         $("select[name=categoria]").change(function(){
            $("select[name=subcategoria]").html('<option value="0">Carregando...</option>');
            
            $.post("subcategoria_j.php", 
                  {categ:$(this).val()},
                  function(valor){
					  //alert(valor);
                     $("select[name=subcategoria]").html(valor);
                  }
                  );
            
         });
		 
		 $("select[name=subcategoria]").change(function(){

            
            $.post("subsubcategoria_j.php", 
                  {subcateg:$(this).val()},
                  function(valor){
					  //alert(valor);
                     $("select[name=cor]").html(valor);
			$('.ccc').each(function(ind,ele){$(ele).after('<select class="ccc" name="c[]">'+valor+'</select><input name="m[]" size="13" placeholder="microchip">').remove();});
                  }
                  );

		
		$.post("subsubcategoria_p.php", 
                  {subcateg:$(this).val()},
                  function(valor){
			//alert(valor);
                     $("input[name=pais]").val(valor);
		
                  });
            
            
         });
		 
      });
</script>
<script type="text/javascript">
$(function(){
  var removeLink = ' <a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"><img src="images/icons/excluir.png" /></a>';
$('a.add').relCopy({ append: removeLink});
$('.parent').val('digite o nome..');

});
</script>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<form  method="post" class="pedform" onsubmit="return false;" id="tform"  enctype="multipart/form-data">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo" style="color:white">Pedigree Outra Entidade 
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            &nbsp;
			<table width="100%" border="0" cellspacing="6" cellpadding="0">

  			  <tr style="display:none;">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Nome ninhada:</label></td>
    				<td><input name="id_credenciado" type="hidden" value="<?=$_SESSION['id']?>"><input name="tituloAposta" type="text" class="forms" id="tituloAposta" size="65" value="-"/></td>
			  </tr>
			 <tr style="display:none">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Microchip:</label></td>
    				<td><input name="microchip" type="text" class="forms" id="tituloAposta" size="65" /></td>
			  </tr>

  
              
              <tr>
    				<td align="right"><label for="subcategoria" class="arial_cinza2_12" >Raça:</label></td>
    				<td>
    				  <select name="subcategoria" id="subcategoria" class="forms" required>
						<option>Selecione uma Raça.</option>
    				                          <?php
					  	$sqlcateg = "SELECT * FROM subcategoria where 1 $fraca ORDER BY nomeSubcategoria ASC";
						$querycateg = mysql_query($sqlcateg) or die(mysql_error());
						while($linhacateg = mysql_fetch_array($querycateg)){
							echo"
								<option value='$linhacateg[idSubcategoria]'>$linhacateg[nomeSubcategoria]</option>
							";	
						}
					  ?>
			        </select>
				</td>
			  </tr>
          		
        <tr style="display:none">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >cor:</label></td>
    				<td><input name="cor" value="cor" class="forms"></td>
			  </tr>
              <tr>
    				<td align="right"><label for="dataInicial" class="arial_cinza2_12" >Data Nascimento:</label></td>
    				<td><input name="dataInicial" type="text" class="forms" id="dataInicial" size="65" placeholder="00/00/00" autocomplete="off" onkeydown="return false;" required/>
   				    <input type="hidden" name="dataInicialEpoch" id="dataInicialEpoch"></td>
			  </tr>
              
             
              
              <tr style="display:none">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >sexo:</label></td>
    				<td><input name="sexo" type="text" class="forms"  size="65" value="fem"/></td>
			  </tr>
           
              
              <tr>
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >País de origem:</label></td>
    				<td><input name="pais" type="text" class="forms"  size="65" required/></td>
			  </tr>
              
              <tr style="display:none">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Registro :</label></td>
    				<td><input name="registro" type="text" class="forms"  value="<?php echo 'RGE 1'.$fped['id_ped'];?>" size="65" /></td>
			  </tr>

		
                <tr>
    				<td align="right"><label for="dataInicial" class="arial_cinza2_12" >Data Emissão:</label></td>
    				<td><input name="dataFinal" type="text" class="forms" id="dataFinal" size="65" readonly onkeydown="return false;" required/>
   				    <input type="hidden" name="dataFinalEpoch" id="dataFinalEpoch"></td>
			  </tr>
              
              <tr style="display:none">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >ninhada:</label></td>
    				<td><input name="ninhada_no" type="text" class="forms" value="***" size="65" /></td>
			  </tr>


              <tr  style="display:none">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Amigo:</label></td>
    				<td><input name="amigo" type="text" class="forms"  size="65" value="***" /></td>
			  </tr>

              <tr>
    				<td align="right"><label for="criador" class="arial_cinza2_12" >Agregar em:</label></td>
    				<td><select name="criador"  class="forms" style="width: 606px;"/><?php
				while($fcr=mysql_fetch_assoc($qcr)){
					echo '<option value="'.$fcr['id_criador'].'">'.$fcr['nome'].'</option>';
				}
				?></select></td>
			  </tr>
              <tr>
    				<td align="right"><label for="canil" class="arial_cinza2_12" >criador externo:</label></td>
    				<td><input name="criador_ex"  type="text" class="forms"  size="65" value="" required/></td>
			  </tr>
              <tr>
    				<td align="right"><label for="canil" class="arial_cinza2_12" >canil:</label></td>
    				<td><input name="cani"  type="text" class="forms"  size="65" value="" required/></td>
			  </tr>
              <tr style="display:none">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >foto:</label></td>
    				<td><input name="fotox" type="file" class="forms"  size="65" /></td>
			  </tr>


              <tr>
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Proprietário:</label></td>
    				<td><input name="proprietario"  type="text" class="forms"  size="65" value="" required/></td>
			  </tr>


              <tr>
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Endereço:</label></td>
    				<td><input name="endereço"  type="text" class="forms"  size="65"  /></td>
			  </tr>

              <tr>
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >ninhada:</label></td>
    				<td><input name="bloco_ninhada" type="hidden" class="forms"  size="65" />

				<div class="wrappern">
				     <div class="nwp1">
				  <div class="ng11"><center style="color:white;padding-top:10px">Ninhada</center>
				  </div>
				  <div class="ng12"><center style="color:white;font-size:14px;padding-top: 11px;">Nascidos<hr>M | F</center>
				  </div>
				  <div class="ng13" >
					&nbsp;&nbsp;&nbsp;<input name="n[]" size="1" id="Masc" value=" 0" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  name="n[]" id="Fêmea" size="1" value=" 0" >
				  </div>
				  <div class="ng14">
					<center style="color:white;font-size:14px;padding-top: 11px;">&nbsp</center>
				  </div>
				  <div class="ng15" >
					&nbsp;&nbsp;&nbsp;<input size="1" name="n[]"  id="Masc2" value=" 0" style="padding-top:10px;margin-top:8px;display:none">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input size="1" name="n[]" id="Fêmea2" value=" 0" style="padding-top:10px;margin-top:8px;display:none">
				  </div>
				     </div>
				     <div class="nwp2">
				  <div class="ng21">
				  </div>
				  <div class="ng22">
					<br> <input value="Nome Pedigree" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><input name="rga" placeholder="Registro Anterior"><button type="button" onclick="$(this).parent().slideUp();">ok</button></span><br><br> <input value="Nome Filhote" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><button type="button" onclick="$(this).parent().slideUp();">ok</button></span>
				  </div>
				  <div class="ng23">
					<br> <input value="Nome Filhote" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><button type="button" onclick="$(this).parent().slideUp();">ok</button></span><br><br> <input value="Nome Filhote" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><button type="button" onclick="$(this).parent().slideUp();">ok</button></span>
				  </div>
				     </div>
				     <div class="nwp3">
				  <div class="ng31">
					<center style="color:white;font-size:15px;">Nascidos na <br> Ninhada</center>
				  </div>
				  <div class="ng32">
					<br> <input value="Nome Filhote" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><button type="button" onclick="$(this).parent().slideUp();">ok</button></span><br><br> <input value="Nome Filhote" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><button type="button" onclick="$(this).parent().slideUp();">ok</button></span>
				  </div>
				  <div class="ng33">
					<br> <input value="Nome Filhote" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><button type="button" onclick="$(this).parent().slideUp();">ok</button></span><br><br> <input value="Nome Filhote" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><button type="button" onclick="$(this).parent().slideUp();">ok</button></span>
				  </div>
				     </div>
				     <div class="nwp4">
				  <div class="ng41">
				  </div>
				  <div class="ng42">
					<br> <input value="Nome Filhote" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><button type="button" onclick="$(this).parent().slideUp();">ok</button></span><br><br> <input value="Nome Filhote" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><button type="button" onclick="$(this).parent().slideUp();">ok</button></span>
				  </div>
				  <div class="ng43">
					<br> <input value="Nome Filhote" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><button type="button" onclick="$(this).parent().slideUp();">ok</button></span><br><br> <input value="Nome Filhote" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><button type="button" onclick="$(this).parent().slideUp();">ok</button></span>
				  </div>
				     </div>
				     <div class="nwp5">
				  <div class="ng51">
				  </div>
				  <div class="ng52">
					<br> <input value="Nome Filhote" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><button type="button" onclick="$(this).parent().slideUp();">ok</button></span><br><br> <input value="Nome Filhote" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><button type="button" onclick="$(this).parent().slideUp();">ok</button></span>
				  </div>
				  <div class="ng53">
					<br> <input value="Nome Filhote" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><button type="button" onclick="$(this).parent().slideUp();">ok</button></span><br><br> <input value="Nome Filhote" name="n[]"  maxlength="50"  size="13"><span style="display:none;background-color:gray;"><br><select name="s[]"><option value="">selecione..</option><option value="Masc">Masc</option><option value="Fêmea">Fêmea</option></select><br> <input value="cor.." class="ccc" name="c[]" size="13"><br><button type="button" onclick="$(this).parent().slideUp();">ok</button></span>
				  </div>
				     </div>
				 </div> 
				</td>
			  </tr>


          

              <tr>
    				<td align="right"><label for="descricao" class="arial_cinza2_12" >Descendentes:</label></td>
    				<td style="background-color: white;padding-top: 14px;z-index:1000;"><span style="width:150px;display: inline-block;">Pais </span><span style="width:150px;display: inline-block;">Avós </span><span style="width:150px;display: inline-block;">Bisavós </span><span style="width:150px;display: inline-block;">Trisavós </span>
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
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Obs:</label></td>
    				<td>
   				    <textarea name="obs" id="regras" cols="45" rows="5" class="forms"></textarea></td>
</tr>
             
         
              <tr><td><input type="submit" id="gs" ><span onclick="mandar();" style="width: 80px;height: 40px;background-color: #709E5E;color: white;">Enviar</span></td>
			  </tr>

             
			</table>
           </div>
            </div>
         </div>
         
         
        
         
         
        </div>
    </div>
    
  </div>
</div>
<?php include "footer.php";?>
  </form>
<script>
$('input[size="13"]').click(function(){

	$(this).next().show('800').css('display','inline');

});


$('input[size="13"]').blur(function(){

	if($(this).val()==''){alert('um campo ficou em branco');}

});
$('select[name="s\\[\\]"]').blur(function(){
	var M=0;
	var F=0;
	$('select[name="s\\[\\]"]').each(function(){if($(this).val()=='Masc'){ M+=1;}else{if($(this).val()=='Fêmea')F+=1;}})
	$('#Masc').val(M);
	$('#Fêmea').val(F);
	$('#Masc2').val(M);
	$('#Fêmea2').val(F);
	
});

//$('.wrappern input').click(function(){$(this).val('');});

$('input').bind('click',function(e){
	var txt=e.target.value;
	if(txt=='digite o nome..'||txt=='Nome Filhote'||txt=='Nome Pedigree')e.target.value='';
});

$('input').bind("keydown", function(e) {


  var code = e.keyCode || e.which; 
  if (code  == 13) {               
    e.preventDefault();
    return false;
  }
});

$('input[class=parent]').bind("keypress", function(e) {

	var txt=e.target.value;
	//alert(txt.length);
	//if(txt.length>50){alert('Limite de digitação alcançado!');return false;}
  
});

$('input[size="13"]').bind("keypress", function(e) {

	var txt=e.target.value;
	//alert(txt.length);
	//if(txt.length>50){alert('Limite de digitação alcançado!');return false;}
  
});

/*
$.get( "post_progenitores.php?id=<?php echo $_SESSION['cid'];?>&pt=1&r="+Math.random(), function( data ) {
  $('#pai1').html( data );
});
$.get( "post_progenitores.php?id=<?php echo $_SESSION['cid'];?>&pt=2&r="+Math.random(), function( data ) {
  $('#pai2').html( data );
});
*/

$('input[name="n\\[\\]"]:gt(4)').attr('readonly','readonly').unbind();

$('input[name="n\\[\\]"]:gt(4)').css('color','gray');

</script>
<style>
#gs {display:none}
button{
	position:relative;
}
.parent{
width:85%;
background-color: rgb(130, 130, 130);
border: 0px solid;
border-bottom: 1px solid;
color: white;
margin-left: 9px;
position: relative;
top: 4px;
}
.tit_grid{width:25%}
.wrapper{
	position: relative;
	float: left;
	left: 0px;
	width: 623px;
	background-color: #FFFFFF;
	padding-top: 6px;
}
.wp1{
	position: relative;
	float: left;
	left: 5px;
	width: 20%
}
.wp1 div{
	width: 100%;
	margin-bottom: 10px;
}
.g11{
	height: 190px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g12{
	height: 190px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g13{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g14{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g15{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g16{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g17{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g18{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.wp2{
	position: relative;
	float: left;
	left: 15px;
	width: 23%;
}
.wp2 div{
	width: 100%;
	margin-bottom: 10px;
}
.g21{
	height: 90px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g22{
	height: 90px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g23{
	height: 90px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g24{
	height: 90px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g25{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g26{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g27{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g28{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.wp3{
	position: relative;
	float: left;
	left: 25px;
	width: 25%;
}
.wp3 div{
	width: 100%;
	margin-bottom: 10px;
}
.g31{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g32{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g33{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g34{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g35{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g36{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g37{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g38{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.wp4{
	position: relative;
	float: left;
	left: 35px;
	width: 25%;
}
.wp4 div{
	width: 100%;
	margin-bottom: 10px;
}
.g41{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g42{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g43{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g44{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g45{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g46{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g47{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g48{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.wp5{
	position: relative;
	float: left;
	left: 45px;
	width: 40px;
}
.wp5 div{
	width: 100%;
	margin-bottom: 10px;
}
.g51{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g52{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g53{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g54{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g55{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g56{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g57{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g58{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.wp6{
	position: relative;
	float: left;
	left: 55px;
	width: 40px;
}
.wp6 div{
	width: 100%;
	margin-bottom: 10px;
}
.g61{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g62{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g63{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g64{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g65{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g66{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g67{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g68{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.wp7{
	position: relative;
	float: left;
	left: 65px;
	width: 40px;
}
.wp7 div{
	width: 100%;
	margin-bottom: 10px;
}
.g71{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g72{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g73{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g74{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g75{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g76{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g77{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g78{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.wp8{
	position: relative;
	float: left;
	left: 75px;
	width: 40px;
}
.wp8 div{
	width: 100%;
	margin-bottom: 10px;
}
.g81{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g82{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g83{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g84{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g85{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g86{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g87{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g88{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.wp9{
	position: relative;
	float: left;
	left: 85px;
	width: 40px;
}
.wp9 div{
	width: 100%;
	margin-bottom: 10px;
}
.g91{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g92{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g93{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g94{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g95{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g96{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g97{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g98{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.wp10{
	position: relative;
	float: left;
	left: 95px;
	width: 40px;
}
.wp10 div{
	width: 100%;
	margin-bottom: 10px;
}
.g101{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g102{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g103{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g104{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g105{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g106{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g107{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g108{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.wp11{
	position: relative;
	float: left;
	left: 105px;
	width: 40px;
}
.wp11 div{
	width: 100%;
	margin-bottom: 10px;
}
.g111{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g112{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g113{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g114{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g115{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g116{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g117{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g118{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.wp12{
	position: relative;
	float: left;
	left: 115px;
	width: 40px;
}
.wp12 div{
	width: 100%;
	margin-bottom: 10px;
}
.g121{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g122{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g123{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g124{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g125{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g126{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g127{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.g128{
	height: 40px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}


/*ninhada*/

.wrappern{
	position: relative;
	left: 0px;
	float: left;
	width: 614px;
	background-color: #fff;
	color: #999;
	font-size: 14px;
	padding: 3px;
}
.wrappern input{ border: 0px solid white;border-bottom: 1px solid white;background-color: rgb(128, 128, 128);color: #FFFFFF;font-size: 14px;margin-top: 6px;margin-left: 4px;display:inline}
.nwp1{
	position: relative;
	float: left;
	left: 2px;
	width: 95px;
	
}
.nwp1 div{
	width: 100%;
	margin-bottom: 4px;
}

.ng11{
	height: 35px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng12{
	height: 55px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng13{
	height: 47px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng13 input{padding-top:10px;margin-top:4px;font-size:11px}
.ng14{
	height: 55px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng15{
	height: 47px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng15 input{padding-top:10px;margin-top:4px;font-size:11px}
.nwp2{
	position: relative;
	float: left;
	left: 6px;
	width: 124px;
}
.nwp2 div{
	width: 100%;
	margin-bottom: 4px;
}
.ng21{
	height: 35px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng22{
	height: 106px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng23{
	height: 106px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng24{
	height: 124px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng25{
	height: 124px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.nwp3{
	position: relative;
	float: left;
	left: 10px;
	width: 124px;
}
.nwp3 div{
	width: 100%;
	margin-bottom: 4px;
}
.ng31{
	height: 35px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng32{
	height: 106px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng33{
	height: 106px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng34{
	height: 124px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng35{
	height: 124px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.nwp4{
	position: relative;
	float: left;
	left: 14px;
	width: 124px;
}
.nwp4 div{
	width: 100%;
	margin-bottom: 4px;
}
.ng41{
	height: 35px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng42{
	height: 106px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng43{
	height: 106px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng44{
	height: 124px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng45{
	height: 124px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.nwp5{
	position: relative;
	float: left;
	left: 18px;
	width: 124px;
}
.nwp5 div{
	width: 100%;
	margin-bottom: 4px;
}
.ng51{
	height: 35px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng52{
	height: 106px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng53{
	height: 106px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng54{
	height: 124px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}
.ng55{
	height: 124px;
	background-color: rgb(130, 130, 130);
	margin-top: 
}

</style>

<script>
function mandar(){
var jqxhr = $.post( "<?php if($_SESSION['id']==17)echo 'sucesso_pedigree_ext_ou_direto.php'; else echo 'sucesso_pedigree_ext_ou2.php';?>",$( "#tform" ).serialize(), function() {
  

})
  .done(function(data) {
    //alert( "second success" );
 alert( "pedigree enviado para aprovação!" );
	location='<?php if($_SESSION['id']==17)echo 'index_principal.php'; else echo 'sucesso_pedigree_re.php';?>?id='+data;


  })
  .fail(function() {
    alert( "Tente novamente" );
  })
  .always(function() {
    //alert( "finished" );
});
}
</script>
</body>
</html>
