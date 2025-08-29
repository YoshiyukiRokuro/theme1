/**
 * Theme1 JavaScript functionality
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        
        // Smooth scrolling for anchor links
        $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 800);
                    return false;
                }
            }
        });
        
        // Mobile menu toggle
        $('.mobile-menu-toggle').click(function() {
            var $navigation = $('.main-navigation');
            var isExpanded = $(this).attr('aria-expanded') === 'true';
            
            $navigation.toggleClass('active');
            $(this).toggleClass('active');
            
            // Update aria-expanded for accessibility
            $(this).attr('aria-expanded', !isExpanded);
            
            // Close menu when clicking outside
            if ($navigation.hasClass('active')) {
                $(document).on('click.mobile-menu', function(e) {
                    if (!$(e.target).closest('.main-navigation, .mobile-menu-toggle').length) {
                        $navigation.removeClass('active');
                        $('.mobile-menu-toggle').removeClass('active').attr('aria-expanded', 'false');
                        $(document).off('click.mobile-menu');
                    }
                });
            } else {
                $(document).off('click.mobile-menu');
            }
        });
        
        // Close mobile menu when window is resized to desktop view
        $(window).resize(function() {
            if ($(window).width() > 768) {
                $('.main-navigation').removeClass('active');
                $('.mobile-menu-toggle').removeClass('active').attr('aria-expanded', 'false');
                $(document).off('click.mobile-menu');
            }
        });
        
        // Parallax effect for hero section (optional)
        $(window).scroll(function() {
            var scrolled = $(window).scrollTop();
            var rate = scrolled * -0.5;
            $('.hero-section').css('background-position', 'center ' + rate + 'px');
        });
        
        // Hero Section Slideshow
        function initHeroSlideshow() {
            var $heroSection = $('.hero-section[data-slideshow="true"]');
            
            if ($heroSection.length && $heroSection.data('media')) {
                var mediaItems = $heroSection.data('media');
                var speed = $heroSection.data('speed') || 5000;
                var transition = $heroSection.data('transition') || 'fade';
                var currentSlide = 0;
                var slideshowInterval;
                var $videoContainer = $heroSection.find('.hero-video-container');
                
                // Create overlay div for fade transitions
                if (transition === 'fade') {
                    $heroSection.css('position', 'relative');
                    if (!$heroSection.find('.slideshow-overlay').length) {
                        $heroSection.append('<div class="slideshow-overlay"></div>');
                    }
                }
                
                // Helper function to get video embed info (similar to PHP function)
                function getVideoEmbedInfo(videoUrl) {
                    if (!videoUrl) return false;
                    
                    // YouTube detection
                    var youtubeMatch = videoUrl.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
                    if (youtubeMatch) {
                        return {
                            type: 'youtube',
                            id: youtubeMatch[1],
                            embed_url: 'https://www.youtube.com/embed/' + youtubeMatch[1] + '?autoplay=1&mute=1&loop=1&playlist=' + youtubeMatch[1] + '&controls=0&showinfo=0&rel=0&modestbranding=1'
                        };
                    }
                    
                    // Vimeo detection
                    var vimeoMatch = videoUrl.match(/(?:vimeo\.com\/)(\d+)/);
                    if (vimeoMatch) {
                        return {
                            type: 'vimeo',
                            id: vimeoMatch[1],
                            embed_url: 'https://player.vimeo.com/video/' + vimeoMatch[1] + '?autoplay=1&muted=1&loop=1&background=1&controls=0'
                        };
                    }
                    
                    // Direct video file
                    var videoExtensions = ['mp4', 'webm', 'ogg', 'mov', 'avi'];
                    var pathParts = videoUrl.split('.');
                    var extension = pathParts[pathParts.length - 1].toLowerCase();
                    if (videoExtensions.indexOf(extension) !== -1) {
                        return {
                            type: 'direct',
                            url: videoUrl
                        };
                    }
                    
                    return false;
                }
                
                // Function to create video element
                function createVideoElement(videoInfo) {
                    if (videoInfo.type === 'direct') {
                        return '<video class="hero-video" autoplay muted loop playsinline><source src="' + videoInfo.url + '" type="video/mp4"></video>';
                    } else {
                        return '<iframe class="hero-video" src="' + videoInfo.embed_url + '" frameborder="0" allow="autoplay; fullscreen"></iframe>';
                    }
                }
                
                // Set initial media
                if (mediaItems.length > 0) {
                    var firstMedia = mediaItems[0];
                    if (firstMedia.type === 'video') {
                        var videoInfo = getVideoEmbedInfo(firstMedia.url);
                        if (videoInfo) {
                            $videoContainer.html(createVideoElement(videoInfo)).show();
                            $heroSection.css('background-image', 'none');
                        }
                    } else {
                        $heroSection.css('background-image', 'url(' + firstMedia.url + ')');
                        $videoContainer.hide();
                    }
                }
                
                // Transition function
                function transitionToSlide(slideIndex) {
                    var mediaItem = mediaItems[slideIndex];
                    var $overlay = $heroSection.find('.slideshow-overlay');
                    
                    if (mediaItem.type === 'video') {
                        var videoInfo = getVideoEmbedInfo(mediaItem.url);
                        if (videoInfo) {
                            // Handle video transition
                            switch (transition) {
                                case 'fade':
                                    $videoContainer.fadeOut(400, function() {
                                        $(this).html(createVideoElement(videoInfo)).fadeIn(400);
                                        $heroSection.css('background-image', 'none');
                                    });
                                    break;
                                default:
                                    $videoContainer.html(createVideoElement(videoInfo)).show();
                                    $heroSection.css('background-image', 'none');
                            }
                        }
                    } else {
                        // Handle image transition
                        switch (transition) {
                            case 'fade':
                                if ($overlay.length) {
                                    $videoContainer.fadeOut(400);
                                    $overlay.css({
                                        'background-image': 'url(' + mediaItem.url + ')',
                                        'opacity': 0
                                    }).animate({
                                        opacity: 1
                                    }, 800, function() {
                                        $heroSection.css('background-image', 'url(' + mediaItem.url + ')');
                                        $overlay.css('opacity', 0);
                                    });
                                } else {
                                    $videoContainer.fadeOut(400);
                                    $heroSection.css('background-image', 'url(' + mediaItem.url + ')');
                                }
                                break;
                            case 'slide':
                                $videoContainer.fadeOut(400);
                                $heroSection.fadeOut(400, function() {
                                    $(this).css('background-image', 'url(' + mediaItem.url + ')').fadeIn(400);
                                });
                                break;
                            default:
                                $videoContainer.hide();
                                $heroSection.css('background-image', 'url(' + mediaItem.url + ')');
                        }
                    }
                }
                
                // Auto-advance slideshow
                function nextSlide() {
                    currentSlide = (currentSlide + 1) % mediaItems.length;
                    transitionToSlide(currentSlide);
                    
                    // Update indicators
                    $('.slideshow-indicators .indicator').removeClass('active');
                    $('.slideshow-indicators .indicator').eq(currentSlide).addClass('active');
                }
                
                // Start slideshow if multiple media items
                if (mediaItems.length > 1) {
                    slideshowInterval = setInterval(nextSlide, speed);
                    
                    // Manual control via indicators
                    $('.slideshow-indicators .indicator').on('click', function() {
                        var slideIndex = $(this).data('slide');
                        currentSlide = slideIndex;
                        transitionToSlide(currentSlide);
                        
                        // Update indicators
                        $('.slideshow-indicators .indicator').removeClass('active');
                        $(this).addClass('active');
                        
                        // Restart interval
                        clearInterval(slideshowInterval);
                        slideshowInterval = setInterval(nextSlide, speed);
                    });
                    
                    // Pause on hover
                    $heroSection.on('mouseenter', function() {
                        clearInterval(slideshowInterval);
                    }).on('mouseleave', function() {
                        slideshowInterval = setInterval(nextSlide, speed);
                    });
                }
            }
        }
        
        // Initialize slideshow
        initHeroSlideshow();
        
        // Fade in animation for sections on scroll
        function checkForAnimation() {
            var triggerBottom = $(window).scrollTop() + $(window).height() / 5 * 4;
            
            $('.section').each(function() {
                var imageTop = $(this).offset().top;
                
                if (imageTop < triggerBottom) {
                    $(this).addClass('animate-in');
                }
            });
        }
        
        $(window).scroll(checkForAnimation);
        checkForAnimation(); // Check on load
        
        // Add animation class to CSS
        $('<style>')
            .prop('type', 'text/css')
            .html(`
                .section {
                    opacity: 0;
                    transform: translateY(30px);
                    transition: opacity 0.6s ease, transform 0.6s ease;
                }
                .section.animate-in {
                    opacity: 1;
                    transform: translateY(0);
                }
                .hero-section {
                    opacity: 1 !important;
                    transform: none !important;
                }
            `)
            .appendTo('head');
    });
    
})(jQuery);