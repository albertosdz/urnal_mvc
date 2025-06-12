(function () {
  // ==============================
  // Variables
  // ==============================
  let tareas = [];
  let filtradas = [];

  // ==============================
  // Elementos del DOM
  // ==============================
  const nuevaTareaBtn = document.querySelector("#agregar-tarea");
  const filtros = document.querySelectorAll('#filtros input[type="radio"');
  const listadoTareas = document.querySelector("#listado-tareas");
  const pendientesRadio = document.querySelector("#pendientes");
  const completadasRadio = document.querySelector("#completadas");

  // ==============================
  // Eventos
  // ==============================
  nuevaTareaBtn.addEventListener("click", () => mostrarFormulario());

  filtros.forEach((radio) => {
    radio.addEventListener("input", filtrarTareas);
  });

  // ==============================
  // Funciones principales
  // ==============================

  /**
   * Obtiene las tareas del proyecto actual desde el servidor.
   * @async
   */
  async function obtenerTareas() {
    try {
      const id = obtenerProyecto();
      const url = `/api/tareas?id=${id}`;
      const respuesta = await fetch(url);
      const resultado = await respuesta.json();

      tareas = resultado.tareas;
      mostrarTareas();
    } catch (error) {
      console.error("Error al obtener tareas:", error);
    }
  }

  /**
   * Muestra las tareas en la interfaz, aplicando filtros si existen.
   */
  function mostrarTareas() {
    limpiarTareas();
    totalPendientes();
    totalCompletadas();

    const arrayTareas = filtradas.length ? filtradas : tareas;

    if (arrayTareas.length === 0) {
      const textoNoTareas = document.createElement("LI");
      textoNoTareas.textContent = "No Hay Tareas";
      textoNoTareas.classList.add("no-tareas");
      listadoTareas.appendChild(textoNoTareas);
      return;
    }

    const estados = {
      0: "Pendiente",
      1: "Completa",
    };

    arrayTareas.forEach((tarea) => {
      const contenedorTarea = document.createElement("LI");
      contenedorTarea.dataset.tareaId = tarea.id;
      contenedorTarea.classList.add("tarea");

      const nombreTarea = document.createElement("P");
      nombreTarea.textContent = tarea.nombre;
      nombreTarea.onclick = () => mostrarFormulario(true, { ...tarea });

      const opcionesDiv = document.createElement("DIV");
      opcionesDiv.classList.add("opciones");

      // Botón para cambiar estado de la tarea
      const btnEstadoTarea = document.createElement("BUTTON");
      btnEstadoTarea.classList.add("estado-tarea", estados[tarea.estado].toLowerCase());
      btnEstadoTarea.textContent = estados[tarea.estado];
      btnEstadoTarea.dataset.estadoTarea = tarea.estado;
      btnEstadoTarea.onclick = () => cambiarEstadoTarea({ ...tarea });

      // Botón para eliminar tarea con icono
      const btnEliminarTarea = document.createElement("BUTTON");
      btnEliminarTarea.classList.add("eliminar-tarea");
      btnEliminarTarea.dataset.idTarea = tarea.id;

      const imgCruz = document.createElement("img");
      imgCruz.src = "build/img/eliminar.svg";
      imgCruz.alt = "Eliminar tarea";
      imgCruz.classList.add("icono-cruz");

      btnEliminarTarea.appendChild(imgCruz);
      btnEliminarTarea.onclick = () => confirmarEliminarTarea({ ...tarea });

      opcionesDiv.appendChild(btnEstadoTarea);
      opcionesDiv.appendChild(btnEliminarTarea);

      contenedorTarea.appendChild(nombreTarea);
      contenedorTarea.appendChild(opcionesDiv);

      listadoTareas.appendChild(contenedorTarea);
    });
  }

  /**
   * Filtra las tareas según el estado seleccionado.
   * @param {Event} e - Evento de cambio en el filtro.
   */
  function filtrarTareas(e) {
    const filtro = e.target.value;

    if (filtro !== "") {
      filtradas = tareas.filter((tarea) => tarea.estado === filtro);
    } else {
      filtradas = [];
    }

    mostrarTareas();
  }

  /**
   * Añade una nueva tarea al proyecto actual enviándola al servidor.
   * @async
   * @param {string} tarea - Nombre de la tarea a agregar.
   */
  async function agregarTarea(tarea) {
    const datos = new FormData();
    datos.append("nombre", tarea);
    datos.append("proyectoId", obtenerProyecto());

    try {
      const url = "http://localhost:3000/api/tarea";
      const respuesta = await fetch(url, {
        method: "POST",
        body: datos,
      });

      const resultado = await respuesta.json();

      mostrarAlerta(
        resultado.mensaje,
        resultado.tipo,
        document.querySelector(".formulario legend")
      );

      if (resultado.tipo === "exito") {
        const modal = document.querySelector(".modal");
        setTimeout(() => modal.remove(), 1000);

        const tareaObj = {
          id: String(resultado.id),
          nombre: tarea,
          estado: "0",
          proyectoId: resultado.proyectoId,
        };

        tareas = [...tareas, tareaObj];
        mostrarTareas();
      }
    } catch (error) {
      console.error("Error al agregar tarea:", error);
    }
  }

  /**
   * Actualiza una tarea existente enviando los datos al servidor.
   * @async
   * @param {Object} tarea - Objeto tarea con propiedades id, nombre, estado, proyectoId.
   */
  async function actualizarTarea(tarea) {
    const { estado, id, nombre } = tarea;

    const datos = new FormData();
    datos.append("id", id);
    datos.append("nombre", nombre);
    datos.append("estado", estado);
    datos.append("proyectoId", obtenerProyecto());

    try {
      const url = "http://localhost:3000/api/tarea/actualizar";

      const respuesta = await fetch(url, {
        method: "POST",
        body: datos,
      });
      const resultado = await respuesta.json();

      if (resultado.respuesta.tipo === "exito") {
        Swal.fire(resultado.respuesta.mensaje, "", "success");

        const modal = document.querySelector(".modal");
        if (modal) modal.remove();

        tareas = tareas.map((tareaMemoria) => {
          if (tareaMemoria.id === id) {
            tareaMemoria.estado = estado;
            tareaMemoria.nombre = nombre;
          }
          return tareaMemoria;
        });

        mostrarTareas();
      }
    } catch (error) {
      console.error("Error al actualizar tarea:", error);
    }
  }

  /**
   * Confirma la eliminación de una tarea mostrando una alerta de confirmación.
   * @param {Object} tarea - Tarea a eliminar.
   */
  function confirmarEliminarTarea(tarea) {
    Swal.fire({
      title: "¿Eliminar Tarea?",
      showCancelButton: true,
      confirmButtonText: "Sí",
      cancelButtonText: "No",
    }).then((result) => {
      if (result.isConfirmed) {
        eliminarTarea(tarea);
      }
    });
  }

  /**
   * Elimina una tarea enviando la solicitud al servidor.
   * @async
   * @param {Object} tarea - Tarea a eliminar.
   */
  async function eliminarTarea(tarea) {
    const { estado, id, nombre } = tarea;

    const datos = new FormData();
    datos.append("id", id);
    datos.append("nombre", nombre);
    datos.append("estado", estado);
    datos.append("proyectoId", obtenerProyecto());

    try {
      const url = "http://localhost:3000/api/tarea/eliminar";
      const respuesta = await fetch(url, {
        method: "POST",
        body: datos,
      });

      const resultado = await respuesta.json();
      if (resultado.resultado) {
        Swal.fire("Eliminada!", resultado.mensaje, "success");

        tareas = tareas.filter((tareaMemoria) => tareaMemoria.id !== tarea.id);
        mostrarTareas();
      }
    } catch (error) {
      console.error("Error al eliminar tarea:", error);
    }
  }

  // ==============================
  // Funciones auxiliares
  // ==============================

  /**
   * Cambia el estado de una tarea entre 'Pendiente' y 'Completa'.
   * @param {Object} tarea - Tarea a cambiar estado.
   */
  function cambiarEstadoTarea(tarea) {
    const nuevoEstado = tarea.estado === "1" ? "0" : "1";
    tarea.estado = nuevoEstado;
    actualizarTarea(tarea);
  }

  /**
   * Muestra el formulario para agregar o editar una tarea.
   * @param {boolean} [editar=false] - Indica si es edición.
   * @param {Object} [tarea={}] - Tarea a editar.
   */
  function mostrarFormulario(editar = false, tarea = {}) {
    console.log(tarea);
    const modal = document.createElement("DIV");
    modal.classList.add("modal");
    modal.innerHTML = `
            <form class="formulario nueva-tarea">
                <legend>${editar ? "Editar Tarea" : "Añade una tarea"}</legend>
                <div class="campo">
                    <label for="tarea">Tarea</label>
                    <input
                        type="text"
                        name="tarea"
                        placeholder="${
                          tarea.nombre
                            ? "Introduzca el nuevo nombre"
                            : "Añadir Tarea al Proyecto"
                        }"
                        id="tarea"
                        value="${tarea.nombre ? tarea.nombre : ""}"
                    />
                </div>
                <div class="opciones">
                    <input 
                      type="submit" 
                      class="submit-nueva-tarea" 
                      value="${
                        tarea.nombre ? "Actualizar Tarea" : "Añadir Tarea"
                      }" 
                    />
                    <button type="button" class="cerrar-modal">Cancelar</button>
                </div>
            </form>
        `;

    setTimeout(() => {
      const formulario = document.querySelector(".formulario");
      formulario.classList.add("animar");
    }, 0);

    modal.addEventListener("click", (e) => {
      e.preventDefault();
      if (e.target.classList.contains("cerrar-modal")) {
        const formulario = document.querySelector(".formulario");
        formulario.classList.add("cerrar");

        setTimeout(() => {
          modal.remove();
        }, 500);
      }
      if (e.target.classList.contains("submit-nueva-tarea")) {
        const nombreTarea = document.querySelector("#tarea").value.trim();

        if (nombreTarea === "") {
          mostrarAlerta(
            "El nombre de la tarea es obligatorio",
            "error",
            document.querySelector(".formulario legend")
          );
          return;
        }

        if (editar) {
          tarea.nombre = nombreTarea;
          actualizarTarea(tarea);
        } else {
          agregarTarea(nombreTarea);
        }
      }
    });

    document.querySelector(".dashboard").appendChild(modal);
  }

  /**
   * Muestra una alerta temporal en la interfaz.
   * @param {string} mensaje - Mensaje a mostrar.
   * @param {string} tipo - Tipo de alerta ('error', 'exito', etc.).
   * @param {HTMLElement} referencia - Elemento donde insertar la alerta.
   */
  function mostrarAlerta(mensaje, tipo, referencia) {
    const alertaPrevia = document.querySelector(".alerta");
    if (alertaPrevia) alertaPrevia.remove();

    const alerta = document.createElement("DIV");
    alerta.classList.add("alerta", tipo);
    alerta.textContent = mensaje;

    referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);

    setTimeout(() => {
      alerta.remove();
    }, 5000);
  }

  /**
   * Obtiene el ID del proyecto actual desde la URL.
   * @returns {string} ID del proyecto.
   */
  function obtenerProyecto() {
    const proyectoParams = new URLSearchParams(window.location.search);
    const proyecto = Object.fromEntries(proyectoParams.entries());
    return proyecto.id;
  }

  /**
   * Limpia el listado de tareas en la interfaz.
   */
  function limpiarTareas() {
    while (listadoTareas.firstChild) {
      listadoTareas.removeChild(listadoTareas.firstChild);
    }
  }

  /**
   * Habilita o deshabilita el filtro de tareas pendientes según existan tareas pendientes.
   */
  function totalPendientes() {
    const totalPendientes = tareas.filter((tarea) => tarea.estado === "0");
    pendientesRadio.disabled = totalPendientes.length === 0;
  }

  /**
   * Habilita o deshabilita el filtro de tareas completadas según existan tareas completadas.
   */
  function totalCompletadas() {
    const totalCompletadas = tareas.filter((tarea) => tarea.estado === "1");
    completadasRadio.disabled = totalCompletadas.length === 0;
  }

  // ==============================
  // Inicialización
  // ==============================
  obtenerTareas();
})();
