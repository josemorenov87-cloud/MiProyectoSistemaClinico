<?php

namespace App\Models;

use mysqli;

class Cita
{
    private $db;
    private $table = 'tb_citas';

    public function __construct()
    {
        global $mysqli;
        $this->db = $mysqli;
    }

    /**
     * Busca citas activas por número de documento del paciente
     * Ordena por fecha_cita y hora_cita ascendentes
     */
    public function buscarPorDocumento($numdoc)
    {
        if (!$numdoc) return null;

        $query = "
            SELECT 
                c.id_cita,
                c.numdoc_paciente,
                c.id_medico,
                c.id_especialidad,
                c.fecha_cita,
                c.hora_cita,
                c.motivo_cita,
                CONCAT(m.nom_medico, ' ', COALESCE(m.apepat_medico, ''), ' ', COALESCE(m.apemat_medico, '')) as nombre_medico,
                e.desc_especialidad
            FROM {$this->table} c
            LEFT JOIN tb_medicos m ON c.id_medico = m.id_medico
            LEFT JOIN tb_especialidades e ON c.id_especialidad = e.id_especialidad
            WHERE c.numdoc_paciente = ?
            AND c.fecha_cita >= CURDATE()
            ORDER BY c.fecha_cita ASC, c.hora_cita ASC
        ";

        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Prepare error: " . $this->db->error);
            return null;
        }

        $stmt->bind_param('s', $numdoc);
        if (!$stmt->execute()) {
            error_log("Execute error: " . $stmt->error);
            return null;
        }

        $result = $stmt->get_result();
        $citas = [];

        while ($row = $result->fetch_assoc()) {
            $citas[] = $row;
        }

        $stmt->close();
        return !empty($citas) ? $citas : null;
    }

    /**
     * Obtiene una cita específica por ID
     */
    public function getById($id_cita)
    {
        if (!$id_cita) return null;

        $query = "
            SELECT 
                c.id_cita,
                c.numdoc_paciente,
                c.id_medico,
                c.id_especialidad,
                c.fecha_cita,
                c.hora_cita,
                c.motivo_cita,
                CONCAT(m.nom_medico, ' ', COALESCE(m.apepat_medico, ''), ' ', COALESCE(m.apemat_medico, '')) as nombre_medico,
                e.desc_especialidad
            FROM {$this->table} c
            LEFT JOIN tb_medicos m ON c.id_medico = m.id_medico
            LEFT JOIN tb_especialidades e ON c.id_especialidad = e.id_especialidad
            WHERE c.id_cita = ?
        ";

        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Prepare error: " . $this->db->error);
            return null;
        }

        $stmt->bind_param('i', $id_cita);
        if (!$stmt->execute()) {
            error_log("Execute error: " . $stmt->error);
            return null;
        }

        $result = $stmt->get_result();
        $cita = $result->fetch_assoc();
        $stmt->close();

        return $cita;
    }

    /**
     * Obtiene todas las citas de una especialidad en una fecha específica
     */
    public function getCitasPorEspecialidadYFecha($id_especialidad, $fecha)
    {
        if (!$id_especialidad || !$fecha) return null;

        $query = "
            SELECT 
                c.id_cita,
                c.numdoc_paciente,
                c.id_medico,
                c.id_especialidad,
                c.fecha_cita,
                c.hora_cita,
                c.motivo_cita,
                CONCAT(m.nom_medico, ' ', COALESCE(m.apepat_medico, ''), ' ', COALESCE(m.apemat_medico, '')) as nombre_medico
            FROM {$this->table} c
            LEFT JOIN tb_medicos m ON c.id_medico = m.id_medico
            WHERE c.id_especialidad = ? AND c.fecha_cita = ?
            ORDER BY c.hora_cita ASC
        ";

        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Prepare error: " . $this->db->error);
            return null;
        }

        $stmt->bind_param('is', $id_especialidad, $fecha);
        if (!$stmt->execute()) {
            error_log("Execute error: " . $stmt->error);
            return null;
        }

        $result = $stmt->get_result();
        $citas = [];

        while ($row = $result->fetch_assoc()) {
            $citas[] = $row;
        }

        $stmt->close();
        return !empty($citas) ? $citas : null;
    }

    /**
     * Obtiene id_especialidad y id_medico por id_cita
     */
    public function obtenerDatosPorId($id_cita)
    {
        $stmt = $this->db->prepare("SELECT id_especialidad, id_medico FROM tb_citas WHERE id_cita = ? LIMIT 1");
        $stmt->bind_param('i', $id_cita);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
