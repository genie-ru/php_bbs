<?php if(isset($error_message)) : ?>
        <ul class="error_message">
            <?php foreach($error_message as $error) : ?>
                <li><?php echo $error ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif; ?>