<?php
    try
    {
        require_once('connection.php');

        $nombre = $_POST["nombre"];
        $direccion = $_POST["direccion"];
        $colonia = $_POST["colonia"];
        $telefono1 = $_POST["telefono1"];
        $telefono2 = $_POST["telefono2"];
        $correo = $_POST["correo"];
        $tienda = $_POST["tienda"];
        $tipo = $_POST["tipo"];
        $fechaCaptura = $_POST["fechaCaptura"];
        $estado = $_POST["estado"];
        $notas = $_POST["notas"];

        $idTienda = $_COOKIE["idtienda"];

        if (!$nombre) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into clientes
                (idtienda, nombre, direccion, colonia, telefono1, telefono2, correo, tienda, tipo, fechacaptura, estado, notas)
                Values
                ($idTienda, '$nombre', '$direccion', '$colonia', '$telefono1', '$telefono2', '$correo', '$tienda', '$tipo', '$fechaCaptura', 
                '$estado', '$notas')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>