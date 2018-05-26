<?php
    try
    {
        require_once('connection.php');
        
        $idContacto = $_POST["idContacto"];
        $nombreContacto = $_POST["nombreContacto"];
        $areaContacto = $_POST["area"];
        $cargoContacto = $_POST["cargoContacto"];
        $telefonos = $_POST["telefonos"];
        $extension = $_POST["extension"];
        $correoElectronico = $_POST["correoElectronico"];
        $notas = $_POST["notas"];
        
        if (!$idContacto) {
            echo "Error. Faltan variables.";
            exit(1);
        }        
        
        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Update contactos SET " . 
        "nombreContacto = '$nombreContacto', area = '$areaContacto', telefonos = '$telefonos', cargo = '$cargoContacto', " .
        "extension = '$extension', correoElectronico = '$correoElectronico', notas = '$notas' ".
        "Where idContacto = $idContacto ";

        $con->query($sql);
     
        echo "Se ha actualizado el contacto.";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>