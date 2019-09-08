<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
    <?php if ( 'yes' === get_option( 'launchpad_settings_custom_js_wrapper' ) ) : ?>
      <script type="text/javascript">(function($){<?php echo html_entity_decode( get_option('launchpad_settings_custom_header_js') ); ?>})(jQuery);</script>
    <?php else: ?>
      <?php echo html_entity_decode( get_option('launchpad_settings_custom_header_js') ); ?>
    <?php endif; ?>
    <?php echo (new LaunchPad\ThemeLayout\EmbeddedStyles)->output(); ?>
    <style type="text/css"><?php echo html_entity_decode( get_option('launchpad_settings_custom_css') ); ?></style>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <?php if ( 'yes' !== $args->hide_header ): ?>
        <div id="wrap-header" class="wrap-header">
            <div class="container">
                <header id="masthead" class="site-header">
                    <div class="row">
                        <?php echo (new LaunchPad\ThemeLayout\HeaderLayout)->output_layout(); ?>
                    </div>
                    <?php if ( $args->menu_args ) : ?>
                        <div id="mobile-nav-container">
                            <button id="responsive-menu-toggle"><?php _e( 'Menu', 'lifterlms-launchpad' ); ?></button>
                            <nav id="nav-mobile"></nav>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <?php echo $args->header_content; ?>
                    </div>
                </header>
            </div>
        </div>
    <?php endif; ?>
    <div id="wrap-main" class="wrap-main row">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="columns 12">
                        <?php echo (new LaunchPad\ThemeLayout\BreadCrumbs)->output(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php do_action('launchpad_before_content'); ?>
                <div id="wrap-content" class="wrap-content <?php echo apply_filters('launchpad_content_width', 'twelve') . ' columns'; ?>">
                    <div id="content" class="site-content">
