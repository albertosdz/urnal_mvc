/* const mobileMenuBtn = document.querySelector("#mobile-menu");
const cerrarMenuBtn = document.querySelector("#cerrar-menu");
const sidebar = document.querySelector(".sidebar"); */

/* if (mobileMenuBtn) {
  mobileMenuBtn.addEventListener("click", function () {
    sidebar.classList.add("mostrar");
    });
    }
    if (cerrarMenuBtn) {
      cerrarMenuBtn.addEventListener("click", function () {
        sidebar.classList.add("ocultar");
        setTimeout(() => {
          sidebar.classList.remove("mostrar");
          sidebar.classList.remove("ocultar");
          }, 600);
          });
          }
          
          // Es necesario eliminar la clase de mostrar del sidebar
          const anchoPantalla = document.body.clientWidth;
          
          window.addEventListener("resize", function () {
            const anchoPantalla = document.body.clientWidth;
            
            if (anchoPantalla >= 768) {
              sidebar.classList.remove("mostrar");
              }
              }); */

const sidebar = document.getElementById("sidebar");
const menuBtn = document.getElementById("menu-btn");
const sidebarBtn = document.getElementById("sidebar-btn");
const darkModeBtn = document.getElementById("dark-mode-btn");


if (localStorage.getItem("darkModeEnabled") === "true") {
  document.documentElement.classList.add("dark-mode");
}

darkModeBtn.addEventListener("click", () => {
  const isDark = document.documentElement.classList.toggle("dark-mode");
  localStorage.setItem("darkModeEnabled", isDark);
});

sidebarBtn.addEventListener("click", () => {
  document.body.classList.toggle("sidebar-hidden");
});

function checkWindowSize() {
  sidebar.classList.remove("minimize");
}

checkWindowSize();
window.addEventListener("resize", checkWindowSize);

if (localStorage.getItem("sidebarMinimized") === "true") {
  sidebar.classList.add("minimize", "no-transition");
}

setTimeout(() => {
  sidebar.classList.remove("no-transition");
}, 50);

menuBtn.addEventListener("click", () => {
  sidebar.classList.toggle("minimize");
  const isMinimized = sidebar.classList.contains("minimize");
  localStorage.setItem("sidebarMinimized", isMinimized);
});

const textoSaludo = document.querySelector("#saludo");
const hora = new Date().getHours();
// Saludo personalizado segun la hora
let saludo = "";

if (hora >= 6 && hora < 14) {
  saludo = "Buenos días ☕ ";
} else if (hora >= 14 && hora < 21) {
  saludo = "Buenas tardes 🌤 ";
} else {
  saludo = "Buenas noches 😴 ";
}

textoSaludo.textContent = saludo;

function actualizarHoraYFecha() {
  const reloj = document.getElementById("reloj");
  const fecha = document.getElementById("fecha");

  const ahora = new Date();

  // Formato de hora: hh:mm
  const hora = ahora.toLocaleTimeString("es-ES", {
    hour: "2-digit",
    minute: "2-digit"
  });

  // Formato de fecha: lunes, 11 de junio de 2025
  const fechaTexto = ahora.toLocaleDateString("es-ES", {
    weekday: "long",
    day: "numeric",
    month: "long",
    year: "numeric"
  });

  reloj.textContent = hora;
  fecha.textContent = fechaTexto.charAt(0).toUpperCase() + fechaTexto.slice(1); // Capitaliza la primera letra
}

// Actualiza cada segundo
setInterval(actualizarHoraYFecha, 1000);
actualizarHoraYFecha(); // Llamada inicial