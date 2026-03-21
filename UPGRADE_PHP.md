# 🔄 Actualizar PHP en WSL a 8.3

## Información actual

```
PHP Version: 7.4.3 (antiguo, sin soporte activo)
Objetivo:    PHP 8.3 (última versión estable)
```

## Método automático (recomendado)

Ejecuta el script que se ha creado:

```bash
bash /home/jabeato/tamagochi_rrss/update-php.sh
```

Este script automatiza todos los pasos y necesita sudo. Te pedirá la contraseña.

## Método manual (paso a paso)

Si prefieres hacerlo manualmente o el script no funciona:

### 1. Agregar repositorio de PHP

```bash
sudo add-apt-repository ppa:ondrej/php
```

### 2. Actualizar lista de paquetes

```bash
sudo apt-get update
```

### 3. Instalar PHP 8.3 y extensiones

```bash
sudo apt-get install -y \
  php8.3 \
  php8.3-cli \
  php8.3-common \
  php8.3-curl \
  php8.3-bcmath \
  php8.3-ctype \
  php8.3-fileinfo \
  php8.3-json \
  php8.3-mbstring \
  php8.3-tokenizer \
  php8.3-xml \
  php8.3-pdo \
  php8.3-mysql \
  php8.3-sqlite3 \
  php8.3-opcache \
  php8.3-intl \
  php8.3-zip
```

### 4. Establecer PHP 8.3 como versión por defecto

```bash
sudo update-alternatives --install /usr/bin/php php /usr/bin/php8.3 80
```

### 5. Verificar la instalación

```bash
php -v
php -m
```

## Troubleshooting

### "La contraseña es incorrecta"
- Asegúrate de escribir la contraseña correcta de tu cuenta de Windows/WSL
- Nota: Al escribirla no verás los caracteres en la terminal (es normal)

### "El repositorio no se puede agregar"
```bash
# Primero instala software-properties-common
sudo apt-get update
sudo apt-get install -y software-properties-common

# Luego intenta agregar el repositorio
sudo add-apt-repository ppa:ondrej/php
```

### "PHP 8.3 no se encuentra en los repositorios"
```bash
# Actualiza la lista de paquetes
sudo apt-get update

# Intenta instalar nuevamente
sudo apt-get install -y php8.3
```

### Volver a PHP 7.4 (si algo sale mal)
```bash
sudo update-alternatives --install /usr/bin/php php /usr/bin/php7.4 70
```

## Verificación

Una vez actualizado, verifica:

```bash
# Versión
php -v

# Extensiones instaladas
php -m

# Información de PHP
php -i | grep "PHP Version"

# Probar Composer (si está instalado)
composer --version
```

## Diferencias PHP 7.4 → 8.3

| Feature | 7.4 | 8.0 | 8.1 | 8.2 | 8.3 |
|---------|-----|-----|-----|-----|-----|
| **Performance** | ✅ | ⬆️ Mejor | ⬆️ Mejor | ⬆️ Mejor | ⬆️ Mejor |
| **Type hints** | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Named Arguments** | ❌ | ✅ | ✅ | ✅ | ✅ |
| **Match Expression** | ❌ | ✅ | ✅ | ✅ | ✅ |
| **Attributes** | ❌ | ✅ | ✅ | ✅ | ✅ |
| **Fibers** | ❌ | ❌ | ✅ | ✅ | ✅ |
| **Readonly** | ❌ | ❌ | ✅ | ✅ | ✅ |
| **Support Active** | ❌ | ⏳ Final | ✅ | ✅ | ✅ |

## Para Laravel 8

Laravel 8 es completamente compatible con PHP 8.3, así que no habrá problemas:

```bash
# Después de actualizar PHP, en el proyecto
composer update

# Verifica que todo está bien
php artisan --version
php artisan tinker
```

## Opción: Usar DDEV (sin actualizar WSL)

Si no quieres actualizar PHP en WSL, **puedes usar DDEV**. El contenedor de Docker tendrá PHP 8.3:

```bash
cd /home/jabeato/tamagochi_rrss
ddev start
```

Esto es más limpio y no modifica tu sistema WSL.

---

✅ **Con PHP 8.3 actualizado, tu proyecto estará completamente moderno.**
