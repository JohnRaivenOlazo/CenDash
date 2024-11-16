// ========================================================================== //
// Loader

const loader = document.querySelector('.loader');

window.addEventListener('load', () => {

    setTimeout(() => {
        loader.classList.add('loaded');
    }, 1000);
});

document.addEventListener("DOMContentLoaded", () => {
  // ========================================================================== //
  //   Navigation

  const navToggle = document.getElementById("nav-toggle");
  const navUl = document.querySelector(".nav-list");

  navToggle.addEventListener("click", () => {
    navUl.classList.toggle("show");
    navToggle.classList.toggle("active");
  });

  const navLinks = document.querySelectorAll(".nav-list li a");

  navLinks.forEach((link) => {
    link.addEventListener("click", () => {
      link.nextElementSibling.classList.toggle("show");
    });
  });

  // ========================================================================== //
  // Vendor Filter

  const container = document.querySelector(".sort-container");
  const links = document.querySelectorAll("div.filter a");

  const isotope = new Isotope(container, {
    filter: "*",
  });

  links.forEach((link) => {
    link.addEventListener("click", function () {
      const selector = this.getAttribute("data-filter");
      isotope.arrange({ filter: selector });
    });
  });
});
