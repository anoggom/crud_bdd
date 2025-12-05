# 🚀 CRUD de Usuarios con PHP Nativo y Tailwind CSS v4

Este proyecto es un ejemplo de un CRUD (Crear, Leer, Actualizar, Borrar) de usuarios desarrollado en **PHP nativo** (sin frameworks) y estilizado con **Tailwind CSS v4**.

## ⚙️ Configuración y Puesta en Marcha

Para comenzar a usar el proyecto, debe configurar su base de datos MySQL y actualizar las credenciales de conexión.

---

### 1. Crear la Base de Datos (MySQL)

Necesita crear una base de datos y un usuario con permisos. Luego, ejecute el siguiente *script* SQL para crear la tabla de usuarios (`users`):

```sql
CREATE TABLE users (
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	name VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	role VARCHAR(255) NOT NULL,
	registration_date DATETIME NOT NULL
	/*password VARCHAR(255) NOT NULL*/
);
```

### 2. Configurar Credenciales
El archivo de configuración de la base de datos es: /config/database.php.

Para conectar la aplicación a su base de datos local, siga estos pasos:

1. Abra el archivo /config/database.php.

2. Reemplace los valores placeholder por sus credenciales reales de MySQL:

```php
// Fichero: /config/database.php

define('DB_HOST', 'su_host_mysql');      // Ej: 'localhost'
define('DB_PORT', '3306');            // Puerto por defecto de MySQL
define('DB_NAME', 'nombre_de_su_db'); // El nombre de la base de datos que creó
define('DB_USER', 'su_usuario');      // Su nombre de usuario de MySQL
define('DB_PASSWORD', 'su_contraseña'); // Su contraseña de MySQL
```
