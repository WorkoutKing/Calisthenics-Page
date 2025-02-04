import "./bootstrap";
import Alpine from "alpinejs";
import { initSwiper } from "./components/swiper";
import { initSidebar } from "./components/sidebar";

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Run all scripts when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM fully loaded");
    initSwiper();
    initSidebar();
});
