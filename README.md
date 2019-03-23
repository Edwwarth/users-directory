# users-directory

Esta aplicacion fue desarrollada con los paquetes y librerias:

whoops, que permite ver errores de mejor manera. \
auryn, que permite inyectar paquetes siguiendo las practicas SOLID. \
fastroute, que permite el manejo de las rutas en la aplicacón. \
patricklouys/http, cuya libreria permite majera Request y Responses.\
mustache, que permite manejar templates y separar de major manera las reponsabilidades en la aplicación. \

\
Esta sistema inicia desde public/index.php.
Ademas, la logica respecto a los request y responses se maneja en el archivo src/Bootstrap.

La configuración .htaccess para hacer la redirección de request a index.php se encuentra en public/.

Las funciones javascript se encuentran en public/assets.

En src/ se encuentran los controladores, los modelos y la persistencia.

Las rutas se encuentran en el archivo src/Routes.php.
Este archivo retorna el metodo, la ubicacion y la función que debe realizarse a partir del request hacia los controladores.

En el archivo src/Dependencies.php se define la inyeccion de las clases del sistema.

Finalmente en la carpeta /templates, se encuentran las diferentes vistas del sistema. 


Instalación:
Ejecutar el archivo composer.json y ubicar el proyecto en el ambiente a desplegar. 

$ composer update
