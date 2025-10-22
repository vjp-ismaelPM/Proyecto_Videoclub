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

## Estructura del proyecto

```
proyecto_videoclub/
│
├── README.md
├── autoload.php
│
├── app/
│   ├── CintaVideo.php
│   ├── Cliente.php
│   ├── Dvd.php
│   ├── Juego.php
│   ├── Resumible.php
│   ├── Soporte.php
│   ├── Videoclub.php
│   └── util/
│       ├── ClienteNoEncontradoException.php
│       ├── CupoSuperadoException.php
│       ├── SoporteNoEncontradoException.php
│       ├── SoporteYaAlquiladoException.php
│       └── VideoclubException.php
│
└── test/
    └── inicio.php
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

**© 2025 - Ismael Pablos Miguel & Aitor Trujillo Pablo**

