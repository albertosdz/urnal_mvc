// =====================
// Variables
// =====================

const sidebar = document.getElementById("sidebar");
const menuBtn = document.getElementById("menu-btn");
const sidebarBtn = document.getElementById("sidebar-btn");
const darkModeBtn = document.getElementById("dark-mode-btn");
const textoSaludo = document.querySelector("#saludo");
const logoutBtn = document.getElementById("logout-btn");

// =====================
// Funciones
// =====================

/**
 * Actualiza el reloj y la fecha en la interfaz.
 * Formatea la hora en hh:mm y la fecha en formato largo en español,
 * capitalizando la primera letra del texto de la fecha.
 */
function actualizarHoraYFecha() {
  const reloj = document.getElementById("reloj");
  const fecha = document.getElementById("fecha");

  const ahora = new Date();

  // Formato de hora: hh:mm
  const hora = ahora.toLocaleTimeString("es-ES", {
    hour: "2-digit",
    minute: "2-digit",
  });

  // Formato de fecha: lunes, 11 de junio de 2025
  const fechaTexto = ahora.toLocaleDateString("es-ES", {
    weekday: "long",
    day: "numeric",
    month: "long",
    year: "numeric",
  });

  reloj.textContent = hora;
  fecha.textContent = fechaTexto.charAt(0).toUpperCase() + fechaTexto.slice(1); // Capitaliza la primera letra
}

/**
 * Comprueba el tamaño de la ventana y ajusta la barra lateral.
 * Actualmente elimina la clase 'minimize' para mantener la barra expandida.
 */
function checkWindowSize() {
  sidebar.classList.remove("minimize");
}

/**
 * Establece el saludo personalizado según la hora del día.
 */
function establecerSaludo() {
  const hora = new Date().getHours();
  let saludo = "";

  if (hora >= 6 && hora < 14) {
    saludo = "Buenos días ☕ ";
  } else if (hora >= 14 && hora < 21) {
    saludo = "Buenas tardes 🌤 ";
  } else {
    saludo = "Buenas noches 😴 ";
  }

  textoSaludo.textContent = saludo;
}

// =====================
// Modo Oscuro
// =====================

// Aplica modo oscuro si está habilitado en localStorage
if (localStorage.getItem("darkModeEnabled") === "true") {
  document.documentElement.classList.add("dark-mode");
}

// Evento para alternar modo oscuro y guardar estado en localStorage
darkModeBtn.addEventListener("click", () => {
  const isDark = document.documentElement.classList.toggle("dark-mode");
  localStorage.setItem("darkModeEnabled", isDark);
});

// =====================
// Barra Lateral
// =====================

// Aplica estado minimizado de la barra lateral desde localStorage
if (localStorage.getItem("sidebarMinimized") === "true") {
  sidebar.classList.add("minimize", "no-transition");
}

// Elimina la clase no-transition después de un breve retraso para animaciones suaves
setTimeout(() => {
  sidebar.classList.remove("no-transition");
}, 50);

// Evento para alternar minimizado de la barra lateral y guardar estado
menuBtn.addEventListener("click", () => {
  sidebar.classList.toggle("minimize");
  const isMinimized = sidebar.classList.contains("minimize");
  localStorage.setItem("sidebarMinimized", isMinimized);
});

// Evento para ocultar o mostrar la barra lateral
sidebarBtn.addEventListener("click", () => {
  document.body.classList.toggle("sidebar-hidden");
});

// Ajusta la barra lateral según el tamaño de ventana
checkWindowSize();
window.addEventListener("resize", checkWindowSize);

// =====================
// Saludo y Fecha/Hora
// =====================

// Establece el saludo inicial
establecerSaludo();

// Actualiza la hora y fecha cada segundo
setInterval(actualizarHoraYFecha, 1000);
actualizarHoraYFecha(); // Llamada inicial

// =====================
// Logout
// =====================

// Evento para limpiar configuraciones y modo oscuro al cerrar sesión
if (logoutBtn) {
  logoutBtn.addEventListener("click", () => {
    document.documentElement.classList.remove("dark-mode");
    localStorage.removeItem("darkModeEnabled");
    localStorage.removeItem("sidebarMinimized");
    // Si necesitas limpiar todo el localStorage (opcional):
    // localStorage.clear();
  });
}