<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");



//id pgs



?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body style="display:none">
<form action="imprime_canil/tarja.php" >
<input name="id"  value="<?=$_GET['id']?>">
<input name="id_f" value="<?=$_GET['pgs']?>">
<input name="se" id="serie" value="">
</form>
</body>
<script>
var s=prompt('Digite o serial da folha:');
if(s>0){document.getElementById('serie').value=s;document.forms['0'].submit();} else {alert('serie inválida');location='index_principal.php';}
</script>
</html>
