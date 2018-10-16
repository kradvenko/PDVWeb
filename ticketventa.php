<?php
    require('php/fpdf.php');


    try
    {
        require_once('php/connection.php');

        $idVenta = $_GET["idVenta"];

        if (!$idVenta) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $prefijo = $_COOKIE["prefijo"];

        $tablaVentas = $prefijo . "ventas";
        $tablaDetalleVentas = $prefijo . "detalleventa";
        $tablaArticulos = $prefijo . "articulos";

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select $tablaArticulos.nombre As Articulo
                From $tablaVentas
                Inner Join $tablaDetalleVentas
                On $tablaVentas.idventa = $tablaDetalleVentas.idventa
                Inner Join $tablaArticulos
                On $tablaArticulos.idarticulo = $tablaDetalleVentas.idarticulo
                Inner Join clientes
                On clientes.idcliente = $tablaVentas.idcliente
                Where $tablaVentas.idventa = $idVenta";

        $result = $con->query($sql);

        $row = $result->fetch_array();

        $rows = $result->num_rows;

        //echo "Total " . $result->num_rows;

        mysqli_close($con);

    }
    catch (Throwable $t)
    {
        echo $t;
        return;
    }
    
    
    //$pdf = new FPDF('P', 'mm', 'Letter');
    

    $pdf = new FPDF('P', 'cm', array(7.5, $rows + 10));

    $pdf->SetMargins(0, 0);

    $pdf->SetFont('Arial','B',12);
    
    $pdf->AddPage();

    $pdf->Ln(0.5);    

    $pdf->Cell(0, 0, iconv('UTF-8', 'windows-1252', 'Ticket de compra'), '0', 0, 'C', false);

    $pdf->SetFont('Arial', 'B', 7);

    $pdf->Ln(0.5);

    $pdf->Cell(0, 0, iconv('UTF-8', 'windows-1252', 'Omar Alexander Alfaro Alarcón'), '0', 0, 'C', false);

    $pdf->Ln(0.5);

    $pdf->Cell(0, 0, iconv('UTF-8', 'windows-1252', 'Cel 311 111 5145 y Local (311) 133 0773'), '0', 0, 'C', false);

    $pdf->Ln(0.5);

    $pdf->Cell(0, 0, iconv('UTF-8', 'windows-1252', 'Miñon 1-B Centro Tepic, Nayarit'), '0', 0, 'C', false);

    while ($row = $result->fetch_array()) {
        $pdf->Ln(0.5);
        $pdf->Cell(0, 0, iconv('UTF-8', 'windows-1252', '$row["Articulo"]'), '0', 0, 'C', false);
    }

    //$pdf->Image('imgs/sin-logo.png',0,0,40);
    /*
    $pdf->Cell(0,10,iconv('UTF-8', 'windows-1252', 'Orden de servicio técnico'),'B',0,'C',true);

    $pdf->Ln(10);
    $pdf->Cell(40);

    $pdf->SetFont('Arial','B',9);    

    $pdf->Cell(0,10,iconv('UTF-8', 'windows-1252', 'Omar Alexander Alfaro Alarcón'),'0',0,'C',false);

    $pdf->Image('imgs/tel.png',50,20,5);

    $pdf->Ln(10);

    $pdf->Cell(10);
    

    $pdf->Image('imgs/loc.png',140,20,5);
    
    $pdf->Cell(15,5,iconv('UTF-8', 'windows-1252', 'Miñon 1-B Centro Tepic, Nayarit'),'0',0,'C',false);
    
    $pdf->Ln(10);

    $pdf->Image('imgs/fb-b.jpg',50,30,5);

    $pdf->Cell(138,5,iconv('UTF-8', 'windows-1252', 'Sinergia movil'),'0',0,'C',false);    
    */
    

    $pdf->Output();
?>