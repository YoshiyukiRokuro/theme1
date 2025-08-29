# Category Horizontal Menu Feature

## Overview

The Category Horizontal Menu feature allows you to display WordPress categories in a beautiful grid layout on your front page. This feature provides an intuitive way for users to browse content by category.

## Features

- **Responsive Grid Layout**: Categories are displayed in a responsive grid that adapts to different screen sizes
- **Customizable Columns**: Choose from 1-4 columns or auto-responsive layout
- **Category Icons**: Add custom images/icons to each category
- **Post Count Display**: Shows the number of posts in each category
- **Hover Effects**: Modern hover animations for better user experience
- **Japanese Aesthetic**: Follows the theme's Japanese design philosophy with clean, minimal styling

## How to Use

### 1. Enable the Category Menu

1. Go to **Appearance > Customize**
2. Navigate to **Category Menu Section > Category Menu Settings**
3. Check **"Enable Category Menu"**
4. Customize the section title and subtitle
5. Select the number of columns (1-4 or Auto)

### 2. Add Category Icons

1. In the Customizer, go to **Category Menu Section > Category Icons**
2. Upload images for each of your categories
3. Recommended image size: 300x120px for best results

### 3. Create Categories

1. Go to **Posts > Categories** in your WordPress admin
2. Create new categories or edit existing ones
3. Add descriptions to categories for better user experience

## Customization

### Column Layout Options

- **Auto (responsive)**: Automatically adjusts columns based on screen size
- **1 Column**: Single column layout (good for mobile)
- **2 Columns**: Two-column layout
- **3 Columns**: Three-column layout (recommended)
- **4 Columns**: Four-column layout (for sites with many categories)

### Styling

The category menu uses the theme's existing color scheme:
- Primary color: `#8b4513` (brown)
- Background: `#f8f8f8` (light gray)
- Cards: White with subtle shadows
- Hover effects: Lift animation with enhanced shadows

### Integration

The category menu appears between the Hero section and News section on the front page. It only displays when:
- The feature is enabled in the Customizer
- At least one category exists with published posts

## Browser Compatibility

- Modern browsers with CSS Grid support
- Mobile-responsive design
- Graceful degradation for older browsers

## Technical Details

- **Template**: `template-parts/category-menu.php`
- **Styles**: Added to `style.css`
- **Customizer Settings**: Added to `functions.php`
- **WordPress Functions**: Uses `get_categories()`, `get_category_link()`, and theme customizer API