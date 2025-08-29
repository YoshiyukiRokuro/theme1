<?php
/**
 * The main template file
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        <?php get_template_part('template-parts/breadcrumb'); ?>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p><?php _e('Nothing found here.', 'theme1'); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>