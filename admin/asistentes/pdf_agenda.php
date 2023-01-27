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

function getSesion($id)
{
    $row = null;
    $query = new Query();
    $sql = "SELECT * FROM `sesiones` WHERE `id` = '$id'";
    $row = $query->getFirst($sql);
    return $row;
}

if ($_GET) 
{
    if(!empty($_GET['id'])){
        $sesion_id = $_GET['id'];
        $sesion = getSesion($sesion_id);
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


// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();


//pagina 1
$pdf->AddPage();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,5,'AGENDA AL CONSEJO DE AREA',0,1,'C');
$pdf->Cell(0,5,utf8_decode("Sesión ".$sesion['tipo']." Nro. ".$sesion['codigo']),0,1,'C');
$pdf->Cell(0,5,utf8_decode(fechaEs($sesion['fecha'])),0,1,'C');
$pdf->Cell(0,5,'Hora: '.$sesion['hora'],0,1,'C');
$pdf->Ln(5);

function getAsistente($id)
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `asistencias` WHERE `id` = '$id'";
    $rows = $query->getFirst($sql);
    return $rows;
}

function getAgendas($id)
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `agendas` WHERE `sesiones_id` = '$id';";
    $rows = $query->getAll($sql);
    return $rows;
}

$pdf->SetFillColor(153,202,255);

$temas = getAgendas($sesion_id);
$pdf->Cell(0,10,'SUMARIO',1,1,'C',1);
$pdf->Ln(3);
$x = $pdf->GetX();
$y = $pdf->GetY();
foreach ($temas as $tema) {

    $persona = getAsistente($tema['asistencias_id']);
    if($persona){
        $nombre = utf8_decode($persona['profesion'].". ".$persona['nombre_completo']);
        $cargo = utf8_decode($persona['cargo']);
    }else{
        $nombre = null;
        $cargo = null;
        continue;
    }
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(0,7,$nombre,0,1);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(0,7,utf8_decode($cargo),0,1);
    $pdf->MultiCell(0, 5, utf8_decode("Tema: \n".$tema['tema']), 1, "J");
    $pdf->Ln(5);
}


$pdf->Output('I', "AGENDA AL CONSEJO DE AREA ".$sesion['codigo'], true);
?>
