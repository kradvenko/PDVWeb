<?php
    try
    {
        require_once('connection.php');

        $idServicio = $_POST["idServicio"];
        $idRefaccion = $_POST["idRefaccion"];
        $precio = $_POST["precio"];

        $prefijo = $_COOKIE["prefijo"];
        $idTienda = $_COOKIE["idtienda"];

        if (!$idRefaccion) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $tabla = $prefijo . "servicios_refacciones";

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "INSERT INTO $tabla (idservicio, idrefaccion, cantidad, precio, subtotal, estado, notas)
                Values ($idServicio, $idRefaccion, 1, $precio, $precio, 'INGRESADO', '')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>