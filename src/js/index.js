import { hello } from "./test";

console.log(hello());

document.querySelectorAll("[data-toggle-menu]").forEach((element) => {
    element.addEventListener("click", (e) => {
        const $target = document.getElementById(
            e.currentTarget.dataset.toggleMenu
        );

        $target.classList.toggle("hidden");
    });
});
