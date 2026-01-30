<?php
/**
 * Controlador para listar CIE-10
 */
namespace App\Controllers;

class Cie10Controller {
    public function index() {
        header('Content-Type: application/json');
        $conn = getConnection();

        $esp = $_GET['esp'] ?? null;
        $sql = "SELECT id_cie10, diag_cie10, esp_cie10 FROM tb_cie10";
        $params = [];
        $types = '';

        if (!empty($esp)) {
            $sql .= " WHERE esp_cie10 = ?";
            $params[] = $esp;
            $types .= 'i';
        }
        $sql .= " ORDER BY diag_cie10";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'No se pudo preparar la consulta']);
            exit;
        }

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $rs = $stmt->get_result();
        $data = [];
        while ($row = $rs->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();

        echo json_encode(['success' => true, 'cie10' => $data]);
        exit;
    }
}
