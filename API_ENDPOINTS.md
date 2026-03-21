# 🔐 API Endpoints - Tamagochi RRSS

## Autenticación

### 1. Registrar nuevo usuario

**Endpoint:** `POST /api/auth/register`

**Request Body:**
```json
{
  "name": "Tu Nombre",
  "email": "tu@email.com",
  "password": "tucontraseña"
}
```

**Response (201):**
```json
{
  "message": "Usuario registrado exitosamente",
  "user": {
    "id": 1,
    "name": "Tu Nombre",
    "email": "tu@email.com",
    "created_at": "2026-03-21T01:47:00.000000Z",
    "updated_at": "2026-03-21T01:47:00.000000Z"
  },
  "token": "1|QwErTyUiOpAsD...",
  "token_type": "Bearer"
}
```

### 2. Login

**Endpoint:** `POST /api/auth/login`

**Request Body:**
```json
{
  "email": "tu@email.com",
  "password": "tucontraseña"
}
```

**Response (200):**
```json
{
  "message": "Login exitoso",
  "user": {
    "id": 1,
    "name": "Tu Nombre",
    "email": "tu@email.com",
    "created_at": "2026-03-21T01:47:00.000000Z",
    "updated_at": "2026-03-21T01:47:00.000000Z"
  },
  "token": "1|QwErTyUiOpAsD...",
  "token_type": "Bearer"
}
```

### 3. Obtener usuario actual (protegido)

**Endpoint:** `GET /api/auth/me`

**Headers:**
```
Authorization: Bearer 1|QwErTyUiOpAsD...
```

**Response (200):**
```json
{
  "user": {
    "id": 1,
    "name": "Tu Nombre",
    "email": "tu@email.com",
    "created_at": "2026-03-21T01:47:00.000000Z",
    "updated_at": "2026-03-21T01:47:00.000000Z"
  }
}
```

### 4. Logout (protegido)

**Endpoint:** `POST /api/auth/logout`

**Headers:**
```
Authorization: Bearer 1|QwErTyUiOpAsD...
```

**Response (200):**
```json
{
  "message": "Logout exitoso"
}
```

---

## 🧪 Pruebas con cURL

### Registrar usuario

```bash
curl -X POST https://tamagochi-rrss.ddev.site/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Juan Perez",
    "email": "juan@example.com",
    "password": "password123"
  }'
```

### Login

```bash
curl -X POST https://tamagochi-rrss.ddev.site/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "juan@example.com",
    "password": "password123"
  }'
```

### Obtener usuario actual (después de login)

```bash
curl -X GET https://tamagochi-rrss.ddev.site/api/auth/me \
  -H "Authorization: Bearer TOKEN_AQUI"
```

Sustituye `TOKEN_AQUI` por el token que recibiste en el login.

### Logout

```bash
curl -X POST https://tamagochi-rrss.ddev.site/api/auth/logout \
  -H "Authorization: Bearer TOKEN_AQUI"
```

---

## 📱 Pruebas desde navegador con Postman

1. **Registrarse:**
   - Método: POST
   - URL: `https://tamagochi-rrss.ddev.site/api/auth/register`
   - Body (JSON):
   ```json
   {
     "name": "Tu Nombre",
     "email": "tu@email.com",
     "password": "tucontraseña"
   }
   ```

2. **Copiar el token** que recibes en la respuesta

3. **Hacer login:**
   - Método: POST
   - URL: `https://tamagochi-rrss.ddev.site/api/auth/login`
   - Body (JSON):
   ```json
   {
     "email": "tu@email.com",
     "password": "tucontraseña"
   }
   ```

4. **Usar el token para acceder a endpoints protegidos:**
   - Método: GET
   - URL: `https://tamagochi-rrss.ddev.site/api/auth/me`
   - Headers:
     - Key: `Authorization`
     - Value: `Bearer TOKEN_AQUI`

---

## ✅ Endpoints disponibles

| Método | Endpoint | Protegido | Descripción |
|--------|----------|-----------|-------------|
| POST | `/api/auth/register` | ❌ | Registrar nuevo usuario |
| POST | `/api/auth/login` | ❌ | Login y obtener token |
| GET | `/api/auth/me` | ✅ | Obtener usuario actual |
| POST | `/api/auth/logout` | ✅ | Logout (elimina token) |
| GET | `/api/user` | ✅ | Alternativa para obtener usuario |

---

## 🔒 Autenticación con token

Todos los endpoints protegidos requieren enviar el token en el header:

```
Authorization: Bearer YOUR_TOKEN_HERE
```

Si no envías el token o es inválido, recibirás un error 401:

```json
{
  "message": "Unauthenticated."
}
```

---

## 📝 Notas

- Los tokens se generan con Laravel Sanctum
- Cada usuario puede tener múltiples tokens activos
- Los tokens NO expiran automáticamente (si quieres, se pueden configurar)
- El token es único por sesión/dispositivo

---

## 🚀 Próximos pasos

Ahora puedes:

1. Agregar más endpoints específicos para tu aplicación
2. Crear controladores para tus recursos (posts, comentarios, etc.)
3. Usar los tokens en tu frontend para autenticación
4. Configurar roles y permisos si lo necesitas

¡Listo para empezar a construir tu API! 🐠
