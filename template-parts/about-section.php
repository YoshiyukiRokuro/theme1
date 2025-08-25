<?php
/**
 * Template part for displaying the About section
 */

// Get about section data
$about_data = theme1_get_about_data();
?>

<!-- About Section -->
<section id="about" class="about-section section">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html($about_data['title']); ?></h2>
        <div class="about-content">
            <div class="about-text">
                <?php echo wp_kses_post($about_data['content']); ?>
            </div>
            <?php if ($about_data['image']) : ?>
            <div class="about-image">
                <img src="<?php echo esc_url($about_data['image']); ?>" alt="<?php echo esc_attr($about_data['image_alt']); ?>" />
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>