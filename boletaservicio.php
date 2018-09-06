<?php
    require('php/fpdf.php');

    $pdf = new FPDF('P', 'mm', 'Letter');
    $pdf->SetFont('Arial','B',16);
    $pdf->AddPage();
    $pdf->Image('imgs/Sinergia.jpg',5,5,40);
    $pdf->Cell(40);
    $pdf->Cell(0,10,'Hoja de servicio','B',0,'C');
    $pdf->Ln(10);
    $pdf->Cell(40);
    $pdf->SetFont('Arial','B',11);

    $pdf->Cell(40,10,'Nombre del cliente','0',0,'L');
    $pdf->Cell(0,10,'CARLOS CUITLAHUAC CONTRERAS CAMACHO','B',0,'L');

    $pdf->Ln(10);
    $pdf->Cell(40);

    $pdf->Cell(20,10,'Marca','0',0,'L');
    $pdf->Cell(50,10,'SAMSUNG','B',0,'L');
    $pdf->Cell(20,10,'Modelo','0',0,'L');
    $pdf->Cell(50,10,'NOTE 7','B',0,'L');

    $pdf->Ln(10);
    $pdf->Cell(40);

    $pdf->Cell(20,10,'Bateria','0',0,'L');
    $pdf->Cell(20,10,'SI','B',0,'L');
    $pdf->Cell(20,10,'Tapa','0',0,'L');
    $pdf->Cell(20,10,'SI','B',0,'L');
    $pdf->Cell(20,10,'Otro','0',0,'L');
    $pdf->Cell(55,10,'OTRAS COSAS','B',0,'L');

    $pdf->Ln(10);
    $pdf->Cell(1);

    $pdf->Cell(30,10,'Falla','0',0,'L');
    $pdf->Cell(165,10,'SAMSUNG','B',0,'L');

    $pdf->Ln(10);
    $pdf->Cell(1);

    $pdf->Cell(30,10,'Observaciones','0',0,'L');
    $pdf->Cell(165,10,'NOTE 7','B',0,'L');

    $pdf->Ln(10);
    $pdf->Cell(1);

    $pdf->Cell(50,10,'Fecha entrega estimada','0',0,'L');
    $pdf->Cell(40,10,'NOTE 7','B',0,'L');
    $pdf->Cell(20,10,'Costo','0',0,'L');
    $pdf->Cell(30,10,'NOTE 7','B',0,'L');
    $pdf->Cell(20,10,'Anticipo','0',0,'L');
    $pdf->Cell(35,10,'NOTE 7','B',0,'L');


    $pdf->Output();
?>