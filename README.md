Desarrollo de API con Laravel Sail 10 con Docker

En esencia, Sail es el docker-compose.yml archivo y el sail script que se almacenan en la raíz de su proyecto. El sail script proporciona una interfaz de línea de comandos con métodos convenientes para interactuar con los contenedores Docker definidos por el docker-compose.yml archivo.

Laravel Sail es compatible con macOS, Linux y Windows (a través de WSL2 ).

Para correr el proyecto y obtener las imagenes de laravel necesarias es necesario tener instalado Docker en mi caso uso Windows(Docker Desktop) junto con WSL2
https://www.docker.com/products/docker-desktop/

Debes tener instalada la versión 2004 o posterior de Windows 10 (Build 19041 o posterior) o Windows 11 para usar los siguientes comandos.

Instalar comando WSL
Ahora puede instalar todo lo que necesita para ejecutar WSL con un solo comando. Abra PowerShell o el Símbolo del sistema de Windows en modo administrador haciendo clic derecho y seleccionando "Ejecutar como administrador", ingrese el comando wsl --install y luego reinicie su equipo.
Este comando habilitará las funciones necesarias para ejecutar WSL e instalar la distribución Ubuntu de Linux. ( Esta distribución predeterminada se puede cambiar ).

Clone el repositorio del github
https://github.com/Heredin/tasks-app

Configurar un alias de shell
De forma predeterminada, los comandos de Sail se invocan utilizando el vendor/bin/sailscript que se incluye con todas las nuevas aplicaciones de Laravel:

./vendor/bin/sail ejecute este siguiente comando desde el directorio raíz del proyecto clonado.

Sin embargo, en lugar de escribir repetidamente vendor/bin/sailpara ejecutar los comandos de Sail, es posible que desee configurar un alias de shell que le permita ejecutar los comandos de Sail más fácilmente:

alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'

Para asegurarse de que esto esté siempre disponible, puede agregarlo a su archivo de configuración de shell en su directorio de inicio, como ~/.zshrco ~/.bashrc, y luego reiniciar su shell.

Una vez configurado el alias de shell, puede ejecutar comandos de Sail simplemente escribiendo sail.

sail up

Antes de iniciar Sail, debe asegurarse de que no haya otros servidores web ni bases de datos ejecutándose en su computadora local. Para iniciar todos los contenedores Docker definidos en docker-compose.ymlel archivo de su aplicación, debe ejecutar el upcomando:

sail up

Para iniciar todos los contenedores Docker en segundo plano, puedes iniciar Sail en modo "separado":

sail up -d

Una vez que se hayan iniciado los contenedores de la aplicación, puede acceder al proyecto en su navegador web en: http://localhost .

Para detener todos los contenedores, simplemente puede presionar Control + C para detener la ejecución del contenedor. O, si los contenedores se están ejecutando en segundo plano, puede usar el stopcomando:

sail stop

Puede instalar las dependencias de la aplicación navegando hasta el directorio de la aplicación y ejecutando el siguiente comando. Este comando utiliza un pequeño contenedor Docker que contiene PHP y Composer para instalar las dependencias de la aplicación:

docker run --rm \
 -u "$(id -u):$(id -g)" \
 -v "$(pwd):/var/www/html" \
 -w /var/www/html \
 laravelsail/php83-composer:latest \
 composer install --ignore-platform-reqs

Al utilizar la laravelsail/phpXX-composerimagen, debe utilizar la misma versión de PHP que planea utilizar para su aplicación ( 80, 81, 82o 83).

#Ejecución de órdenes artesanales#

Los comandos de Laravel Artisan se pueden ejecutar usando el artisan comando:

ejemplo: sail artisan queue:work

Para correr las migraciones del proyecto y poder interactuar con la base de datos(MySQL)
corremos el siguiente comando

./vendor/bin/sail artisan migrate o si usamos el alias
sail artisan migrate

Recuerda que debemos tener levantado el proyecto con el siguiente comando
./vendor/bin/sail up -d o sail up -d

Para su conocimiento se expondran los endpoints para poder interactuar con la api
puede usar el programa que mas le agrade , en mi caso uso Postman

Register con name, email, password y password_confirmation
http://localhost/api/auth/register

Login con email y password
http://localhost/api/auth/login

Retorna token de seguridad en cada proceso

Obtener Domicilios de cada usuario
http://localhost/api/domicilios/user/3

Guardar Domicilio
http://localhost/api/domicilios

Actualizar Domicilios de cada usuario autenticado
http://localhost/api/domicilios/2

Eliminar Domicilio de cada usuario autenticado
http://localhost/api/domicilios/1

Mostrar detalle del Domicilio de cada usuario autenticado
http://localhost/api/domicilios/2

Cerrar Sesión de usuario
http://localhost/api/auth/logout

Cualquier duda o detalle con gusto lo revisamos.
