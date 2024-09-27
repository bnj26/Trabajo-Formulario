<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = htmlspecialchars($_POST['rut']);
    $nombre = htmlspecialchars($_POST['nombre']);
    $correo = htmlspecialchars($_POST['correo']);
    $comentario = htmlspecialchars($_POST['comentario']);
    

    
    if (!empty($rut) && !empty($nombre) && !empty($correo) && !empty($comentario)) {
        
        echo "RUT: $rut<br>";
        echo "Nombre: $nombre<br>";
        echo "Correo: $correo<br>";
        echo "Comentario: $comentario<br>";
        
    } else {
        echo "Por favor, completa todos los campos obligatorios.";
    }
}  
?>
<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "datos";
$conn = mysqli_connect($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$rut = htmlspecialchars($_POST['rut']);
$nombre = htmlspecialchars($_POST['nombre']);
$correo = htmlspecialchars($_POST['correo']);
$comentario = htmlspecialchars($_POST['comentario']);

$sql = "INSERT INTO registro (rut,nombre, correo,comentario) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Error preparando la consulta: " . $conn->error;
    exit;
}

$stmt->bind_param("ssss", $rut, $nombre, $correo, $comentario);

if ($stmt->execute()) {
    echo "Registro exitoso!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>