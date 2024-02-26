<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Cliente - Alumno Sonny Pinillo</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 60%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        th:first-child {
            width: 100px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        .btn-agregar {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        .btn-agregar:hover {
            background-color: #45a049;
        }

        .btn-eliminar {
            background-color: #f44336;
            color: white;
            border: none;
        }

        .btn-eliminar:hover {
            background-color: #d32f2f;
        }

        .btn-editar {
            background-color: #008CBA;
            color: white;
            border: none;
        }

        .btn-editar:hover {
            background-color: #007EA7;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>CRUD de Cliente - Alumno Sonny Pinillo</h2>

        <table id="tablaClientes">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Acciones</th>
            </tr>
            <?php
            // Incluir el archivo de configuración
            require_once 'config.php';

            // Consultar la lista de clientes
            $stmt = $conn->query("SELECT * FROM cliente");
            $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Mostrar la lista de clientes
            foreach ($clientes as $cliente) {
                echo "<tr>";
                echo "<td>{$cliente['ID']}</td>";
                echo "<td>{$cliente['Nombre']}</td>";
                echo "<td>{$cliente['Apellido']}</td>";
                echo "<td>{$cliente['Edad']}</td>";
                echo "<td>";
                echo "<button class='btn btn-editar' onclick='abrirPopupEditar({$cliente['ID']})'>Editar</button>";
                echo "<button class='btn btn-eliminar' onclick='eliminarCliente({$cliente['ID']})'>Eliminar</button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>

        <form id="agregarForm">
            <input type="text" id="nombre" name="nombre" placeholder="Nombre">
            <input type="text" id="apellido" name="apellido" placeholder="Apellido">
            <input type="text" id="edad" name="edad" placeholder="Edad">
            <button type="submit" class="btn btn-agregar">Agregar Cliente</button>
        </form>

    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('agregarForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            fetch('agregar_cliente_ajax.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('tablaClientes').innerHTML = data;
                limpiarCampos(); // Llama a la función para limpiar los campos del formulario
            })
            .catch(error => console.error('Error:', error));
        });
    });

    function limpiarCampos() {
        // Obtiene los campos del formulario y los establece en vacío
        document.getElementById('nombre').value = '';
        document.getElementById('apellido').value = '';
        document.getElementById('edad').value = '';
    }

    function eliminarCliente(id) {
        if(confirm("¿Estás seguro de que deseas eliminar este cliente?")) {
            fetch('eliminar_cliente_ajax.php?id=' + id)
            .then(response => response.text())
            .then(data => {
                document.getElementById('tablaClientes').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
        }
    }

    function abrirPopupEditar(id) {
        window.open('popup_editar_cliente.php?id=' + id, 'Editar Cliente', 'width=400,height=300');
    }
    </script>
</body>
</html>
