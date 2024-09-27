document.getElementById('inicio').onclick = function() {
    window.location.href = 'index.php'; // Redirigir a registrar_vehiculo.php
};

document.getElementById('busqueda').onsubmit = function(event) {
    event.preventDefault(); // Evitar el envío normal del formulario

    var buscar = document.getElementById('buscar').value;

    // Usar fetch para enviar la búsqueda
    fetch('includes/procesar_busqueda.php?buscar=' + encodeURIComponent(buscar))
        .then(response => response.text())
        .then(data => {
            document.getElementById('resultados').innerHTML = data; // Mostrar los resultados
        })
        .catch(error => console.error('Error:', error));
};