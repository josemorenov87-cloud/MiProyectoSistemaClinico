<?php
namespace App\Models;

class HorarioMedico {
    private $conexion;
    private $tabla = 'tb_horariomed';

    public function __construct() {
        global $mysqli;
        $this->conexion = $mysqli;
    }

    /**
     * Guardar nuevo horario
     */
    public function guardar($id_medico, $fecha, $hora, $hora_fin, $estado) {
        $query = "INSERT INTO " . $this->tabla . " (id_med, fecha, hora, hora_fin, estado) 
                  VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $this->conexion->prepare($query);
        
        if (!$stmt) {
            error_log("Error preparando consulta: " . $this->conexion->error);
            return false;
        }

        $stmt->bind_param("isssi", $id_medico, $fecha, $hora, $hora_fin, $estado);
        
        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error ejecutando inserción: " . $stmt->error);
            return false;
        }
    }

    /**
     * Obtener todos los horarios de un médico
     */
    public function obtenerPorMedico($id_medico) {
        $query = "SELECT * FROM " . $this->tabla . " 
                  WHERE id_med = ? 
                  ORDER BY fecha ASC, hora ASC";
        
        $stmt = $this->conexion->prepare($query);
        
        if (!$stmt) {
            error_log("Error preparando consulta: " . $this->conexion->error);
            return [];
        }

        $stmt->bind_param("i", $id_medico);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $horarios = [];
        while ($row = $resultado->fetch_assoc()) {
            $horarios[] = $row;
        }
        
        return $horarios;
    }

    /**
     * Obtener un horario específico por ID
     */
    public function obtenerPorId($id_horario) {
        $query = "SELECT * FROM " . $this->tabla . " WHERE id_horariomed = ?";
        
        $stmt = $this->conexion->prepare($query);
        
        if (!$stmt) {
            error_log("Error preparando consulta: " . $this->conexion->error);
            return null;
        }

        $stmt->bind_param("i", $id_horario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado->num_rows > 0) {
            return $resultado->fetch_assoc();
        }
        
        return null;
    }

    /**
     * Eliminar un horario
     */
    public function eliminar($id_horario) {
        $query = "DELETE FROM " . $this->tabla . " WHERE id_horariomed = ?";
        
        $stmt = $this->conexion->prepare($query);
        
        if (!$stmt) {
            error_log("Error preparando consulta: " . $this->conexion->error);
            return false;
        }

        $stmt->bind_param("i", $id_horario);
        
        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error ejecutando eliminación: " . $stmt->error);
            return false;
        }
    }

    /**
     * Actualizar estado de un horario
     */
    public function actualizarEstado($id_horario, $estado) {
        $query = "UPDATE " . $this->tabla . " SET estado = ? WHERE id_horariomed = ?";
        
        $stmt = $this->conexion->prepare($query);
        
        if (!$stmt) {
            error_log("Error preparando consulta: " . $this->conexion->error);
            return false;
        }

        $stmt->bind_param("ii", $estado, $id_horario);
        
        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error ejecutando actualización: " . $stmt->error);
            return false;
        }
    }

    /**
     * Obtener horarios disponibles de un médico en una fecha
     */
    public function obtenerDisponiblesPorFecha($id_medico, $fecha) {
        $query = "SELECT * FROM " . $this->tabla . " 
                  WHERE id_med = ? AND fecha = ? AND estado = 1
                  ORDER BY hora ASC";
        
        $stmt = $this->conexion->prepare($query);
        
        if (!$stmt) {
            error_log("Error preparando consulta: " . $this->conexion->error);
            return [];
        }

        $stmt->bind_param("is", $id_medico, $fecha);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $horarios = [];
        while ($row = $resultado->fetch_assoc()) {
            $horarios[] = $row;
        }
        
        return $horarios;
    }
}
