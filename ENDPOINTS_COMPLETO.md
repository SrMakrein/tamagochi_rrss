# 🐠 API Endpoints - Tamagochi RRSS (Completo)

## 📋 Tabla de Contenidos

1. [Autenticación](#autenticación)
2. [Tamagochi](#tamagochi---estado-y-acciones)
3. [Estadísticas](#estadísticas)
4. [Configuración](#configuración)

---

## 🔐 Autenticación

### Registrar nuevo usuario
**POST** `/api/auth/register`

**Body:**
```json
{
  "name": "Tu Nombre",
  "email": "tu@email.com",
  "password": "password123"
}
```

**Response (201):**
```json
{
  "message": "Usuario registrado exitosamente",
  "user": { "id": 1, "name": "Tu Nombre", "email": "tu@email.com", "created_at": "..." },
  "token": "1|...",
  "token_type": "Bearer"
}
```

### Login
**POST** `/api/auth/login`

**Body:**
```json
{
  "email": "tu@email.com",
  "password": "password123"
}
```

**Response (200):**
```json
{
  "message": "Login exitoso",
  "user": { "id": 1, "name": "Tu Nombre", "email": "tu@email.com" },
  "token": "1|...",
  "token_type": "Bearer"
}
```

### Obtener usuario actual (Protegido)
**GET** `/api/auth/me`

**Headers:** `Authorization: Bearer TOKEN`

**Response (200):**
```json
{
  "user": { "id": 1, "name": "Tu Nombre", "email": "tu@email.com", "created_at": "..." }
}
```

### Logout (Protegido)
**POST** `/api/auth/logout`

**Headers:** `Authorization: Bearer TOKEN`

**Response (200):**
```json
{
  "message": "Logout exitoso"
}
```

---

## 🎮 Tamagochi - Estado y Acciones

### Obtener estado del Tamagochi (Protegido)
**GET** `/api/tamagochi`

**Headers:** `Authorization: Bearer TOKEN`

**Response (200):**
```json
{
  "data": {
    "id": 1,
    "user_id": 1,
    "name": "Mi Tamagochi",
    "status": "happy",
    "energy": 85,
    "hunger": 30,
    "happiness": 90,
    "health": 100,
    "level": 5,
    "experience": 45,
    "times_played": 12,
    "last_fed": "2026-03-21T02:50:00Z",
    "last_played": "2026-03-21T02:45:00Z",
    "created_at": "2026-03-21T00:00:00Z",
    "updated_at": "2026-03-21T02:50:00Z"
  }
}
```

### Alimentar al Tamagochi (Protegido)
**POST** `/api/tamagochi/feed`

**Headers:** `Authorization: Bearer TOKEN`

**Response (200):**
```json
{
  "message": "✅ ¡Tu tamagochi ha sido alimentado!",
  "data": { "id": 1, "name": "Mi Tamagochi", "hunger": 0, "energy": 80, ... }
}
```

### Jugar con el Tamagochi (Protegido)
**POST** `/api/tamagochi/play`

**Headers:** `Authorization: Bearer TOKEN`

**Response (200):**
```json
{
  "message": "✅ ¡Ha sido una sesión divertida!",
  "data": { "id": 1, "happiness": 100, "energy": 65, "level": 6, "experience": 55, ... }
}
```

### Dormir con el Tamagochi (Protegido)
**POST** `/api/tamagochi/sleep`

**Headers:** `Authorization: Bearer TOKEN`

**Response (200):**
```json
{
  "message": "✅ ¡Tu tamagochi está descansando!",
  "data": { "id": 1, "energy": 100, "health": 110, "status": "sleeping", ... }
}
```

### Actualizar nombre del Tamagochi (Protegido)
**PUT** `/api/tamagochi/update-name`

**Headers:** `Authorization: Bearer TOKEN`

**Body:**
```json
{
  "name": "Nuevo nombre"
}
```

**Response (200):**
```json
{
  "message": "✅ Nombre actualizado",
  "data": { "id": 1, "name": "Nuevo nombre", ... }
}
```

---

## 📊 Estadísticas

### Obtener mis estadísticas (Protegido)
**GET** `/api/statistics/my-stats`

**Headers:** `Authorization: Bearer TOKEN`

**Response (200):**
```json
{
  "data": {
    "id": 1,
    "user_id": 1,
    "total_posts": 25,
    "total_likes": 150,
    "total_comments": 45,
    "followers_count": 50,
    "following_count": 30,
    "level": 5,
    "total_playtime": 240,
    "tamagochis_level_up": 2,
    "posts_published": 25,
    "badges_earned": 5,
    "created_at": "2026-03-21T00:00:00Z"
  }
}
```

### Obtener ranking de usuarios (Público)
**GET** `/api/statistics/leaderboard?limit=10`

**Query Parameters:**
- `limit` (opcional): Número de usuarios a mostrar (default: 10, max: 100)

**Response (200):**
```json
{
  "message": "Top 10 usuarios",
  "data": [
    {
      "id": 5,
      "name": "Juan",
      "email": "juan@example.com",
      "level": 8,
      "total_posts": 40,
      "followers_count": 100,
      "following_count": 50
    },
    ...
  ]
}
```

### Obtener estadísticas globales (Público)
**GET** `/api/statistics/global`

**Response (200):**
```json
{
  "data": {
    "total_users": 6,
    "total_posts": 125,
    "total_likes": 850,
    "total_comments": 250,
    "avg_level": 6.5,
    "total_playtime_minutes": 1200
  }
}
```

### Obtener estadísticas de un usuario (Público)
**GET** `/api/statistics/user/{userId}`

**Response (200):**
```json
{
  "data": {
    "user": {
      "id": 2,
      "name": "Maria",
      "email": "maria@example.com",
      "created_at": "2026-03-21T00:00:00Z"
    },
    "statistics": {
      "id": 2,
      "total_posts": 30,
      "level": 7,
      ...
    },
    "tamagochi": {
      "id": 2,
      "name": "Tamagochi de Maria",
      "status": "happy",
      "level": 8,
      ...
    }
  }
}
```

---

## ⚙️ Configuración

### Obtener configuración de cuenta (Protegido)
**GET** `/api/settings`

**Headers:** `Authorization: Bearer TOKEN`

**Response (200):**
```json
{
  "data": {
    "id": 1,
    "user_id": 1,
    "theme": "light",
    "language": "es",
    "notifications_enabled": true,
    "email_notifications": true,
    "push_notifications": true,
    "private_profile": false,
    "tamagochi_notifications": true,
    "notification_frequency": 30,
    "show_statistics": true,
    "two_factor_enabled": false,
    "bio": "Mi bio",
    "avatar_url": "https://...",
    "created_at": "2026-03-21T00:00:00Z"
  }
}
```

### Actualizar configuración (Protegido)
**PUT** `/api/settings`

**Headers:** `Authorization: Bearer TOKEN`

**Body:**
```json
{
  "theme": "dark",
  "language": "en",
  "notifications_enabled": false,
  "bio": "Nueva bio",
  "avatar_url": "https://..."
}
```

**Response (200):**
```json
{
  "message": "✅ Configuración actualizada",
  "data": { "id": 1, "theme": "dark", "language": "en", ... }
}
```

### Cambiar contraseña (Protegido)
**POST** `/api/settings/change-password`

**Headers:** `Authorization: Bearer TOKEN`

**Body:**
```json
{
  "current_password": "password123",
  "new_password": "newpassword456",
  "new_password_confirmation": "newpassword456"
}
```

**Response (200):**
```json
{
  "message": "✅ Contraseña actualizada"
}
```

### Eliminar cuenta (Protegido)
**DELETE** `/api/settings/delete-account`

**Headers:** `Authorization: Bearer TOKEN`

**Body:**
```json
{
  "password": "password123"
}
```

**Response (200):**
```json
{
  "message": "✅ Cuenta eliminada"
}
```

### Ver perfil público de usuario (Público)
**GET** `/api/users/{userId}`

**Response (200):**
```json
{
  "data": {
    "id": 2,
    "name": "Maria",
    "created_at": "2026-03-21T00:00:00Z",
    "bio": "Usuario activo",
    "avatar_url": "https://...",
    "level": 7,
    "followers_count": 75,
    "following_count": 40,
    "tamagochi": {
      "name": "Tamagochi de Maria",
      "status": "happy",
      "level": 8
    }
  }
}
```

---

## 📝 Resumen de Endpoints

| Método | Endpoint | Protegido | Descripción |
|--------|----------|-----------|-------------|
| POST | `/api/auth/register` | ❌ | Registrarse |
| POST | `/api/auth/login` | ❌ | Login |
| POST | `/api/auth/logout` | ✅ | Logout |
| GET | `/api/auth/me` | ✅ | Usuario actual |
| GET | `/api/tamagochi` | ✅ | Estado del tamagochi |
| POST | `/api/tamagochi/feed` | ✅ | Alimentar |
| POST | `/api/tamagochi/play` | ✅ | Jugar |
| POST | `/api/tamagochi/sleep` | ✅ | Dormir |
| PUT | `/api/tamagochi/update-name` | ✅ | Cambiar nombre |
| GET | `/api/statistics/my-stats` | ✅ | Mis estadísticas |
| GET | `/api/statistics/leaderboard` | ❌ | Ranking |
| GET | `/api/statistics/global` | ❌ | Estadísticas globales |
| GET | `/api/statistics/user/{id}` | ❌ | Estadísticas de usuario |
| GET | `/api/settings` | ✅ | Mi configuración |
| PUT | `/api/settings` | ✅ | Actualizar config |
| POST | `/api/settings/change-password` | ✅ | Cambiar contraseña |
| DELETE | `/api/settings/delete-account` | ✅ | Eliminar cuenta |
| GET | `/api/users/{id}` | ❌ | Perfil público |

---

## 🧪 Ejemplos con cURL

### Login
```bash
curl -X POST https://tamagochi-rrss.ddev.site/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email": "demo@tamagochi.test", "password": "password123"}'
```

### Obtener estado del Tamagochi
```bash
curl -X GET https://tamagochi-rrss.ddev.site/api/tamagochi \
  -H "Authorization: Bearer TOKEN"
```

### Jugar con el Tamagochi
```bash
curl -X POST https://tamagochi-rrss.ddev.site/api/tamagochi/play \
  -H "Authorization: Bearer TOKEN"
```

### Ver ranking
```bash
curl https://tamagochi-rrss.ddev.site/api/statistics/leaderboard?limit=5
```

### Actualizar configuración
```bash
curl -X PUT https://tamagochi-rrss.ddev.site/api/settings \
  -H "Authorization: Bearer TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"theme": "dark", "language": "en"}'
```

---

## ✅ Datos de prueba

**Usuario demo:**
- Email: demo@tamagochi.test
- Password: password123

**Usuarios adicionales creados con seeder:**
- 5 usuarios adicionales con tamagochis, estadísticas y configuración
- Datos variados para probar el ranking

---

¡Listo para probar todos los endpoints! 🐠
