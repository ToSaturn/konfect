<div class="site-branding columns <?php echo $args->branding_cols; ?>">
    <?php if ( !$args->logo ) : ?>
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
    <?php else: ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <img class="site-logo" src="<?php echo $args->logo; ?>" title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
        </a>
    <?php endif; ?>
    <?php if ( $args->display_tagline === 'yes' ) : ?>
        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
    <?php endif; ?>
</div>