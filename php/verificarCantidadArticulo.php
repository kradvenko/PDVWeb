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

        $sql = "Select *
                From tiendas
                Where tipo = 'SUCURSAL' And idmatriz = $idTienda";
        
        $result = $con->query($sql);

        while ($row = $result->fetch_array()) {
            $item = array("id" => $row["idtienda"] , "prefijo" => $row["prefijo"]);
            array_push($tiendas, $item);
        }

        for ($i = 0; $i < sizeof($tiendas); $i++) {
            $item = $tiendas[$i];                       
        }

        $sql = "SELECT SUM(cantidadenviada) As Suma
                From envios
                Where idarticulode = $idArticulo";
        $con->query($sql);
        $row = $result->fetch_array();
        $cantidadEnviada = $row["Suma"];

        if ($cantidadEnviada <= $cantidad && $cantidadEnviada != null) {
            echo "OK";
        } else {
            echo "No existe cantidad suficiente para enviar. Existen envíos que contienen este artículo.";
        }

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo "Error: " . $t;
    }
?>