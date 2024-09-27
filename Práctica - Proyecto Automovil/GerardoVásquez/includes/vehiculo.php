<?php
class Vehiculo {
    private $conn; // Conexión a la base de datos
    private $table_name = "vehiculo"; // Nombre de la tabla

    // Propiedades de la clase
    public $placa;
    public $anio;
    public $color;
    public $numero_motor;
    public $numero_chasis;
    public $cedula_fk;
    public $id_marca;
    public $id_modelo;
    public $id_tipo;


    // Constructor que recibe la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar un nuevo automóvil
    public function registrar($propietario) {
        try {
                $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE placa = :placa";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":placa", $this->placa);
                $stmt->execute();
        
                if ($stmt->fetchColumn() > 0) {
                    echo "El vehículo con placa " . $this->placa . " ya está registrado.";
                    return false;
                }
                
                // Obtener el ID de la marca
                $query = "SELECT id_marca FROM marca_vehiculo WHERE id_marca = :marca";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':marca', $this->id_marca);
                $stmt->execute();
                $marca_row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($marca_row === false) {
                    echo "Error al buscar la marca: " . implode(", ", $stmt->errorInfo());
                    return false;
                } 
                $this->id_marca = $marca_row['id_marca'];
                
                // Obtener el ID del modelo
                $query = "SELECT id_modelo FROM modelo_vehiculo WHERE id_modelo = :modelo";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':modelo', $this->id_modelo);
                $stmt->execute();
                $modelo_row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($modelo_row === false) {
                    echo "Error al buscar el modelo: " . implode(", ", $stmt->errorInfo());
                    return false;
                }
                
                $this->id_modelo = $modelo_row['id_modelo'];
                
                
                
                // Obtener el ID del tipo de vehículo
                $query = "SELECT id_tipo FROM tipo_vehiculo WHERE id_tipo = :tipo";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':tipo', $this->id_tipo);
                $stmt->execute();
                $tipo_row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($tipo_row === false) {
                    echo "Error al buscar el tipo de vehículo: " . implode(", ", $stmt->errorInfo());
                    return false;
                }
                
                $this->id_tipo = $tipo_row['id_tipo'];
                

                // Query para insertar un nuevo automóvil
                $query = "INSERT INTO " . $this->table_name . " (placa, anio, color, numero_motor, numero_chasis, cedula_fk, id_marca, id_modelo, id_tipo) VALUES (:placa, :anio, :color, :numero_motor, :numero_chasis, :cedula_fk, :id_marca, :id_modelo, :id_tipo)";

                // Preparar la declaración
                $stmt = $this->conn->prepare($query);

                // Limpiar los datos para evitar inyección SQL
                $this->placa = htmlspecialchars(strip_tags($this->placa));
                $this->anio = htmlspecialchars(strip_tags($this->anio));
                $this->color = htmlspecialchars(strip_tags($this->color));
                $this->numero_motor = htmlspecialchars(strip_tags($this->numero_motor));
                $this->numero_chasis = htmlspecialchars(strip_tags($this->numero_chasis));
                $this->cedula_fk = htmlspecialchars(strip_tags($this->cedula_fk));
                $this->id_marca = htmlspecialchars(strip_tags($this->id_marca));
                $this->id_modelo = htmlspecialchars(strip_tags($this->id_modelo));
                $this->id_tipo = htmlspecialchars(strip_tags($this->id_tipo));

                // Enlazar los parámetros
                $stmt->bindParam(":placa", $this->placa);
                $stmt->bindParam(":anio", $this->anio);
                $stmt->bindParam(":color", $this->color);
                $stmt->bindParam(":numero_motor", $this->numero_motor);
                $stmt->bindParam(":numero_chasis", $this->numero_chasis);
                $stmt->bindParam(":cedula_fk", $this->cedula_fk);
                $stmt->bindParam(":id_marca", $this->id_marca);
                $stmt->bindParam(":id_modelo", $this->id_modelo);
                $stmt->bindParam(":id_tipo", $this->id_tipo);

                // Ejecutar la declaración
                if ($stmt->execute()) {
                    return true;
                }
                return false;
        } catch (PDOException $e) {
            // Verificar si el error es por clave duplicada
            if ($e->getCode() == 23000) { // Código de error SQL para violación de unicidad
                return false;
            } else {
                echo "Error al registrar vehículo: " . $e->getMessage();
            }
            return false;
        }
        
    }

    // Método para buscar un automóvil por ID
    public function buscar($placa) {
        // Limpiar el ID para evitar inyección SQL
        $placa = htmlspecialchars(strip_tags($placa));
        
        if (empty($placa)) {
            return "Placa no válida.";
        }
        
        // Si quieres una validación específica, como que solo tenga letras y números:
        if (!preg_match("/^[A-Za-z0-9]+$/", $placa)) {
            return "Formato de placa no válido.";
        }

        // Query para buscar el automóvil por ID
        $query = "SELECT * FROM " . $this->table_name . " WHERE placa = :placa";
        
        // Preparar la declaración
        $stmt = $this->conn->prepare($query);
        
        // Enlazar el parámetro
        $stmt->bindParam(":placa", $placa);
        
        // Ejecutar la declaración
        $stmt->execute();

        // Obtener el resultado
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>