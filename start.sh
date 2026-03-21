#!/bin/bash

# Quick start script para tamagochi_rrss con DDEV

echo "🐠 Iniciando Tamagochi RRSS con DDEV..."
echo ""

# Verificar si Docker está corriendo
if ! docker ps > /dev/null 2>&1; then
    echo "❌ Error: Docker no está corriendo"
    echo "Por favor, inicia Docker primero"
    exit 1
fi

echo "✅ Docker está corriendo"
echo ""

# Navegar al directorio del proyecto
cd "$(dirname "$0")" || exit

echo "📦 Verificando configuración de DDEV..."
if [ ! -f ".ddev/config.yaml" ]; then
    echo "❌ Error: .ddev/config.yaml no encontrado"
    exit 1
fi

echo "✅ Configuración encontrada"
echo ""

echo "🚀 Iniciando DDEV..."
ddev start

echo ""
echo "✅ ¡DDEV iniciado exitosamente!"
echo ""

echo "📋 URLs de acceso:"
echo "  - App: http://tamagochi-rrss.ddev.site"
echo "  - Mailhog: http://tamagochi-rrss.ddev.site:8025"
echo "  - phpMyAdmin: http://tamagochi-rrss.ddev.site:8036"
echo ""

echo "💡 Comandos útiles:"
echo "  - Terminal PHP: ddev ssh"
echo "  - Ver logs: ddev logs"
echo "  - Ejecutar Artisan: ddev artisan <comando>"
echo "  - Detener: ddev stop"
echo ""

echo "🎉 ¡Listo para desarrollar!"
