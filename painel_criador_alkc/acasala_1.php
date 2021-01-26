<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

$id_cria=(int)$_SESSION['cid'];
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
<title>::. Painel de Controle  .::</title>

  <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>





<style>
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
  }
  </style>
  <script>
  (function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Mostrar todos" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " Registro inválido" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );
 
  $(function() {

    //$( "#combobox2" ).combobox();
    $( "#toggle" ).click(function() {
      //$( "#combobox" ).toggle();
    });
  });


  </script>

<script type="text/javascript">
      
     
</script>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<form action="" method="post" class="pedform" enctype="multipart/form-data">
<?php include "header_l.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo" style="color:white">Novo Cruzamento 
            <div style="float:right;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" width="74" height="22" border="0" title="Voltar página anterior" ></a></div>
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            &nbsp;
			<?php if(isset($_GET['raca'])){?><table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr >
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Registro do Pai:</label></td>
    				<td>
  <select id="combobox" required>

  </select>
					</td>
			  </tr>
			 <tr >
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Registro da Mãe:</label></td>
    				<td>
<select id="combobox2" required>

  </select>
<input type="hidden" name="ra" id="rac" value="<?=$_GET['raca']?>">
</td>
			  </tr>

			 <tr >
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Data:</label></td>
    				<td>
<input name="data" id="data" type="date" placeholder="00/00/0000">

</td>
			  </tr>

			 <tr >
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Obs:</label></td>
    				<td>
<input name="obs" id="obs" type="text" >

</td>
			  </tr>

			 <tr >
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Sucesso:</label></td>
    				<td>
<input name="su" id="ck" type="checkbox" onclick="$('#ck2').val('ok');"><input type="hidden" id="ck2" value="">

</td>
			  </tr>

  			 <tr >
    				<td align="right"><input type="submit" value="Continuar" onclick="return valida();"></td></tr>
              
             
			</table><?php } else {?>

			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr >
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Selecione a Raça:</label></td>
    				<td>    				  <select name="subcategoria"  class="forms racas" required><option value="">Selecione</option>
					<?php

						//not in (346,347,348,363,364,355,380,351,352,323,353,354,365,342,369)

					  	$sqlcateg = "SELECT distinct(id_raca),nomeSubcategoria FROM pedigree join subcategoria on id_raca=idSubcategoria where id_criador=$id_cria  union SELECT distinct(id_raca),nomeSubcategoria FROM pedigree join subcategoria on id_raca=idSubcategoria where id_ped in (select id_ped from adiciona_filhote where id_criador=$id_cria)  ORDER BY nomeSubcategoria ASC";
						$querycateg = mysql_query($sqlcateg) or die(mysql_error());
						while($linhacateg = mysql_fetch_array($querycateg)){
							echo"
								<option value='$linhacateg[id_raca]'>$linhacateg[nomeSubcategoria]</option>
							";	
						}
/*
					  	$sqlcateg2 = "SELECT distinct(id_raca),nomeSubcategoria FROM pedigree join subcategoria on id_raca=idSubcategoria where id_ped in (select id_ped from adiciona_filhote where id_criador=$id_cria) and id_raca not in (346,347,348,363,364,355,380,351,352,323,353,354,365,342,369) ORDER BY nomeSubcategoria ASC";
						$querycateg2 = mysql_query($sqlcateg2) or die(mysql_error());
						while($linhacateg2 = mysql_fetch_array($querycateg2)){
							echo"
								<option value='$linhacateg2[id_raca]'>$linhacateg2[nomeSubcategoria]</option>
							";	
						}*/
					  ?></select>
					</td>
			  </tr>

</td>
			  </tr>

  			 <tr >
    				<td align="right"><input type="submit" value="Continuar" onclick="return valida2();"></td></tr>
              
             
			</table><?php }?>
           </div>
            </div>
         </div>
         
         
        
         <select id="sel1" style="display:none"></select>

         <select id="sel2" style="display:none"></select>

         
        </div>
    </div>
    
  </div>
</div>
<?php include "footer.php";?>
  </form>


 <script>

//onclick
//$('#pai1 option:selected').prop('index');

$.get( "post_progenitores_importM.php?id=<?php echo $_SESSION['cid'];?>&pt=1&rac=<?=$_GET['raca']?>&r="+Math.random(), function( data ) {
$('#sel1').html(data);
  $('#combobox').html( data );
$('#combobox option:first').text('');
	    $( "#combobox" ).combobox();
});
$.get( "post_progenitores_importF.php?id=<?php echo $_SESSION['cid'];?>&pt=2&rac=<?=$_GET['raca']?>&r="+Math.random(), function( data ) {
$('#sel2').html(data); 
 $('#combobox2').html( data );
$('#combobox2 option:first').text('');
      $( "#combobox2" ).combobox();
});

$('.racas').change(function(data){var r=$('.racas').val();location=location+'?raca='+r;});

function valida(){

var c1=$('#combobox option:selected').prop('index');

var c2=$('#combobox2 option:selected').prop('index');


var s1=$('#sel1 option:eq('+c1+')').attr('longdesc');

var s2=$('#sel2 option:eq('+c2+')').attr('longdesc');


var r1=$('#combobox option:selected').attr('alt');

var r2=$('#combobox2 option:selected').attr('alt');



var I1=$('#combobox option:selected').attr('value');

var I2=$('#combobox2 option:selected').attr('value');

var dt=$('#data').val();

var ck=$('#ck2').val();

var obs=$('#obs').val();


//console.log(s1+' '+s2);
if(s2=='Fêmea'&&s1=='Masc'){
var rac=$('#rac').val();
if(c1=='0'||c2=='0'||c1==null||c2==null){alert('Selecione um pai e mãe para cadastrar ');return false}
location='adicionar_pedigree_c.php?p1='+c1+'&p2='+c2+'&r='+rac+'&r1='+r1+'&r2='+r2+'&I1='+I1+'&I2='+I2+'&data='+dt+'&ck='+ck+'&obs='+obs;
}else alert('Escolha um macho e uma femea.');
return false;
}


</script>
<?php $qrd=mysql_query("select * from criadores where id_criador=".$_SESSION['cid']); 
	$f=mysql_fetch_assoc($qrd);
	$data2=mktime(0,0,0,(int)$f['mes_assinatura'],(int)$f['dia_assinatura'],(int)$f['ano_assinatura']+1);
	$sobra=$data2-time();
	$dias=$sobra/86400;
	echo ' <!--('.(int)$dias.' dias de assinatura restantes)-->';
	if ($dias<0) die('<script>alert("conta expirada.");location="pagar_renovacao.php";</script>');
?>
<style>

.racas{ height: 40px;}

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
</style>
</body>
</html>
