<?php

require('../controlador/reportes/fpdf.php');

$pdf = new FPDF();
//$pdf->Image('../view/img/SIGEV.PNG',10,8,33,'PNG');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);

require_once '../model/dao/implementacion/CursosMySqlDAO.class.php';
require_once '../model/dto/Curso.class.php';
require_once '../model/dao/implementacion/PreguntasMySqlDAO.class.php';
require_once '../model/dto/Pregunta.class.php';

$cursoDAO = new CursosMySqlDAO();
$pdf->Cell(40, 10, utf8_decode('Cursos'));
$pdf->SetFont('Arial', 'U', 10);
$cursoslis = $cursoDAO->listarTodos();

foreach ($cursoslis as $fila) {
    $pdf->Ln();
    $pdf->Cell(25, 10, utf8_decode($fila['idcurso']));
    $pdf->Cell(50, 10, utf8_decode($fila['nombrecurso']));
}

$preguntasDAO = new PreguntasMySqlDAO();
$preglis = $preguntasDAO->listarTodos();
$pdf->Ln();
$pdf->Cell(40, 10, utf8_decode('Preguntas'));

foreach ($preglis as $fila) {
    $pdf->Ln();
    $pdf->Cell(20, 10, utf8_decode($fila['idpregunta']));
    $pdf->Cell(80, 10, utf8_decode($fila['enunciado']));
    $pdf->Cell(50, 10, utf8_decode($fila['valorpregunta']));
}

$pdf->Output();
