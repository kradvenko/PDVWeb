<?php    
    try
    {
        require_once('connection.php');

        header('Content-type: application/json');

        $term = $_GET["term"];

        $con = new mysqli($hn, $un, $pw, $db);

        $data = array();

        $sql = "Select * From generosfotografia " .
                "Where generosfotografia.genero Like '%$term%'";

        $result = $con->query($sql);

        while ($row = $result->fetch_array()) {
            $soporte = array("id" => $row["idgenerofotografia"] , "value" => $row["genero"]);
            array_push($data, $soporte);
        }
        
        echo json_encode($data);
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>