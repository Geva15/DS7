<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Propietario</title>
    <link rel="stylesheet" href="assets\css\registro_propietario.css">
</head>
<body>
    <header>
        <button id="inicio">Volver</button>
    </header>
    <h2>Registrar Propietario</h2>
    <div class="contenedor">
        <form action="procesos/procesar_registroP.php" method="post">
            <div class="contenedorfila">
                <div class="contenedorcolumna">
                    <label for="cedula">Cédula:</label>
                    <input type="text" id="cedula" name="cedula" required><br>
                </div>

                <div class="contenedorcolumna">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required><br>
                </div>

                <div class="contenedorcolumna">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" required><br>
                </div>
            </div>
            <div class="contenedorfila">
                <div class="contenedorcolumna">
                    <label for="telefono">Telefono:</label>
                    <input type="number" id="telefono" name="telefono" required><br>
                </div>

                <div class="contenedorcolumna">
                    <label for="tipo">Tipo de persona:</label>
                    <select id="tipo" name="tipo" required><br>
                        <option value="natural" selected>Natural</option>
                        <option value="juridico">Jurídico</option>
                    </select>
                </div>

                <div class="contenedorcolumna">
                    <label for="direccion">Direccion:</label>
                    <input type="text" id="direccion" name="direccion" required><br>
                </div>
            </div>
            <div id="botoncito">
                <input type="submit" value="Registrar">
            </div>
        </form>
    </div>
</body>
<script>
    document.getElementById('inicio').onclick = function() {
    window.location.href = 'index.php'; // Redirigir a la pagina de inicio.php
};
</script>
</html>