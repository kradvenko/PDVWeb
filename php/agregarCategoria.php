<?php
    try
    {
        require_once('connection.php');

        $categoria = $_POST["categoria"];

        $idTienda = $_COOKIE["idtienda"];

        if (!$categoria) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into categorias (idtienda, categoria, estado) Values (" . $idTienda . ", '" . $categoria. "', 'ACTIVO')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>