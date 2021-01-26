<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

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
    	  <div class="arial_branco20" id="internas_titulo" style="color:white">Novo Pedigree 
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
    				<td align="right"><input type="submit" value="Continuar" onclick="return valida();"></td></tr>
              
             
			</table><?php } else {?>

			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
  			  <tr >
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Selecione a Raça:</label></td>
    				<td>    				  <select name="subcategoria"  class="forms racas" required>
					<?php
					  	$sqlcateg = "SELECT * FROM subcategoria where 1 $fraca ORDER BY nomeSubcategoria ASC";
						$querycateg = mysql_query($sqlcateg) or die(mysql_error());
						while($linhacateg = mysql_fetch_array($querycateg)){
							echo"
								<option value='$linhacateg[idSubcategoria]'>$linhacateg[nomeSubcategoria]</option>
							";	
						}
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

$.get( "post_progenitores_import3.php?id=<?php echo $_SESSION['cid'];?>&pt=1&rac=<?=$_GET['raca']?>&r="+Math.random(), function( data ) {
$('#sel1').html(data);
  $('#combobox').html( data );
$('#combobox option:first').text('');
	    $( "#combobox" ).combobox();
});
$.get( "post_progenitores_import3.php?id=<?php echo $_SESSION['cid'];?>&pt=2&rac=<?=$_GET['raca']?>&r="+Math.random(), function( data ) {
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



//console.log(s1+' '+s2);
if(s2=='Fêmea'&&s1=='Masc'){
var rac=$('#rac').val();
if(c1=='0'||c2=='0'||c1==c2||c1==null||c2==null){alert('Selecione um pai e mãe para cadastrar a ninhada');return false}
location='adicionar_pedigree.php?p1='+c1+'&p2='+c2+'&r='+rac;
}else alert('Escolha um macho e uma femea.');
return false;
}
</script>
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
</body>
</html>
