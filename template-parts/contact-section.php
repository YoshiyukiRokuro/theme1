<?php
/**
 * Template part for displaying the Contact & Access section
 */

// Get contact section data
$contact_data = theme1_get_contact_data();
?>

<!-- Contact/Access Section -->
<section id="contact" class="contact-section section">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html($contact_data['title']); ?></h2>
        <p class="section-subtitle"><?php echo esc_html($contact_data['subtitle']); ?></p>
        
        <div class="contact-info">
            <div class="contact-item">
                <h3><?php _e('Address', 'theme1'); ?></h3>
                <p><?php echo wp_kses_post($contact_data['address']); ?></p>
            </div>
            
            <div class="contact-item">
                <h3><?php _e('Contact Information', 'theme1'); ?></h3>
                <p>
                    <?php if ($contact_data['phone']) : ?>
                        <?php _e('Phone:', 'theme1'); ?> <?php echo esc_html($contact_data['phone']); ?><br>
                    <?php endif; ?>
                    <?php if ($contact_data['email']) : ?>
                        <?php _e('Email:', 'theme1'); ?> <a href="mailto:<?php echo esc_attr($contact_data['email']); ?>"><?php echo esc_html($contact_data['email']); ?></a><br>
                    <?php endif; ?>
                    <?php if ($contact_data['hours']) : ?>
                        <?php _e('Hours:', 'theme1'); ?> <?php echo esc_html($contact_data['hours']); ?>
                    <?php endif; ?>
                </p>
            </div>
            
            <div class="contact-item">
                <h3><?php _e('Access', 'theme1'); ?></h3>
                <p><?php echo wp_kses_post($contact_data['access_info']); ?></p>
            </div>
        </div>
    </div>
</section>