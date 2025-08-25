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
        
        // Mobile menu toggle (if needed for future enhancement)
        $('.mobile-menu-toggle').click(function() {
            $('.main-navigation').toggleClass('active');
            $(this).toggleClass('active');
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
                var currentSlide = 0;
                var slideshowInterval;
                
                // Set initial background
                if (images.length > 0) {
                    $heroSection.css('background-image', 'url(' + images[0] + ')');
                }
                
                // Auto-advance slideshow
                function nextSlide() {
                    currentSlide = (currentSlide + 1) % images.length;
                    $heroSection.css('background-image', 'url(' + images[currentSlide] + ')');
                    
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
                        $heroSection.css('background-image', 'url(' + images[currentSlide] + ')');
                        
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