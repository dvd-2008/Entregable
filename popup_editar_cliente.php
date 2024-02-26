<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>
<body>
    <?php
    // Incluir el archivo de configuración
    require_once 'config.php';

    // Verificar si se ha proporcionado un ID de cliente
    if(isset($_GET['id'])) {
        // Obtener el ID del cliente desde la URL
        $id = $_GET['id'];

        try {
            // Preparar la consulta SQL para obtener la información del cliente
            $stmt = $conn->prepare("SELECT * FROM cliente WHERE ID = :id");
            // Asignar valor al parámetro de la consulta
            $stmt->bindParam(':id', $id);
            // Ejecutar la consulta
            $stmt->execute();
            // Obtener los datos del cliente
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            // En caso de error, mostrar el mensaje de error
            echo "Error al obtener información del cliente: " . $e->getMessage();
            // Salir del script
            exit();
        }
    } else {
        // Si no se proporciona un ID de cliente, mostrar un mensaje de error y salir del script
        echo "No se proporcionó un ID de cliente.";
        exit();
    }
    ?>

    <h2>Editar Cliente</h2>
    <form id="editarForm">
        <input type="hidden" id="id" value="<?php echo $cliente['ID']; ?>">
        Nombre: <input type="text" id="nombre" value="<?php echo $cliente['Nombre']; ?>"><br>
        Apellido: <input type="text" id="apellido" value="<?php echo $cliente['Apellido']; ?>"><br>
        Edad: <input type="text" id="edad" value="<?php echo $cliente['Edad']; ?>"><br>
        <button type="button" onclick="actualizarCliente()">Guardar Cambios</button>
    </form>

    <script>
    function actualizarCliente() {
        var id = document.getElementById('id').value;
        var nombre = document.getElementById('nombre').value;
        var apellido = document.getElementById('apellido').value;
        var edad = document.getElementById('edad').value;

        var formData = new FormData();
        formData.append('id', id);
        formData.append('nombre', nombre);
        formData.append('apellido', apellido);
        formData.append('edad', edad);

        fetch('actualizar_cliente.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            window.opener.location.reload(); // Recargar la página padre (index.php)
            window.close(); // Cerrar la ventana de edición
        })
        .catch(error => console.error('Error:', error));
    }
    </script>
</body>
</html>
