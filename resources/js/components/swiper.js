import Swiper from "swiper";
import "swiper/css";

export function initSwiper() {
    const swiperContainer = document.querySelector(".swiper-container");
    if (swiperContainer) {
        new Swiper(".swiper-container", {
            loop: true,
            autoplay: { delay: 5000 },
            slidesPerView: 3,
            spaceBetween: 30,
            centeredSlides: true,
            breakpoints: {
                1024: { slidesPerView: 3, spaceBetween: 30 },
                768: { slidesPerView: 2, spaceBetween: 20 },
                500: { slidesPerView: 1, spaceBetween: 20 },
                0: { slidesPerView: 1, spaceBetween: 10 },
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    }
}
