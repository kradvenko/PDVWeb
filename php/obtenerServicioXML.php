<?php
    try
    {
        require_once('connection.php');

        $idServicio = $_POST["idServicio"];

        if (!$idServicio) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $prefijo = $_COOKIE["prefijo"];

        $tienda = $prefijo . "servicios";

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select *, marcas.marca, clientes.nombre As cliente
                From $tienda
                Left Join marcas
                On marcas.idmarca = $tienda.idmarca
                Inner Join clientes
                On clientes.idcliente = $tienda.idcliente
                Where idservicio = $idServicio";

        $result = $con->query($sql);

        header("Content-Type: text/xml");	
	    echo "<resultado>\n";

        while ($row = $result->fetch_array()) {
            echo "<idservicio>" . $row['idservicio'] . "</idservicio>\n";
            echo "<idcliente>" . $row['idcliente'] . "</idcliente>\n";
            echo "<cliente>" . $row['cliente'] . "</cliente>\n";
            echo "<esn>" . $row['esn'] . "</esn>\n";
            echo "<folio>" . $row['folio'] . "</folio>\n";
            echo "<idmarca>" . $row['idmarca'] . "</idmarca>\n";
            echo "<marca>" . $row['marca'] . "</marca>\n";
            echo "<modelo>" . $row['modelo'] . "</modelo>\n";
            echo "<bateria>" . $row['bateria'] . "</bateria>\n";
            echo "<tapa>" . $row['tapa'] . "</tapa>\n";
            echo "<otro>" . $row['otro'] . "</otro>\n";
            echo "<falla>" . $row['falla'] . "</falla>\n";
            echo "<observaciones>" . $row['observaciones'] . "</observaciones>\n";
            echo "<fechaentregaestimada>" . $row['fechaentregaestimada'] . "</fechaentregaestimada>\n";
            echo "<contraseña>" . $row['contraseña'] . "</contraseña>\n";
            echo "<costo>" . $row['costo'] . "</costo>\n";
            echo "<anticipo>" . $row['anticipo'] . "</anticipo>\n";
            echo "<fechaingresado>" . $row['fechaingresado'] . "</fechaingresado>\n";
            echo "<fechaentregado>" . $row['fechaentregado'] . "</fechaentregado>\n";
            echo "<estado>" . $row['estado'] . "</estado>\n";
            echo "<notas>" . $row['notas'] . "</notas>\n";
            echo "<patron>" . $row['patron'] . "</patron>\n";
        }

        echo "</resultado>\n";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>