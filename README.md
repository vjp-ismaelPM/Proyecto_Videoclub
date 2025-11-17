# Proyecto Videoclub

**Autores:**  
- Ismael Pablos Miguel  
- Aitor Trujillo Pablo

**Proyecto Videoclub - Desarrollo Web en Entorno Servidor** 

---

## Descripción del proyecto

Este proyecto forma parte de nuestro trabajo y consiste en el desarrollo de una aplicación en **PHP** que simula el funcionamiento de un videoclub.  
El sistema permite gestionar clientes, productos (DVDs, juegos y cintas de vídeo) y los alquileres de dichos productos.  

Durante el desarrollo hemos aplicado los principios de **Programación Orientada a Objetos (POO)**, como herencia, encapsulación y manejo de excepciones personalizadas.  
El código está organizado de forma modular para mantener una estructura limpia, legible y fácil de mantener.



---

## Tecnologías y herramientas utilizadas

- **Lenguaje:** PHP 8.0 o superior  
- **Entorno de desarrollo:** XAMPP (Apache + PHP)  
- **Editor recomendado:** Visual Studio Code  
- **Sistema operativo:** Compatible con Windows, macOS y Linux  
---



---
## Uso de herramientas de asistencia

Durante el desarrollo del proyecto hemos hecho uso responsable de **ChatGPT** y **Grok** para:

- Obtener sugerencias sobre la organización del código y estructura de clases
- Revisar y optimizar algunos métodos específicos
- Resolver dudas de sintaxis o uso de POO en PHP

Estas herramientas se han utilizado únicamente como apoyo, asegurándonos de entender y validar todas las soluciones antes de incorporarlas al proyecto.

---


## Estructura del proyecto

```
Proyecto_Videoclub/
│
├── README.md
├── autoload.php
│
├── app/
│   ├── model/
│   │   ├── CintaVideo.php
│   │   ├── Cliente.php
│   │   ├── Dvd.php
│   │   ├── Juego.php
│   │   ├── Resumible.php
│   │   ├── Soporte.php
│   │   ├── Videoclub.php
│   │   ├── util/
│   │   │   ├── ClienteNoEncontradoException.php
│   │   │   ├── CupoSuperadoException.php
│   │   │   ├── SoporteNoEncontradoException.php
│   │   │   ├── SoporteYaAlquiladoException.php
│   │   │   └── VideoclubException.php
│   │
│   ├── login/
│   │   ├── createCliente.php
│   │   ├── formCreateCliente.php
│   │   ├── formUpdateCliente.php
│   │   ├── login.php
│   │   ├── logout.php
│   │   ├── mainAdmin.php
│   │   ├── mainCliente.php
│   │   ├── removeCliente.php
│   │   ├── updateCliente.php
│   │   └── css/
│   │   │   ├── createCliente.css
│   │   │   ├── mainAdmin.css
│   │   │   ├── mainCliente.css
│   │   │   └── updateCliente.css
│
├── public/
│   └── index.php
│
├── img/
│   └── (imágenes usadas en la interfaz)
│
├── test/
│   └── inicio.php
│
└── vendor/
    └── (dependencias, si se usan)
```

---

## Cómo ejecutar el proyecto

1. **Colocar el proyecto en XAMPP**  
   Descarga o clona la carpeta `proyecto_videoclub` dentro del directorio `htdocs` de XAMPP.  
   ```
   C:\xampp\htdocs\proyecto_videoclub
   ```

2. **Iniciar Apache desde XAMPP**  
   Abre el panel de control y activa el servicio de **Apache**.

3. **Abrir el proyecto en el navegador**  
   Accede a la siguiente URL:
   ```
   http://localhost/proyecto_videoclub/public/idex.php
   ```

   En el caso de que quieras probar los test es en:
   ```
   http://localhost/proyecto_videoclub/test/inicio.php
   ```
   

4. **Probar las distintas funcionalidades**  
   En el archivo `inicio.php` se incluyen diferentes bloques de pruebas comentados.  
   Para ejecutar una prueba concreta, descomenta el bloque correspondiente y comenta los demás para evitar una salida por pantalla demasiado extensa.

---

## Funcionamiento de la aplicación

El sistema permite gestionar las operaciones básicas de un videoclub:

- Registrar y listar clientes (socios)  
- Registrar distintos tipos de productos: juegos, DVDs y cintas de vídeo  
- Alquilar y devolver productos  
- Controlar los límites de alquiler por cliente  
- Gestionar errores mediante excepciones personalizadas  

Excepciones implementadas:
- `SoporteYaAlquiladoException`  
- `SoporteNoEncontradoException`  
- `CupoSuperadoException`  
- `ClienteNoEncontradoException`  
- `VideoclubException`

Además, se ha incluido la posibilidad de encadenar métodos para una ejecución más fluida:
```php
$vc->alquilarSocioProducto(1,1)->listarSocios();
```

---

## Diseño del código

- El proyecto está desarrollado íntegramente con **Programación Orientada a Objetos**.  
- Las clases `Dvd`, `Juego` y `CintaVideo` heredan de la clase abstracta `Soporte`.  
- Se ha implementado una interfaz `Resumible` para definir un formato común de presentación de información.  
- Todas las excepciones están organizadas dentro del namespace `app\util`.  
- El código está preparado para poder ampliarse fácilmente añadiendo nuevos tipos de soportes o reglas de negocio.
---

## Requisitos

- PHP 8.0 o superior
- Servidor web (recomendado: XAMPP con Apache)
- Navegador web moderno


## Estructura principal del proyecto

- `autoload.php` — cargador automático de clases (namespace -> ruta `app/`)
- `app/` — código fuente (modelos, lógica y utilidades)
  - `model/` — clases del dominio (Soporte, Dvd, Juego, CintaVideo, Cliente, Videoclub, etc.)
  - `model/util/` — excepciones personalizadas
  - `login/` — páginas y controladores de login, paneles y formularios
- `public/` — punto de entrada público (front-end / formulario de login)
- `img/` — imágenes usadas en la interfaz
- `test/` — scripts de pruebas locales
- `vendor/` — dependencias (si se usan)


## Instalación y ejecución (XAMPP en Windows)

1. Copia la carpeta del proyecto a `C:\xampp\htdocs\` (por ejemplo: `C:\xampp\htdocs\Proyecto_Videoclub`).
2. Arranca Apache (y MySQL si lo necesitas) desde el panel de control de XAMPP.
3. Abre en el navegador la URL siguiente:
   - http://localhost/Proyecto_Videoclub/public/index.php


## Uso básico

- Credenciales de administrador por defecto:
  - Usuario: `admin`
  - Contraseña: `admin`

- El administrador puede:
  - Ver el listado de clientes y soportes
  - Crear, editar y eliminar clientes

- Un usuario cliente se crea desde el panel de administración (solo admin). Los datos de clientes y soportes se guardan en la sesión para esta versión simple de la aplicación.


## Inicializar datos y sesiones

- La aplicación guarda temporalmente los datos en la sesión (`$_SESSION['soportesData']`, `$_SESSION['clientesData']`, etc.).
- Si accedes por primera vez y faltan datos, puedes iniciar sesión como admin y añadir soportes y clientes desde el panel.
- Para pruebas locales, puedes usar el script `test/inicio.php` para crear objetos manualmente o inspeccionar la carga automática.


## Desarrollo y pruebas

- El autoload está en `autoload.php`. Respeta el namespace `Dwes\ProyectoVideoclub\Model\...` para que las clases se carguen correctamente.
- Para depurar, habilita la visualización de errores en `php.ini` o al comienzo de los scripts durante el desarrollo:
  - ini_set('display_errors', 1);
  - error_reporting(E_ALL);


## Notas importantes

- Esta versión usa la sesión como almacenamiento temporal. Para producción deberías migrar a una base de datos y aplicar hashing de contraseñas (password_hash / password_verify).
- Algunos métodos en las clases (por ejemplo en `Cliente.php` o `Videoclub.php`) están incompletos o representados de forma resumida; revisar e implementar según necesidades.


## Contribuciones

Si quieres contribuir:
1. Haz un fork del repositorio
2. Crea una rama con tu cambio
3. Envía un pull request con una descripción clara de los cambios


## Licencia

Este proyecto no incluye una licencia explícita en el repositorio. Añade una licencia si vas a compartir el código públicamente.


---

Si necesitas que incluya instrucciones más detalladas (ej.: cómo añadir un conjunto inicial de soportes por defecto, ejemplos de uso o un script de inicialización), dime qué prefieres y lo añado.

