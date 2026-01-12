document.addEventListener("DOMContentLoaded", function () {
  const menuToggle = document.getElementById("menu-toggle");

  const navMenu = document.getElementById("nav-menu");
  console.log(navMenu);

  menuToggle.addEventListener("click", function () {
    navMenu.classList.toggle("hidden");
  });
});
