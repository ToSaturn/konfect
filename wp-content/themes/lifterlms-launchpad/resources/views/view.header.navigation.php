<nav id="site-navigation" class="site-navigation columns <?php echo $args->navigation_cols; ?>">
    <div id="responsive-menu">
    	<?php if ( $args->menu_args ) : ?>
    		<?php wp_nav_menu( $args->menu_args ); ?>
    	<?php endif; ?>
    </div>
</nav>