<h2> INFORMACIÓN</h2>
 Este proyecto se ha desarrollado usando Drupal 8, se hizo una instalacion minimal con la intencion de crear una API REST con drupal. actualmente se consume una api externa y se exponen los datos procesados a traves de la API. En un futuro si se quiere se pueden exponer (mediante la API) datos de los contenidos creados desde el adminsitrador. En este proyecto no se usa el motor de plantillas de drupal para mantener separada la logica de la vista.
 
<h2>REQUERIMIENTOS </h2>

Requerimientos para correr el proyecto:

- MySql
- PHP 
- Apache

Se recomienda instalar XAMPP que contiene todo lo necesario para iniciar el proyecto (https://www.apachefriends.org/download.html)

<h2>BASE DE DATOS </h2>

Dentro de la carpeta del proyecto se encuentra un dump de la base de datos en un archivo .sql, este archivo esta ubicado en "bd_dumps". Este se debe importar con su gestor de base de datos (phpMyAdmin, MySql Workbench, etc)

<h2>ENTRANDO A ADMINISTRADOR DRUPAL</h2>

Para asegurarse de que todo funciono correctamente ir al navegador y entrar a "http://localhost/zpotify" y verificar que no se muestre la pagina de instalacion de drupal.

<h2>CORRIENDO PROYECTO FRONT END / CLIENTE</h2>

como parte de la prueba se realizó un projecto cliente para consumir los servicios que se exponen en esta API. a continuación se encuentra el link del repositorio con las instrucciones para su uso

<h2> API ENDPOINTS </h2>

BASE URL: http://localhost/zpotify

ENDPOINT | METODO | DATOS  
 /latest-releases | GET | Ultimos lanzamientos
 /artist/:id | GET |  Datos del artista
 /artist/top-tracks/:id  | GET | Top tracks del artista 

PROYECTO FRONT: https://github.com/hposaday/-zpotifyFront
