<?php
session_start();

require_once("Connections/conexao.php");

if($_SESSION['login']=='')die("<script>location='index.php';</script>");

$id=$_GET['id'];

$f=(int)$_GET['f'];

if($f>12)die('erro filhote');

$sql_t="select * from pedigre_trocados where id_ped=".$id." and id_f=".($f+4);
$qr=mysql_query($sql_t);
$nt=mysql_num_rows($qr);
$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$id;
if($nt>0){
//JOIN pedigre_trocados USING ( id_ped )

$qtr=mysql_query("select * from pedigre_trocados where id_ped=$id and id_f=".($f+4))or die('r');

$dados_f=mysql_fetch_assoc($qtr);

$nt=mysql_num_rows($qtr);
}


$qr=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr);
$catid=$linha_ped['id_raca'];

$linha_ped['emissao']=date("d/m/Y",$linha_ped['emissao']);

$linha_ped['nasc']=date("d/m/Y",$linha_ped['nasc']);

$sql = "SELECT * FROM subcategoria WHERE idSubcategoria='$catid'";
$query = mysql_query($sql) or die(mysql_error());
$linha = mysql_fetch_array($query);

$linha_ped['id_raca']=$linha['nomeSubcategoria'];

$l=0;
//caso imprimir

if($_POST){
	 foreach($linha_ped as $k=>$v){ if($l>1&&$l<19)echo $k.':'.$v;}
	
}
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
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle.::</title>

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
    	  <div class="arial_branco20" id="internas_titulo">Cadastro Pedigree          
            
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;">
            <form  method="post" action="print_ped.php">
            <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>" />
			<table width="100%" border="0" cellspacing="6" cellpadding="0">
            
                           <?php 
				$linha_ped['registro']=$linha_ped['registro'].''.$_GET['f'];
				if($nt>=1)$linha_ped['proprietario']=$dados_f['proprietario'];//$tr='okk'.$dados_f['proprietario'];
				foreach($linha_ped as $k=>$v){ if($l>1&&$l<20){?>
              <tr>
    				<td align="right" ><label for="subcategoria" class="arial_cinza2_12" id="lab-<?php echo $k;?>"><?php echo $k;?></label></td>
    				<td id="td-<?php echo $k;?>"><input name="subcategoria" type="text" class="forms" id="subcategoria" size="65"  value="<?php echo $v;?>"/></td>
			  </tr>
		<?php }$l++;}?>
                                        <tr>
    				<td align="right" ><label for="subcategoria" class="arial_cinza2_12" id=""></label></td>
    				<td id="sss">&nbsp;</td>
			  </tr>  
		<tr>
		<td id="par" style="display:none;">

   		<div class="wrapper" style="display:none">
	     <div class="wp1">
          <div class="g11">
	<input class="parent" name="p[]">
          </div>
          <div class="g12">
	<input class="parent" name="p[]">
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




		</td>
		</tr>
		<tr>
		<td><?php 
$sql_fot="SELECT * FROM  `tarja` where id_ped=".$_GET['id']." and id_f=".$_GET['f']." ORDER BY id_foto DESC";
$qrf=mysql_query($sql_fot);
$lin=mysql_fetch_assoc($qrf);
$nnn=mysql_num_rows($qrf);
if($nnn>=1)echo '<img src="./images/pedigree/'.$lin['arquivo'].'" style="max-width:70px;"><small id="remm">Apagar Foto</small>'; else {echo'sem foto';

$sql_fot2="SELECT * FROM  `foto_ped` where id_ped=".$_GET['id']." and id_f=22 ORDER BY id_foto DESC";
$qrf2=mysql_query($sql_fot2);
$lin2=mysql_fetch_assoc($qrf2);
$nnn2=mysql_num_rows($qrf2);

if($nnn2>=1)echo '<img src="./pedext/'.$lin2['arquivo'].'" style="max-width:70px;">';
}

if($nnn<1){
?></td><td ><iframe src="up_foto_t.php?id_foto=<?php echo $_GET['id'];?>&f=<?php echo $_GET['f'];?>" frameborder="0" border="0" ></iframe></td>
              <?php }?></tr>
              <tr>
                <td align="left" >&nbsp;</td>
                <td >

Nº de série : <input value="" name="serie" placeholder="ex:000000" maxlength="6" required>
		</td></tr>
              <tr>
                <td align="left" >&nbsp;</td>
                <td id="lista_ped"><?=$tr;?>
                <input type="submit" name="Submit"  class="button" value="imprimir" id="sendd" onclick="$('#sendd').hide();" style="height: 50px;width: 102px;position: relative;left: 250px;top: -60px;background-color: rgb(48, 133, 154);font-size: 14px;color: white;"/> 
                </td>            
              </tr>
              
			</table>
  			</form>
           </div>
        </div>
         </div>
    </div>   
    </div> 
  </div>
</div>
<style>
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
.qcode{cursor:pointer}
</style>
<script>
$('#remm').click(function(){$.post('semfoto.php',{idf:<?=$id?>},function(){alert('Foto removida');$('#remm').prev().remove();});});
var campos=$('#td-parentes input').val();
var lista=campos.split(';');
$('#td-parentes').html($('#par').html());
$('#td-parentes input').each(function(i,x){
$(x).val(lista[i]);
});

var ninha=$('#td-ninhada input').val();
var listan=ninha.split(';');
//$('#td-ninhada').html("<div class=\"wrappern\">                   <div class=\"nwp1\">                <div class=\"ng11\"><center style=\"color:white;padding-top:10px\">Ninhada</center>                </div>                <div class=\"ng12\"><center style=\"color:white;font-size:14px;padding-top: 11px;\">Nascidos<hr>M | F</center>                </div>                <div class=\"ng13\" >                 &nbsp;&nbsp;&nbsp;<input name=\"n[]\" size=\"1\" value=\" 0\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  name=\"n[]\" size=\"1\" value=\" 0\" >                </div>                <div class=\"ng14\">                 <center style=\"color:white;font-size:14px;padding-top: 11px;\">Nascidos<hr>M | F</center>                </div>                <div class=\"ng15\">                 &nbsp;&nbsp;&nbsp;<input size=\"1\" name=\"n[]\" value=\" 0\" style=\"padding-top:10px;margin-top:8px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input size=\"1\" name=\"n[]\" value=\" 0\" style=\"padding-top:10px;margin-top:8px\">                </div>                   </div>                   <div class=\"nwp2\">                <div class=\"ng21\">                </div>                <div class=\"ng22\">                 <br> <input name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\"><br><br> <input name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\">                </div>                <div class=\"ng23\">                 <br> <input name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\"><br><br> <input name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\">                </div>                   </div>                   <div class=\"nwp3\">                <div class=\"ng31\">                 <center style=\"color:white\">Nascidos na <br> Ninhada</center>                </div>                <div class=\"ng32\">                 <br> <input name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\"><br><br> <input  name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\">                </div>                <div class=\"ng33\">                 <br> <input name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\"><br><br> <input name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\">                </div>                   </div>                   <div class=\"nwp4\">                <div class=\"ng41\">                </div>                <div class=\"ng42\">                 <br> <input name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\"><br><br> <input name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\">                </div>                <div class=\"ng43\">                 <br> <input name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\"><br><br> <input name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\">                </div>                   </div>                   <div class=\"nwp5\">                <div class=\"ng51\">                </div>                <div class=\"ng52\">                 <br> <input name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\"><br><br> <input name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\">                </div>                <div class=\"ng53\">                 <br> <input name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\"><br><br> <input name=\"n[]\" size=\"9\"><img src=\"images/icons/qrcode.png\" class=\"qcode\" width=\"25px\" height=\"26px\" style=\"   margin-bottom: -7px;    margin-left: 7px;\">                </div>                   </div>               </div> ");

$("#td-ninhada").parent().remove();

/*
$('#td-ninhada input').each(function(i,x){
$(x).val(listan[i]);
$(x).attr('tabindex',i);
});
*/

$('#lista_ped').append('<br>');

var mydata='';

$.post('cotas_filhote.php',{i:<?php echo ($_GET['f']+4);?>,id:<?php echo $id;?>},function(data){mydata=data;$('#lista_ped').append(listan[<?php echo ($_GET['f']+4);?>]+'-'+mydata+'ª via <input type="checkbox" name="pgs[]" value="'+<?php echo ($_GET['f']+4);?>+'"><br><br>Somente Tarjeta <input type="checkbox" name="tarjeta" value="<?php echo ($_GET['f']+4);?>">');});





$("#lab-id_raca").text('Raça');
$("#lab-endereco").text('Endereço');
$("#lab-emissao").text('Data Emissão');
$("#lab-pais").text('País Origem');
$("#lab-no_ninhada").text('Ninhada Nº');
$("#lab-genero").text('Gênero');
$("#lab-amigo").text('CRMV');
$("#lab-registro").text('Nº registro stud');
$("#lab-variedade").text('Cor');
$("#lab-sexo").remove();
$("#td-sexo").remove();

$("#td-genero").parent().remove();
$("#lab-genero").remove();
$("#td-genero").remove();

$("#td-cor").parent().remove();
$("#lab-cor").remove();
$("#td-cor").remove();

$("#td-variedade").parent().remove();
$("#lab-variedade").remove();
$("#td-variedade").remove();

$("#lab-no_ninhada").parent().parent().hide();

//$("#lab-amigo").parent().parent().hide();

$("[id='td-nº microchip']").parent().remove();
$("[id='td-nome']").parent().remove();


$('.qcode').click(function(){var id_f=$(this).prev().attr('tabindex');var code=prompt('Digite o código:');if(code!=''&&code!==null)$.post('env_code.php',{id_ped:<?=$id?>,id_filhote:id_f,code:code},function(data){alert(data);});});
</script>
<?php include "footer.php";?>
</body>
</html>
