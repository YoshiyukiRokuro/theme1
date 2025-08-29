<?php
/**
 * Template part for category horizontal menu
 */

// Check if category menu is enabled
if (!get_theme_mod('category_menu_enable', false)) {
    return;
}

// Get customizer settings
$category_menu_title = get_theme_mod('category_menu_title', __('Browse Categories', 'theme1'));
$category_menu_subtitle = get_theme_mod('category_menu_subtitle', __('Explore our content by category', 'theme1'));
$category_menu_columns = get_theme_mod('category_menu_columns', 'auto');
$column_class = ($category_menu_columns !== 'auto') ? ' columns-' . $category_menu_columns : '';

// Get categories
$categories = get_categories(array(
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC'
));

if (empty($categories)) {
    return;
}
?>

<!-- Category Menu Section -->
<section id="category-menu" class="category-menu-section section">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html($category_menu_title); ?></h2>
        <p class="section-subtitle"><?php echo esc_html($category_menu_subtitle); ?></p>
        
        <div class="category-grid<?php echo esc_attr($column_class); ?>">
            <?php foreach ($categories as $category) : 
                $category_icon = get_theme_mod('category_icon_' . $category->term_id, '');
                $category_link = get_category_link($category->term_id);
                $post_count = $category->count;
            ?>
                <div class="category-item">
                    <a href="<?php echo esc_url($category_link); ?>" class="category-link">
                        <?php if (!empty($category_icon)) : ?>
                            <div class="category-icon">
                                <img src="<?php echo esc_url($category_icon); ?>" alt="<?php echo esc_attr($category->name); ?>" loading="lazy" />
                            </div>
                        <?php endif; ?>
                        <div class="category-content">
                            <h3 class="category-name"><?php echo esc_html($category->name); ?></h3>
                            <?php if (!empty($category->description)) : ?>
                                <p class="category-description"><?php echo esc_html($category->description); ?></p>
                            <?php endif; ?>
                            <span class="category-count"><?php echo sprintf(_n('%s post', '%s posts', $post_count, 'theme1'), number_format_i18n($post_count)); ?></span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>