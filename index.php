<?php
$connect = mysqli_connect("localhost", "id20935269_robot_chile_sa", "Colombia01+", "id20935269_robot_chile_sa");

$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';
$tipo_doc = isset($_POST['tipo_doc']) ? $_POST['tipo_doc'] : '';
$nombre_cliente = isset($_POST['nombre_cliente']) ? $_POST['nombre_cliente'] : '';
$apellido_cliente = isset($_POST['apellido_cliente']) ? $_POST['apellido_cliente'] : '';
$queja = isset($_POST['queja']) ? $_POST['queja'] : '';
$nombre_departamento = isset($_POST['nombre_departamento']) ? $_POST['nombre_departamento'] : '';
$nombre_empleado_dep = isset($_POST['nombre_empleado_dep']) ? $_POST['nombre_empleado_dep'] : '';

$email_error = '';
$message_error = '';

// Comprobación de errores en el formulario
if (count($_POST)) {
    $errors = 0;

    if ($_POST['email'] == '') {
        $email_error = 'Por favor, ingresa una dirección de correo electrónico';
        $errors++;
    }

    if ($_POST['message'] == '') {
        $message_error = 'Por favor, ingresa un mensaje';
        $errors++;
    }

    // Si no hay errores, procedemos a insertar en la base de datos y enviar el correo
    if ($errors == 0) {
        // Insertar en la base de datos
        $query = 'INSERT INTO contact (
                tipo_doc,
                nombre_cliente,
                apellido_cliente,
                email,
                queja,
                nombre_departamento,
                nombre_empleado_dep,
                message
            ) VALUES (
                "' . addslashes($tipo_doc) . '",
                "' . addslashes($nombre_cliente) . '",
                "' . addslashes($apellido_cliente) . '",
                "' . addslashes($email) . '",
                "' . addslashes($queja) . '",
                "' . addslashes($nombre_departamento) . '",
                "' . addslashes($nombre_empleado_dep) . '",
                "' . addslashes($message) . '"
            )';
        mysqli_query($connect, $query);

        // Enviar correo
        $message = 'Has recibido un formulario de contacto:
            
Tipo de Documento: ' . $_POST['tipo_doc'] . '
Nombre Cliente: ' . $_POST['nombre_cliente'] . '
Apellido Cliente: ' . $_POST['apellido_cliente'] . '
Email: ' . $_POST['email'] . '
Queja: ' . $_POST['queja'] . '
Nombre Departamento: ' . $_POST['nombre_departamento'] . '
Nombre Empleado Departamento: ' . $_POST['nombre_empleado_dep'] . '
Mensaje: ' . $_POST['message'];

        mail('poveda.geovanny@hotmail.com', 'Formulario de contacto', $message);

        // Redirección a thankyou.php con los datos del cliente, departamento y empleado
        header('Location: thankyou.php?cliente=' . urlencode($nombre_cliente) . '&departamento=' . urlencode($nombre_departamento) . '&empleado=' . urlencode($nombre_empleado_dep));
        die(); // Detenemos la ejecución del script
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Formulario de Contacto PHP</title>
    <!-- Agregar enlaces a los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
      <style>
        /* Estilos para centrar la imagen */
    
        /* Estilos para controlar el ancho del botón */
        button.btn-lg {
            width: 1110px; /* Define el ancho deseado del botón, ajusta según tus necesidades */
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <br>
        <br>
        <h1 class="display-4">Formulario de Contacto PHP</h1>

        <form method="post" action="" class="needs-validation" novalidate>

            <div class="form-group">
                <label for="tipo_doc">Tipo de Documento:</label>
                <input type="text" class="form-control" id="tipo_doc" name="tipo_doc" value="<?php echo $tipo_doc; ?>" required>
            </div>

            <div class="form-group">
                <label for="nombre_cliente">Nombre Cliente:</label>
                <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" value="<?php echo $nombre_cliente; ?>" required>
            </div>

            <div class="form-group">
                <label for="apellido_cliente">Apellido Cliente:</label>
                <input type="text" class="form-control" id="apellido_cliente" name="apellido_cliente" value="<?php echo $apellido_cliente; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                <div class="invalid-feedback">
                    Por favor, ingresa una dirección de correo electrónico válida.
                </div>
            </div>

            <div class="form-group">
                <label for="queja">Motivo de su solicitud o queja:</label>
                <input type="text" class="form-control" id="queja" name="queja" value="<?php echo $queja; ?>">
            </div>

            <div class="form-group">
                <label for="nombre_departamento">Nombre Departamento:</label>
                <select class="form-control" id="nombre_departamento" name="nombre_departamento">
                    <option value=""></option>
                    <option value="atencion_al_cliente">Atención al Cliente</option>
                    <option value="soporte_tecnico">Soporte Técnico</option>
                    <option value="facturacion">Facturación</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nombre_empleado_dep">Nombre Empleado Departamento:</label>
                <input type="text" class="form-control" id="nombre_empleado_dep" name="nombre_empleado_dep" value="<?php echo $nombre_empleado_dep; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="message">Mensaje:</label>
                <textarea class="form-control" id="message" name="message" rows="4" required><?php echo $message; ?></textarea>
                <div class="invalid-feedback">
                    Por favor, ingresa un mensaje.
                </div>
            </div>
  <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
            
         
        </form>
    </div>
<br>
<br>
<br>
<br>
    <!-- Agregar enlaces a los archivos JS de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // JavaScript para cambiar el valor del campo "Nombre Empleado Departamento" cuando se selecciona un departamento
        document.getElementById('nombre_departamento').addEventListener('change', function() {
            var departamento = this.value;
            var empleados = {
                "atencion_al_cliente": ["Maria Soler", "Cristian Jaramillo", "Ana Lucia Perez", "Juan Guillermo Paez"],
                "soporte_tecnico": ["Maria Gutierrez", "Alex Gomez", "Jhon Tapiero", "Sonia Aguilera"],
                "facturacion": ["Camilo Garcia", "Alberto Gomez", "Cristina Marmoler", "Sol Malambo"]
            };
            var empleadoAleatorio = empleados[departamento][Math.floor(Math.random() * empleados[departamento].length)];
            document.getElementById('nombre_empleado_dep').value = empleadoAleatorio;
        });

        // JavaScript para validar el formulario con Bootstrap
        (function() {
            'use strict';

            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');

                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

</body>

</html>
