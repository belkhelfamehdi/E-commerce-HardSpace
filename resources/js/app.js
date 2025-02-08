import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();


//-------- Active Sticky Js ----------//

window.addEventListener('scroll', function() {
    const section = document.querySelector('nav');
    let scrollPosition = window.pageYOffset;

    if (scrollPosition > 5) {
        section.classList.add('is-Sticky');
    } else {
        section.classList.remove('is-Sticky');
    }
});


//-------- Slider carousel ----------//

const images = ["https://cdn.originpc.com/img/home/slides/2023/amd-ryzen-7000-series-3d.jpg", "https://cdn.discordapp.com/attachments/883711728716746755/1337352585186639943/mystic-light-02.jpg?ex=67a873a7&is=67a72227&hm=b6993afb2621c3dd28cc6eaf3e254ccb865222a79061722bba9e2f9df6b60964&", "https://cdn.originpc.com/img/home/slides/2023/intel-13900KS-2.jpg", "https://cdn.originpc.com/img/home/slides/2023/nvidia-4070Ti.jpg", "https://cdn.originpc.com/img/home/slides/2022/corsair-xeneon-flex-v2.jpg"];

let currentImage = 0;

const background = document.getElementById("background-image");
const prevButton = document.getElementById("prev-btn");
const nextButton = document.getElementById("next-btn");
const s0 = document.getElementById("Slide 0");
const s1 = document.getElementById("Slide 1");
const s2 = document.getElementById("Slide 2");
const s3 = document.getElementById("Slide 3");
const s4 = document.getElementById("Slide 4");
const indicator = [s0, s1, s2, s3, s4];

function changeBackgroundImage() {
    background.style.backgroundImage = `url(${images[currentImage]})`;
    indicator[currentImage].classList.remove("opacity-40");
    indicator[currentImage].classList.add("opacity-100");
}

prevButton.addEventListener("click", () => {
    indicator[currentImage].classList.remove("opacity-100");
    indicator[currentImage].classList.add("opacity-40");
    currentImage = (currentImage - 1 + images.length) % images.length;
    changeBackgroundImage();
});

nextButton.addEventListener("click", () => {
    indicator[currentImage].classList.remove("opacity-100");
    indicator[currentImage].classList.add("opacity-40");
    currentImage = (currentImage + 1) % images.length;
    changeBackgroundImage();

});

function autoChangeImage() {
    indicator[currentImage].classList.remove("opacity-100");
    indicator[currentImage].classList.add("opacity-40");
    currentImage = (currentImage + 1) % images.length;
    changeBackgroundImage();
}

setInterval(autoChangeImage, 4000);

changeBackgroundImage();


//-------- Humburger menu ----------//

$(document).ready(function() {

    $(".nav-toggler").each(function(_, navToggler) {
        const target = $(navToggler).data("target");
        $(navToggler).on("click", function() {
            $(target).animate({
                height: 'toggle',
            });
        });
        //-------- searchbar ----------//
        $('.search').click(function() {
            $('.def-i').toggleClass('hidden');
            $('.searchbar').toggleClass('md:-left-full');
            if ($(window).width() >= 768) {
                $('.nav-i').toggleClass('hidden');
            }
        })
    });
    $('.nav-toggler').click(function() {
        const currentSrc = $('#logo').attr('src');
        const Src = $('#logo').data('src');
        if (window.matchMedia && !window.matchMedia('(prefers-color-scheme: dark)').matches) {
            $('#logo').attr('src', currentSrc === Src ? 'https://cdn.discordapp.com/attachments/1081252763545108592/1081295290239299695/Logo_White_named.png' : Src);
        }

    });

    $('.user').mouseenter(function() {
        $('.login').removeClass('opacity-0');
        $('.login').removeClass('pointer-events-none');
    });
    $('.user').mouseleave(function() {
        if (!$('.login *:focus').length) {
            $('.login').addClass('opacity-0');
            $('.login').addClass('pointer-events-none');
        }
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

//-------- Card Swiper ----------//
const swiper = new Swiper(".mySwiper", {
    slidesPerGroup: 1,
    loop: true,
    fade: true,
    grabCursor: true,
    disableOnInteraction: false,
    loopFillGroupWithBlank: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 2000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        disableOnInteraction: false,
    },
    breakpoints: {
        500: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        868: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
        1000: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
        1250: {
            slidesPerView: 5,
            spaceBetween: 30,
        },
    },
});
