<?php
require_once '../app/conexion.php';
if (isset($_POST['id_prov'])) {
    $id_prov = $_POST['id_prov'];
    $conn = conectar();
    $sql = "SELECT id_dist, nom_dist FROM tb_distrito WHERE id_prov = ? ORDER BY nom_dist";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $id_prov);
    $stmt->execute();
    $result = $stmt->get_result();
    echo '<option value="">Seleccione Distrito</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id_dist'] . '">' . htmlspecialchars($row['nom_dist']) . '</option>';
    }
    $stmt->close();
    $conn->close();
}
