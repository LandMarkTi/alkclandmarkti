<?php
require_once("Connections/conexao.php");
if($_POST){
	$id = $_POST['idfoto'];
	$f=$_POST['f'];
	//Pegando os dados da foto enviada
	$fotonome = $_FILES['foto']['name'];
	$fototipo = $_FILES['foto']['type'];
	$fototamanho = $_FILES['foto']['size'];
	$fototemp = $_FILES['foto']['tmp_name'];
	//move_uploaded_file($fototemp,'./images/pedigree/'.$fotonome);
	
	$sqla = "INSERT into foto_ped  values('','".rawurlencode($fotonome)."','$id','$f')";
	$querya = mysql_query($sqla) or die(mysql_error());
	header("Location: up_foto.php?id_foto=$id&r=1");
}

?><html>
<body>Enviar foto do pedigree:
<form method="post" enctype="multipart/form-data">
<input name="idfoto" type="hidden" value="<?php echo $_GET['id_foto'];?>">
<input name="f" type="hidden" value="<?php echo $_GET['f'];?>">
<input type="file" name="foto">
<input type="submit">
</form>
<script>
<?php if($_GET['r']==1)echo 'window.parent.location.reload();';?>
</script>
</body>
</html>
