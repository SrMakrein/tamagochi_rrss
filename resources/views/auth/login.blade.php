<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🐠 Tamagochi RRSS - Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 0.9em;
            opacity: 0.9;
        }

        .content {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn-container {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-register {
            background: #f0f0f0;
            color: #333;
            border: 2px solid #e0e0e0;
        }

        .btn-register:hover {
            background: #e0e0e0;
        }

        .message {
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: none;
        }

        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            display: block;
        }

        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            display: block;
        }

        .loading {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .user-info {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
            display: none;
        }

        .user-info h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 1.2em;
        }

        .user-info p {
            margin: 10px 0;
            color: #666;
            font-size: 0.95em;
        }

        .user-info strong {
            color: #333;
        }

        .token-display {
            background: #f0f0f0;
            padding: 10px;
            border-radius: 3px;
            font-family: monospace;
            font-size: 0.8em;
            word-break: break-all;
            margin: 10px 0;
            max-height: 100px;
            overflow-y: auto;
        }

        .tab-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            border-bottom: 2px solid #e0e0e0;
        }

        .tab-btn {
            padding: 10px 20px;
            border: none;
            background: none;
            cursor: pointer;
            color: #999;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
            font-weight: 600;
        }

        .tab-btn.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .demo-info {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 0.9em;
            color: #1565c0;
            border-left: 4px solid #1976d2;
        }

        .demo-info strong {
            display: block;
            margin-top: 8px;
            color: #0d47a1;
        }

        @media (max-width: 500px) {
            .header h1 {
                font-size: 1.5em;
            }

            .content {
                padding: 20px;
            }

            .btn-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🐠 Tamagochi RRSS</h1>
            <p>Sistema de Autenticación</p>
        </div>

        <div class="content">
            <!-- Tabs -->
            <div class="tab-buttons">
                <button class="tab-btn active" onclick="switchTab('login')">Login</button>
                <button class="tab-btn" onclick="switchTab('register')">Registrarse</button>
            </div>

            <!-- Tab: Login -->
            <div id="login-tab" class="tab-content active">
                <div class="demo-info">
                    <strong>Demo:</strong>
                    Email: demo@tamagochi.test<br>
                    Password: password123
                </div>

                <div id="login-message" class="message"></div>

                <form id="login-form" onsubmit="handleLogin(event)">
                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <input type="email" id="login-email" name="email" required placeholder="tu@email.com">
                    </div>

                    <div class="form-group">
                        <label for="login-password">Contraseña</label>
                        <input type="password" id="login-password" name="password" required placeholder="••••••••">
                    </div>

                    <div class="loading" id="login-loading">
                        <div class="spinner"></div>
                    </div>

                    <div class="btn-container">
                        <button type="submit" class="btn-login">Ingresar</button>
                    </div>
                </form>

                <div id="login-user-info" class="user-info"></div>
            </div>

            <!-- Tab: Register -->
            <div id="register-tab" class="tab-content">
                <div id="register-message" class="message"></div>

                <form id="register-form" onsubmit="handleRegister(event)">
                    <div class="form-group">
                        <label for="register-name">Nombre</label>
                        <input type="text" id="register-name" name="name" required placeholder="Tu nombre completo">
                    </div>

                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <input type="email" id="register-email" name="email" required placeholder="tu@email.com">
                    </div>

                    <div class="form-group">
                        <label for="register-password">Contraseña</label>
                        <input type="password" id="register-password" name="password" required placeholder="••••••••" minlength="6">
                    </div>

                    <div class="loading" id="register-loading">
                        <div class="spinner"></div>
                    </div>

                    <div class="btn-container">
                        <button type="submit" class="btn-login">Registrarse</button>
                    </div>
                </form>

                <div id="register-user-info" class="user-info"></div>
            </div>
        </div>
    </div>

    <script>
        const API_URL = '/api';

        // Cambiar entre tabs
        function switchTab(tab) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
            
            document.getElementById(tab + '-tab').classList.add('active');
            event.target.classList.add('active');
        }

        // Mostrar mensaje
        function showMessage(elementId, message, type) {
            const el = document.getElementById(elementId);
            el.textContent = message;
            el.className = `message ${type}`;
        }

        // Limpiar formulario
        function clearForm(formId) {
            document.getElementById(formId).reset();
        }

        // Mostrar información del usuario
        function displayUserInfo(containerId, user, token) {
            const container = document.getElementById(containerId);
            container.innerHTML = `
                <h3>✅ Login Exitoso</h3>
                <p><strong>Nombre:</strong> ${user.name}</p>
                <p><strong>Email:</strong> ${user.email}</p>
                <p><strong>ID:</strong> ${user.id}</p>
                <p><strong>Token:</strong></p>
                <div class="token-display">${token}</div>
                <p style="margin-top: 15px; font-size: 0.85em; color: #999;">
                    El token ha sido guardado en localStorage. Úsalo en el header "Authorization: Bearer TOKEN" para acceder a endpoints protegidos.
                </p>
                <button onclick="logout()" class="btn-register" style="width: 100%; margin-top: 15px;">Cerrar Sesión</button>
            `;
            container.style.display = 'block';
        }

        // Login
        async function handleLogin(event) {
            event.preventDefault();

            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;
            const loading = document.getElementById('login-loading');
            const message = document.getElementById('login-message');

            loading.style.display = 'block';

            try {
                const response = await fetch(`${API_URL}/auth/login`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                loading.style.display = 'none';

                if (!response.ok) {
                    showMessage('login-message', '❌ ' + (data.message || 'Error en login'), 'error');
                    return;
                }

                showMessage('login-message', '✅ ' + data.message, 'success');
                localStorage.setItem('auth_token', data.token);
                location.href = '/dashboard';
                clearForm('login-form');
                displayUserInfo('login-user-info', data.user, data.token);
            } catch (error) {
                loading.style.display = 'none';
                showMessage('login-message', '❌ Error: ' + error.message, 'error');
            }
        }

        // Registrar
        async function handleRegister(event) {
            event.preventDefault();

            const name = document.getElementById('register-name').value;
            const email = document.getElementById('register-email').value;
            const password = document.getElementById('register-password').value;
            const loading = document.getElementById('register-loading');
            const message = document.getElementById('register-message');

            loading.style.display = 'block';

            try {
                const response = await fetch(`${API_URL}/auth/register`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ name, email, password })
                });

                const data = await response.json();

                loading.style.display = 'none';

                if (!response.ok) {
                    showMessage('register-message', '❌ ' + (data.message || 'Error en registro'), 'error');
                    return;
                }

                showMessage('register-message', '✅ ' + data.message, 'success');
                localStorage.setItem('auth_token', data.token);
                clearForm('register-form');
                displayUserInfo('register-user-info', data.user, data.token);
            } catch (error) {
                loading.style.display = 'none';
                showMessage('register-message', '❌ Error: ' + error.message, 'error');
            }
        }

        // Logout
        async function logout() {
            const token = localStorage.getItem('auth_token');

            if (!token) {
                alert('No hay sesión activa');
                return;
            }

            try {
                const response = await fetch(`${API_URL}/auth/logout`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                localStorage.removeItem('auth_token');
                document.getElementById('login-user-info').style.display = 'none';
                document.getElementById('register-user-info').style.display = 'none';
                location.href = '/dashboard';
                clearForm('login-form');
                clearForm('register-form');

                alert('✅ Sesión cerrada');
                location.reload();
            } catch (error) {
                alert('❌ Error: ' + error.message);
            }
        }

        // Restaurar sesión si existe token
        window.addEventListener('load', () => {
            const token = localStorage.getItem('auth_token');
            if (token) {
                console.log('Token encontrado:', token);
                // Podrías verificar el token aquí si lo deseas
            }
        });
    </script>
</body>
</html>
