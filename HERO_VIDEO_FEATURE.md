# Hero Video Embedding Feature

## Overview

The Hero Image section now supports video embedding alongside existing image functionality. Videos can be mixed with images in slideshows and will automatically loop with muted audio for optimal user experience.

## Supported Video Types

### 1. YouTube Videos
- **Format**: Full YouTube URLs or shortened youtu.be URLs
- **Examples**: 
  - `https://www.youtube.com/watch?v=VIDEO_ID`
  - `https://youtu.be/VIDEO_ID`
- **Features**: Automatic mute, loop, no controls, autoplay

### 2. Vimeo Videos
- **Format**: Standard Vimeo URLs
- **Example**: `https://vimeo.com/VIDEO_ID`
- **Features**: Background mode, muted, loop, autoplay

### 3. Direct Video Files
- **Formats**: MP4, WebM, OGG, MOV, AVI
- **Example**: `https://example.com/video.mp4`
- **Features**: HTML5 video element with autoplay, mute, loop

## How to Use

### WordPress Customizer

1. Go to **Appearance > Customize**
2. Navigate to **Hero Section > Hero Image**
3. You'll see 3 video URL fields alongside the existing image fields:
   - Hero Background Video 1 URL
   - Hero Background Video 2 URL
   - Hero Background Video 3 URL

### Configuration Priority

- If both an image and video are set for the same slot, **video takes priority**
- Videos will be embedded instead of the corresponding image
- Empty video fields will fall back to using the image (if set)

### Slideshow Integration

- Videos work seamlessly with the existing slideshow functionality
- Mixed content slideshows (images + videos) are fully supported
- Slideshow indicators work with both images and videos
- All existing transition effects (fade, slide, none) work with videos

### Performance Considerations

- Videos are embedded using optimized settings for background use
- YouTube and Vimeo videos use official embed players
- Direct video files should be optimized for web (compressed, reasonable file size)
- Videos are set to autoplay muted to comply with browser policies

## Technical Implementation

- **PHP Functions**: `theme1_get_video_embed_info()` detects video types
- **JavaScript**: Enhanced slideshow to handle mixed media
- **CSS**: Responsive video positioning and loading states
- **Fallback**: Graceful degradation if video URLs are invalid

## Browser Compatibility

- Modern browsers with HTML5 video support
- YouTube/Vimeo embeds work in all major browsers
- Mobile devices supported with responsive design
- Autoplay works reliably when muted (browser requirement)