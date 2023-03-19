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