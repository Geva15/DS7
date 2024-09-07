<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Automóviles</title>
    <link rel="stylesheet" href="assets\css\style.css">
</head>
<body>
    <div id="contenedor1">
        <h2>Registrar Automóvil</h2>
    </div>
    <form action="procesar_registro.php" method="post">
        <label for="placa">Placa:</label>
        <input type="text" id="placa" name="placa" required><br>

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required><br>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required><br>

        <label for="anio">Año:</label>
        <input type="number" id="anio" name="anio" required><br>

        <label for="color">Color:</label>
        <input type="text" id="color" name="color" required><br>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>
