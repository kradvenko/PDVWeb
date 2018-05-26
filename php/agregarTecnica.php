<?php
    try
    {
        require_once('connection.php');

        $tecnica = $_POST["tecnica"];

        if (!$tecnica) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into tecnicasfotograficas (tecnica) Values ('" . $tecnica . "')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>