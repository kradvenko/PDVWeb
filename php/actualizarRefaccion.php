<?php
    try
    {
        require_once('connection.php');

        $idRefaccion = $_POST["idRefaccion"];

        $cantidad = $_POST["cantidad"];
        $precio = $_POST["precio"];
        $estado = $_POST["estado"];
        $notas = $_POST["notas"];
        $subtotal = $precio * $cantidad;

        $prefijo = $_COOKIE["prefijo"];
        $idTienda = $_COOKIE["idtienda"];

        if (!$idRefaccion) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $tabla = $prefijo . "servicios_refacciones";

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "UPDATE $tabla
                SET cantidad = $cantidad, precio = $precio, estado = '$estado', notas = '$notas', subtotal = $subtotal
                WHERE idrefaccion = $idRefaccion";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>