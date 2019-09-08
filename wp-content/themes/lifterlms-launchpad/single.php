<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();

            get_template_part( 'content', get_post_format() );

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

            // Previous/next post navigation.
            // Don't show navigation links for single membership
            if( get_post_type() != 'llms_membership' ){

                the_post_navigation( array(
                    'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'lifterlms-launchpad' ) . '</span> ' .
                        '<span class="screen-reader-text">' . __( 'Next post:', 'lifterlms-launchpad' ) . '</span> ' .
                        '<span class="post-title">%title</span>',
                    'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'lifterlms-launchpad' ) . '</span> ' .
                        '<span class="screen-reader-text">' . __( 'Previous post:', 'lifterlms-launchpad' ) . '</span> ' .
                        '<span class="post-title">%title</span>',
                ) );
            }

        // End the loop.
        endwhile; ?>

    </main>
</div>

<?php get_footer(); ?>
