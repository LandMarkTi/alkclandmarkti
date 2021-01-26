<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");



//id pgs



?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body style="display:none">
<form action="print_ped.php" method="post">
<input name="pgs[]" id="pgs[]" value="<?=$_GET['pgs']?>">
<input name="id" value="<?=$_GET['id']?>">
<input name="serie" id="serie" value="">
<input name="dizer"  value="no">

</form>
</body>
<script>
var s=prompt('Digite o serial da folha:');
if(s>0){document.getElementById('serie').value=s;document.forms['0'].submit();} else {alert('serie inválida');location='listagem_transf.php';}
</script>
</html>
