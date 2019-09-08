<?php get_header(); ?>

            <section id="primary" class="content-area">
                <main id="main" class="site-main">
                    <?php if ( have_posts() ) {
                        while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
                                <header class="entry-header">
                                    <?php the_post_thumbnail();?>
                                    <h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
                                </header>
                                <footer class="entry-meta">
                                    <?php printf( __( 'Posted on %1$s by %2$s. ', 'lifterlms-launchpad' ), get_the_date(), get_the_author() ); ?>
                                    <?php _e( 'Categories: ', 'lifterlms-launchpad' ); the_category( ', ' ); echo '. '; ?>
                                </footer>
                                <div class="entry-content">
                                    <?php the_content(); ?>
                                    <?php wp_link_pages(); ?>
                                </div>
                            </article>
                        <?php endwhile;
                    } else { ?>
                        <article id="post-0" class="post no-results not-found">
                            <header class="entry-header">
                                <h1><?php _e( 'Not found', 'lifterlms-launchpad' ); ?></h1>
                            </header>
                            <div class="entry-content">
                                <p><?php _e( 'Sorry, but your request could not be completed.', 'lifterlms-launchpad' ); ?></p>
                                <?php get_search_form(); ?>
                            </div>
                        </article>
                    <?php } ?>
                </main>
            </section>

<?php get_footer(); ?>