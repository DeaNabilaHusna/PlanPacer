import { initDropdown } from './dropdown.js';

document.addEventListener('DOMContentLoaded', () => {
    initDropdown();
});
// document.addEventListener("DOMContentLoaded", function () {
//     const notificationButton = document.querySelector("#notification-button");
//     const notificationCard = document.querySelector("#notification-card");

//     notificationButton.addEventListener("click", function () {
//         notificationCard.classList.toggle("hidden");
//     });
// });

// document.addEventListener("DOMContentLoaded", function () {
//     const navToggle = document.getElementById("nav-toggle");
//     const sidebar = document.getElementById("application-sidebar");

//     // Toggle sidebar 
//     navToggle.addEventListener("click", function () {
//         sidebar.classList.toggle("-translate-x-full");
//     });

//     // Tutup sidebar
//     document.addEventListener("click", function (event) {
//         const isClickInsideSidebar = sidebar.contains(event.target);
//         const isClickOnToggleButton = navToggle.contains(event.target);

//         if (
//             !isClickInsideSidebar &&
//             !isClickOnToggleButton &&
//             !sidebar.classList.contains("-translate-x-full")
//         ) {
//             sidebar.classList.add("-translate-x-full");
//         }
//     });
// });


