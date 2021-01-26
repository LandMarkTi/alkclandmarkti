<!DOCTYPE html>
<html>
<body background="https://i.ytimg.com/vi/ZPjHlGWHZio/maxresdefault.jpg" text="white"> 
<?
session_start();
if 
($_SESSION[nome]==""){
echo "<font size=5><center><br><br><br>Voce nao esta Logado.</center></font>";
exit;
}
$nome = $_SESSION[nome];
echo "<font size=5><center><br><br>Você está logado com a seção: $nome</center></font>";
?>
<!DOCTYPE html>
</form>
</br>
<p></p>
<form method="POST" action="sair.php" style="text-align:center">
<input style="font-size:30px;" type="submit" value="Encerrar seção">
</form>
</body>
</html>
