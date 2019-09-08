<?php if (isset($title)) : ?>

    <h1 class="launchpad-label <?php echo $class; ?>"><?php echo esc_html($title); ?></h1>

<?php endif; ?>

<?php  if (isset($desc)) : ?>

    <p class="launchpad-description <?php echo $class; ?>"><?php echo $desc; ?></p>

<?php endif; ?>

<table class="form-table">

    <?php  if (isset($id)) :

        do_action( 'launchpad_settings_' . sanitize_title($id));

    endif; ?>
