import "./bootstrap";

import Alpine from "alpinejs";
import Swiper from "swiper";
import "swiper/css";

document.addEventListener("DOMContentLoaded", function () {
    const swiper = new Swiper(".swiper-container", {
        loop: true,
        autoplay: {
            delay: 5000,
        },
        slidesPerView: 3,
        spaceBetween: 30,
        centeredSlides: true,
        breakpoints: {
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            500: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            0: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
        },

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
});

window.Alpine = Alpine;
Alpine.start();
