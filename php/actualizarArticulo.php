<?php
    try
    {
        require_once('connection.php');

        $idArticulo = $_POST["idArticulo"];
        $idCategoria = $_POST["idCategoria"];
        $codigo = $_POST["codigo"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $modelo = $_POST["modelo"];
        $idMarca = $_POST["idMarca"];
        $color = $_POST["color"];
        $cantidad = $_POST["cantidad"];
        $minimo = $_POST["minimo"];
        $costoPublico = $_POST["costoPublico"];
        $costoReal = $_POST["costoReal"];
        $costoDistribuidor = $_POST["costoDistribuidor"];
        $estado = $_POST["estado"];
        $precioDistribuidor = $_POST["precioDistribuidor"];
        $preciosMayoreo = (isset($_POST["preciosMayoreo"]) ? $_POST["preciosMayoreo"] : []);
        $idLote = $_POST["idLote"];
        $aprobado = $_POST["aprobado"];
        $notas = $_POST["notas"];

        $prefijo = $_COOKIE["prefijo"];
        $tipoTienda = $_COOKIE["tipotienda"];
        $idTienda = $_COOKIE["idtienda"];

        if (!$prefijo) {
            return;
        }

        if (!$idCategoria) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $data = array();
        $sql = "";
        $con = new mysqli($hn, $un, $pw, $db);

        if ($tipoTienda == "MATRIZ") {
            $sql = "Select *
                    From tiendas
                    Where tipo = 'SUCURSAL' And idmatriz = $idTienda";
            
            $result = $con->query($sql);

            while ($row = $result->fetch_array()) {
                $item = array("id" => $row["idtienda"] , "prefijo" => $row["prefijo"]);
                array_push($data, $item);
            }

            $sql = "UPDATE " . $prefijo . "articulos
                    Set idcategoria = $idCategoria, codigo = '$codigo', nombre = '$nombre', descripcion = '$descripcion', modelo = '$modelo',
                    idmarca = $idMarca, color = '$color', cantidad = $cantidad, minimo = $minimo, costopublico = $costoPublico, costoreal = $costoReal, costodistribuidor = $costoDistribuidor, estado = '$estado', preciodistribuidor = $precioDistribuidor,
                    idlote = $idLote, aprobado = '$aprobado', notas = '$notas'
                    Where idarticulo = $idArticulo";
            
            $con->query($sql);

            for ($i = 0; $i < sizeof($data); $i++) {
                $item = $data[$i];
                $sql = "UPDATE " . $item["prefijo"] . "articulos
                Set idcategoria = $idCategoria, codigo = '$codigo', nombre = '$nombre', descripcion = '$descripcion', modelo = '$modelo',
                idmarca = $idMarca, color = '$color', cantidad = $cantidad, minimo = $minimo, costopublico = $costoPublico, costoreal = $costoReal, costodistribuidor = $costoDistribuidor, estado = '$estado', preciodistribuidor = $precioDistribuidor,
                idlote = $idLote, aprobado = '$aprobado', notas = '$notas'
                Where idmatriz = $idArticulo";

                $con->query($sql);
            }

            $sql = "DELETE From " . $prefijo . "preciosmayoreo Where idarticulo = " . $idArticulo;
            $con->query($sql);

            for ($i = 0; $i < sizeof($preciosMayoreo); $i++) {
                $item = $preciosMayoreo[$i];
                $sql = "INSERT INTO " . $prefijo . "preciosmayoreo
                    (idarticulo, precio, de, a)
                    VALUES
                    ($idArticulo, " . $item["Costo"] .", " . $item["De"] . ", " . $item["A"] .  ")";

                $con->query($sql);
            }            
        } else {
            $sql = "UPDATE " . $prefijo . "articulos
                    Set idcategoria = $idCategoria, codigo = '$codigo', nombre = '$nombre', descripcion = '$descripcion', modelo = '$modelo',
                    idmarca = $idMarca, color = '$color', cantidad = $cantidad, minimo = $minimo, costopublico = $costoPublico, costoreal = $costoReal, costodistribuidor = $costoDistribuidor, estado = '$estado', preciodistribuidor = $precioDistribuidor,
                    idlote = $idLote, aprobado = '$aprobado', notas = '$notas'
                    Where idarticulo = $idArticulo";
            
            $con->query($sql);
        }        

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>