# apisuplos

Este es el Backend de la app suplos. Se debe alojar en un servidor local como Wampserver.

## version de PHP

PHP version 8.0.26


## version de MariaDB

MariaDB version 10.10.2


## version de PhpMyAdmin

PhpMyAdmin version 5.2.0


### notas de Instalación

	Estos son los pasos para instalar Wampserver, importar la base de datos en phpMyAdmin y descargar el repositorio de GitHub, en la ruta adecuada:

	•	Descarga e instala Wampserver:
		Ve al sitio web oficial de Wampserver: https://www.wampserver.com.
		Descarga la versión correspondiente a tu sistema operativo (32 bits o 64 bits).
		Ejecuta el archivo de instalación y sigue las instrucciones del asistente de instalación.
		Durante la instalación, se te pedirá seleccionar el directorio de instalación. Por defecto, se instalará en C:\wamp64\ para sistemas de 64 bits y C:\wamp\ para sistemas de 32 bits. Puedes mantener esta ubicación o elegir una diferente si lo deseas.
		Completa el proceso de instalación.

	Una vez que hayas instalado Wampserver, asegúrate de iniciarlo y verificar que los servicios de Apache y MySQL estén activos. Puedes encontrar el ícono de Wampserver en la bandeja del sistema de Windows.

	•	Ahora, descarga el repositorio de GitHub:
		1.	Ve al repositorio de GitHub: https://github.com/heinerTC/apisuplos.git.
		2.	Haz clic en el botón verde "Code" y luego en "Download ZIP".
		3.	Guarda el archivo ZIP en la ubicación C:\wamp64\www en tu sistema.
		4.	Extrae el contenido del archivo ZIP descargado en la carpeta C:\wamp64\www. Esto creará una nueva carpeta llamada apisuplos con los archivos del proyecto.

	•	Importa la base de datos en phpMyAdmin:
		1.	Abre tu navegador web y ve a http://localhost/phpmyadmin, (asegúrate de que Wampserver esté en ejecución).
		2.	Inicia sesión en phpMyAdmin si se solicita, usuario “root” y sin contraseña, para fines prácticos.
		3.	En la interfaz de phpMyAdmin, crea una nueva base de datos con el nombre “suplos” que es el nombre del proyecto.
		4.	Haz clic en la nueva base de datos creada en el panel de la izquierda.
		5.	En la parte superior, selecciona la pestaña "Importar".
		6.	Haz clic en el botón "Seleccionar archivo" y navega hasta la carpeta bd, dentro de la carpeta apisuplos, que se extrajo anteriormente. Dentro de la carpeta bd, selecciona el archivo SQL correspondiente a la base de datos (suplos.sql).
		7.	Haz clic en el botón "Ejecutar" para importar el archivo SQL y crea las tablas y datos correspondientes en tu base de datos.
		Ahora puedes acceder al proyecto en tu navegador web, ingresando la siguiente URL: http://localhost/apisuplos. Esto cargará la aplicación web desarrollada en PHP, con los datos y funcionalidades correspondientes. Recuerda que necesitas tener Wampserver en ejecución, para acceder a la aplicación y que los servicios de Apache y MySQL estén activos. No se requiere ninguna acción adicional para instalar el Backend.

	Nota importante: en el archivo “config.php”, ubicado en la carpeta “api”, se encuentran los parámetros para que el Backend en php, se conecte a MySQL.


