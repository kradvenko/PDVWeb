<?php
    try
    {
        require_once('connection.php');

        $idArticulo = $_POST["idArticulo"];
        $idTiendaA = $_POST["idTiendaA"];
        $cantidad = $_POST["cantidad"];

        $prefijo = $_COOKIE["prefijo"];
        $tipoTienda = $_COOKIE["tipotienda"];
        $idTienda = $_COOKIE["idtienda"];

        $tiendas = array();

        if (!$idArticulo) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);
        $cantidadEnviada = 0;
        $mensaje;

        $sql = "Select *
                From tiendas
                Where tipo = 'SUCURSAL' And idmatriz = $idTienda And idtienda = $idTiendaA";
        
        $result = $con->query($sql);

        while ($row = $result->fetch_array()) {
            $item = array("id" => $row["idtienda"] , "prefijo" => $row["prefijo"]);
            array_push($tiendas, $item);
        }

        for ($i = 0; $i < sizeof($tiendas); $i++) {
            $item = $tiendas[$i];
            $prefijoSucursal = $item["prefijo"];
            $sql = "SELECT *
                    From " . $prefijoSucursal . "articulos
                    Where idmatriz = $idArticulo";
                    
            $result = $con->query($sql);

            if ($result->num_rows == 0) {
                $mensaje = "El artículo no existe en la sucursal.";
                echo $mensaje;
                return;
            }
        }

        $sql = "SELECT SUM(cantidadenviada) As Suma
                From detalleenvio
                Where idarticulode = $idArticulo And estado = 'ACTIVO'";
        $con->query($sql);
        $result = $con->query($sql);
        $row = $result->fetch_array();+
        $cantidadEnEnvios = $row["Suma"];
        $mensajeEnEnvios = "";

        if ($cantidadEnEnvios != null) {
            if ($cantidadEnEnvios > 0) {
                $mensajeEnEnvios = " Existen artículos en envíos.";
            }
        } else {
            $cantidadEnEnvios = 0;
        }

        $sql = "SELECT cantidad
                From mat_articulos
                Where idarticulo = $idArticulo";
        $con->query($sql);
        $result = $con->query($sql);
        $row = $result->fetch_array();
        $cantidadActual = $row["cantidad"];

        if ($cantidad <= ($cantidadActual - $cantidadEnEnvios)) {
            $mensaje = "OK";
        } else {
            $mensaje = "No existe cantidad suficiente para enviar." . $mensajeEnEnvios . " La cantidad máxima es " . ($cantidadActual - $cantidadEnEnvios);
        }
        echo $mensaje;
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo "Error: " . $t;
    }
?>