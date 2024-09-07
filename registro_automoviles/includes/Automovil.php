<?php
class Automovil {
    private $conn; // Conexión a la base de datos
    private $table_name = "automoviles"; // Nombre de la tabla

    // Propiedades de la clase
    public $id;
    public $placa;
    public $marca;
    public $modelo;
    public $anio;
    public $color;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar un nuevo automóvil
    public function registrar() {
        // Query para insertar un nuevo automóvil
        $query = "INSERT INTO " . $this->table_name . " (placa, marca, modelo, anio, color) VALUES (:placa, :marca, :modelo, :anio, :color)";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos para evitar inyección SQL
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->anio = htmlspecialchars(strip_tags($this->anio));
        $this->color = htmlspecialchars(strip_tags($this->color));

        // Enlazar los parámetros
        $stmt->bindParam(":marca", $this->placa);
        $stmt->bindParam(":marca", $this->marca);
        $stmt->bindParam(":modelo", $this->modelo);
        $stmt->bindParam(":anio", $this->anio);
        $stmt->bindParam(":color", $this->color);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // Método para buscar un automóvil por ID
    public function buscar($id) {
        // Limpiar el ID para evitar inyección SQL
        $id = htmlspecialchars(strip_tags($id));
        
        // Validar el ID
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            return "ID no válido.";
        }

        // Query para buscar el automóvil por ID
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        
        // Preparar la declaración
        $stmt = $this->conn->prepare($query);
        
        // Enlazar el parámetro
        $stmt->bindParam(":id", $id);
        
        // Ejecutar la declaración
        $stmt->execute();

        // Obtener el resultado
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($data) {
            // Cargar datos en las propiedades
            $this->id = $data['id'];
            $this->placa = $data['placa'];
            $this->marca = $data['marca'];
            $this->modelo = $data['modelo'];
            $this->anio = $data['anio'];
            $this->color = $data['color'];
            return $data;
        } else {
            return "No se encontraron resultados.";
        }
    }

    // Método para eliminar un automóvil por ID
    public function eliminar($id) {
        // Limpiar el ID para evitar inyección SQL
        $id = htmlspecialchars(strip_tags($id));

        // Validar el ID
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            return "ID no válido.";
        }

        // Query para eliminar el automóvil por ID
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        
        // Preparar la declaración
        $stmt = $this->conn->prepare($query);
        
        // Enlazar el parámetro
        $stmt->bindParam(":id", $id);
        
        // Ejecutar la declaración
        if ($stmt->execute()) {
            return "Registro eliminado correctamente.";
        } else {
            return "Error al eliminar registro: " . $this->conn->errorInfo()[2];
        }
    }

    // Método para actualizar un automóvil por ID
    public function actualizar() {
        // Query para actualizar el automóvil
        $query = "UPDATE " . $this->table_name . " SET placa = :placa, marca = :marca, modelo = :modelo, anio = :anio, color = :color WHERE id = :id";
        
        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos para evitar inyección SQL
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->anio = htmlspecialchars(strip_tags($this->anio));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Enlazar los parámetros
        $stmt->bindParam(":placa", $this->placa);
        $stmt->bindParam(":marca", $this->marca);
        $stmt->bindParam(":modelo", $this->modelo);
        $stmt->bindParam(":anio", $this->anio);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":id", $this->id);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            return "Registro actualizado correctamente.";
        } else {
            return "Error al actualizar registro: " . $this->conn->errorInfo()[2];
        }
    }
}
?>
