document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll(".carrusel__slide");
  const nextBtn = document.getElementById("nextSlide");
  const prevBtn = document.getElementById("prevSlide");
  let current = 0;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.toggle("activo", i === index);
    });
  }

  nextBtn.addEventListener("click", () => {
    current = (current + 1) % slides.length;
    showSlide(current);
  });

  prevBtn.addEventListener("click", () => {
    current = (current - 1 + slides.length) % slides.length;
    showSlide(current);
  });

  let autoSlideInterval = setInterval(() => {
    current = (current + 1) % slides.length;
    showSlide(current);
  }, 6000);

  showSlide(current);

  const header = document.querySelector(".header");
  const stickyNav = document.querySelector(".sticky-nav");

  const observer = new IntersectionObserver(
    (entries) => {
      if (!entries[0].isIntersecting) {
        stickyNav.classList.add("visible");
      } else {
        stickyNav.classList.remove("visible");
      }
    },
    {
      root: null,
      threshold: 0,
    }
  );

  observer.observe(header);

  observer.observe(header);

  const toggle = document.querySelector(".boton-menu");
  const menuMovil = document.querySelector(".menu-movil");
  const menuLinks = document.querySelectorAll(".menu-movil .menu-link");

  // Alterna visibilidad del menú al hacer clic en el botón hamburguesa
  toggle.addEventListener("click", () => {
    menuMovil.classList.toggle("visible");
  });

  // Cierra el menú al hacer clic en un enlace
  menuLinks.forEach((link) => {
    link.addEventListener("click", () => {
      menuMovil.classList.remove("visible");
    });
  });
});

// Filtra las preguntas y respuestas por categoría
function filterFAQ(category) {
  // Obtiene todas las categorías
  const categories = document.querySelectorAll(".faq__category");

  // Si la categoría está vacía, muestra todo
  categories.forEach((cat) => {
    if (
      category === "" ||
      cat.querySelector(".faq__category-title").textContent === category
    ) {
      cat.style.display = "block"; // Muestra la categoría
    } else {
      cat.style.display = "none"; // Oculta las categorías no seleccionadas
    }
  });
}
