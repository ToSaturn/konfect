</table>
<div class="launchpad-settings-divider <?php echo $class; ?>">
    <?php if (isset($title)) : ?>

        <h1 class="launchpad-l; ?>"><?php echo esc_html($title); ?></h1>

    <?php endif; ?>

    <?php  if (isset($desc)) : ?>

        <p class="launc echo $class; ?>"><?php echo $desc; ?></p>

    <?php endif; ?>
</div>
<table class="form-table">

    <?php  if (isset($id)) :

        do_action( 'launchpad_settings_' . sanitize_title($id));

    endif; ?>

