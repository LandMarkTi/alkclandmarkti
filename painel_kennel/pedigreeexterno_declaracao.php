<?php
session_start();
if ($_SESSION['login'] == '') die("<script>location='index.php';</script>");
require_once("Connections/conexao.php");

$sqldec = "select * from pedigreeexterno p, criadores c where p.id_criador = c.id_criador and id = " . $_GET['id'];
$querydec = mysql_query($sqldec);
$dadosdeclaracao = mysql_fetch_assoc($querydec);

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$dataextenso = strftime('%A, %d de %B de %Y', $dadosdeclaracao['datasolicitacao']);
$hoje = date("m/d/Y", $dadosdeclaracao['datasolicitacao']);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>REQUISI&Ccedil;&Atilde;O E DECLARA&Ccedil;&Atilde;O DE INSER&Ccedil;&Atilde;O DE PEDIGREE DE OUTRA ENTIDADE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">REQUISI&Ccedil;&Atilde;O E DECLARA&Ccedil;&Atilde;O DE INSER&Ccedil;&Atilde;O DE PEDIGREE DE OUTRA ENTIDADE</h5>
            <h6 class="card-subtitle mb-2 text-muted"><?= $dataextenso ?></h6>            
            <p class="card-text">Eu, <?= utf8_decode($dadosdeclaracao['nome']) ?>, CPF <?= $dadosdeclaracao['cpf'] ?> RG <?= $dadosdeclaracao['RG'] ?> propriet&aacute;rio do canil <?= $dadosdeclaracao['nome_completo'] ?> n. <?= $dadosdeclaracao['id_criador'] ?>, filiado ao ALKC, declaro que o c&atilde;o <?= utf8_decode($dadosdeclaracao['nomecachorro']) ?>; registrado na entidade <?= $dadosdeclaracao['nomeentidade'] ?> sob o n&uacute;mero de registro <?= $dadosdeclaracao['registroexterno'] ?> &eacute; de minha propriedade, autorizo que seja feito o registro em meu nome, e reconhe&ccedil;o que s&atilde;o de minha total responsabilidade os dados fornecidos e a posse do animal bem como o documento original em m&atilde;os, onde forne&ccedil;o a c&oacute;pia digital para o ALKC. Sabendo-se que quaisquer causas ou consequ&ecirc;ncias futuras recorrentes, oriundos por informa&ccedil;&otilde;es deste documento fornecido, ser&atilde;o de minha responsabilidade. E que ainda, caso ocorra algum desencontro de dados fornecidos o documento poder&atilde; ser cancelado.</p>
            <p class="card-text">Tenho ci&ecirc;ncia dos meus atos e me responsabilizo por a&ccedil;&otilde;es c&iacute;veis e criminais que possam recorrer sobre as informa&ccedil;&otilde;es aqui declaradas.</p>
            <p class="card-text">O acima descrito &eacute; verdade e dou f&eacute;</p>
            <p class="card-text">Data:<?= $hoje ?></p>
        </div>
    </div>
</body>

</html>