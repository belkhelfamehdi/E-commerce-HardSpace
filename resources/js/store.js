import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

$(document).ready(function() {

    //-------- Humburger menu ----------//

    $(".nav-toggler").each(function(_, navToggler) {
        var target = $(navToggler).data("target");
        $(navToggler).on("click", function() {
            $(target).animate({
                height: 'toggle',
            });
            console.log('clicked');
        });
    });
    $('.nav-toggler').click(function() {
        const currentSrc = $('#logo').attr('src');
        const Src = $('#logo').data('src');
        if (window.matchMedia && !window.matchMedia('(prefers-color-scheme: dark)').matches) {
            $('#logo').attr('src', currentSrc === Src ? 'https://cdn.discordapp.com/attachments/1081252763545108592/1081295290239299695/Logo_White_named.png' : Src);
        }

    });
    //-------- searchbar ----------//
    $('.search').click(function() {
        $('.def-i').toggleClass('hidden');
        $('.searchbar').toggleClass('md:-left-full');
        if ($(window).width() >= 768) {
            $('.nav-i').toggleClass('hidden');
        }
    });



    //-------- Affichage de disponibilité et Tags ----------//


    const stock = $('.stock');
    const stockMenu = $('#filter-section-0');
    const cat = $('.cat');
    const catMenu = $('#filter-section-1');


    stock.on('click', function() {
        $('.stock svg').toggleClass('-rotate-90');
        stockMenu.animate({
            height: 'toggle',
        });
    });

    cat.on('click', function() {
        $('.cat svg').toggleClass('-rotate-90');
        catMenu.animate({
            height: 'toggle',
        });


    });

    //-------- Responsive sidebar ----------//

    const $menuButton = $('.togmenu');
    const $offCanvasMenu = $('.menu-f');
    const $backdrop = $('.backd');

    $menuButton.on('click', function(event) {
        $offCanvasMenu.toggleClass('active');
        $backdrop.toggleClass('open pointer-events-none');
    });


    $('.prev-btn').click(function() {
        showPage(currentPage - 1);
        updatePagination();
        $('html, body').animate({
            scrollTop: $("#store").offset().top
        });
    });

    $('.next-btn').click(function() {
        showPage(currentPage + 1);
        updatePagination();
        $('html, body').animate({
            scrollTop: $("#store").offset().top
        });
    });

    $('.user').mouseenter(function() {
        $('.login').removeClass('opacity-0');
        $('.login').removeClass('pointer-events-none');
    });
    $('.user').mouseleave(function() {
        $('.login').addClass('opacity-0');
        $('.login').addClass('pointer-events-none');
    });
    
    $('.cart').mouseenter(function() {
        $('.cart_p').removeClass('opacity-0');
        $('.cart_p').removeClass('pointer-events-none');
    });
    $('.cart').mouseleave(function() {
        if (!$('.cart_p *:focus').length) {
            $('.cart_p').addClass('opacity-0');
            $('.cart_p').addClass('pointer-events-none');
        }
    });

});