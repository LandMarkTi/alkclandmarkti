<?php
session_start();

require_once("Connections/conexao.php");

if($_SESSION['lp']=='adm.purina@alkc.com.br') {} else die("<script>location='index.php';</script>");

$usr=(int)$_GET['id'];

$id_pu=(int)$_GET['id_pur'];

$sql = "SELECT * FROM form_health where id_capa=$usr ORDER BY id_capa DESC ";
$query = mysql_query($sql) or die(mysql_error());
$linha=mysql_fetch_assoc($query);
$n=mysql_num_rows($query);


$l=0;
//caso imprimir

if($_POST){

	
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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


</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
   	  <div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Dados do kit          
            <div style="float:right; margin-left:10px;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior" ></a></div>
          
        
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form  method="post" action="env_cont_p.php" >
            <input type="hidden" name="id_pu" id="id" value="<?=$id_pu ?>" />
			 <input type="hidden" name="idf" id="id" value="<?=time()?>" />

			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
                           <?php 

			$vt_capa=explode("\n",base64_decode($linha['cliente']));			
			foreach($vt_capa as $key=>$val){

				$atual=explode(":",$val);
				if(count($atual)==2){
				?>
  			  <tr class ="dcredenciado">
    				<td align="right"><label for="nome" class="arial_cinza2_12" ><?php echo str_replace("_"," ",$atual[0]);?></label></td>
    				<td><input name="<?php echo $key;?>" type="text" class="forms" id="nome" size="45" value="<?php echo $atual[1];?>"/></td>
			  </tr>
			  <?php }}?>
                            
		
              <tr>
                <td align="right">&nbsp;</td>
                <td class="opts">
                

				<a href="#" class="button" onclick="$('form').submit();$('#somee').hide();" id="somee" style="color:white" >Confirmar contato</a>
                <?php 


?></td>            
              </tr>
              
			</table>
  			</form>
           </div>
	  

<?php $_SESSION['pstipo']='Pagamento Pedigree';?>
        </div>
         </div>
    </div>   
    </div> 
  </div>
</div>
<style>
.button {
float: left;
margin: 0px 25px 10px 0px;
font-weight: bold;
line-height: 1;
padding: 6px 10px;
cursor: pointer;
color: #666666;
text-align: center;
background: #a5b8da;
background: -moz-linear-gradient(top, #999 0%, #333 100%);
background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FFF), to(#D8D8D8));
border: 1px solid #AEAEAE;
-moz-border-radius: 10px;
-webkit-border-radius: 10px;
border-radius: 10px;
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
	background-color: #cccccc;
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
body {
   border-width: 0px;
   padding: 0px;
   margin: 0px;
   font-size: 90%;
   background-color: #e7e7de
}


.wrappern input{ border: 0px solid white;border-bottom: 1px solid white;background-color: rgb(128, 128, 128);color: #FFFFFF;font-size: 14px;margin-top: 6px;margin-left: 4px;}
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

</script>
<?php include "footer.php";?>
</body>
</html>
