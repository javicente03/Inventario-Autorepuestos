<?php
/* Smarty version 3.1.40, created on 2022-05-16 00:26:07
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_62819a1f930954_62436501',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2284d78ed55d23b05ee1b4de2c8ca610927a553c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\_header.tpl',
      1 => 1652660762,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62819a1f930954_62436501 (Smarty_Internal_Template $_smarty_tpl) {
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
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/products/list">Productos<i class="material-icons right">dashboard</i></a></li>

                    <li><a class="dropdown-trigger" href="#!" data-target="drop-purchases">Compras<i class="material-icons right">shopping_cart</i></a></li>

                    <li><a class="dropdown-trigger" href="#!" data-target="drop-sales">Ventas<i class="material-icons right">payment</i></a></li>

                    <li><a class="dropdown-trigger" href="#!" data-target="drop-providers">Proveedores<i class="material-icons right">local_shipping</i></a></li>

                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/clients/list" >Clientes<i class="material-icons right">group</i></a></li>

                    <li><a class="dropdown-trigger" href="#!" data-target="drop-categories">Categorías<i class="material-icons right">layers</i></a></li>

                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/tasa-dolar">Tasa $<i class="material-icons right">account_balance</i></a></li>
                </ul>
                <?php }?>
                
            </div>
        </div>
    </nav>
</div>

<ul id="drop-purchases" class="dropdown-content">
                      <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/purchases/list">Listado</a></li>
                      <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/purchases/new">Crear</a></li>
                    </ul>

                    <ul id="drop-sales" class="dropdown-content">
                      <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/sales/list">Listado</a></li>
                      <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/sales/new">Crear</a></li>
                    </ul>

                    <ul id="drop-providers" class="dropdown-content">
                      <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/providers/list">Listado</a></li>
                      <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/providers/new">Crear</a></li>
                    </ul>

                    <ul id="drop-categories" class="dropdown-content">
                      <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/categories/list">Listado</a></li>
                      <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/categories/new">Crear</a></li>
                    </ul>




<div class="fixed-action-btn">
  <a class="btn-floating btn-large red">
    <i class="large material-icons">account_circle</i>
  </a>
  <ul>
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/signout" class="btn-floating red tooltipped" data-position="left" data-tooltip="Cerrar Sesión"><i class="material-icons">close</i></a></li>
  </ul>
</div>
      <?php }
}
