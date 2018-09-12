<?php
    require('php/fpdf.php');


    try
    {
        require_once('php/connection.php');

        $idServicio = $_GET["idServicio"];

        if (!$idServicio) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $prefijo = $_COOKIE["prefijo"];

        $tienda = $prefijo . "servicios";

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select *, marcas.marca, clientes.nombre As cliente, clientes.telefono1
                From $tienda
                Left Join marcas
                On marcas.idmarca = $tienda.idmarca
                Inner Join clientes
                On clientes.idcliente = $tienda.idcliente
                Where idservicio = $idServicio";

        $result = $con->query($sql);  
        $row = $result->fetch_array();      

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
        return;
    }

    $pdf = new FPDF('P', 'mm', 'Letter');
    $pdf->SetMargins(0,0);

    $pdf->SetFont('Arial','B',16);
    
    $pdf->AddPage();

    $pdf->Image('imgs/sin-logo.png',0,0,40);

    $pdf->Cell(40);
    $pdf->SetFillColor(100,170,250);
    //$pdf->SetDrawColor(50,50,250);
    
    $pdf->Cell(0,10,iconv('UTF-8', 'windows-1252', 'Orden de servicio técnico'),'B',0,'C',true);

    $pdf->Ln(10);
    $pdf->Cell(40);

    $pdf->SetFont('Arial','B',9);    

    $pdf->Cell(0,10,iconv('UTF-8', 'windows-1252', 'Omar Alexander Alfaro Alarcón'),'0',0,'C',false);

    $pdf->Image('imgs/tel.png',50,20,5);

    $pdf->Ln(10);

    $pdf->Cell(10);
    $pdf->Cell(155,5,iconv('UTF-8', 'windows-1252', 'Cel 311 111 5145 y Local (311) 133 0773'),'0',0,'C',false);

    $pdf->Image('imgs/loc.png',140,20,5);
    
    $pdf->Cell(15,5,iconv('UTF-8', 'windows-1252', 'Miñon 1-B Centro Tepic, Nayarit'),'0',0,'C',false);
    
    $pdf->Ln(10);

    $pdf->Image('imgs/fb-b.jpg',50,30,5);

    $pdf->Cell(138,5,iconv('UTF-8', 'windows-1252', 'Sinergia movil'),'0',0,'C',false);    

    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(10,10,'Folio',0,0,'L',true);
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(12,10,$row["folio"],'0',0,'C',true);

    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(12,10,'Fecha',0,0,'L',true);
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(0,10,$row["fechaingresado"],'0',0,'C',true);

    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',11);
    
    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(40,10,'Nombre',0,0,'L',true);
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(0,10,$row["cliente"],'0',0,'C',true);

    $pdf->Ln(10);    

    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(30,10,iconv('UTF-8', 'windows-1252', 'Teléfono'),0,0,'L',true);
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(80,10,$row["telefono1"],'0',0,'C',true);
    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(30,10,'ESN',0,0,'L',true);
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(0,10,$row["esn"],'0',0,'C',true);

    $pdf->Ln(12);

    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(30,10,'Marca',0,0,'L',true);
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(80,10,$row["marca"],'0',0,'C',true);
    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(30,10,'Modelo',0,0,'L',true);
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(0,10,$row["modelo"],'0',0,'C',true);

    $pdf->Ln(10);

    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(20,10,'Bateria',0,0,'L',true);
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(20,10,$row["bateria"],'0',0,'C',true);
    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(20,10,'Tapa',0,0,'L',true);
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(20,10,$row["tapa"],'0',0,'C',true);
    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(20,10,'Otro','0',0,'L',true);
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(0,10,$row["otro"],'0',0,'C',true);

    $pdf->Ln(12);

    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(30,10,'Falla','0',0,'L',true);
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(0,10,$row["falla"],'0',0,'C',true);

    $pdf->Ln(10);

    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(30,10,'Observaciones','0',0,'L',true);
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(0,10,$row["observaciones"],'0',0,'C',true);

    $pdf->Ln(12);

    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(50,10,'Fecha entrega estimada','0',0,'L',true);
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(59,10,$row["fechaentregaestimada"],'0',0,'C',true);
    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(20,10,'Costo','0',0,'L',true);
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(30,10,$row["costo"],'0',0,'C',true);
    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(20,10,'Anticipo','0',0,'L',true);
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(0,10,$row["anticipo"],'0',0,'C',true);

    $pdf->Ln(12);

    $clausulas = "Sin excepción alguna NO se entregan equipos sin orden de servicio. En equipos mojados, doblados o con daño severo, NO aplica garantía y NO nos hacemos responsables de daños al momento de la revisión. La garantía solo cubre la falla principal y solo aplica para mano de obra NO en refacciones. El taller NO se hace responsable de chip, memorias o artículos no registrados en la orden de servicio. Todo trabajo requiere el 50% de anticipo. Por ningún motivo ser realizarán devoluciones de dinero en liberaciones, ejemplo: si el dispositivo tiene alguna cuenta o contraseña privada del usuario, que impida su uso o funcionamiento.";
    $condiciones = "Toda revisión causa honorarios. Después de 15 días de entrega se harán cargos por movimientos y almacenaje. Después de 60 días de la fecha de entrega otorgo mi(s) equipos y accesorios a Sinergia Movil para que disponga de ellos.";

    $pdf->SetFont('Arial','I',10);
    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(0,5,'Clausulas','0',0,'C',true);
    $pdf->Ln(5);
    $pdf->SetFont('Arial','I',7);
    $pdf->SetFillColor(235,235,235);
    $pdf->MultiCell(0,3,iconv('UTF-8', 'windows-1252',$clausulas),0,'J',true);
    $pdf->SetFont('Arial','I',10);
    $pdf->SetFillColor(200,200,230);
    $pdf->Cell(0,5,'Condiciones de servicio','0',0,'C',true);
    $pdf->Ln(5);
    $pdf->SetFont('Arial','I',7);
    $pdf->SetFillColor(235,235,235);
    $pdf->MultiCell(140,3,iconv('UTF-8', 'windows-1252',$condiciones),0,'J',true);
    $pdf->Cell(140);
    $pdf->Cell(0,5,iconv('UTF-8', 'windows-1252','Firma de autorización'),'T',0,'C',true);

    $pdf->Output();
?>