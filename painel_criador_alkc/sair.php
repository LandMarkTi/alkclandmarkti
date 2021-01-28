<?php
session_start();
session_destroy();
?>
<script>
    <?php
    if (getenv('ENV') == 'development') {
    ?>
        window.location = 'http://<?= getenv('SERVER_ADDR') ?>/painel_criador_alkc';
    <?php
    } else {
    ?>
        window.location = 'http://alkc.org.br/';
    <?php
    }
    ?>
</script>