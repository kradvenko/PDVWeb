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

        $sql = "Select $tablaArticulos.nombre As Articulo, $tablaDetalleVentas.cantidad As Cantidad, $tablaDetalleVentas.subtotal As Subtotal, $tablaDetalleVentas.total AS Total,
                $tablaVentas.total As TotalVenta, clientes.nombre As Cliente
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

        $Cliente = $row["Cliente"];

        //echo "Total " . $result->num_rows;

        mysqli_close($con);

    }
    catch (Throwable $t)
    {
        echo $t;
        return;
    }
    
    $TotalVenta = 0;
    
    //$pdf = new FPDF('P', 'mm', 'Letter');
    

    $pdf = new FPDF('P', 'cm', array(7.5, $rows + 8));

    $pdf->SetMargins(0.1, 0.0, 0.1, 10);

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

    $pdf->Ln(0.5);
    $pdf->Cell(0, 0, iconv('UTF-8', 'windows-1252', 'Cliente: ' . $Cliente), '0', 0, 'C', false);

    $pdf->Ln(0.5);
    $pdf->Cell(0, 0, iconv('UTF-8', 'windows-1252', ""), 'B', 0, 'C', false);

    $pdf->Ln(0.5);
    $pdf->Cell(1, 0, iconv('UTF-8', 'windows-1252', "Cantidad"), '0', 0, 'C', false);
    $pdf->Cell(3, 0, iconv('UTF-8', 'windows-1252', "Artículo"), '0', 0, 'L', false);
    $pdf->Cell(1, 0, iconv('UTF-8', 'windows-1252', "Subtotal"), '0', 0, 'C', false);
    $pdf->Cell(1, 0, iconv('UTF-8', 'windows-1252', "Total"), '0', 0, 'C', false);

    $pdf->Ln(0.5);
    $pdf->Cell(0, 0, iconv('UTF-8', 'windows-1252', ""), 'B', 0, 'C', false);    

    $pdf->Ln(0.5);
    $pdf->Cell(1, 0, iconv('UTF-8', 'windows-1252', $row["Cantidad"]), '0', 0, 'C', false);
    $pdf->Cell(3, 0, iconv('UTF-8', 'windows-1252', $row["Articulo"]), '0', 0, 'L', false);
    $pdf->Cell(1, 0, iconv('UTF-8', 'windows-1252', "$ " . $row["Subtotal"]), '0', 0, 'C', false);
    $pdf->Cell(1, 0, iconv('UTF-8', 'windows-1252', "$ " . $row["Total"]), '0', 0, 'C', false);
    $TotalVenta = $row["TotalVenta"];

    while ($row = $result->fetch_array()) {
        $pdf->Ln(0.5);
        $pdf->Cell(1, 0, iconv('UTF-8', 'windows-1252', $row["Cantidad"]), '0', 0, 'C', false);
        $pdf->Cell(3, 0, iconv('UTF-8', 'windows-1252', $row["Articulo"]), '0', 0, 'L', false);
        $pdf->Cell(1, 0, iconv('UTF-8', 'windows-1252', "$ " . $row["Subtotal"]), '0', 0, 'C', false);
        $pdf->Cell(1, 0, iconv('UTF-8', 'windows-1252', "$ " . $row["Total"]), '0', 0, 'C', false);        
    }

    $pdf->Ln(0.5);

    $pdf->Cell(0, 0, iconv('UTF-8', 'windows-1252', ""), 'B', 0, 'C', false);

    $pdf->Ln(0.5);
    $pdf->Cell(1, 0, iconv('UTF-8', 'windows-1252', ""), '0', 0, 'C', false);
    $pdf->Cell(3, 0, iconv('UTF-8', 'windows-1252', ""), '0', 0, 'L', false);
    $pdf->Cell(1, 0, iconv('UTF-8', 'windows-1252', "Total venta: "), '0', 0, 'C', false);
    $pdf->Cell(1, 0, iconv('UTF-8', 'windows-1252', " $ " . $TotalVenta), '0', 0, 'C', false);

    $pdf->Ln(0.5);
    $pdf->Cell(0, 0, iconv('UTF-8', 'windows-1252', "Sinergia movil"), '0', 0, 'C', false);    

    $pdf->Output();
?>