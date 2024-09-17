export function initDropdown() {
    document.addEventListener("DOMContentLoaded", (event) => {
        const container = document.querySelector("html");

        container.addEventListener("click", (event) => {
            const isDropdownToggle = event.target.closest(".dropdownToggle");

            // hidden untuk tampilan awal
            document.querySelectorAll(".dropdownMenu").forEach((menu) => {
                menu.classList.add("hidden");
            });

            if (isDropdownToggle) {
                event.preventDefault();
                const dropdownMenu = isDropdownToggle.nextElementSibling;
                if (dropdownMenu) {
                    dropdownMenu.classList.toggle("hidden");
                }
            }
        });
    });
}
