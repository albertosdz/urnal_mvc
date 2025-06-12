/**
 * landing.js
 *
 * Este archivo contiene la lógica para la interacción de la landing page,
 * incluyendo el carrusel de imágenes, la navegación sticky que aparece al hacer scroll,
 * y el menú móvil desplegable.
 */

document.addEventListener("DOMContentLoaded", () => {
  // =========================
  // Carrusel de imágenes
  // =========================
  const slides = document.querySelectorAll(".carrusel__slide");
  const nextBtn = document.getElementById("nextSlide");
  const prevBtn = document.getElementById("prevSlide");
  let current = 0;

  /**
   * Muestra la diapositiva correspondiente al índice dado,
   * ocultando las demás.
   * @param {number} index - Índice de la diapositiva a mostrar.
   */
  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.toggle("activo", i === index);
    });
  }

  // Avanza a la siguiente diapositiva al hacer clic en el botón "Siguiente"
  nextBtn.addEventListener("click", () => {
    current = (current + 1) % slides.length;
    showSlide(current);
  });

  // Retrocede a la diapositiva anterior al hacer clic en el botón "Anterior"
  prevBtn.addEventListener("click", () => {
    current = (current - 1 + slides.length) % slides.length;
    showSlide(current);
  });

  // Avanza automáticamente el carrusel cada 6 segundos
  let autoSlideInterval = setInterval(() => {
    current = (current + 1) % slides.length;
    showSlide(current);
  }, 6000);

  // Muestra la primera diapositiva inicialmente
  showSlide(current);

  // =========================
  // Navegación sticky (barra fija al hacer scroll)
  // =========================
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

  // Observa el header para mostrar u ocultar la barra sticky según el scroll
  observer.observe(header);

  // =========================
  // Menú móvil desplegable
  // =========================
  const toggle = document.querySelector(".boton-menu");
  const menuMovil = document.querySelector(".menu-movil");
  const menuLinks = document.querySelectorAll(".menu-movil .menu-link");

  // Alterna visibilidad del menú al hacer clic en el botón hamburguesa
  toggle.addEventListener("click", () => {
    menuMovil.classList.toggle("visible");
  });

  // Cierra el menú al hacer clic en un enlace del menú móvil
  menuLinks.forEach((link) => {
    link.addEventListener("click", () => {
      menuMovil.classList.remove("visible");
    });
  });
});

/**
 * Filtra las preguntas y respuestas del FAQ por categoría.
 * Muestra solo las categorías que coinciden con el parámetro dado,
 * ocultando las demás. Si la categoría es una cadena vacía,
 * muestra todas las categorías.
 *
 * @param {string} category - Nombre de la categoría para filtrar.
 */
function filterFAQ(category) {
  // Obtiene todas las categorías del FAQ
  const categories = document.querySelectorAll(".faq__category");

  // Muestra u oculta categorías según el filtro aplicado
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
