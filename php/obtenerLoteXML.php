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
                From lotes 
                Inner Join origeneslote
                On origeneslote.idorigenlote = lotes.idorigen
                Where idlote = $idLote";

        $result = $con->query($sql);

        header("Content-Type: text/xml");	
	    echo "<resultado>\n";

        while ($row = $result->fetch_array()) {
            echo "<cat>";
            echo "<idlote>" . $row["idlote"] . "</idlote>";
            echo "<idorigen>" . $row["idorigen"] . "</idorigen>";
            echo "<fechalote>" . $row["fechalote"] . "</fechalote>";
            echo "<tipocambio>" . $row["tipocambio"] . "</tipocambio>";
            echo "<fechaingreso>" . $row["fechaingreso"] . "</fechaingreso>";
            echo "<estado>" . $row["estado"] . "</estado>";
            echo "<costolote>" . $row["costolote"] . "</costolote>";
            echo "<moneda>" . $row["moneda"] . "</moneda>";
            echo "<fechapago>" . $row["fechapago"] . "</fechapago>";
            echo "<fecharecibido>" . $row["fecharecibido"] . "</fecharecibido>";
            echo "<pagado>" . $row["pagado"] . "</pagado>";
            echo "<recibido>" . $row["recibido"] . "</recibido>";
            echo "<costoenvio>" . $row["costoenvio"] . "</costoenvio>";
            echo "<tipocambioenvio>" . $row["tipocambioenvio"] . "</tipocambioenvio>";
            echo "<monedaenvio>" . $row["monedaenvio"] . "</monedaenvio>";
            echo "<origen>" . $row["origen"] . "</origen>";
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