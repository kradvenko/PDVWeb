<?php
    
    try
    {
        require_once('connection.php');

        header('Content-type: application/json');

        $term = $_GET["term"];

        $con = new mysqli($hn, $un, $pw, $db);

        $data = array();

        $sql = "Select ciudades.idciudad, Concat(paises.pais, ' ',  ciudades.ciudad) As Lugar " . 
                "From ciudades " .
                "Inner Join regiones " .
                "On regiones.idregion = ciudades.idregion " .
                "Inner Join paises " .
                "On paises.idpais = ciudades.idpais " .
                "Where ciudades.ciudad Like '%$term%'";

        $result = $con->query($sql);

        while ($row = $result->fetch_array()) {
            $ciudad = array("id" => $row["idciudad"] , "value" => $row["Lugar"]);
            array_push($data, $ciudad);
        }
        
        echo json_encode($data);
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>