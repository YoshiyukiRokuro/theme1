<?php
/**
 * The template for displaying all pages
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container <?php echo !is_active_sidebar('page-sidebar') ? 'no-sidebar' : ''; ?>">
        <div class="content-area">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>

                    <div class="entry-content">
                        <?php
                        the_content();
                        
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('Pages:', 'theme1'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <?php if (get_edit_post_link()) : ?>
                        <footer class="entry-footer">
                            <div class="edit-link">
                                <?php edit_post_link(__('Edit', 'theme1')); ?>
                            </div>
                        </footer>
                    <?php endif; ?>
                </article>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            <?php endwhile; ?>
        </div>
        
        <?php if (is_active_sidebar('page-sidebar')) : ?>
            <aside id="secondary" class="page-sidebar widget-area">
                <div class="sidebar-content">
                    <?php dynamic_sidebar('page-sidebar'); ?>
                </div>
            </aside>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>