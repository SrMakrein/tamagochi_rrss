# DDEV Configuration for tamagochi_rrss

## Instalación y Setup

### Requisitos previos
- Docker instalado y corriendo
- ddev v1.24.0+
- PHP 8.3 (instalado en la máquina host, opcional)

### Primer arranque

```bash
# Navega al directorio del proyecto
cd /path/to/tamagochi_rrss

# Inicia el contenedor ddev
ddev start

# El primer arranque ejecutará las migraciones automáticamente
```

### Comandos útiles de ddev

```bash
# Iniciar el proyecto
ddev start

# Parar el proyecto
ddev stop

# Reiniciar el proyecto
ddev restart

# Ver logs
ddev logs

# Acceder a la terminal PHP
ddev ssh

# Ejecutar comandos Artisan
ddev artisan migrate
ddev artisan tinker
ddev artisan make:model NombreModelo

# Ejecutar composer
ddev composer install
ddev composer require package-name

# Ejecutar npm/yarn
ddev npm install
ddev npm run dev

# Ver el estado del proyecto
ddev status

# Descarga el estado de la base de datos
ddev snapshot

# Importa un snapshot anterior
ddev snapshot restore
```

### URLs de acceso

Una vez iniciado, el proyecto estará disponible en:
- **HTTP:** http://tamagochi-rrss.ddev.site
- **HTTPS:** https://tamagochi-rrss.ddev.site
- **Mailhog:** http://tamagochi-rrss.ddev.site:8025 (para testing de emails)
- **phpMyAdmin:** http://tamagochi-rrss.ddev.site:8036

### Variables de entorno

El archivo `.env` debe tener las siguientes variables configuradas para ddev:

```env
DB_HOST=db
DB_PORT=3306
DB_DATABASE=tamagochi_rrss
DB_USERNAME=db
DB_PASSWORD=db
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### Desarrollo

- **PHP Version:** 8.3 (Última versión estable)
- **Node Version:** 18
- **Database:** MySQL 8.0
- **Mail Driver:** mailhog (para testing)

### Troubleshooting

**Docker no está corriendo:**
```bash
# Asegúrate de que Docker está iniciado en tu sistema
docker ps
```

**Puerto en uso:**
```bash
# Si los puertos están en uso, puedes cambiarlos en config.yaml
ddev config --router-http-port=8080 --router-https-port=8443
```

**Limpiar todo y empezar de nuevo:**
```bash
ddev delete
ddev start
```

### Actualizar PHP en el host

Para actualizar PHP a 8.3 en WSL:

```bash
# Agregar repositorio de PHP
sudo add-apt-repository ppa:ondrej/php

# Actualizar lista de paquetes
sudo apt-get update

# Instalar PHP 8.3
sudo apt-get install -y php8.3 php8.3-{cli,common,curl,bcmath,ctype,fileinfo,json,mbstring,tokenizer,xml,pdo,mysql}

# Establecer PHP 8.3 como versión por defecto
sudo update-alternatives --install /usr/bin/php php /usr/bin/php8.3 80
sudo update-alternatives --install /usr/bin/composer composer /usr/bin/composer 80

# Verificar la versión
php -v
```
