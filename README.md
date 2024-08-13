# Gestión de Productos - Aplicación MVC en PHP con Bootstrap

## Descripción

Esta es una aplicación web para la gestión de productos utilizando el patrón de diseño `MVC` (Modelo-Vista-Controlador) con Programación Orientada a Objetos `(POO)` en `PHP`. La interfaz de usuario está diseñada con `Bootstrap` para un aspecto moderno y responsive.

## Requisitos

Antes de comenzar, asegúrate de tener instalados los siguientes requisitos:

- **PHP 7.4+** - [Instalar PHP](https://www.php.net/manual/es/install.php)
- **Servidor Web (Apache)** - Se recomienda utilizar [LARAGON](https://laragon.org/docs/) para Apache.
- **MySQL/MariaDB** - Base de datos relacional para almacenar los productos.
- **Composer** - (Opcional) Para la gestión de dependencias PHP.

## 1. Clonar el Repositorio

Clona el repositorio en tu máquina local utilizando Git:

```bash
git clone https://github.com/tu_usuario/tu_repositorio.git
````

## 2. Configuración de la Base de Datos

- **Crea la base de datos en MySQL/MariaDB:**

````sql
    CREATE DATABASE crud_app;
````

- **Crea la tabla `productos` en la base de datos:**

````sql
    USE crud_app;
        
    CREATE TABLE productos (
       id INT AUTO_INCREMENT PRIMARY KEY,
       nombre VARCHAR(255) NOT NULL,
       precio DECIMAL(10, 2) NOT NULL,
       cantidad INT NOT NULL
    );
````

- **Edita el archivo `config/database.php` y reemplaza los valores con los datos de acceso a tu base de datos:**

`````php
    // config/database.php
    <?php
    
    class Database {
        private $host = 'localhost'; // Cambia esto si usas un host diferente
        private $dbname = 'gestion_productos'; // Nombre de tu base de datos
        private $username = 'tu_usuario'; // Usuario de MySQL
        private $password = 'tu_contraseña'; // Contraseña de MySQL
        private $pdo;
    
        public function __construct() {
            try {
                $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error en la conexión: " . $e->getMessage());
            }
        }
    
        public function getConnection() {
            return $this->pdo;
        }
    }
`````

## 3. Ejecutar la Aplicación

- Inicia tu servidor web `Laragon`.

- Abre tu navegador y accede a la aplicación en http://localhost/crud_app.

- Deberías ver la página de inicio de la aplicación.

## 4. Opciones y Funcionalidades

- **Listado de Productos:** Visualiza todos los productos en la base de datos.
- **Agregar Producto:** Añade nuevos productos con nombre, precio y cantidad.
- **Editar Producto:** Modifica los datos de un producto existente.
- **Eliminar Producto:** Elimina productos de la base de datos.
- **Valor del Inventario:** Calcula el valor total del inventario basado en el precio y la cantidad de productos.
- **Producto de Mayor Valor:** Muestra el producto con mayor valor en el inventario.
- **Integración de APIs:** Puedes integrar APIs externas para mostrar datos adicionales, ejemplo datos curiosos sobre gatos o datos inútiles.

## 5. Solución de Problemas

- **Error de conexión a la base de datos:** Verifica que los detalles en `config/database.php` sean correctos y que el servidor `MySQL` esté en ejecución.
- **404 Not Found:** Asegúrate de que el `servidor web` esté apuntando al directorio `public/` y que las reglas de reescritura estén configuradas correctamente.