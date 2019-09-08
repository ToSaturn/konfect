<?php

if ( ! function_exists('is_lifterlms_enabled')) {

    /**
     * Check if LifterLMS plugin is enabled
     *
     * @return bool
     */
    function is_lifterlms_enabled()
    {
        return class_exists('\LifterLMS');
    }

}

if ( ! function_exists( 'launchpad_post_thumbnail' ) ) {

    /**
     * Display an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     *
     * @since Twenty Fifteen 1.0
     */
    function launchpad_post_thumbnail()
    {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                <?php
                the_post_thumbnail('post-thumbnail', array('alt' => get_the_title()));
                ?>
            </a>

        <?php endif; // End is_singular()
    }
}

if ( ! function_exists( 'launchpad_entry_meta' ) ) {

    /**
     * Prints HTML with meta information for the categories, tags.
     *
     * @since Twenty Fifteen 1.0
     */
    function launchpad_entry_meta() {
        if ( is_sticky() && is_home() && ! is_paged() ) {
            printf( '<span class="sticky-post">%s</span>', __( 'Featured', 'lifterlms-launchpad' ) );
        }

        $format = get_post_format();
        if ( current_theme_supports( 'post-formats', $format ) ) {
            printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
                sprintf( '<span class="meta-label">%s </span>', _x( 'Format', 'Used before post format.', 'lifterlmns-launchpad' ) ),
                esc_url( get_post_format_link( $format ) ),
                get_post_format_string( $format )
            );
        }

        if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

            // if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            //     $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            // }

            $time_string = sprintf( $time_string,
                esc_attr( get_the_date( 'c' ) ),
                get_the_date(),
                esc_attr( get_the_modified_date( 'c' ) ),
                get_the_modified_date()
            );

            printf( '<span class="posted-on"><span class="meta-label">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
                _x( 'Posted on', 'Used before publish date.', 'lifterlms-launchpad' ),
                esc_url( get_permalink() ),
                $time_string
            );
        }

        if ( 'post' == get_post_type() ) {
            if ( is_singular() || is_multi_author() ) {
                printf( '<span class="byline"><span class="author vcard"><span class="meta-label">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
                    _x( 'Author', 'Used before post author name.', 'lifterlms-launchpad' ),
                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                    get_the_author()
                );
            }

            $categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'lifterlms-launchpad' ) );
            if ( $categories_list && launchpad_categorized_blog() ) {
                printf( '<span class="cat-links"><span class="meta-label">%1$s </span>%2$s</span>',
                    _x( 'Categories', 'Used before category names.', 'lifterlms-launchpad' ),
                    $categories_list
                );
            }

            $tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'lifterlms-launchpad' ) );
            if ( $tags_list ) {
                printf( '<span class="tags-links"><span class="meta-label">%1$s </span>%2$s</span>',
                    _x( 'Tags', 'Used before tag names.', 'lifterlms-launchpad' ),
                    $tags_list
                );
            }
        }

        if ( is_attachment() && wp_attachment_is_image() ) {
            // Retrieve attachment metadata.
            $metadata = wp_get_attachment_metadata();

            printf( '<span class="full-size-link"><span class="meta-label">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
                _x( 'Full size', 'Used before full size attachment link.', 'lifterlms-launchpad' ),
                esc_url( wp_get_attachment_url() ),
                $metadata['width'],
                $metadata['height']
            );
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            /* translators: %s: post title */
            comments_popup_link( sprintf( __( 'Leave a comment<span class="meta-label"> on %s</span>', 'lifterlms-launchpad' ), get_the_title() ) );
            echo '</span>';
        }
    }
}

if ( ! function_exists( 'launchpad_categorized_blog' ) ) {

    /**
     * Determine whether blog/site has more than one category.
     *
     * @since Twenty Fifteen 1.0
     *
     * @return bool True of there is more than one category, false otherwise.
     */
    function launchpad_categorized_blog()
    {
        if (false === ($all_the_cool_cats = get_transient('launchpad_categories'))) {
            // Create an array of all the categories that are attached to posts.
            $all_the_cool_cats = get_categories(array(
                'fields' => 'ids',
                'hide_empty' => 1,

                // We only need to know if there is more than one category.
                'number' => 2,
            ));

            // Count the number of categories that are attached to the posts.
            $all_the_cool_cats = count($all_the_cool_cats);

            set_transient('launchpad_categories', $all_the_cool_cats);
        }

        if ($all_the_cool_cats > 1) {
            // This blog has more than 1 category so launchpad_categorized_blog should return true.
            return true;
        } else {
            // This blog has only 1 category so launchpad_categorized_blog should return false.
            return false;
        }
    }
}

if ( ! function_exists( 'launchpad_comment_nav' ) ) {

    /**
     * Display navigation to next/previous comments when applicable.
     *
     * @since Twenty Fifteen 1.0
     */
    function launchpad_comment_nav()
    {
        // Are there comments to navigate through?
        if (get_comment_pages_count() > 1 && get_option('page_comments')) :
            ?>
            <nav class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php _e('Comment navigation', 'lifterlms-launchpad'); ?></h2>
                <div class="nav-links">
                    <?php
                    if ($prev_link = get_previous_comments_link(__('Older Comments', 'lifterlms-launchpad'))) :
                        printf('<div class="nav-previous">%s</div>', $prev_link);
                    endif;

                    if ($next_link = get_next_comments_link(__('Newer Comments', 'lifterlms-launchpad'))) :
                        printf('<div class="nav-next">%s</div>', $next_link);
                    endif;
                    ?>
                </div><!-- .nav-links -->
            </nav><!-- .comment-navigation -->
            <?php
        endif;
    }

}