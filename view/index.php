<?php
include ("header.php");
if ($_SESSION['usuario']['rol'] == 1) {
    echo 'Bienvenido, estudiante: ' . $_SESSION['usuario']['nombres'];
} else if ($_SESSION['usuario']['rol'] == 2) {
    echo 'Bienvenido, profesor: ' . $_SESSION['usuario']['nombres'];
} else if ($_SESSION['usuario']['rol'] == 3) {
    echo 'Bienvenido, administrativo: ' . $_SESSION['usuario']['nombres'];
}
include ("footer.php");
?>