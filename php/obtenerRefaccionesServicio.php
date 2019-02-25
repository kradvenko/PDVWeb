<?php
    try
    {
        require_once('connection.php');

        $idServicio = $_POST["idServicio"];

        $prefijo = $_COOKIE["prefijo"];
        $idTienda = $_COOKIE["idtienda"];

        if (!$idServicio) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $tabla = $prefijo . "servicios_refacciones";
        $tablaArticulos = $prefijo . "articulos";

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "SELECT $tabla.*, $tablaArticulos.nombre AS Refaccion
                FROM $tabla
                INNER JOIN $tablaArticulos
                ON $tabla.idrefaccion = $tablaArticulos.idarticulo
                WHERE $tabla.idservicio = $idServicio";

        $result = $con->query($sql);

        $type = "Odd";
        
        while ($row = $result->fetch_array()) {
            echo "<div class='col-12 divBitacoraEntrada". $type . "'>";
            echo $row["Refaccion"];
            echo "</div>";
            echo "<div class='col-2'>";
            echo "Cantidad";
            echo "</div>";
            echo "<div class='col-3'>";
            echo "<input id='tbRefaccionCantidad_" . $row["idrefaccion"] . "' type='text' class='form-control' value='" . $row["cantidad"] . "' />";
            echo "</div>";
            echo "<div class='col-2'>";
            echo "Precio";
            echo "</div>";
            echo "<div class='col-5'>";
            echo "<input id='tbRefaccionPrecio_" . $row["idrefaccion"] . "' type='text' class='form-control' value='" . $row["precio"] . "' />";
            echo "</div>";
            echo "<div class='col-2'>";
            echo "Estado";
            echo "</div>";
            echo "<div class='col-10'>";
            echo "<select id='selRefaccionEstado_" . $row["idrefaccion"] . "' class='form-control'>";
            switch ($row["estado"]){
                case "INGRESADO":
                        echo "<option value='INGRESADO' selected='selected'>Ingresado</option>";
                        echo "<option value='EN ESPERA AUTORIZACION'>En espera de autorización del cliente</option>";
                        echo "<option value='INSTALADO'>Instalado</option>";
                        echo "<option value='CANCELADO'>Cancelado</option>";
                        break;
                case "EN ESPERA AUTORIZACION":
                        echo "<option value='INGRESADO'>Ingresado</option>";
                        echo "<option value='EN ESPERA AUTORIZACION' selected='selected'>En espera de autorización (técnico)</option>";
                        echo "<option value='INSTALADO'>Instalado</option>";
                        echo "<option value='CANCELADO'>Cancelado</option>";
                        break;
                case "INSTALADO":
                        echo "<option value='INGRESADO'>Ingresado</option>";
                        echo "<option value='EN ESPERA AUTORIZACION'>En espera de autorización (técnico)</option>";
                        echo "<option value='INSTALADO' selected='selected'>Instalado</option>";
                        echo "<option value='CANCELADO'>Cancelado</option>";
                        break;
                case "CANCELADO":
                        echo "<option value='INGRESADO'>Ingresado</option>";
                        echo "<option value='EN ESPERA AUTORIZACION'>En espera de autorización (técnico)</option>";
                        echo "<option value='INSTALADO'>Instalado</option>";
                        echo "<option value='CANCELADO' selected='selected'>Cancelado</option>";
                        break;
            }            
            echo "</select>";
            echo "</div>";
            echo "<div class='col-2'>";
            echo "Notas";
            echo "</div>";
            echo "<div class='col-10'>";
            echo "<input id='tbRefaccionNotas_" . $row["idrefaccion"] . "' type='text' class='form-control' value='" . $row["notas"] . "' />";
            echo "</div>";
            echo "<div class='col-5'>";
            echo "<button type='button' class='btn btn-outline-success' onclick='actualizarRefaccion(" . $row["idrefaccion"] . ")'>
                    Guardar
                </button>";
            echo "</div>";
            
            if ($type == "Odd") {
                $type = "Even";
            } else if ($type == "Even") {
                $type = "Odd";
            }
        }

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>