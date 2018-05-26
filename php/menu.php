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
                        <a class="nav-link mainMenuElement" href="localidades.php">Control de localidades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mainMenuElement" href="instituciones.php">Control de instituciones</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mainMenuElement" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Fichas de bienes
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item mainMenuElement" href="ficha_foto.php">Fotografías</a>                        
                        </div>
                    </li>
                    </ul>
                </div>
            </nav>';
        return $menu;
    }
?>