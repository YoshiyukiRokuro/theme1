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
<section class="hero-section full-width" style="<?php echo $hero_data['background_image'] ? 'background-image: url(' . esc_url($hero_data['background_image']) . ');' : ''; ?>">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title"><?php echo esc_html($hero_data['title']); ?></h1>
            <p class="hero-subtitle"><?php echo esc_html($hero_data['subtitle']); ?></p>
            <a href="<?php echo esc_url($hero_data['cta_url']); ?>" class="hero-cta"><?php echo esc_html($hero_data['cta_text']); ?></a>
        </div>
    </div>
</section>

<!-- News Section -->
<section id="news" class="news-section section">
    <div class="container">
        <h2 class="section-title"><?php _e('Latest News', 'theme1'); ?></h2>
        <p class="section-subtitle"><?php _e('Stay updated with our latest announcements and stories', 'theme1'); ?></p>
        
        <div class="news-grid">
            <?php
            $news_query = new WP_Query(array(
                'posts_per_page' => 3,
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
<section id="about" class="about-section section">
    <div class="container">
        <h2 class="section-title"><?php _e('About Us', 'theme1'); ?></h2>
        <div class="about-content">
            <div class="about-text">
                <p><?php _e('We are inspired by the timeless beauty and simplicity of Japanese design. Our approach emphasizes clean lines, thoughtful spacing, and a harmonious balance between tradition and modernity.', 'theme1'); ?></p>
                <p><?php _e('Through careful attention to detail and respect for minimalist principles, we create experiences that resonate with tranquility and elegance.', 'theme1'); ?></p>
            </div>
            <div class="about-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-about.jpg" alt="<?php _e('About us image', 'theme1'); ?>" />
            </div>
        </div>
    </div>
</section>

<!-- Contact/Access Section -->
<section id="contact" class="contact-section section">
    <div class="container">
        <h2 class="section-title"><?php _e('Contact & Access', 'theme1'); ?></h2>
        <p class="section-subtitle"><?php _e('Get in touch with us or visit our location', 'theme1'); ?></p>
        
        <div class="contact-info">
            <div class="contact-item">
                <h3><?php _e('Address', 'theme1'); ?></h3>
                <p>
                    <?php _e('123 Japanese Street', 'theme1'); ?><br>
                    <?php _e('Design District', 'theme1'); ?><br>
                    <?php _e('Tokyo, Japan 100-0001', 'theme1'); ?>
                </p>
            </div>
            
            <div class="contact-item">
                <h3><?php _e('Contact Information', 'theme1'); ?></h3>
                <p>
                    <?php _e('Phone: +81-3-1234-5678', 'theme1'); ?><br>
                    <?php _e('Email: info@theme1.com', 'theme1'); ?><br>
                    <?php _e('Hours: 9:00 AM - 6:00 PM', 'theme1'); ?>
                </p>
            </div>
            
            <div class="contact-item">
                <h3><?php _e('Access', 'theme1'); ?></h3>
                <p>
                    <?php _e('5 minutes walk from Station A', 'theme1'); ?><br>
                    <?php _e('3 minutes walk from Station B', 'theme1'); ?><br>
                    <?php _e('Parking available nearby', 'theme1'); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>