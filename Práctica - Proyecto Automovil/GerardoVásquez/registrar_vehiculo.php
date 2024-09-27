<?php
include 'includes/database.php';
$cedula_propietario = isset($_GET['cedula']) ? $_GET['cedula'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar vehiculo</title>
    <link rel="stylesheet" href="assets\css\style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <button id="inicio">Volver</button>
    </header>
    <div class="content2">
        <div class="contenedor1">
            <h1>Registro de Vehículo</h1>
            <form action="procesos/procesar_registro.php" method="post">
                <div class="contenedor2">
                    <div class="contenedor3">
                        <label for="placa">Placa del Vehículo:</label>
                        <input type="text" id="placa" name="placa" required>
                    </div>

                    <div class="contenedor3">
                        <label for="marca">Marca:</label>
                        <select id="marca" name="marca" required>
                            <option value="">Seleccione una marca</option>
                        </select>
                    </div>

                    <div class="contenedor3">
                        <label for="modelo">Modelo:</label>
                        <select id="modelo" name="modelo" required>
                            <option value="">Seleccione un modelo</option>
                        </select>
                    </div>

                    <div class="contenedor3">
                        <label for="anio">Año:</label>
                        <input type="number" id="anio" name="anio" required>
                    </div>

                    <div class="contenedor3">
                        <label for="color">Color:</label>
                        <input type="text" id="color" name="color" required>
                    </div>

                    <div class="contenedor3">
                        <label for="numero_motor">Número de Motor:</label>
                        <input type="text" id="numero_motor" name="numero_motor" required>
                    </div>

                    <div class="contenedor3">
                        <label for="numero_chasis">Número de Chasis:</label>
                        <input type="text" id="numero_chasis" name="numero_chasis" required>
                    </div>

                    <div class="contenedor3">
                        <label for="tipo_vehiculo">Tipo de Vehículo:</label>
                        <select id="tipo_vehiculo" name="tipo_vehiculo" required>
                            <option value="">Seleccione un tipo</option>
                        </select>
                    </div>
                    <div class="contenedor3">
                        <label for="propietario">Cédula del Propietario:</label>
                        <input type="text" id="propietario" name="propietario" value="<?php echo htmlspecialchars($cedula_propietario); ?>" required>
                    </div>
                </div>
                <input type="submit" value="Registrar">
            </form>
        </div>
    </div>
    <footer>
            <h3>Gerardo Vasquez</h3>
            <h3>8-1002-2180</h3>
            <h3>1LS131</h3>
    </footer>
</body>
<script>
    document.getElementById('inicio').onclick = function() {
        window.location.href = 'index.php'; // Redirigir a la pagina principal.php
    };  
    $(document).ready(function() {

        $.ajax({
            type: 'POST', 
            url: 'assets/ajax/get_marca.php', 
            success: function(response) {
                console.log(response);
                
                $('#marca').html(response);
            },
            error: function(xhr, status, error) {
                // Manejo de errores en caso de que la solicitud falle
                console.error('Error al obtener las marcas de autos:', error);
            }
        }); 
        $('#marca').change(function(){
            var id_marca = $(this).val();
            if (id_marca) {
                $.ajax({
                    type: 'POST', // Método de solicitud HTTP (POST) para enviar los datos al servidor
                    url: 'assets/ajax/get_modelo.php', // URL del archivo PHP que manejará la solicitud y devolverá los datos
                    data: { id_marca: id_marca }, // Datos enviados en la solicitud, en este caso, el ID de la marca
                    success: function(response) {
                        console.log(response)
                        // Si la solicitud tiene éxito, actualizar el combobox de distrito con los datos recibidos (opciones HTML)
                        $('#modelo').html(response);
                    },
                    error: function(xhr, status, error) {
                        // Manejo de errores en caso de que la solicitud falle
                        console.error('Error al obtener los modelos de autos:', error);
                    }
                });
            } else {
                
                $('#modelo').html('<option value="">Seleccione un modelo de auto</option>');
                $('#tipo_vehiculo').html('<option value="">Seleccione un tipo de auto</option>');
            }
        }); 
            
        $('#modelo').change(function(){
            var id_modelo = $(this).val();

            if (id_modelo) {
                $.ajax({
                    type: 'POST', // Método de solicitud HTTP (POST) para enviar los datos al servidor
                    url: 'assets/ajax/get_tipo_vehiculo.php', 
                    data: { id_modelo: id_modelo }, 
                    success: function(response) {
                        console.log(response)
                        
                        $('#tipo_vehiculo').html(response);
                    },
                    error: function(xhr, status, error) {
                        // Manejo de errores en caso de que la solicitud falle
                        console.error('Error al obtener los tipos de autos:', error);
                    }
                });
            } else {
                
                $('#tipo_vehiculo').html('<option value="">Seleccione un tipo</option>');
            }
        });
    });
    
</script>
</html>