<?php

/** 
 * Afficher un message sur la page
 * @category  PPE
 * @package   GSB
 * @author Sophie Abouaf
 */
?>
<div class="alert alert-info" role="alert">
    <?php
    foreach ($_REQUEST['messages'] as $messages) {
        echo '<p>' . htmlspecialchars($messages) . '</p>';
    }
    ?>
</div>

