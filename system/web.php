<?php
// Ruta para registrar médico
if ($_SERVER['REQUEST_URI'] === '/system/registrar_medico') {
    require 'controller_medico.php';
}
// Ruta para registrar paciente
if ($_SERVER['REQUEST_URI'] === '/system/registrar_paciente') {
    require 'controller_paciente.php';
}
// Ruta para registrar atención médica
if ($_SERVER['REQUEST_URI'] === '/system/registrar_atencion') {
    require 'controller_atencion.php';
}
