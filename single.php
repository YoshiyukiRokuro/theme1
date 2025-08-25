<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container <?php echo !is_active_sidebar('post-sidebar') ? 'no-sidebar' : ''; ?>">
        <div class="content-area">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <div class="entry-meta">
                            <span class="posted-on">
                                <?php echo get_the_date(); ?>
                            </span>
                            <span class="byline">
                                <?php _e('by', 'theme1'); ?> <?php the_author(); ?>
                            </span>
                            <?php if (has_category()) : ?>
                                <span class="cat-links">
                                    <?php _e('in', 'theme1'); ?> <?php the_category(', '); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content();
                        
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('Pages:', 'theme1'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <footer class="entry-footer">
                        <?php if (has_tag()) : ?>
                            <div class="tags-links">
                                <strong><?php _e('Tags:', 'theme1'); ?></strong>
                                <?php the_tags('', ', ', ''); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (get_edit_post_link()) : ?>
                            <div class="edit-link">
                                <?php edit_post_link(__('Edit', 'theme1')); ?>
                            </div>
                        <?php endif; ?>
                    </footer>
                </article>

                <?php
                // Post navigation
                the_post_navigation(array(
                    'prev_text' => '<span class="nav-subtitle">' . __('Previous:', 'theme1') . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . __('Next:', 'theme1') . '</span> <span class="nav-title">%title</span>',
                ));

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            <?php endwhile; ?>
        </div>
        
        <?php if (is_active_sidebar('post-sidebar')) : ?>
            <aside id="secondary" class="post-sidebar widget-area">
                <div class="sidebar-content">
                    <?php dynamic_sidebar('post-sidebar'); ?>
                </div>
            </aside>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>