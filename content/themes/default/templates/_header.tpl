<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper navcolor fixed">
            <div class="contenedor-nav">
                <a class="brand-logo" href="{$base_url}">
                    <img width="64px" src="{$base_url}/includes/assets/img/logo-b.png">
                </a>

                {if $user->_logged_in}
                <ul class="right hide-on-small-only options-menu">
                    <li><a href="#about">
                        <i class="material-icons left">person</i>
                        <span data-lang="about-button" class="hide-on-med-and-down">Productos</span></a></li>
                    <li><a href="#services">
                        <i class="material-icons left">widgets</i>
                        <span data-lang="services-button" class="hide-on-med-and-down">Clientes</span></a></li>
                    <li><a href="#technologies">
                        <i class="material-icons left">code</i>
                        <span data-lang="technologies-button" class="hide-on-med-and-down">Proveedores</span></a></li>
                    <li><a href="#works">
                        <i class="material-icons left">work</i>
                        <span data-lang="works-button" class="hide-on-med-and-down">Compras</span></a></li>
                    <li><a href="#education">
                        <i class="material-icons left">school</i>
                        <span data-lang="education-button" class="hide-on-med-and-down">Ventas</span></a></li>
                    <li><a href="#contact">
                        <i class="material-icons left">contact_mail</i>
                        <span data-lang="contact-button" class="hide-on-med-and-down">{$user->_data['user_name']}</span></a></li>
                    
                </ul>

                <ul class="right hide-on-med-and-up">
                    <a href="#" data-target="sidenav" class="sidenav-trigger"><i class="material-icons">menu</i></a>    
                </ul>
                {/if}
                
            </div>
        </div>
    </nav>
</div>

<ul id="sidenav" class="sidenav">
    <li>
        <a data-lang="welcome">Bienvenido a mi portafolio</a>
    </li>
    <li class="divider"></li>
    <li><a href="#about">
        <i class="material-icons left">person</i>
                        <span data-lang="about-button">Sobre mí</span></a></li>
    <li><a href="#services">
        <i class="material-icons left">widgets</i>
                        <span data-lang="services-button">Servicios</span></a></li>
    <li><a href="#technologies">
        <i class="material-icons left">code</i>
        <span data-lang="technologies-button">Tecnologías</span></a></li>
    <li><a href="#works">
        <i class="material-icons left">work</i>
        <span data-lang="works-button">Trabajos</span></a></li>
    <li><a href="#education">
        <i class="material-icons left">school</i>
        <span data-lang="education-button">Educación</span></a></li>

    <li><a href="#contact">
        <i class="material-icons left">contact_mail</i>
        <span data-lang="contact-button">Contáctame</span></a></li>
</ul>