<?php
// Incluir el archivo de configuración
require_once 'config.php';

if(isset($_GET['id'])) {
    // Recuperar el ID del cliente
    $id = $_GET['id'];

    try {
        // Preparar la consulta SQL para borrar el cliente
        $stmt = $conn->prepare("DELETE FROM cliente WHERE ID = :id");
        // Asignar valor al parámetro de la consulta
        $stmt->bindParam(':id', $id);
        // Ejecutar la consulta
        $stmt->execute();
        // Redirigir de nuevo al index.php después de borrar el cliente
        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        // En caso de error, mostrar el mensaje de error
        echo "Error al borrar cliente: " . $e->getMessage();
    }
} else {
    // Si no se envió el ID del cliente a borrar, redirigir al index.php
    header("Location: index.php");
    exit();
}
?>
