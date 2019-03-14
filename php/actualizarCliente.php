<?php
    try
    {
        require_once('connection.php');

        $idCliente = $_POST["idCliente"];
        $nombre = $_POST["nombre"];
        $direccion = $_POST["direccion"];
        $colonia = $_POST["colonia"];
        $telefono1 = $_POST["telefono1"];
        $telefono2 = $_POST["telefono2"];
        $correo = $_POST["correo"];
        $tienda = $_POST["tienda"];
        $tipo = $_POST["tipo"];        
        $estado = $_POST["estado"];
        $notas = $_POST["notas"];

        $idTienda = $_COOKIE["idtienda"];

        if (!$idCliente) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "UPDATE clientes
                SET nombre = '$nombre', direccion = '$direccion', colonia = '$colonia', telefono1 = '$telefono1', 
                telefono2 = '$telefono2', correo = '$correo', tipo = '$tipo', estado = '$estado', notas = '$notas' 
                WHERE idcliente = $idCliente";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>