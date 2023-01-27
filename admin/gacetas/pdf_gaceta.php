<?php
session_start();
require('../../fpdf/fpdf.php');
require "../../mysql/Query.php";

function getGaceta($id)
{
    $row = null;
    $query = new Query();
    $sql = "SELECT * FROM `gacetas` WHERE `id` = '$id'";
    $row = $query->getFirst($sql);
    return $row;
}

function getSesion($id)
{
    $row = null;
    $query = new Query();
    $sql = "SELECT * FROM `sesiones` WHERE `id` = '$id'";
    $row = $query->getFirst($sql);
    return $row;
}

function getAsistentes($id, $invitado)
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `asistencias` WHERE `sesiones_id` = '$id' AND  `invitado` = '$invitado' ;";
    $rows = $query->getAll($sql);
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

function getResoluciones($id)
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `resoluciones` WHERE `band`= 1 AND `sesiones_id` = '$id'; ";
    $rows = $query->getAll($sql);
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

function fechaEs($fecha)
{
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
    return $nombredia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio;
}

if ($_GET) {
    if (!empty($_GET['id'])) {
        $gaceta_id = $_GET['id'];
        $gaceta = getGaceta($gaceta_id);
        $_SESSION['gaceta_id'] = $gaceta_id;
        $_SESSION['sesiones_id'] = $gaceta['sesiones_id'];
        $sesion = getSesion($gaceta['sesiones_id']);
    }
}


class PDF extends FPDF
{

// Cabecera de página
    function Header()
    {
        $sesiones_id = $_SESSION['sesiones_id'];
        $gaceta_id = $_SESSION['gaceta_id'];
        $query = new Query();
        $sql = "SELECT * FROM `sesiones` WHERE `id` = '$sesiones_id'";
        $sesion = $query->getFirst($sql);

        $query = new Query();
        $sql = "SELECT * FROM `gacetas` WHERE `id` = '$gaceta_id'";
        $gaceta = $query->getFirst($sql);

        $newDate = date("Y", strtotime($gaceta['fecha']));

        $this->SetFont('Arial', 'B', 14);
        $this->Image('../../img/unerg.png', 8, 3, 30, 30);
        $this->SetX(-33);
        $this->Image('../../img/logo.jpg', null, 5, 30, 30);
        $this->SetXY(10, 15);
        $this->Cell(0, 7, utf8_decode('GACETA OFICIAL DEL CONSEJO DE AIS'), 0, 1, 'C');
        $this->Cell(0, 7, utf8_decode('SESIÓN' . ' ' . strtoupper($sesion['tipo'])), 0, 1, 'C');
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(45, 7, utf8_decode('AÑO' . ' ' . strtoupper($newDate)), 0, 0, 'C');
        $this->Cell(100, 7, utf8_decode(fechaEs($sesion['fecha'])), 0, 0, 'C');
        $this->Cell(45, 7, utf8_decode('Nº' . ' ' . strtoupper($gaceta['numero'])), 0, 1, 'C');
        $this->Ln(5);
    }

// Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(150, 10, utf8_decode('UNIVERSIDAD NACIONAL EXPERIMENTAL DE LOS LLANOS CENTRALES RÓMULO GALLEGOS'), 0, 0);
        $this->Cell(40, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 1, 'R');
    }
}


// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 5, 'ASISTENCIA AL CONSEJO DE AREA', 0, 1, 'C');
$pdf->Cell(0, 5, utf8_decode("Sesión " . $sesion['tipo'] . " Nro. " . $sesion['codigo']), 0, 1, 'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'MIEMBRO DEL CONSEJO', 0, 1, 'C');
$miembros = getAsistentes($sesion['id'], "MIEMBROS");
foreach ($miembros as $persona) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 5, utf8_decode($persona['profesion'] . ". " . $persona['nombre_completo'] . ", " . $persona['cargo']), 0, 1, 'C');
}
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'DEPARTAMENTOS', 0, 1, 'C');
$departamentos = getAsistentes($sesion['id'], "DEPARTAMENTOS");
foreach ($departamentos as $persona) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 5, utf8_decode($persona['profesion'] . ". " . $persona['nombre_completo'] . ", " . $persona['cargo']), 0, 1, 'C');
}
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'COORDINACIONES', 0, 1, 'C');
$coordinaciones = getAsistentes($sesion['id'], "COORDINACIONES");
foreach ($coordinaciones as $persona) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 5, utf8_decode($persona['profesion'] . ". " . $persona['nombre_completo'] . ", " . $persona['cargo']), 0, 1, 'C');
}
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'INVITADOS', 0, 1, 'C');
$coordinaciones = getAsistentes($sesion['id'], "INVITADOS");
foreach ($coordinaciones as $persona) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 5, utf8_decode($persona['profesion'] . ". " . $persona['nombre_completo']), 0, 1, 'C');
}

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 5, 'SUMARIO', 0, 1, 'C');
$pdf->Cell(0, 5, utf8_decode("Sesión " . $sesion['tipo'] . " Nro. " . $sesion['codigo']), 0, 1, 'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 10);
$temas = getAgendas($sesion['id']);
foreach ($temas as $tema) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 5, "Tema:", 0, 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 5, utf8_decode($tema['tema']), 0, "J");
    $pdf->Ln(5);
}

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 5, 'RESOLUCIONES', 0, 1, 'C');
$pdf->Cell(0, 5, utf8_decode("Sesión " . $sesion['tipo'] . " Nro. " . $sesion['codigo']), 0, 1, 'C');
$pdf->Ln(5);

$resoluciones = getResoluciones($sesion['id']);
foreach($resoluciones as $resolucion){
    $newDate = date("d/m/Y", strtotime($resolucion['fecha']));
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 5, utf8_decode("Resolución Nº ".$resolucion['codigo']." de fecha ".$newDate), 0, 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 5, utf8_decode($resolucion['descripcion']), 0, "J");
    $pdf->Ln(5);
    $sello = getSello($resolucion['sello_id']);
    $presidente = getFirmante($resolucion['presidente_id']);
    $secretario = getFirmante($resolucion['secretario_id']);
}

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 5, 'AUTORIDADES', 0, 1, 'C');
$pdf->Cell(0, 5, utf8_decode("Sesión " . $sesion['tipo'] . " Nro. " . $sesion['codigo']), 0, 1, 'C');
$pdf->Ln(50);

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->Image($sello['path'], 80, $y + 5, 50, 50);
$yfirma = $y + 5;
$y = $pdf->GetY();
$pdf->SetY($y + 25);
$pdf->Cell(70,5,'__________________________', 0, 0, 'C');
$pdf->Cell(50,5,'', 0, 0, 'C');
$pdf->Cell(70,5,'__________________________', 0, 1, 'C');

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

$pdf->Output('I', "GACETA NRO " . strtoupper($gaceta['numero']), true);
?>
