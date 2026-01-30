<?php

namespace App\Models;

use mysqli;

class Triaje
{
    private $db;
    private $table = 'tb_triaje';

    public function __construct()
    {
        global $mysqli;
        $this->db = $mysqli;
    }

    /**
     * Guarda un nuevo registro de triaje en la BD
     */
    public function guardar($data)
    {
        $query = "
            INSERT INTO {$this->table} (
                id_cita,
                numdoc_paciente,
                temp,
                presion,
                spo2,
                pulso,
                talla,
                peso,
                IMC,
                interp,
                Alergias,
                fecha_registro
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ";

        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Prepare error: " . $this->db->error);
            return ['success' => false, 'message' => 'Error en la preparación de la consulta'];
        }

        // Convertir valores
        // id_cita puede ser NULL, lo guardamos como NULL en la BD
        $id_cita = !empty($data['id_cita']) ? intval($data['id_cita']) : null;
        $numdoc = $data['numdoc_paciente'] ?? '';
        $temp = !empty($data['temp']) ? floatval($data['temp']) : null;
        $presion = $data['presion'] ?? '';
        $spo2 = !empty($data['spo2']) ? floatval($data['spo2']) : null;
        $pulso = !empty($data['pulso']) ? floatval($data['pulso']) : null;
        $talla = !empty($data['talla']) ? floatval($data['talla']) : null;
        $peso = !empty($data['peso']) ? floatval($data['peso']) : null;
        $imc = !empty($data['imc']) ? floatval($data['imc']) : null;
        $interp = $data['imc_interp'] ?? '';
        $alergias = $data['alergias'] ?? '';

        // Bind parameters con tipos correctos: i=int, s=string, d=double
        // id_cita (int, nullable), numdoc (string), temp (double), presion (string), 
        // spo2 (double), pulso (double), talla (double), peso (double), imc (double), 
        // interp (string), alergias (string)
        $stmt->bind_param(
            'isdsdddddss',
            $id_cita,
            $numdoc,
            $temp,
            $presion,
            $spo2,
            $pulso,
            $talla,
            $peso,
            $imc,
            $interp,
            $alergias
        );

        if (!$stmt->execute()) {
            error_log("Execute error: " . $stmt->error);
            return ['success' => false, 'message' => 'Error al guardar el triaje: ' . $stmt->error];
        }

        $id_triaje = $this->db->insert_id;
        $stmt->close();

        return [
            'success' => true,
            'message' => 'Triaje registrado correctamente',
            'id_triaje' => $id_triaje
        ];
    }

    /**
     * Obtiene un triaje por ID
     */
    public function getById($id)
    {
        if (!$id) return null;

        $query = "SELECT * FROM {$this->table} WHERE id_triaje = ?";
        $stmt = $this->db->prepare($query);
        if (!$stmt) return null;

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $triaje = $result->fetch_assoc();
        $stmt->close();

        return $triaje;
    }

    /**
     * Obtiene todos los triajes de un paciente
     */
    public function getTriajesPaciente($numdoc)
    {
        if (!$numdoc) return null;

        $query = "
            SELECT * FROM {$this->table} 
            WHERE numdoc_paciente = ?
            ORDER BY fecha_registro DESC
        ";
        $stmt = $this->db->prepare($query);
        if (!$stmt) return null;

        $stmt->bind_param('s', $numdoc);
        $stmt->execute();
        $result = $stmt->get_result();
        $triajes = [];

        while ($row = $result->fetch_assoc()) {
            $triajes[] = $row;
        }

        $stmt->close();
        return !empty($triajes) ? $triajes : null;
    }

    /**
     * Obtiene triajes por rango de fechas
     */
    public function getTriajesPorFecha($fecha_inicio, $fecha_fin)
    {
        $query = "
            SELECT * FROM {$this->table} 
            WHERE DATE(fecha_registro) BETWEEN ? AND ?
            ORDER BY fecha_registro DESC
        ";
        $stmt = $this->db->prepare($query);
        if (!$stmt) return null;

        $stmt->bind_param('ss', $fecha_inicio, $fecha_fin);
        $stmt->execute();
        $result = $stmt->get_result();
        $triajes = [];

        while ($row = $result->fetch_assoc()) {
            $triajes[] = $row;
        }

        $stmt->close();
        return !empty($triajes) ? $triajes : null;
    }

    /**
     * Obtiene el triaje del día de hoy para un paciente
     */
    public function getTriajeHoy($numdoc)
    {
        if (!$numdoc) return null;

        $query = "
            SELECT * FROM {$this->table} 
            WHERE numdoc_paciente = ?
            AND DATE(fecha_registro) = CURDATE()
            ORDER BY fecha_registro DESC
            LIMIT 1
        ";
        $stmt = $this->db->prepare($query);
        if (!$stmt) return null;

        $stmt->bind_param('s', $numdoc);
        $stmt->execute();
        $result = $stmt->get_result();
        $triaje = $result->fetch_assoc();
        $stmt->close();

        return $triaje;
    }

    /**
     * Obtiene el id_triaje y id_cita por número de documento
     */
    public function obtenerIdPorDocumento($numdoc)
    {
        $stmt = $this->db->prepare("SELECT id_triaje, id_cita FROM tb_triaje WHERE numdoc_paciente = ? ORDER BY id_triaje DESC LIMIT 1");
        $stmt->bind_param('s', $numdoc);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
