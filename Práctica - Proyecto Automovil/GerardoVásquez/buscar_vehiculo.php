<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de búsqueda de vehículo</title>
    <link rel="stylesheet" href="assets\css\style.css">
</head>
<body>
    <header>
        <button id="inicio">Volver</button>
    </header>
    <div class="content3">
        <div class="contenedorbusq">
            <h1>Busqueda de vehículo</h1>
            <form id="busqueda" action="includes\procesar_busqueda.php" method="get">
                <input type="search" placeholder="Ingrese la placa del vehiculo" id="buscar" name="buscar">
                <button type="submit" id="enviar" name="enviar">Buscar</button>
            </form>
            <div class="resultados" id="resultados">

            </div>
        </div>
    </div>
    <footer>
            <h3>Gerardo Vasquez</h3>
            <h3>8-1002-2180</h3>
            <h3>1LS131</h3>
    </footer>
</body>

<script src="assets\js\busqueda.js"></script>
</html>