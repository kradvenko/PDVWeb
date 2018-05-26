<?php
    try
    {
        require_once('connection.php');
        
        $idInstitucion = $_POST["idInstitucion"];
        $nombreInstitucion = $_POST["nombreInstitucion"];
        $sectorInstitucion = $_POST["sectorInstitucion"];
        $tipoInstitucion = $_POST["tipoInstitucion"];
        $domicilio = $_POST["domicilio"];
        $colonia = $_POST["colonia"];
        $codigoPostal = $_POST["codigoPostal"];
        $idpais = $_POST["idPais"];
        $idregion = $_POST["idRegion"];
        $idciudad = $_POST["idCiudad"];
        $categorias = $_POST["categorias"];
        
        if (!$idInstitucion) {
            echo "Error. Faltan variables.";
            exit(1);
        }
        
        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Update instituciones SET " . 
        "nombreInstitucion = '$nombreInstitucion', sectorInstitucion = '$sectorInstitucion', tipoInstitucion = '$tipoInstitucion', " .
        "domicilio = '$domicilio', colonia = '$colonia', codigoPostal = '$codigoPostal', idpais = $idpais, idregion = $idregion, idciudad = $idciudad " .
        "Where idInstitucion = $idInstitucion ";

        $con->query($sql);

        $sql = "Delete From institucioncategorias Where idInstitucion = $idInstitucion";

        $con->query($sql);

        for ($i = 0; $i < sizeof($categorias); $i++) {
            $sql = "Insert Into institucioncategorias (idinstitucion, idcategoria, categoria) " .
            "Values ('$idInstitucion', " . $categorias[$i]["id"] . ", '" . $categorias[$i]["categoria"] . "')";

            $con->query($sql);
        }

        //echo $idInstitucion;
        echo "Se ha actualizado la institución.";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>