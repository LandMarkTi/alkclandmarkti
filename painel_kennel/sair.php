<?php
session_start();
session_destroy();
?>
<script>
    <?php
    if (getenv('ENV') == 'development') {
    ?>
        window.location = 'http://<?= getenv('SERVER_ADDR') ?>/painel_kennel/autenticar.php?aut=dog2045pet';
    <?php
    } else {
    ?>
        window.location = 'http://alkc.club/';
    <?php
    }
    ?>
</script>