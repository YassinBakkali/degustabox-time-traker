# Degustabox Time Tracker

Este proyecto consiste en una aplicación de Symfony integrada con Docker. El objetivo es gestionar el seguimiento del tiempo para las tareas. Este archivo de README te guiará a través del proceso de instalación y puesta en marcha del proyecto.

## Requisitos

Antes de comenzar, asegúrate de tener lo siguiente instalado en tu máquina:

- [PHP](recomendado: 8.0 o superior)
- [Composer]
- [Docker]
- [Docker Compose]

## Instalación

### 1. Clonar los repositorios

Primero, crea una carpeta donde descargarás los proyectos. Asegúrate de tener permisos adecuados para trabajar con Docker.

Ahora, clona los siguientes repositorios en esta carpeta:
Clona el proyecto de Symfony:
```
git clone https://github.com/YassinBakkali/degustabox-time-traker.git

```
Clona el proyecto de Docker
```
git clone https://github.com/YassinBakkali/degustabox-time-traker.git

```
### 2. Instalar dependencias del proyecto Symfony

Una vez que hayas descargado el proyecto de Symfony, navega a la carpeta degustabox-time-tracker y ejecuta el siguiente comando para instalar las dependencias del proyecto:
```
composer install

```
### 3. Configurar Docker 

Ahora, navega a la carpeta del proyecto de Docker degustabox-time-traker-docker y levanta los contenedores con Docker Compose:
```
docker-compose up -d

```
### 4. Migrar la base de datos de Symfony

Una vez que los contenedores de Docker estén levantados, necesitas acceder al contenedor de PHP para ejecutar las migraciones de la base de datos de Symfony

Accede al contenedor PHP con el siguiente comando:
```
docker compose exec -it php bash

```

Ahora, dentro del contenedor PHP, ejecuta los siguientes comandos para crear y aplicar las migraciones de la base de datos:
```
php bin/console make:migration
php bin/console doctrine:migrations:migrate

```

### 5. Acceder a la aplicación

Una vez que la base de datos se haya migrado, podrás acceder a la aplicación en tu navegador
```
http://localhost:8080/tasks

```
