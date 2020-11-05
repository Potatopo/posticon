<div class="wrap">
    <h1>Post Icon</h1>
    <form method="post" action="options.php">
        <?php
            settings_fields( 'post-icon-settings-group' );
            do_settings_sections( 'post-icon-settings-page' );
            submit_button();
        ?>
    </form>
</div>