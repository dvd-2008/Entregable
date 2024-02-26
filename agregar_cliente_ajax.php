<?php
// Incluir el archivo de configuración
require_once 'config.php';

if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['edad'])) {
    // Recuperar datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];

    try {
        // Preparar la consulta SQL para insertar un nuevo cliente
        $stmt = $conn->prepare("INSERT INTO cliente (Nombre, Apellido, Edad) VALUES (:nombre, :apellido, :edad)");
        // Asignar valores a los parámetros de la consulta
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':edad', $edad);
        // Ejecutar la consulta
        $stmt->execute();

        // Obtener la lista actualizada de clientes
        $stmt = $conn->query("SELECT * FROM cliente");
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Construir la tabla de clientes
        $tablaClientes = '<table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Acciones</th>
            </tr>';
        foreach ($clientes as $cliente) {
            $tablaClientes .= "<tr>";
            $tablaClientes .= "<td>{$cliente['ID']}</td>";
            $tablaClientes .= "<td>{$cliente['Nombre']}</td>";
            $tablaClientes .= "<td>{$cliente['Apellido']}</td>";
            $tablaClientes .= "<td>{$cliente['Edad']}</td>";
            $tablaClientes .= "<td>";
            $tablaClientes .= "<button class='btn' onclick='abrirPopupEditar({$cliente['ID']})'>Editar</button>";
            $tablaClientes .= "<button class='btn' onclick='eliminarCliente({$cliente['ID']})'>Eliminar</button>";
            $tablaClientes .= "</td>";
            $tablaClientes .= "</tr>";
        }
        $tablaClientes .= '</table>';

        // Devolver la tabla de clientes
        echo $tablaClientes;
    } catch(PDOException $e) {
        // En caso de error, mostrar el mensaje de error
        echo "Error al agregar cliente: " . $e->getMessage();
    }
} else {
    // Si no se enviaron datos del formulario, mostrar un mensaje de error
    echo "Error: No se recibieron datos del formulario.";
}
?>
