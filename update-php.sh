#!/bin/bash

# Script para actualizar PHP a 8.3 en WSL

echo "================================"
echo "Actualizando PHP en WSL a 8.3"
echo "================================"

echo ""
echo "Paso 1: Agregando repositorio de PHP ondrej/php..."
sudo add-apt-repository ppa:ondrej/php -y

echo ""
echo "Paso 2: Actualizando lista de paquetes..."
sudo apt-get update

echo ""
echo "Paso 3: Instalando PHP 8.3 con extensiones necesarias..."
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

echo ""
echo "Paso 4: Estableciendo PHP 8.3 como versión por defecto..."
sudo update-alternatives --install /usr/bin/php php /usr/bin/php8.3 80

echo ""
echo "Paso 5: Verificando la versión de PHP..."
php -v

echo ""
echo "Paso 6: Verificando extensiones de PHP..."
php -m

echo ""
echo "✅ ¡Actualización completada!"
echo ""
echo "Versión de PHP activa:"
php -v
