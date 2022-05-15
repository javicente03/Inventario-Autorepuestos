<?php
/* Smarty version 3.1.40, created on 2022-05-14 18:56:35
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_627ffb633acdf8_34455325',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2284d78ed55d23b05ee1b4de2c8ca610927a553c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\_header.tpl',
      1 => 1652554587,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_627ffb633acdf8_34455325 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper navcolor fixed">
            <div class="contenedor-nav">
                <a class="brand-logo" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
">
                    <img width="64px" src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/img/logo-b.png">
                </a>

                <?php if ($_smarty_tpl->tpl_vars['user']->value->_logged_in) {?>
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
                        <span data-lang="contact-button" class="hide-on-med-and-down"><?php echo $_smarty_tpl->tpl_vars['user']->value->_data['user_name'];?>
</span></a></li>
                    
                </ul>

                <ul class="right hide-on-med-and-up">
                    <a href="#" data-target="sidenav" class="sidenav-trigger"><i class="material-icons">menu</i></a>    
                </ul>
                <?php }?>
                
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
</ul><?php }
}
