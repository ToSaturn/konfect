<div id="wrap-sidebar" class="wrap-sidebar <?php echo apply_filters('launchpad_sidebar_width', 'four') . ' columns'; ?>">
    <?php if ( is_active_sidebar( $id ) ) { ?>
        <div id="secondary" class="widget-area" role="complementary">
            <?php dynamic_sidebar( $id ); ?>
        </div>
    <?php } ?>
</div>