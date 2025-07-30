document.addEventListener("DOMContentLoaded", () => {
  const burger = document.getElementById("burger");
  const menu = document.getElementById("menu");
  const body = document.body;
  const menuLinks = document.querySelectorAll(".header_menu a");

  const toggleMenu = () => {
    burger.classList.toggle("active");
    menu.classList.toggle("active");
    body.classList.toggle("no-scroll");
  };

  burger.addEventListener("click", toggleMenu);

  menuLinks.forEach(link => {
    link.addEventListener("click", () => {
      // Закриваємо меню при кліку на пункт
      burger.classList.remove("active");
      menu.classList.remove("active");
      body.classList.remove("no-scroll");
    });
  });
});