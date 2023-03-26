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
    $('.search').click(function() {
        $('.def-i').toggleClass('hidden');
        if ($(window).width() >= 768) {
            $('.nav-i').toggleClass('hidden');
        }
    });

    $('.thumbnails > div > img').on("click", function() {
        const newImageSrc = $(this).attr('src');
        const mainImage = $('.main-image > div > img');

        mainImage.fadeOut(100, function() {
            mainImage.attr('src', newImageSrc);
            mainImage.fadeIn(100);
        });
    });

    var imageSrcArray = [];

    var currentImageIndex = 0;
    var imageDiv = $('.thumbnails');

    $('#hero').attr('src', imageSrcArray[currentImageIndex]);
    imageDiv.find('img').each(function() {
        imageSrcArray.push($(this).attr('src'));
    });

    function updateImage() {
        $('#hero').fadeOut(100, function() {
            $(this).attr('src', imageSrcArray[currentImageIndex]).fadeIn(100);
        });
    }

    // handle the next button click
    $('#next-mobile').click(function() {
        currentImageIndex++;
        if (currentImageIndex >= imageSrcArray.length) {
            currentImageIndex = 0;
        }
        updateImage();
    });

    // handle the previous button click
    $('#previous-mobile').click(function() {
        currentImageIndex--;
        if (currentImageIndex < 0) {
            currentImageIndex = imageSrcArray.length - 1;
        }
        updateImage();
    });

    // initialize the first image
    updateImage();

    $('.user').mouseenter(function() {
        $('.login').removeClass('opacity-0');
        $('.login').removeClass('pointer-events-none');
    });
    $('.user').mouseleave(function() {
        $('.login').addClass('opacity-0');
        $('.login').addClass('pointer-events-none');
    });

});

// Total increment/decrement
const counter = document.getElementById('amount');
const incrementBtn = document.getElementById('plus');
const decrementBtn = document.getElementById('minus');

let count = 0;

incrementBtn.addEventListener('click', () => {
    count++;
    console.log(count)
    counter.textContent = count;
});

decrementBtn.addEventListener('click', () => {
    if (count > 0) {
        count--;
        counter.textContent = count;
    } else {
        decrementBtn.disabled = true;
    }
});