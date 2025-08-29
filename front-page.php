<?php
/**
 * The front page template file
 */

get_header(); ?>

<?php
// Get hero section data
$hero_data = theme1_get_hero_data();
?>

<!-- Hero Section -->
<section class="hero-section full-width" 
    <?php if ($hero_data['slideshow_enable'] && count($hero_data['media_items']) > 1) : ?>
        data-slideshow="true" 
        data-speed="<?php echo esc_attr($hero_data['slideshow_speed']); ?>"
        data-transition="<?php echo esc_attr($hero_data['slideshow_transition']); ?>"
        data-media="<?php echo esc_attr(json_encode($hero_data['media_items'])); ?>"
    <?php else : ?>
        <?php
        // Single media item handling
        $first_media = !empty($hero_data['media_items']) ? $hero_data['media_items'][0] : null;
        if ($first_media && $first_media['type'] === 'video') {
            $video_info = theme1_get_video_embed_info($first_media['url']);
            if ($video_info) {
                echo 'data-single-video="true" data-video-info="' . esc_attr(json_encode($video_info)) . '"';
            }
        } elseif ($hero_data['background_image']) {
            echo 'style="background-image: url(' . esc_url($hero_data['background_image']) . ');"';
        }
        ?>
    <?php endif; ?>>
    
    <?php
    // Add video elements for single video or slideshow
    if ($hero_data['slideshow_enable'] && count($hero_data['media_items']) > 1) {
        // Slideshow mode - videos will be handled by JavaScript
        echo '<div class="hero-video-container" style="display: none;"></div>';
    } elseif (!empty($hero_data['media_items']) && $hero_data['media_items'][0]['type'] === 'video') {
        // Single video mode
        $video_info = theme1_get_video_embed_info($hero_data['media_items'][0]['url']);
        if ($video_info) {
            echo '<div class="hero-video-container">';
            if ($video_info['type'] === 'direct') {
                echo '<video class="hero-video" autoplay muted loop playsinline>';
                echo '<source src="' . esc_url($video_info['url']) . '" type="video/mp4">';
                echo '</video>';
            } else {
                echo '<iframe class="hero-video" src="' . esc_url($video_info['embed_url']) . '" frameborder="0" allow="autoplay; fullscreen"></iframe>';
            }
            echo '</div>';
        }
    }
    ?>
    
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title"><?php echo esc_html($hero_data['title']); ?></h1>
            <p class="hero-subtitle"><?php echo esc_html($hero_data['subtitle']); ?></p>
            <a href="<?php echo esc_url($hero_data['cta_url']); ?>" class="hero-cta"><?php echo esc_html($hero_data['cta_text']); ?></a>
        </div>
    </div>
    
    <?php if ($hero_data['slideshow_enable'] && count($hero_data['media_items']) > 1) : ?>
        <div class="slideshow-indicators">
            <?php foreach ($hero_data['media_items'] as $index => $media) : ?>
                <button class="indicator <?php echo $index === 0 ? 'active' : ''; ?>" data-slide="<?php echo $index; ?>"></button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<!-- Category Menu Section -->
<?php get_template_part('template-parts/category-menu'); ?>

<!-- News Section -->
<section id="news" class="news-section section">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html(get_theme_mod('news_title', __('Latest News', 'theme1'))); ?></h2>
        <p class="section-subtitle"><?php echo esc_html(get_theme_mod('news_subtitle', __('Stay updated with our latest announcements and stories', 'theme1'))); ?></p>
        
        <?php
        // Get customizer settings
        $news_columns = get_theme_mod('news_columns', 'auto');
        $news_posts_count = get_theme_mod('news_posts_count', 3);
        $column_class = ($news_columns !== 'auto') ? ' columns-' . $news_columns : '';
        ?>
        
        <div class="news-grid<?php echo esc_attr($column_class); ?>">
            <?php
            $news_query = new WP_Query(array(
                'posts_per_page' => $news_posts_count,
                'post_status' => 'publish'
            ));
            
            if ($news_query->have_posts()) :
                while ($news_query->have_posts()) : $news_query->the_post(); ?>
                    <article class="news-item">
                        <div class="news-date"><?php echo get_the_date(); ?></div>
                        <h3 class="news-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="news-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <div class="news-item">
                    <h3 class="news-title"><?php _e('Welcome to Theme1', 'theme1'); ?></h3>
                    <div class="news-excerpt"><?php _e('This is a sample news item. Create your first post to see it here.', 'theme1'); ?></div>
                </div>
                <div class="news-item">
                    <h3 class="news-title"><?php _e('Japanese Design Inspiration', 'theme1'); ?></h3>
                    <div class="news-excerpt"><?php _e('Experience the tranquility and elegance of Japanese aesthetics in web design.', 'theme1'); ?></div>
                </div>
                <div class="news-item">
                    <h3 class="news-title"><?php _e('Customize Your Experience', 'theme1'); ?></h3>
                    <div class="news-excerpt"><?php _e('Use the WordPress Customizer to personalize your hero section and make this theme your own.', 'theme1'); ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- About Section -->
<?php get_template_part('template-parts/about-section'); ?>

<!-- Contact/Access Section -->
<?php get_template_part('template-parts/contact-section'); ?>

<?php get_footer(); ?>