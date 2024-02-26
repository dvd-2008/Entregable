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
        echo "Error al eliminar cliente: " . $e->getMessage();
    }
} else {
    // Si no se proporciona un ID de cliente, mostrar un mensaje de error
    echo "Error: No se recibió el ID del cliente.";
}
?>
