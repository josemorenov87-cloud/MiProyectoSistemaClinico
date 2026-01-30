<?php
require_once '../app/conexion.php';
if (isset($_POST['id_depart'])) {
    $id_depart = $_POST['id_depart'];
    $conn = conectar();
    $sql = "SELECT id_prov, nom_prov FROM tb_provincia WHERE id_depart = ? ORDER BY nom_prov";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $id_depart);
    $stmt->execute();
    $result = $stmt->get_result();
    echo '<option value="">Seleccione Provincia</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id_prov'] . '">' . htmlspecialchars($row['nom_prov']) . '</option>';
    }
    $stmt->close();
    $conn->close();
}
?>
