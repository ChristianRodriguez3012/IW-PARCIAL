<?php
// Define las credenciales y el nombre de la base de datos
$servername = "db";
$username = "pc";
$password = "pc";
$dbname = "petclinic";

// Crea una nueva conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica si la conexión fue exitosa
if ($conn->connect_error) {
    // Si hay un error, termina la ejecución del script y muestra un mensaje de error
    die("Conexión fallida: " . $conn->connect_error);
}

// Define las consultas SQL para obtener todos los registros de las tablas 'pets' y 'owners'
$sql_pets = "SELECT * FROM pets";
$sql_owners = "SELECT * FROM owners";

// Ejecuta las consultas y guarda los resultados
$result_pets = $conn->query($sql_pets);
$result_owners = $conn->query($sql_owners);

// Si hay resultados para la consulta de 'pets', los muestra
if ($result_pets->num_rows > 0) {
    echo "<h2>Pets</h2><ul>";
    while($row = $result_pets->fetch_assoc()) {
        echo "<li>" . $row["name"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "0 results for pets";
}

// Si hay resultados para la consulta de 'owners', los muestra
if ($result_owners->num_rows > 0) {
    echo "<h2>Owners</h2><ul>";
    while($row = $result_owners->fetch_assoc()) {
        echo "<li>" . $row["first_name"] . " " . $row["last_name"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "0 results for owners";
}

// Cierra la conexión a la base de datos
$conn->close();
?>