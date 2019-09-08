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

            // End the loop.
        endwhile;
        ?>

    </main>
</div>

<?php get_footer(); ?>
