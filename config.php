<?php
$host = 'localhost'; 
$dbname = 'cliente'; //
$username = 'root'; 
$password = ''; 
$port = '3309'; 

try {
    
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password); 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa";
} catch(PDOException $e) {    
    echo "Error de conexión: " . $e->getMessage();
}
?>
