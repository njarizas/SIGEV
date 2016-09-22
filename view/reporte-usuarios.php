<?php
require('../controlador/reportes/fpdf.php');

$pdf = new FPDF();
//$pdf->Image('../view/img/SIGEV.PNG',10,8,33,'PNG');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
require_once '../model/dto/Usuario.class.php';
require_once '../model/dao/implementacion/UsuariosMySqlDAO.class.php';
require_once '../model/dao/implementacion/TiposDocumentoMySqlDAO.class.php';
$usuarioDAO = new UsuariosMySqlDAO();
$pdf->Cell(40, 10, utf8_decode('Lista de Usuarios'));
$pdf->SetFont('Arial', 'U', 10);
$usuarioslis = $usuarioDAO->listarTodos();
foreach ($usuarioslis as $fila) {
    $pdf->Ln();
    $pdf->Cell(25, 10, utf8_decode($fila['documento']));
    $pdf->Cell(50, 10, utf8_decode($fila['nombres']));
    $pdf->Cell(60, 10, utf8_decode(trim($fila['apellido1']) . ' ' . $fila['apellido2']));
    $pdf->Cell(50, 10, utf8_decode($fila['correo']));
}
$pdf->Output();