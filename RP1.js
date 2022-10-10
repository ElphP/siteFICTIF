function ToggleMenu() {
  const burger = document.querySelector(".burger");
  const navbar_lien = document.querySelector(".navbar_lien");
  const navlien = document.querySelector(".navlien");
  burger.addEventListener("click", () => {
    burger.classList.toggle("appnav");
  });
  burger.addEventListener("click", () => {
    navbar_lien.classList.toggle("appnav2");
  });
}
ToggleMenu();

