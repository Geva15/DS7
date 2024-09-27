<?php
class Propietario {
    private $conn; // Conexión a la base de datos
    private $table_name = "propietarios"; // Nombre de la tabla
        
    // Propiedades de la clase
    public $cedula;
    public $nombre;
    public $apellido;
    public $direccion;
    public $telefono;
    public $tipo;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar un nuevo automóvil
    public function registrar() {
        // Query para insertar un nuevo automóvil
        $query = "INSERT INTO " . $this->table_name . " (cedula, nombre, apellido, direccion, telefono, tipo) VALUES (:cedula, :nombre, :apellido, :direccion, :telefono, :tipo)";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos para evitar inyección SQL
        $this->cedula = htmlspecialchars(strip_tags($this->cedula));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->tipo = htmlspecialchars(strip_tags($this->tipo));

        // Enlazar los parámetros
        $stmt->bindParam(":cedula", $this->cedula);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":tipo", $this->tipo);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function obtenerPorId($cedula) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE cedula = :cedula";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":cedula", $cedula);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->cedula = $row['cedula'];
            $this->nombre = $row['nombre'];
            $this->apellido = $row['apellido'];
            $this->telefono = $row['telefono'];
            $this->direccion = $row['direccion'];
            $this->tipo = $row['tipo'];
            return true;
        }
        return false;
    }
    public function existe() {
        $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE cedula = :cedula";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":cedula", $this->cedula);
        $stmt->execute();
    
        return $stmt->fetchColumn() > 0;
    }
}
?>