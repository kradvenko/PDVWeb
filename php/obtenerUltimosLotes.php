<?php
    try
    {
        require_once('connection.php');

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select * 
                    From lotes 
                    Inner Join origeneslote
                    On origeneslote.idorigenlote = lotes.idorigen
                    Order By lotes.idlote Desc 
                    Limit 10";

        $result = $con->query($sql);

        
        while ($row = $result->fetch_array()) {
            echo "<span class='ultimoArticulo' onclick='elegirLote(\"" . $row["idlote"] . "\")'>" . $row["origen"] . " - " . $row["fechalote"] . "</span>";
        }        

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>