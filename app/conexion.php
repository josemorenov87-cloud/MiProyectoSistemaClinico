<?php
// Legacy connection wrapper for backward compatibility
// Delegates to new unified config in config/database.php

require_once __DIR__ . '/../config/database.php';

// Provide $conn for legacy includes
$conn = getConnection();

if (!function_exists('conectar')) {
    function conectar() {
        return getConnection();
    }
}
?>