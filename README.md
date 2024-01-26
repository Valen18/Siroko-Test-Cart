# Prueba técnica de TechPump para Senior PHP Developer por Valentín Ayesa
<a href="https://www.linkedin.com/in/valentinayesa/"><img src="https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white" /></a>
## Procedimiento de puesta en marcha:

Clonar el repositorio

    https://github.com/Valen18/Siroko-Test-Cart

Una vez clonado, en un terminal ejecutar los siguientes comandos dentro de la carpeta del proyecto:

    composer install 

    npm install

A continuación renombre el archivo ".env.example" a ".env" y configura los datos de la base de datos.
En mi caso:

	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=carrito
	DB_USERNAME=root
	DB_PASSWORD=Rkt%3049jfn!
	
Todo lo demás, déjalo por defecto en este ejercicio.

El siguiente paso es ejecutar los siguientes comandos:

    php artisan key:generate 

Ahora ejecuta las migraciones y los seeders con los siguientes comandos desde la consola (siempre en el directorio del proyecto):

    php artisan migrate && php artisan db:seed

Cuando termine necesitarás ejecutar en la consola:

    npm run dev

Y abrir una nueva consola en el directorio del proyecto para ejecutar:

    php artisan serve

Esto ejecutará el servidor de desarrollo Vite y a la vez el servidor Artisan nativo de Laravel.
A continuación podrá acceder a la aplicación desde la url que indique la consola, normalmente: .

    http://127.0.0.1:8000/
