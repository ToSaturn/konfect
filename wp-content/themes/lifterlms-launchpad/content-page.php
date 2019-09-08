<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    // Post thumbnail.
    launchpad_post_thumbnail();
    ?>

    <?php if ( is_singular() && 'yes' !== get_post_meta( get_the_ID(), 'launchpad_hide_page_title', true ) ): ?>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header>
    <?php endif; ?>

    <div class="entry-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'lifterlms-launchpad' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'lifterlms-launchpad' ) . ' </span>%',
            'separator'   => '<span class="screen-reader-text">, </span>',
        ) );
        ?>
    </div>

    <?php edit_post_link( __( 'Edit', 'lifterlms-launchpad' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

</article>