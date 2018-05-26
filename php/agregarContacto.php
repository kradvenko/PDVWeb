<?php
    try
    {
        require_once('connection.php');
        
        $idInstitucion = $_POST["idInstitucion"];
        $nombreContacto = $_POST["nombreContacto"];
        $areaContacto = $_POST["area"];
        $cargoContacto = $_POST["cargoContacto"];
        $telefonos = $_POST["telefonos"];
        $extension = $_POST["extension"];
        $correoElectronico = $_POST["correoElectronico"];
        $notas = $_POST["notas"];
        
        if (!$idInstitucion) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into contactos (idinstitucion, nombreContacto, area, cargo, telefonos, extension, correoElectronico, notas) " . 
        " Values ('$idInstitucion', '$nombreContacto', '$areaContacto', '$cargoContacto', '$telefonos', '$extension', '$correoElectronico', '$notas')";

        $con->query($sql);

        $idContacto = $con->insert_id;

        echo "Se ha agregado el contacto.";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>