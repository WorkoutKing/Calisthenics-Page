import Swiper from "swiper";
import "swiper/css";
import "swiper/css/navigation";
import { Navigation } from "swiper/modules";

export function initSwiper() {
    const swiperContainer = document.querySelector(".swiper-container");
    if (swiperContainer) {
        new Swiper(".swiper-container", {
            loop: true,
            autoplay: { delay: 5000 },
            slidesPerView: 3,
            spaceBetween: 30,
            centeredSlides: true,
            modules: [Navigation],

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                1024: { slidesPerView: 3, spaceBetween: 30 },
                768: { slidesPerView: 2, spaceBetween: 20 },
                500: { slidesPerView: 1, spaceBetween: 20 },
                0: { slidesPerView: 1, spaceBetween: 10 },
            },
        });
    }
}
