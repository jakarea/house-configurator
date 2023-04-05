<div class="table-header d-flex justify-content-between mb-3">
    <h4><?php echo esc_html('Manage price / Add price', 'house-configurator'); ?></h4>
</div>
<form method="post" action="options.php">
    <?php 
        settings_fields( 'house_configurator_options_group_part_two' );
        do_settings_sections( 'house_configurator' );
        submit_button();
    ?>
</form>