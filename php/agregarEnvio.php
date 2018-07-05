<?php
    try
    {
        require_once('connection.php');

        $idTiendaA = $_POST["idTiendaA"];
        $estado = $_POST["estado"];
        $notas = $_POST["notas"];
        $articulos = (isset($_POST["articulos"]) ? $_POST["articulos"] : []);

        $idTiendaDe = $_COOKIE["idtienda"];

        if (!$idTiendaA) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "INSERT Into envios
                (idtiendade, idtiendaa, estado, notas)
                Values
                ($idTiendaDe, $idTiendaA, '$estado', '$notas')";

        $con->query($sql);
        $idEnvio = $con->insert_id;

        if ($idEnvio > 0) {
            $sql = "SELECT prefijo
                    From tiendas
                    Where idtienda = $idTiendaA";

            $result = $con->query($sql);
            $row = $result->fetch_array();
            $prefijoSucursal = $row["prefijo"];

            for ($i = 0; $i < sizeof($articulos); $i++) {
                $item = $articulos[$i];
                $idArticuloMatriz = $item["id"];
                $cantidadEnviada = $item["cantidad"];

                $sql = "SELECT idarticulo
                        From " . $prefijoSucursal . "articulos
                        Where idmatriz = $idArticuloMatriz";
                
                $result = $con->query($sql);
                $row = $result->fetch_array();
                $idArticuloSucursal = $row["idarticulo"];

                $sql = "INSERT Into detalleenvio 
                        (idenvio, idarticulode, idarticuloa, cantidadenviada, cantidadrecibida, estado)
                        Values
                        ($idEnvio, $idArticuloMatriz, $idArticuloSucursal, $cantidadEnviada, 0, 'ACTIVO')";
                $con->query($sql);
            }
        }

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>