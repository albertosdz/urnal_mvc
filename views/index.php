<div class="landing">

    <header class="header" id="header">
        <nav class="header__nav">

            <a href="#header" class="logo">
                <img src="build/img/logo.png" alt="logo">
                <h2>rnal</h2>
            </a>

            <div class="secciones">
                <a href="#planes">Planes</a>
                <a href="#nosotros">Nosotros</a>
                <a href="#faq">FAQ</a>
            </div>

            <div class="botones">
                <a href="/login" class="boton-secundario">Iniciar sesión</a>
                <a href="/crear" class="boton-principal">Regístrate</a>
            </div>
        </nav>

        <div class="menu-toggle">
            <a href="#header" class="logo-mobile">
                <img src="build/img/logo.png" alt="logo" >
            </a>
            <button class="boton-menu" aria-label="Abrir menú">&#9776;</button>
        </div>

        <div class="hero-component">
            <h1>Urnal organiza tu día, optimiza tu vida.</h1>
            <p>Gestión de proyectos y tareas de manera simple e inteligente.</p>
            <a href="/crear" class="boton-principal">Regístrate</a>
        </div>
    </header>

    <nav class="menu-movil">
        <a href="#planes" class="menu-link"><h3>Planes</h3></a>
        <a href="#nosotros" class="menu-link"><h3>Nosotros</h3></a>
        <a href="#faq" class="menu-link"><h3>FAQ</h3></a>
        <a href="/login" class="menu-link boton-secundario">Iniciar sesión</a>
        <a href="/crear" class="menu-link boton-principal">Regístrate</a>
    </nav>

    <nav class="sticky-nav">
        <div class="contenedor-nav">
            <a href="#header" class="logo">
                <img src="build/img/logo.png" alt="logo">
                <h2>rnal</h2>
            </a>

            <div class="secciones">
                <a href="#planes">Planes</a>
                <a href="#nosotros">Nosotros</a>
                <a href="#faq">FAQ</a>
            </div>

            <div class="botones">
                <a href="/login" class="boton-secundario">Iniciar sesión</a>
                <a href="/crear" class="boton-principal">Regístrate</a>
            </div>

        </div>
    </nav>

    <div class="landing-contenido">

        <section class="beneficios">
            <h2 class="beneficios__titulo">Organiza tus proyectos con claridad</h2>
            <p class="beneficios__descripcion">
                Urnal es una herramienta sencilla y práctica para gestionar tus proyectos. Crea tareas, marca tu progreso y mantén el foco sin complicaciones.
            </p>

            <div class="beneficios__carrusel">

                <div class="carrusel__slide activo" id="beneficio1">
                    <div class="carrusel__contenido">
                        <h3>Crea proyectos a tu medida</h3>
                        <p>
                            Define proyectos y agrupa tus tareas según tus objetivos. Ya sea un trabajo personal, académico o profesional, Urnal se adapta a tu forma de trabajar.
                        </p>
                    </div>
                </div>

                <div class="carrusel__slide" id="beneficio2">
                    <div class="carrusel__contenido">
                        <h3>Gestiona tareas fácilmente</h3>
                        <p>
                            Añade tareas con solo unos clics, organízalas dentro de tus proyectos y márcalas como completadas para ver tu progreso en tiempo real.
                        </p>
                    </div>
                </div>

                <div class="carrusel__slide" id="beneficio3">
                    <div class="carrusel__contenido">
                        <h3>Visualiza tu avance</h3>
                        <p>
                            A medida que completas tareas, verás cómo tus proyectos avanzan. Urnal te ayuda a mantenerte motivado viendo lo que ya lograste.
                        </p>
                    </div>
                </div>



            </div>

            <div class="beneficios__navegacion">
                <button id="prevSlide" aria-label="Anterior">&#10094;</button>
                <button id="nextSlide" aria-label="Siguiente">&#10095;</button>
            </div>
        </section>

        <section id="features" class="features">
            <h2 class="features__title " key="features_title">
                Las herramientas clave para avanzar en tus proyectos
            </h2>
            <div class="features__items">
                <div class="features__item">
                    <h3>Gestor de proyectos</h3>
                    <img src="build/img/proyects.svg" alt="" />
                </div>
                <div class="features__item">
                    <h3>Planificación de tareas</h3>
                    <img src="build/img/tasks.svg" alt="" />
                </div>
                <div class="features__item">
                    <h3>Seguimiento de hábitos</h3>
                    <img src="build/img/habits.svg" alt="" />
                </div>
                <div class="features__item">
                    <h3>Organización semanal visual</h3>
                    <img src="build/img/brain.svg" alt="" />
                </div>

            </div>
        </section>

        <section class="planes" id="planes">
            <div class="planes__titulo">
                <h1 class="planes__titulo-texto">Urnal a tu manera</h1>
                <p class="planes__titulo-descripcion">
                    Elige el mejor plan que se adapte a tus necesidades
                </p>
            </div>
            <div class="seccion__planes">
                <div class="planes__plan planes__plan--gratuito">
                    <h2 class="planes__plan-titulo">🆓 Gratuito</h2>

                    <div class="planes__plan-precio">
                        <p><span class="planes__plan-precio-cantidad">0</span>€ / mes</p>
                    </div>
                    <p class="planes__plan-descripcion">
                        Ideal para quienes buscan una solución sencilla para gestionar sus
                        tareas diarias sin compromisos.
                    </p>

                    <hr class="planes__plan-separador" />
                    <h3 class="planes__plan-subtitulo">Incluido en el plan</h3>
                    <ul class="planes__plan-lista">
                        <li class="planes__plan-item">✅ Tareas ilimitadas</li>
                        <li class="planes__plan-item">✅ Notificaciones básicas</li>
                        <li class="planes__plan-item">
                            ✅ Sincronización en un solo dispositivo
                        </li>
                        <li class="planes__plan-item">❌ Sin automatización avanzada</li>
                        <li class="planes__plan-item">❌ Sin soporte prioritario</li>
                    </ul>
                </div>

                <div class="planes__plan planes__plan--pro">
                    <h2 class="planes__plan-titulo">💼 Pro</h2>

                    <div class="planes__plan-precio">
                        <p><span class="planes__plan-precio-cantidad">9.99</span>€ / mes</p>
                    </div>
                    <p class="planes__plan-descripcion">
                        Perfecto para profesionales y estudiantes que necesitan más control,
                        automatización y organización en su día a día.
                    </p>

                    <hr class="planes__plan-separador" />
                    <h3 class="planes__plan-subtitulo">Incluido en el plan</h3>
                    <ul class="planes__plan-lista">
                        <li class="planes__plan-item">✅ Todo en el Plan Gratuito</li>
                        <li class="planes__plan-item">
                            ✅ Automatización inteligente para optimizar tareas
                        </li>
                        <li class="planes__plan-item">
                            ✅ Integración con calendarios y apps externas
                        </li>
                        <li class="planes__plan-item">
                            ✅ Sincronización en múltiples dispositivos
                        </li>
                        <li class="planes__plan-item">
                            ✅ Soporte prioritario para resolver dudas más rápido
                        </li>
                    </ul>
                </div>

                <div class="planes__plan planes__plan--empresarial">
                    <h2 class="planes__plan-titulo">🏢 Empresarial</h2>

                    <div class="planes__plan-precio">
                        <span class="planes__plan-precio-cantidad">29.99</span>€ / mes
                    </div>
                    <p class="planes__plan-descripcion">
                        Diseñado para equipos y empresas que buscan mejorar la colaboración,
                        gestión de proyectos y control de tareas compartidas.
                    </p>

                    <hr class="planes__plan-separador" />
                    <h3 class="planes__plan-subtitulo">Incluido en el plan</h3>
                    <ul class="planes__plan-lista">
                        <li class="planes__plan-item">✅ Todo en el Plan Pro</li>
                        <li class="planes__plan-item">
                            ✅ Colaboración en equipo con asignación de tareas
                        </li>
                        <li class="planes__plan-item">
                            ✅ Gestión de roles y permisos para mayor control
                        </li>
                        <li class="planes__plan-item">
                            ✅ Soporte VIP 24/7 con respuesta prioritaria
                        </li>
                    </ul>
                </div>
            </div>

        </section>

        <section class="nosotros" id="nosotros">
            <h2 class="nosotros__subtitulo">
                Qué es <span class="nosotros__subtitulo--azul">Urnal</span>
            </h2>
            <p class="nosotros__descripcion">
                Urnal es una aplicación innovadora para gestionar proyectos, tareas
                y hábitos de forma intuitiva y eficiente. Su diseño minimalista y su
                sistema de automatización inteligente facilitan la planificación y
                el seguimiento de actividades, adaptándose al horario personal y
                reduciendo la carga de trabajo manual para mejorar la productividad.
            </p>
        </section>

        <section class="nosotros__seccion fondoClaro">
            <h2 class="nosotros__subtitulo">
                El equipo detrás de
                <span class="nosotros__subtitulo--azul">Urnal</span>
            </h2>
            <p class="nosotros__descripcion">
                Urnal ha sido desarrollado por un equipo apasionado por la
                tecnología (yo) y la productividad, con el objetivo de ofrecer una
                herramienta eficiente y accesible. Combinamos experiencia en
                desarrollo, diseño UX y metodologías de productividad para crear una
                aplicación que realmente haga la diferencia.
            </p>
        </section>

        <section class="nosotros__seccion">
            <h2 class="nosotros__subtitulo">
                Filosofía de <span class="nosotros__subtitulo--azul">Urnal</span>
            </h2>
            <p class="nosotros__descripcion">
                En Urnal creemos que organizarse debe ser un proceso natural y
                flexible. Por eso, nuestra aplicación se basa en cuatro principios
                clave:
            </p>

            <ul class="nosotros__lista">
                <li class="nosotros__lista-item">
                    <span class="nosotros__lista-item--negrita">Simplicidad:</span>
                    Diseño limpio y funcional sin distracciones.
                </li>
                <li class="nosotros__lista-item">
                    <span class="nosotros__lista-item--negrita">Automatización:</span>
                    Herramientas inteligentes que reducen el esfuerzo manual.
                </li>
                <li class="nosotros__lista-item">
                    <span class="nosotros__lista-item--negrita">Adaptabilidad:</span>
                    Integración con horarios y rutinas personales.
                </li>
                <li class="nosotros__lista-item">
                    <span class="nosotros__lista-item--negrita">Productividad sin esfuerzo:</span>
                    Optimización del tiempo con una gestión fluida en segundo plano.
                </li>
            </ul>
        </section>

        <section class="nosotros__seccion fondoOscuro">
            <h2 class="nosotros__subtitulo">Características Principales</h2>
            <p class="nosotros__descripcion">
                Urnal cuenta con funciones diseñadas para optimizar la gestión del
                tiempo y la productividad:
            </p>
            <ul class="nosotros__lista">
                <li class="nosotros__lista-item">
                    <span class="nosotros__lista-item--negrita">Gestor de proyectos:</span>
                    Organización estructurada y sencilla.
                </li>
                <li class="nosotros__lista-item">
                    <span class="nosotros__lista-item--negrita">Planificación de tareas:</span>
                    Creación, edición y priorización eficiente.
                </li>
                <li class="nosotros__lista-item">
                    <span class="nosotros__lista-item--negrita">Seguimiento de hábitos:</span>
                    Desarrollo de rutinas productivas.
                </li>
                <li class="nosotros__lista-item">
                    <span class="nosotros__lista-item--negrita">Automatización inteligente:</span>
                    Ajuste dinámico de tareas según el horario.
                </li>
                <li class="nosotros__lista-item">
                    <span class="nosotros__lista-item--negrita">Interfaz intuitiva:</span>
                    Diseño minimalista para una experiencia fluida.
                </li>
            </ul>
        </section>
        </section>

        <section class="faq" id="faq">
            <div class="faq__header">
                <h2 class="faq__title">¿Tienes dudas? Estamos aquí para ayudarte</h2>
                <p class="faq__description">
                    Explora nuestras preguntas frecuentes y encuentra respuestas rápidas
                    sobre Urnal.
                </p>
                <!-- Filtro por categorías -->
                <div class="faq__filters">
                    <button
                        class="boton-principal"
                        onclick="filterFAQ('Cuenta y Configuración')">
                        Cuenta y Configuración
                    </button>
                    <button
                        class="boton-principal"
                        onclick="filterFAQ('Planes y Facturación')">
                        Planes y Facturación
                    </button>
                    <button
                        class="boton-principal"
                        onclick="filterFAQ('Uso de la Aplicación')">
                        Uso de la Aplicación
                    </button>
                    <button class="boton-principal" onclick="filterFAQ('')">
                        Mostrar todo
                    </button>
                </div>
            </div>

            <div class="faq__categories">
                <div class="faq__category">
                    <h2 class="faq__category-title">Cuenta y Configuración</h2>

                    <div class="faq__item">
                        <h3 class="faq__question">¿Necesito una cuenta para usar Urnal?</h3>
                        <p class="faq__answer">
                            Sí, necesitas registrarte con tu correo electrónico para empezar a crear y gestionar tus proyectos y tareas en Urnal.
                        </p>
                    </div>

                    <div class="faq__item">
                        <h3 class="faq__question">¿Puedo cambiar mi contraseña?</h3>
                        <p class="faq__answer">
                            Puedes actualizar tu contraseña desde la configuración de tu perfil en cualquier momento.
                        </p>
                    </div>

                    <div class="faq__item">
                        <h3 class="faq__question">¿Cómo elimino mi cuenta?</h3>
                        <p class="faq__answer">
                            Para la eliminación de la cuenta es necesario ponerse en contacto con administración.
                        </p>
                    </div>
                </div>

                <div class="faq__category">
                    <h2 class="faq__category-title">Planes y Facturación</h2>

                    <div class="faq__item">
                        <h3 class="faq__question">¿Urnal es gratuito?</h3>
                        <p class="faq__answer">
                            Urnal ofrece un plan gratuito con funciones esenciales. También puedes optar por planes de pago con características avanzadas.
                        </p>
                    </div>

                    <div class="faq__item">
                        <h3 class="faq__question">¿Qué incluye el plan gratuito?</h3>
                        <p class="faq__answer">
                            El plan gratuito permite crear proyectos ilimitados, gestionar tareas y visualizar tu progreso sin coste alguno.
                        </p>
                    </div>

                    <div class="faq__item">
                        <h3 class="faq__question">¿Cómo cambio mi plan?</h3>
                        <p class="faq__answer">
                            Puedes actualizar o cambiar tu plan desde tu perfil, en la sección de suscripción.
                        </p>
                    </div>
                </div>

                <div class="faq__category">
                    <h2 class="faq__category-title">Uso de la Aplicación</h2>

                    <div class="faq__item">
                        <h3 class="faq__question">¿Cómo creo un proyecto?</h3>
                        <p class="faq__answer">
                            Una vez que accedes a tu cuenta, puedes crear un nuevo proyecto desde el panel principal con solo unos clics.
                        </p>
                    </div>

                    <div class="faq__item">
                        <h3 class="faq__question">¿Puedo agregar subtareas o etiquetas?</h3>
                        <p class="faq__answer">
                            Actualmente puedes crear tareas simples agrupadas por proyecto. Subtareas y etiquetas estarán disponibles en próximas versiones.
                        </p>
                    </div>

                    <div class="faq__item">
                        <h3 class="faq__question">¿Cómo marco una tarea como completada?</h3>
                        <p class="faq__answer">
                            Dentro de cada proyecto, puedes marcar las tareas completadas haciendo clic en el icono correspondiente junto al nombre de la tarea.
                        </p>
                    </div>

                    <div class="faq__item">
                        <h3 class="faq__question">¿Puedo ver el avance de mis proyectos?</h3>
                        <p class="faq__answer">
                            Se esta trabajando para en que próximas actualizaciones se incluyan este tipo de características.
                        </p>
                    </div>
                </div>
            </div>
        </section>


    </div>

    <footer class="footer">
        <p class="footer__title">
            Urnal by <a href="https://github.com/albertosdz">albertosdz</a>
        </p>
        <div class="footer__redes">
            <a href="https://www.instagram.com/"><img src="build/img/instagram.svg" alt="instagram" /></a>
            <a href="https://www.youtube.com/"><img src="build/img/youtube.svg" alt="youtube" /></a>
            <a href="https://x.com"><img src="build/img/x.svg" alt="x" /></a>
            <a href="https://es.linkedin.com/"><img src="build/img/linkedin.svg" alt="linkedin" /></a>
        </div>
        <a href="registro.html" class="boton-secundario">Regístrate gratis</a>
    </footer>

</div>

<?php
$script = '
    <script src="build/js/landing.js"></script>
';
?>