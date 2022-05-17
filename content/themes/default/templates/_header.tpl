<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper navcolor fixed">
            <div class="contenedor-nav">
                <a class="brand-logo" href="{$base_url}">
                    <img width="64px" src="{$base_url}/includes/assets/img/logo-b.png">
                </a>

                {if $user->_logged_in}

                <ul class="right hide-on-small-only options-menu">
                    <li><a href="{$base_url}/products/list">Productos<i class="material-icons right">dashboard</i></a></li>

                    <li><a class="dropdown-trigger" href="#!" data-target="drop-purchases">Compras<i class="material-icons right">shopping_cart</i></a></li>

                    <li><a class="dropdown-trigger" href="#!" data-target="drop-sales">Ventas<i class="material-icons right">payment</i></a></li>

                    <li><a class="dropdown-trigger" href="#!" data-target="drop-providers">Proveedores<i class="material-icons right">local_shipping</i></a></li>

                    <li><a href="{$base_url}/clients/list" >Clientes<i class="material-icons right">group</i></a></li>

                    <li><a class="dropdown-trigger" href="#!" data-target="drop-categories">Categorías<i class="material-icons right">layers</i></a></li>

                    <li><a href="{$base_url}/tasa-dolar">Tasa $<i class="material-icons right">account_balance</i></a></li>
                </ul>
                {/if}
                
            </div>
        </div>
    </nav>
</div>

<ul id="drop-purchases" class="dropdown-content">
                      <li><a href="{$base_url}/purchases/list">Listado</a></li>
                      <li><a href="{$base_url}/purchases/new">Crear</a></li>
                    </ul>

                    <ul id="drop-sales" class="dropdown-content">
                      <li><a href="{$base_url}/sales/list">Listado</a></li>
                      <li><a href="{$base_url}/sales/new">Crear</a></li>
                    </ul>

                    <ul id="drop-providers" class="dropdown-content">
                      <li><a href="{$base_url}/providers/list">Listado</a></li>
                      <li><a href="{$base_url}/providers/new">Crear</a></li>
                    </ul>

                    <ul id="drop-categories" class="dropdown-content">
                      <li><a href="{$base_url}/categories/list">Listado</a></li>
                      <li><a href="{$base_url}/categories/new">Crear</a></li>
                    </ul>



{if $user->_logged_in}

<div class="fixed-action-btn">
  <a class="btn-floating btn-large indigo darken-4">
    <i class="large material-icons">account_circle</i>
  </a>
  <ul>
    <li><a href="{$base_url}/signout" class="btn-floating red tooltipped" data-position="left" data-tooltip="Cerrar Sesión"><i class="material-icons">close</i></a></li>
  </ul>
</div>
{/if}