<?php
    
    function menu() {
        $menu = '<div class="row divMargin">
                    <div class="col-6">
                        
                    </div>
                    <div class="col-4">
                        Usuario actual :  ' . $_COOKIE["nombre"] . ' 
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-primary btn-danger" onclick="cerrarSesion()">Cerrar sesión</button> 
                    </div>
                </div>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Navegación</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link mainMenuElement" href="menu.php">Menú principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mainMenuElement" href="nuevaventa.php">Nueva venta</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mainMenuElement" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Servicios
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">                        
                            <a class="dropdown-item mainMenuElement" href="nuevoservicio.php">Nuevo servicio</a>
                            <a class="dropdown-item mainMenuElement" href="verservicios.php">Ver servicio</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mainMenuElement" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Inventarios
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item mainMenuElement" href="nuevoarticulo.php">Agregar artículo</a>
                            <!--<a class="dropdown-item mainMenuElement" href="lotes.php">Control lotes</a>-->
                            <a class="dropdown-item mainMenuElement" href="lotearticulos.php">Lotes y artículos</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mainMenuElement" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Envios
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item mainMenuElement" href="enviosarticulos.php">Crear envío</a>
                            <a class="dropdown-item mainMenuElement" href="recibirenvio.php">Recibir envío</a>
                        </div>
                    </li>                    
                    </ul>
                </div>
            </nav>';
        return $menu;
    }
?>