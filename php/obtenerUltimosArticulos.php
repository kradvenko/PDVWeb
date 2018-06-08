<?php
    try
    {
        require_once('connection.php');

        $con = new mysqli($hn, $un, $pw, $db);

        $prefijo = $_COOKIE["prefijo"];

        $sql = "Select * 
                    From " . $prefijo . "articulos 
                    Order By idarticulo Desc 
                    Limit 10";

        $result = $con->query($sql);

        
        while ($row = $result->fetch_array()) {
            echo "<span class='ultimoArticulo' onclick='elegirArticulo(" . $row["idarticulo"] . ", " . $row["idmatriz"] . ")'>" . $row["nombre"] . "</span>";
        }        

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>