<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "usuario";
$password = "123";
$dbname = "petclinic";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta a la tabla 'pets'
$sql_pets = "SELECT * FROM pets";
$result_pets = $conn->query($sql_pets);

if ($result_pets->num_rows > 0) {
    echo "<h2>Mascotas:</h2>";
    while($row = $result_pets->fetch_assoc()) {
        echo "Nombre: " . $row["name"]. "<br>";
    }
} else {
    echo "No se encontraron mascotas.";
}

// Consulta a la tabla 'owners'
$sql_owners = "SELECT * FROM owners";
$result_owners = $conn->query($sql_owners);

if ($result_owners->num_rows > 0) {
    echo "<h2>Propietarios:</h2>";
    while($row = $result_owners->fetch_assoc()) {
        echo "Nombre: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
    }
} else {
    echo "No se encontraron propietarios.";
}

$conn->close();
?>
