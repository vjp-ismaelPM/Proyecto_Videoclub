# Proyecto Videoclub

**Autores:**  

- Ismael Pablos Miguel  
- Aitor Trujillo Pablo

**Proyecto Videoclub - Desarrollo Web en Entorno Servidor**

---

## Descripción del proyecto

Este proyecto consiste en el desarrollo de una aplicación en **PHP** que simula el funcionamiento de un videoclub.  
El sistema permite gestionar clientes, productos (DVDs, juegos y cintas de vídeo) y los alquileres de dichos productos.

Se han aplicado principios de **Programación Orientada a Objetos (POO)**, como herencia, encapsulación, interfaces y manejo de excepciones personalizadas. Además, se ha integrado un sistema de **logging** profesional, **documentación técnica** automática y **web scraping de Metacritic**.

---

## Tecnologías y herramientas utilizadas

- **Lenguaje:** PHP 8.1 o superior
- **Gestor de dependencias:** [Composer](https://getcomposer.org/)
- **Logging:** [Monolog](https://github.com/Seldaek/monolog) (vía PSR-3)
- **Documentación:** [phpDocumentor](https://www.phpdoc.org/)
- **Web Scraping:** Funciones nativas de PHP (DOMDocument, DOMXPath)
- **Entorno de desarrollo:** XAMPP / Docker
- **Editor recomendado:** Visual Studio Code

---

## Instalación y Configuración

1. **Clonar el repositorio** en tu carpeta de servidor local (ej. `C:\xampp\htdocs\Proyecto_Videoclub`).

2. **Instalar dependencias**:
   Asegúrate de tener Composer instalado y ejecuta en la raíz del proyecto:

   ```bash
   composer install
   ```

3. **Configurar permisos**:
   Asegúrate de que la carpeta `logs/` tenga permisos de escritura para que el sistema pueda generar los archivos de log.

---

## Estructura del proyecto

```text
Proyecto_Videoclub/
├── app/
│   ├── model/              # Clases del modelo de negocio
│   │   ├── Util/           # Excepciones personalizadas
│   │   ├── CintaVideo.php
│   │   ├── Cliente.php
│   │   ├── Dvd.php
│   │   ├── Juego.php
│   │   ├── Soporte.php
│   │   └── Videoclub.php
│   ├── util/               # Utilidades generales
│   │   ├── LogFactory.php  # Factoría para el sistema de logs
│   │   └── MetacriticScraper.php  # Web scraping de Metacritic
│   └── login/              # Sistema de autenticación
│       ├── login.php       # Procesa el login
│       ├── mainAdmin.php   # Panel de administrador
│       └── mainCliente.php # Panel de cliente
├── public/
│   └── index.php           # Página de login (punto de entrada)
├── docs/                   # Documentación técnica generada (HTML)
├── logs/                   # Archivos de log del sistema
├── test/                   # Scripts de prueba y ejemplos
│   ├── inicio.php
│   ├── inicio3.php         # Pruebas con Metacritic
│   └── test_videoclub_log.php
├── vendor/                 # Dependencias de Composer
├── composer.json           # Configuración de dependencias
└── README.md
```

---

## Cómo Usar la Aplicación

### 1. Acceso al Sistema de Login

**URL de acceso:**

```
http://localhost/Proyecto_Videoclub/public/index.php
```

O simplemente:

```
http://localhost/Proyecto_Videoclub/
```

**Credenciales de prueba:**

- **Administrador:**
  - Usuario: `admin`
  - Contraseña: `admin`

- **Clientes:**
  - Usuario: `amancio` / Contraseña: `1234`
  - Usuario: `pablo` / Contraseña: `abcd`

### 2. Archivos de Prueba

**Prueba básica del videoclub:**

```
http://localhost/Proyecto_Videoclub/test/inicio.php
```

**Prueba con Metacritic y Web Scraping:**

```
http://localhost/Proyecto_Videoclub/test/inicio3.php
```

**Prueba del sistema de logs:**

```bash
php test/test_videoclub_log.php
```

---

## Funcionalidades Principales

### 1. Gestión de Alquileres

- Registro de socios y catálogo de productos.
- Alquiler individual o múltiple de soportes.
- Control de cupos máximos por socio.
- Gestión de estados de disponibilidad.

### 2. Sistema de Logging (Monolog)

Toda la actividad crítica del sistema (alquileres, devoluciones, errores) se registra automáticamente en `logs/videoclub.log`. Se utiliza una factoría centralizada (`LogFactory`) que devuelve una implementación de `Psr\Log\LoggerInterface`.

### 3. Documentación Técnica (PHPDoc)

El código está íntegramente documentado siguiendo el estándar PHPDoc. Para regenerar la documentación técnica:

```bash
php vendor/bin/phpdoc -d app/model,app/util -t docs
```

Puedes visualizarla abriendo `docs/index.html` en cualquier navegador.

### 4. Integración con Metacritic

El sistema permite almacenar URLs de Metacritic para cada soporte y realizar web scraping para obtener:

- **Metascore** (puntuación de críticos)
- **User Score** (puntuación de usuarios)
- **Resumen** de la película o juego

**Nota:** Los métodos `incluirCintaVideo`, `incluirDvd` e `incluirJuego` requieren la URL de Metacritic como primer parámetro. Si no tienes URL, pasa una cadena vacía `""`.

---

## Características Técnicas

### Programación Orientada a Objetos

- **Herencia**: `CintaVideo`, `Dvd` y `Juego` heredan de la clase abstracta `Soporte`.
- **Encapsulación**: Todas las propiedades son privadas con getters/setters apropiados.
- **Interfaces**: Se utiliza `Psr\Log\LoggerInterface` para desacoplar el sistema de logs.
- **Excepciones**: Gestión robusta de errores mediante excepciones personalizadas en el namespace `Dwes\ProyectoVideoclub\Model\Util`.

### Autoloading

Gestión automática de carga de clases mediante Composer (PSR-4). No es necesario usar `require` o `include` manualmente.

### Web Scraping

Implementado con funciones nativas de PHP:

- `file_get_contents()` con User-Agent personalizado
- `DOMDocument` y `DOMXPath` para parsear HTML
- Manejo de errores y valores por defecto

---

## Notas Importantes

- **Encapsulación mejorada**: Las propiedades `$titulo` y `$alquilado` en la clase `Soporte` son privadas y se acceden mediante getters/setters (`getTitulo()`, `getAlquilado()`, `setAlquilado()`).

- **Logs automáticos**: Todas las operaciones importantes se registran automáticamente en `logs/videoclub.log`.

- **Documentación actualizada**: Ejecuta `phpdoc` después de cualquier cambio en el código para mantener la documentación al día.

- **URLs de Metacritic**: Al crear productos, el primer parámetro es la URL de Metacritic. Para productos sin URL, usa `""`.

---

**© 2025 - Ismael Pablos Miguel & Aitor Trujillo Pablo**
