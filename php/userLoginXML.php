<?php
    try
    {
        require_once('connection.php');

        $u = $_POST["u"];
        $p = $_POST["p"];

        if (!$u || !$p) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select * From usuarios Where usuario = '$u' And pass = '$p' And estado = 'ACTIVO'";

        $result = $con->query($sql);

        header("Content-Type: text/xml");	
	    echo "<resultado>\n";

        while ($row = $result->fetch_array()) {
            echo "<respuesta>OK</respuesta>\n";
            echo "<idusuario>" . $row['idusuario'] . "</idusuario>\n";
            echo "<usuario>" . $row['usuario'] . "</usuario>\n";
            echo "<pass>" . $row['pass'] . "</pass>\n";
            echo "<tipo>" . $row['tipo'] . "</tipo>\n";
            echo "<estado>" . $row['estado'] . "</estado>\n";
            echo "<nombre>" . $row['nombre'] . "</nombre>\n";
        }

        echo "</resultado>\n";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?> 