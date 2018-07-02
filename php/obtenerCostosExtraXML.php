<?php
    try
    {
        require_once('connection.php');

        $idLote = $_POST["idLote"];
        

        if (!$idLote) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select * 
                From costosextra 
                Where idlote = $idLote";

        $result = $con->query($sql);

        header("Content-Type: text/xml");	
	    echo "<resultado>\n";

        while ($row = $result->fetch_array()) {
            echo "<cat>";
            echo "<idcostoextra>" . $row["idcostoextra"] . "</idcostoextra>";
            echo "<idlote>" . $row["idlote"] . "</idlote>";
            echo "<motivo>" . $row["motivo"] . "</motivo>";
            echo "<monto>" . $row["monto"] . "</monto>";
            echo "<tipocambio>" . $row["tipocambio"] . "</tipocambio>";
            echo "<moneda>" . $row["moneda"] . "</moneda>";
            echo "</cat>";
        }

        echo "</resultado>\n";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>