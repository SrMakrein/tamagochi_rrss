# 🐠 Tamagochi RRSS - Configuración completada

## ✅ Lo que se ha hecho

### 1. **Configuración de DDEV**
Se han creado los siguientes archivos en `.ddev/`:

- **config.yaml** - Configuración principal de ddev
  - PHP 8.3 (última versión estable)
  - Node.js 18
  - MySQL 8.0
  - Zona horaria: Europe/Madrid
  - Puerto HTTP: 80 | HTTPS: 443

- **docker-compose.override.yaml** - Configuración adicional de Docker
- **Dockerfile.web** - Imagen personalizada con extensiones PHP necesarias
- **setup.sh** - Script de inicialización automática

### 2. **Variables de Entorno (.env actualizado)**
El archivo `.env` ha sido configurado con los valores correctos para ddev:

```
APP_URL=http://tamagochi-rrss.ddev.site
DB_HOST=db
DB_DATABASE=tamagochi_rrss
DB_USERNAME=db
DB_PASSWORD=db
```

### 3. **Archivos de Referencia**
- **DDEV_SETUP.md** - Guía completa de uso de ddev
- **update-php.sh** - Script para actualizar PHP en WSL

## 🚀 Próximos pasos

### Opción A: Usar DDEV (recomendado)

**Si Docker está corriendo:**

```bash
cd /home/jabeato/tamagochi_rrss
ddev start
```

Esto:
- Levanta los contenedores de Docker
- Ejecuta migraciones automáticamente
- Instala dependencias PHP y Node
- Hace disponible el proyecto en: http://tamagochi-rrss.ddev.site

### Opción B: Actualizar PHP en WSL (para desarrollo local)

**Sin usar Docker, pero con PHP 8.3 en tu máquina:**

```bash
bash /home/jabeato/tamagochi_rrss/update-php.sh
```

Este script:
1. Agrega el repositorio ondrej/php
2. Instala PHP 8.3 con todas las extensiones necesarias
3. Lo establece como versión por defecto
4. Verifica la instalación

**Luego puedes ejecutar:**
```bash
php artisan serve
```

## 📝 Información del Proyecto

| Aspecto | Valor |
|--------|-------|
| **Framework** | Laravel 8 |
| **PHP** | 8.3 (en Docker) |
| **Node.js** | 18 |
| **Database** | MySQL 8.0 |
| **Mail (dev)** | Mailhog |
| **URL (DDEV)** | http://tamagochi-rrss.ddev.site |

## 📚 Comandos DDEV más útiles

```bash
# Iniciar
ddev start

# Parar
ddev stop

# Reiniciar
ddev restart

# Acceso a terminal PHP
ddev ssh

# Ejecutar comandos Artisan
ddev artisan migrate
ddev artisan tinker

# Ver logs
ddev logs

# Composer
ddev composer require package-name

# NPM
ddev npm run dev
```

## 🔍 Verificación

Para verificar que todo está correctamente configurado:

```bash
# Revisar archivos creados
ls -la /home/jabeato/tamagochi_rrss/.ddev/

# Ver configuración
cat /home/jabeato/tamagochi_rrss/.ddev/config.yaml

# Verificar .env
cat /home/jabeato/tamagochi_rrss/.env
```

## ⚠️ Notas importantes

1. **Docker debe estar corriendo** para que ddev funcione
2. **PHP 8.3 en el host** es opcional si usas Docker
3. El script `update-php.sh` requiere permisos de sudo
4. Los cambios en `.env` se aplicarán al reiniciar ddev

## 🆘 Troubleshooting

**Docker no funciona:**
```bash
# Asegúrate de que está instalado y corriendo
docker ps
```

**Puertos en conflicto:**
```bash
ddev config --router-http-port=8080 --router-https-port=8443
ddev restart
```

**Limpiar y empezar de nuevo:**
```bash
ddev delete
ddev start
```

---

✨ **¡Proyecto configurado y listo para desarrollar!**
