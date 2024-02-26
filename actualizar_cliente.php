<?php
// Incluir el archivo de configuración
require_once 'config.php';

if(isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['edad'])) {
    // Recuperar datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];

    try {
        // Preparar la consulta SQL para actualizar el cliente
        $stmt = $conn->prepare("UPDATE cliente SET Nombre = :nombre, Apellido = :apellido, Edad = :edad WHERE ID = :id");
        // Asignar valores a los parámetros de la consulta
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':edad', $edad);
        $stmt->bindParam(':id', $id);
        // Ejecutar la consulta
        $stmt->execute();
        // Redirigir al index.php después de actualizar el cliente
        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        // En caso de error, mostrar el mensaje de error
        echo "Error al actualizar cliente: " . $e->getMessage();
    }
} else {
    // Si no se enviaron datos del formulario, redirigir al index.php
    header("Location: index.php");
    exit();
}
?>
