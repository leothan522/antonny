<?php
require('../../fpdf/fpdf.php');
require "../../mysql/Query.php";

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $this->SetFont('Arial','B',8);
    $this->Image('../../img/unerg.png', 8, 3, 30, 30);
    $this->SetX(-33);
    $this->Image('../../img/logo.jpg', null, 5, 30, 30);
    $this->SetXY(10,15);
    $this->Cell(0,4,utf8_decode('REPÚBLICA BOLIVARIANA DE VENEZUELA'),0,1, 'C');
    $this->Cell(0,4,utf8_decode('MINISTERIO DEL PODER POPULAR PARA LA EDUCACIÓN UNIVERSITARIA, CIENCIA Y TEGNOLOGÍA'),0,1, 'C');
    $this->Cell(0,4,utf8_decode('UNIVERSIDAD NACIONAL EXPERIMENTAL DE LOS LLANOS CENTRALES RÓMULO GALLEGOS'),0,1, 'C');
    $this->Cell(0,4,utf8_decode('ÁREA DE INGENIERÍA EN SISTEMAS'),0,1, 'C');
    $this->Ln(5);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

function fechaEs($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes,", "Martes", "Miércoles,", "Jueves,", "Viernes,", "Sábado,", "Domingo,");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
    }

function getResol($id)
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `resoluciones` WHERE `id` = $id;";
    $rows = $query->getFirst($sql);
    return $rows;
}

function getSello($id)
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `sellos` WHERE `id` = '$id';";
    $rows = $query->getFirst($sql);
    return $rows;
}

function getFirmante($id)
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `firmantes` WHERE `id` = '$id';";
    $rows = $query->getFirst($sql);
    return $rows;
}

if ($_GET)
{
    if(!empty($_GET['id'])){
        $resol_id = $_GET['id'];
        $get_resol = getResol($resol_id);
    }else{
        $resol_id = false;
    }
}else{
    $resol_id = false;
}


// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();


//pagina 1
$pdf->AddPage();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,5,utf8_decode(strtoupper($get_resol['codigo'])),0,1);
$pdf->Ln(3);
$pdf->Cell(25,5,utf8_decode("PARA: "),0,0);
$pdf->Cell(0,5,utf8_decode(strtoupper($get_resol['profesion']." ".$get_resol['nombre'])),0,1);
$pdf->Cell(25,5,utf8_decode(""),0,0);
$pdf->Cell(165,5,strtoupper($get_resol['cargo']),0,1);
$pdf->Cell(25,5,utf8_decode("DE: "),0,0);
$pdf->Cell(0,5,utf8_decode(strtoupper($get_resol['de'])),0,1);
$newDate = date("d/m/Y", strtotime($get_resol['fecha']));
$pdf->Cell(25,5,utf8_decode("FECHA: "),0,0);
$pdf->Cell(0,5,$newDate,0,1);
$pdf->Cell(25,5,utf8_decode("ASUNTO: "),0,0);
$pdf->Cell(0,5,utf8_decode(strtoupper($get_resol['asunto'])),0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0,5,utf8_decode(strtoupper($get_resol['descripcion'])),0);
$pdf->Ln(20);
$pdf->Cell(0,5,'Atentamente,', 0, 1, 'C');
$x = $pdf->GetX();
$y = $pdf->GetY();
$sello = getSello($get_resol['sello_id']);
$pdf->Image($sello['path'], 80, $y + 5, 50, 50);
$yfirma = $y + 5;
$y = $pdf->GetY();
$pdf->SetY($y + 25);
$pdf->Cell(70,5,'__________________________', 0, 0, 'C');
$pdf->Cell(50,5,'', 0, 0, 'C');
$pdf->Cell(70,5,'__________________________', 0, 1, 'C');

$presidente = getFirmante($get_resol['presidente_id']);
$secretario = getFirmante($get_resol['secretario_id']);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(70,5,utf8_decode(strtoupper($presidente['profesion']. " ".$presidente['nombre'])), 0, 0, 'C');
$pdf->Cell(50,5,'', 0, 0, 'C');
$pdf->Cell(70,5,utf8_decode(strtoupper($secretario['profesion']. " ".$secretario['nombre'])), 0, 1, 'C');

$pdf->Cell(70,5,"Decano - Presidente", 0, 0, 'C');
$pdf->Cell(50,5,'', 0, 0, 'C');
$pdf->Cell(70,5,"Secreatria del Consejo", 0, 1, 'C');

$x = $pdf->GetX();
$y = $pdf->GetY();
if (!is_null($presidente['path_firma'])){
    $pdf->Image($presidente['path_firma'], $x + 20 , $y-41, 30, 30);
}

if (!is_null($secretario['path_firma'])){
    $pdf->Image($secretario['path_firma'], $x + 140 , $y-41, 30, 30);
}

$pdf->Ln(15);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,4,utf8_decode(strtoupper($get_resol['cc'])),0);





$pdf->Output('I', "RESOLUCION ".$get_resol['codigo'], true);
?>
