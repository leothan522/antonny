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
$pdf->Cell(0,5,'ASISTENCIA AL CONSEJO DE AREA',0,1,'C');
$pdf->Cell(0,5,utf8_decode("Sesión ".$sesion['tipo']." Nro. ".$sesion['codigo']),0,1,'C');
$pdf->Cell(0,5,utf8_decode(fechaEs($sesion['fecha'])),0,1,'C');
$pdf->Cell(0,5,'Hora: '.$sesion['hora'],0,1,'C');
$pdf->Ln(5);

function getAsistentes($id, $invitado)
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `asistencias` WHERE `sesiones_id` = '$id' AND  `invitado` = '$invitado' ;";
    $rows = $query->getAll($sql);
    return $rows;
}




$pdf->SetFillColor(153,202,255);

$miembros = getAsistentes($sesion_id, "MIEMBROS");
$pdf->Cell(150,10,'MIEMBRO DEL CONSEJO',1,0,'C',1);
$x2 = $pdf->GetX();
$pdf->Cell(40,10,'FIRMA',1,1,'C',1);
$x = $pdf->GetX();
$y = $pdf->GetY();
foreach ($miembros as $persona) {    
    $pdf->Rect($x, $y, 150, 14);
    $pdf->Rect($x2, $y, 40, 14);
    $y = $y + 14;
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(150,7,utf8_decode($persona['profesion'].". ".$persona['nombre_completo']),0,1);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(150,7,utf8_decode($persona['cargo']),0,1);
}

$departamentos = getAsistentes($sesion_id, "DEPARTAMENTOS");
$pdf->SetFont('Arial','B',11);
$pdf->Cell(150,10,'DEPARTAMENTOS:',0,0);
$x2 = $pdf->GetX();
$pdf->Cell(40,10,'',0,1);
$x = $pdf->GetX();
$y = $pdf->GetY();
foreach ($departamentos as $persona) {    
    $pdf->Rect($x, $y, 150, 14);
    $pdf->Rect($x2, $y, 40, 14);
    $y = $y + 14;
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(150,7,utf8_decode($persona['profesion'].". ".$persona['nombre_completo']),0,1);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(150,7,utf8_decode($persona['cargo']),0,1);
}

$coordinaciones = getAsistentes($sesion_id, "COORDINACIONES");
$pdf->SetFont('Arial','B',11);
$pdf->Cell(150,10,'COORDINACIONES:',0,0);
$x2 = $pdf->GetX();
$pdf->Cell(40,10,'',0,1);
$x = $pdf->GetX();
$y = $pdf->GetY();
foreach ($coordinaciones as $persona) {    
    $pdf->Rect($x, $y, 150, 14);
    $pdf->Rect($x2, $y, 40, 14);
    $y = $y + 14;
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(150,7,utf8_decode($persona['profesion'].". ".$persona['nombre_completo']),0,1);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(150,7,utf8_decode($persona['cargo']),0,1);
}

//paginA 2
$pdf->AddPage();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,5,'ASISTENCIA AL CONSEJO DE AREA',0,1,'C');
$pdf->Cell(0,5,utf8_decode("Sesión ".$sesion['tipo']." Nro. ".$sesion['codigo']),0,1,'C');
$pdf->Cell(0,5,utf8_decode(fechaEs($sesion['fecha'])),0,1,'C');
$pdf->Cell(0,5,'Hora: '.$sesion['hora'],0,1,'C');
$pdf->Ln(5);

$coordinaciones = getAsistentes($sesion_id, "INVITADOS");
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,10,'INVITADOS:',1,1, 'C',1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(80,10,'NOMBRE Y APELLIDO',1,0, 'C');
$pdf->Cell(50,10,utf8_decode('PROFESIÓN'),1,0, 'C');
$pdf->Cell(30,10,utf8_decode('TELÉFONO'),1,0, 'C');
$pdf->Cell(30,10,'FIRMA',1,1, 'C');
$pdf->SetFont('Arial','',10);
foreach ($coordinaciones as $persona) {    
    
    $pdf->Cell(80,10,utf8_decode($persona['nombre_completo']),1,0,);
    $pdf->Cell(50,10,utf8_decode($persona['profesion']),1,0);
    $pdf->Cell(30,10,utf8_decode($persona['telefono']),1,0);
    $pdf->Cell(30,10,'',1,1);
}

$pdf->Output('I', "ASISTENCIAS AL CONSEJO DE AREA ".$sesion['codigo'], true);
?>
