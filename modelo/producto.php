<?php
require_once __DIR__ . '/../core/Database.php';

class Producto {
    private const NOMBRE_CLASE = 'Producto';
    
    public $Id;
    public $Nombre;
    public $Precio;
    public $Stock;

    public function __construct() {
        // Constructor vacío para que FETCH_CLASS funcione correctamente
    }

    /**
     * Obtener todas las personas desde la BD
     * Usando FETCH_CLASS para mapear automáticamente a objetos Persona (ORM)
     */
    public static function obtenerTodas() {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('SELECT Id, Nombre, Precio, Stock FROM productos ORDER BY Id DESC');
            $stmt->execute();
            
            // PDO mapea automáticamente las columnas a las propiedades de la clase
            return $stmt->fetchAll(PDO::FETCH_CLASS, self::NOMBRE_CLASE);
        } catch (PDOException $e) {
            error_log("Error al obtener productos: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtener una persona por ID
     * Usando FETCH_CLASS para mapear automáticamente a objeto Persona (ORM)
     */
    public static function obtenerPorId($id) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('SELECT Id, Nombre, Precio, Stock FROM productos WHERE Id = :id');
            $stmt->execute([':id' => $id]);
            
            // PDO mapea automáticamente las columnas a las propiedades de la clase
            $stmt->setFetchMode(PDO::FETCH_CLASS, self::NOMBRE_CLASE);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error al obtener producto: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Agregar una nueva persona
     */
    public static function agregar($nombre, $precio, $stock) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('INSERT INTO productos (Nombre, Precio, Stock) VALUES (:nombre, :precio, :stock)');
            
            return $stmt->execute([
                ':nombre' => $nombre,
                ':precio' => $precio,
                ':stock' => $stock
            ]);
        } catch (PDOException $e) {
            error_log("Error al agregar producto: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Editar una persona existente
     */
    public static function editar($id, $nombre, $precio, $stock) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('UPDATE productos SET Nombre = :nombre, Precio = :precio, Stock = :stock WHERE Id = :id');
            
            return $stmt->execute([
                ':id' => $id,
                ':nombre' => $nombre,
                ':precio' => $precio,
                ':stock' => $stock
            ]);
        } catch (PDOException $e) {
            error_log("Error al editar producto: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Eliminar una persona
     */
    public static function eliminar($id) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('DELETE FROM productos WHERE Id = :id');
            
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar producto: " . $e->getMessage());
            return false;
        }
    }
}
?>
