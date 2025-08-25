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
            
            if ($heroSection.length && $heroSection.data('images')) {
                var images = $heroSection.data('images');
                var speed = $heroSection.data('speed') || 5000;
                var transition = $heroSection.data('transition') || 'fade';
                var currentSlide = 0;
                var slideshowInterval;
                
                // Create overlay div for fade transitions
                if (transition === 'fade') {
                    $heroSection.css('position', 'relative');
                    if (!$heroSection.find('.slideshow-overlay').length) {
                        $heroSection.append('<div class="slideshow-overlay"></div>');
                    }
                }
                
                // Set initial background
                if (images.length > 0) {
                    $heroSection.css('background-image', 'url(' + images[0] + ')');
                }
                
                // Transition function
                function transitionToSlide(slideIndex) {
                    var $overlay = $heroSection.find('.slideshow-overlay');
                    
                    switch (transition) {
                        case 'fade':
                            if ($overlay.length) {
                                $overlay.css({
                                    'background-image': 'url(' + images[slideIndex] + ')',
                                    'opacity': 0
                                }).animate({
                                    opacity: 1
                                }, 800, function() {
                                    $heroSection.css('background-image', 'url(' + images[slideIndex] + ')');
                                    $overlay.css('opacity', 0);
                                });
                            } else {
                                $heroSection.css('background-image', 'url(' + images[slideIndex] + ')');
                            }
                            break;
                        case 'slide':
                            // For slide transition, we'll use a simple fade for now
                            // as CSS-only slide transitions are complex for background images
                            $heroSection.fadeOut(400, function() {
                                $(this).css('background-image', 'url(' + images[slideIndex] + ')').fadeIn(400);
                            });
                            break;
                        default:
                            // No transition
                            $heroSection.css('background-image', 'url(' + images[slideIndex] + ')');
                    }
                }
                
                // Auto-advance slideshow
                function nextSlide() {
                    currentSlide = (currentSlide + 1) % images.length;
                    transitionToSlide(currentSlide);
                    
                    // Update indicators
                    $('.slideshow-indicators .indicator').removeClass('active');
                    $('.slideshow-indicators .indicator').eq(currentSlide).addClass('active');
                }
                
                // Start slideshow if multiple images
                if (images.length > 1) {
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