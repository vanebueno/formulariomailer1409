<?php
$connect = mysqli_connect("localhost", "id20935269_robot_chile_sa", "Colombia01+", "id20935269_robot_chile_sa");

// Ontengo el ID
$query = "SELECT id FROM contact ORDER BY id DESC LIMIT 1";
$result = mysqli_query($connect, $query);

$next_id = 1; // Valor predeterminado si no hay registros en la tabla

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $next_id = $row['id'];
}
?>

<!doctype html>
<html>
<head>
    <title>Gracias!!!</title>
    <style>
        /* Estilos para centrar la imagen */
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Esto asegura que ocupe toda la altura de la pantalla */
        }
         /* Estilos para aumentar el tamaño del texto en los párrafos */
        p {
            font-size: 120%; /* Aumentar el tamaño del texto al 120% del tamaño predeterminado */
        }
        
    </style>
</head>
<body>
    
     <!-- Agregar una imagen después del párrafo -->
    <img src="img/gracias.jpg" alt="Imagen de agradecimiento" width="300" height="200">

    <h1>Numero de solicitud: <?php echo $next_id; ?></h1>

    <p>Gracias por contactarnos: <?php echo isset($_GET['cliente']) ? $_GET['cliente'] : 'Cliente no especificado'; ?></p>
    <p>Departamento: <?php echo isset($_GET['departamento']) ? $_GET['departamento'] : 'Departamento no especificado'; ?></p>
    <p>Empleado que lo atenderá: <?php echo isset($_GET['empleado']) ? $_GET['empleado'] : 'Empleado no especificado'; ?></p>

</body>
</html>
