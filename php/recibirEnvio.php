<?php
    try
    {
        require_once('connection.php');

        $idEnvio = $_POST["idEnvio"];
        $idTiendaA = $_POST["idTiendaA"];
        $articulos = (isset($_POST["articulos"]) ? $_POST["articulos"] : []);
        $fechaRecibido = $_POST["fechaRecibido"];

        $idTiendaDe = $_COOKIE["idtienda"];
        $prefijoMatriz = $_COOKIE["prefijo"];

        if (!$idEnvio) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);        

        $sql = "SELECT prefijo
                From tiendas
                Where idtienda = $idTiendaA";

        $result = $con->query($sql);
        $row = $result->fetch_array();
        $prefijoSucursal = $row["prefijo"];

        $estado = "RECIBIDO";

        for ($i = 0; $i < sizeof($articulos); $i++) {
            $item = $articulos[$i];

            if ($item["estado"] == "RECIBIDO INCOMPLETO") {
                $estado = $item["estado"];
            }

            $idArticuloMatriz = $item["id"];
            $idArticuloSucursal = $item["ida"];
            $cantidadRecibida = $item["cantidadrecibida"];

            $sql = "UPDATE " . $prefijoMatriz . "articulos
                    SET cantidad = cantidad - $cantidadRecibida
                    WHERE idarticulo = $idArticuloMatriz";
            $con->query($sql);            

            $sql = "UPDATE " . $prefijoSucursal . "articulos
                    SET cantidad = cantidad + $cantidadRecibida
                    WHERE idarticulo = $idArticuloSucursal";
            $con->query($sql);

            $sql = "UPDATE detalleenvio 
                    SET estado = '" . $item["estado"] . "', cantidadrecibida = $cantidadRecibida
                    WHERE iddetalleenvio = " . $item["iddetalleenvio"];
            $con->query($sql);
        }

        $sql = "UPDATE envios SET estado = '$estado', fecharecepcion = '$fechaRecibido' WHERE idenvio = $idEnvio";
        $con->query($sql);
        
        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>