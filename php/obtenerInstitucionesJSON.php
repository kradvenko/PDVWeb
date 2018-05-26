<?php
    try
    {
        require_once('connection.php');

        header('Content-type: application/json');

        $term = $_GET["term"];

        $con = new mysqli($hn, $un, $pw, $db);

        $data = array();

        $sql = "Select instituciones.idinstitucion, instituciones.nombreInstitucion ". 
                "From instituciones " .
                "Where instituciones.nombreInstitucion Like '%$term%'";

        $result = $con->query($sql);

        while ($row = $result->fetch_array()) {
            $institucion = array("id" => $row["idinstitucion"] , "value" => $row["nombreInstitucion"]);
            array_push($data, $institucion);
        }
        
        echo json_encode($data);

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>