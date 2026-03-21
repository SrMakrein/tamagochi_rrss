# 🛡️ Admin Panel - Endpoints de Administración

## 📋 Acceso de Administrador

**Credenciales Admin:**
- Email: `admin@tamagochi.test`
- Password: `admin123`
- Role: `admin`

---

## 🛠️ Endpoints de Administración (Todos Protegidos)

Todos estos endpoints requieren:
- `Authorization: Bearer TOKEN` (de usuario admin)
- Role: `admin`

---

### 📊 Dashboard de Administración

**GET** `/api/admin/dashboard`

Obtiene estadísticas generales del sistema.

**Response (200):**
```json
{
  "message": "Dashboard de administración",
  "data": {
    "total_users": 7,
    "total_admins": 1,
    "total_regular_users": 6,
    "users_logged_today": 2,
    "total_tamagochis": 7,
    "average_tamagochi_level": 5.5,
    "total_posts": 125,
    "total_likes": 850,
    "top_5_users": [
      {
        "id": 5,
        "name": "Usuario Top",
        "email": "top@example.com",
        "role": "user",
        "created_at": "2026-03-21T00:00:00Z"
      }
    ]
  }
}
```

---

### 👥 Gestión de Usuarios

#### Listar todos los usuarios
**GET** `/api/admin/users?limit=20&page=1`

**Query Parameters:**
- `limit` (opcional): Usuarios por página (default: 20)
- `page` (opcional): Número de página (default: 1)

**Response (200):**
```json
{
  "message": "Lista de usuarios",
  "data": {
    "data": [
      {
        "id": 1,
        "name": "Juan Pérez",
        "email": "juan@example.com",
        "role": "user",
        "last_login": "2026-03-21T02:50:00Z",
        "created_at": "2026-03-21T00:00:00Z",
        "tamagochi": { ... },
        "statistic": { ... },
        "setting": { ... }
      }
    ],
    "current_page": 1,
    "per_page": 20,
    "total": 7
  }
}
```

#### Ver detalles de un usuario
**GET** `/api/admin/users/{userId}`

**Response (200):**
```json
{
  "data": {
    "id": 2,
    "name": "Maria García",
    "email": "maria@example.com",
    "role": "user",
    "last_login": "2026-03-21T02:40:00Z",
    "created_at": "2026-03-21T00:00:00Z",
    "tamagochi": {
      "id": 2,
      "name": "Mi Tamagochi",
      "status": "happy",
      "energy": 80,
      "level": 5,
      ...
    },
    "statistic": {
      "total_posts": 25,
      "total_likes": 150,
      ...
    },
    "setting": {
      "theme": "light",
      "language": "es",
      ...
    }
  }
}
```

#### Crear un nuevo usuario
**POST** `/api/admin/users`

**Body:**
```json
{
  "name": "Nuevo Usuario",
  "email": "nuevo@example.com",
  "password": "password123",
  "role": "user"
}
```

**Response (201):**
```json
{
  "message": "✅ Usuario creado",
  "data": {
    "id": 10,
    "name": "Nuevo Usuario",
    "email": "nuevo@example.com",
    "role": "user",
    "created_at": "2026-03-21T02:52:00Z"
  }
}
```

#### Actualizar datos de un usuario
**PUT** `/api/admin/users/{userId}`

**Body:**
```json
{
  "name": "Nombre Actualizado",
  "email": "nuevo@email.com"
}
```

**Response (200):**
```json
{
  "message": "✅ Usuario actualizado",
  "data": {
    "id": 2,
    "name": "Nombre Actualizado",
    "email": "nuevo@email.com",
    ...
  }
}
```

#### Cambiar rol de un usuario
**PUT** `/api/admin/users/{userId}/role`

**Body:**
```json
{
  "role": "admin"
}
```

**Response (200):**
```json
{
  "message": "✅ Rol actualizado",
  "data": {
    "id": 2,
    "name": "Maria García",
    "role": "admin",
    ...
  }
}
```

#### Eliminar un usuario
**DELETE** `/api/admin/users/{userId}`

**Response (200):**
```json
{
  "message": "✅ Usuario eliminado"
}
```

⚠️ **Nota:** No puedes eliminar tu propia cuenta como admin.

---

### 🎮 Gestión de Tamagochis

#### Resetear tamagochi de un usuario
**POST** `/api/admin/users/{userId}/tamagochi/reset`

Vuelve el tamagochi a su estado inicial.

**Response (200):**
```json
{
  "message": "✅ Tamagochi reseteado",
  "data": {
    "id": 2,
    "user_id": 2,
    "name": "Mi Tamagochi",
    "status": "normal",
    "energy": 100,
    "hunger": 50,
    "happiness": 75,
    "health": 100,
    "level": 1,
    "experience": 0,
    "times_played": 0,
    "last_fed": null,
    "last_played": null
  }
}
```

---

### 📈 Actividad y Monitoreo

#### Ver actividad de usuarios
**GET** `/api/admin/activity?days=7`

**Query Parameters:**
- `days` (opcional): Últimos X días (default: 7)

**Response (200):**
```json
{
  "message": "Actividad de usuarios últimos 7 días",
  "data": [
    {
      "id": 1,
      "name": "Juan Pérez",
      "email": "juan@example.com",
      "last_login": "2026-03-21T02:50:00Z",
      "created_at": "2026-03-20T15:30:00Z"
    },
    {
      "id": 2,
      "name": "Maria García",
      "email": "maria@example.com",
      "last_login": "2026-03-21T02:40:00Z",
      "created_at": "2026-03-20T16:20:00Z"
    }
  ]
}
```

---

## 📝 Resumen de Endpoints Admin

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/admin/dashboard` | Dashboard de estadísticas |
| GET | `/api/admin/users` | Listar usuarios |
| GET | `/api/admin/users/{id}` | Ver detalles de usuario |
| POST | `/api/admin/users` | Crear usuario |
| PUT | `/api/admin/users/{id}` | Actualizar usuario |
| PUT | `/api/admin/users/{id}/role` | Cambiar rol |
| DELETE | `/api/admin/users/{id}` | Eliminar usuario |
| POST | `/api/admin/users/{id}/tamagochi/reset` | Resetear tamagochi |
| GET | `/api/admin/activity` | Ver actividad de usuarios |

---

## 🧪 Ejemplos de Uso

### Login como Admin
```bash
curl -X POST https://tamagochi-rrss.ddev.site/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@tamagochi.test",
    "password": "admin123"
  }'
```

### Ver dashboard admin
```bash
curl https://tamagochi-rrss.ddev.site/api/admin/dashboard \
  -H "Authorization: Bearer TOKEN"
```

### Listar todos los usuarios
```bash
curl https://tamagochi-rrss.ddev.site/api/admin/users \
  -H "Authorization: Bearer TOKEN"
```

### Ver detalles de un usuario específico
```bash
curl https://tamagochi-rrss.ddev.site/api/admin/users/2 \
  -H "Authorization: Bearer TOKEN"
```

### Crear un nuevo usuario como admin
```bash
curl -X POST https://tamagochi-rrss.ddev.site/api/admin/users \
  -H "Authorization: Bearer TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Nuevo Usuario",
    "email": "nuevo@example.com",
    "password": "password123",
    "role": "user"
  }'
```

### Cambiar rol de usuario a admin
```bash
curl -X PUT https://tamagochi-rrss.ddev.site/api/admin/users/3/role \
  -H "Authorization: Bearer TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"role": "admin"}'
```

### Ver actividad de últimos 30 días
```bash
curl https://tamagochi-rrss.ddev.site/api/admin/activity?days=30 \
  -H "Authorization: Bearer TOKEN"
```

### Resetear tamagochi de un usuario
```bash
curl -X POST https://tamagochi-rrss.ddev.site/api/admin/users/2/tamagochi/reset \
  -H "Authorization: Bearer TOKEN"
```

---

## 🔐 Protección y Seguridad

- ✅ Solo usuarios con `role = 'admin'` pueden acceder
- ✅ Validación de permisos en cada endpoint
- ✅ No se puede eliminar la propia cuenta como admin
- ✅ Tokens Bearer requeridos
- ✅ `last_login` se registra en cada acceso

---

## 📊 Capacidades del Panel Admin

✅ Ver todos los usuarios y su información  
✅ Ver estadísticas de cada usuario  
✅ Crear, editar y eliminar usuarios  
✅ Cambiar roles (user ↔ admin)  
✅ Monitorear actividad de usuarios  
✅ Resetear tamagochis  
✅ Ver estadísticas globales del sistema  

---

¡El panel de administración está completo! 🛡️
