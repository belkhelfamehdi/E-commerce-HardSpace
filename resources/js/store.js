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

    //-------- Pagination ----------//

    var productsPerPage = 9; // Maximum 9 products per page
    var currentPage = 1;

    function showPage(pageNumber) {
        currentPage = pageNumber;
        var startIndex = (pageNumber - 1) * productsPerPage;
        var endIndex = startIndex + productsPerPage;
        $('.product > div').hide().slice(startIndex, endIndex).show();
    }

    showPage(currentPage);

    function updatePagination() {
        var numProducts = $('.product > div').length;
        var numPages = Math.ceil(numProducts / productsPerPage);
        $('.pagination').empty();

        var startPage, endPage;
        if (numPages <= 4) {
            startPage = 1;
            endPage = numPages;
        } else {
            if (currentPage <= 2) {
                startPage = 1;
                endPage = 4;
            } else if (currentPage >= numPages - 1) {
                startPage = numPages - 3;
                endPage = numPages;
            } else {
                startPage = currentPage - 1;
                endPage = currentPage + 2;
            }
        }

        for (var i = startPage; i <= endPage; i++) {
            var linkHtml = '<button href="#" type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm border rounded shadow-md dark:bg-gray-900 dark:border-gray-800" title="Page ' + i + '">' + i + '</button>';
            $('.pagination').append(linkHtml);
        }

        if (numPages > 4 && currentPage >= 3) {
            $('.pagination').prepend('<span type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm border rounded shadow-md dark:bg-gray-900 dark:border-gray-800"">...</span>');
        }

        $('.pagination button').removeClass('active');
        $('.pagination button:eq(' + (currentPage - startPage) + ')').addClass('active bg-pcolor dark:bg-pcolor text-white');
        $('#pagination button').removeClass('active');
        $('#pagination button:eq(' + (currentPage - startPage) + ')').addClass('active bg-pcolor dark:bg-pcolor text-white');

        if (currentPage === 1) {
            $('.prev-btn').prop('disabled', true);
        } else {
            $('.prev-btn').prop('disabled', false);
        }

        if (currentPage === numPages) {
            $('.next-btn').prop('disabled', true);
        } else {
            $('.next-btn').prop('disabled', false);
        }
    }

    updatePagination();

    $('.pagination').on('click', 'button', function(e) {
        e.preventDefault();
        var pageNumber = parseInt($(this).text());
        if ($(this).text() === '...') {
            return;
        } else if ($(this).text() === 'Last Page') {
            pageNumber = Math.ceil($('.product > div').length / productsPerPage);
        }
        showPage(pageNumber);
        updatePagination();
        $('html, body').animate({
            scrollTop: $("#store").offset().top
        });
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


});