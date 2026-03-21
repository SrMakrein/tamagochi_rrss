<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🐠 Tamagochi RRSS - Mi Compañero</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            min-height: 100vh;
        }

        .navbar {
            background: rgba(0, 0, 0, 0.2);
            color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            font-size: 1.5em;
        }

        .navbar-right {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .navbar-role {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9em;
        }

        .navbar button {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid white;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .navbar button:hover {
            background: white;
            color: #667eea;
        }

        .settings-icon {
            cursor: pointer;
            font-size: 1.3em;
            transition: transform 0.3s;
        }

        .settings-icon:hover {
            transform: rotate(20deg);
        }

        /* SETTINGS MODAL */
        .settings-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 3000;
            padding: 20px;
        }

        .settings-modal.show {
            display: flex;
        }

        .settings-content {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 600px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .settings-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .settings-header h2 {
            color: #667eea;
            font-size: 1.8em;
        }

        .settings-close {
            font-size: 1.5em;
            cursor: pointer;
            color: #999;
            transition: color 0.3s;
        }

        .settings-close:hover {
            color: #333;
        }

        .settings-section {
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 1px solid #f0f0f0;
        }

        .settings-section:last-child {
            border-bottom: none;
        }

        .settings-section h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 1.1em;
        }

        .setting-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .setting-group label {
            font-weight: 600;
            color: #333;
            font-size: 0.95em;
        }

        .setting-group input,
        .setting-group select,
        .setting-group textarea {
            padding: 12px;
            border: 2px solid #f0f0f0;
            border-radius: 8px;
            font-size: 0.95em;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: border-color 0.3s;
        }

        .setting-group input:focus,
        .setting-group select:focus,
        .setting-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }

        .setting-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .toggle-switch {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider-toggle {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 26px;
        }

        .slider-toggle:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked + .slider-toggle {
            background-color: #667eea;
        }

        input:checked + .slider-toggle:before {
            transform: translateX(24px);
        }

        .color-picker {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .color-option {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s;
        }

        .color-option:hover {
            transform: scale(1.1);
        }

        .color-option.selected {
            border-color: #333;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .settings-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .settings-buttons button {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.95em;
        }

        .settings-buttons button.save {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .settings-buttons button.save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .settings-buttons button.cancel {
            background: #f0f0f0;
            color: #333;
        }

        .settings-buttons button.cancel:hover {
            background: #e0e0e0;
        }

        body.dark-mode {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #f0f0f0;
        }

        body.dark-mode .tamagochi-main,
        body.dark-mode .controls-section,
        body.dark-mode .quick-actions,
        body.dark-mode .stat-info,
        body.dark-mode .settings-content {
            background: #2d2d44;
            color: #f0f0f0;
        }

        body.dark-mode .control-item,
        body.dark-mode .stat-box,
        body.dark-mode .description {
            background: #3d3d54;
            color: #f0f0f0;
        }

        body.dark-mode .setting-group input,
        body.dark-mode .setting-group select,
        body.dark-mode .setting-group textarea {
            background: #1a1a2e;
            color: #f0f0f0;
            border-color: #3d3d54;
        }

        body.dark-mode .settings-section {
            border-bottom-color: #3d3d54;
        }

        @media (max-width: 768px) {
            .settings-content {
                padding: 25px;
                max-width: calc(100% - 40px);
            }

            .settings-header h2 {
                font-size: 1.4em;
            }

            .color-picker {
                justify-content: center;
            }
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .login-prompt {
            background: #fff3cd;
            color: #856404;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }

        .login-prompt a {
            color: #0066cc;
            text-decoration: none;
            font-weight: 600;
        }

        /* TAMAGOCHI PRINCIPAL */
        .tamagochi-main {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
            text-align: center;
        }

        .tamagochi-display {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
        }

        .tamagochi-name {
            font-size: 1.3em;
            color: #667eea;
            margin-bottom: 10px;
        }

        .tamagochi-name input {
            padding: 10px 15px;
            border: 2px solid #667eea;
            border-radius: 8px;
            font-size: 1em;
            width: 300px;
            text-align: center;
        }

        .tamagochi-visual {
            font-size: 150px;
            line-height: 1;
            animation: bounce 2s infinite;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .tamagochi-visual:hover {
            transform: scale(1.1);
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .tamagochi-status {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .status-badge {
            background: #f9f9f9;
            padding: 15px 25px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
            font-weight: 600;
            font-size: 1.1em;
        }

        .status-badge.good {
            border-left-color: #52c41a;
            color: #52c41a;
        }

        .status-badge.normal {
            border-left-color: #ffd93d;
            color: #cc8800;
        }

        .status-badge.bad {
            border-left-color: #ff6b6b;
            color: #ff6b6b;
        }

        .time-display {
            font-size: 0.9em;
            color: #999;
            margin-top: 15px;
        }

        /* CONTROLES DESLIZANTES */
        .controls-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }

        .controls-section h2 {
            color: #667eea;
            margin-bottom: 30px;
            text-align: center;
        }

        .controls-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .control-item {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 15px;
            border: 2px solid #f0f0f0;
            transition: all 0.3s;
        }

        .control-item.critical {
            border-color: #ff6b6b;
            background: #fff5f5;
        }

        .control-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .control-label strong {
            font-size: 1.1em;
            color: #333;
        }

        .control-value {
            background: #667eea;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9em;
        }

        .control-value.critical {
            background: #ff6b6b;
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }

        .slider {
            width: 100%;
            height: 8px;
            border-radius: 5px;
            background: linear-gradient(to right, #ff6b6b, #ffd93d, #52c41a);
            outline: none;
            -webkit-appearance: none;
            appearance: none;
            cursor: pointer;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #667eea;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.4);
            transition: all 0.2s;
        }

        .slider::-webkit-slider-thumb:hover {
            transform: scale(1.2);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.6);
        }

        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #667eea;
            cursor: pointer;
            border: none;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.4);
            transition: all 0.2s;
        }

        .slider::-moz-range-thumb:hover {
            transform: scale(1.2);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.6);
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background: #e9ecef;
            border-radius: 10px;
            margin-top: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        .progress-fill.energy {
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .progress-fill.hunger {
            background: linear-gradient(90deg, #ff9a56, #ff6b6b);
        }

        .progress-fill.happiness {
            background: linear-gradient(90deg, #ffd93d, #ffb347);
        }

        .progress-fill.health {
            background: linear-gradient(90deg, #52c41a, #87d068);
        }

        /* DESCRIPCIÓN */
        .description {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
            font-size: 0.9em;
            color: #666;
            border-left: 4px solid #667eea;
        }

        .stat-info {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }

        .stat-info h2 {
            color: #667eea;
            margin-bottom: 20px;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .stat-box {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
            text-align: center;
        }

        .stat-box .label {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 10px;
        }

        .stat-box .value {
            font-size: 1.8em;
            font-weight: 600;
            color: #667eea;
        }

        .quick-actions {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }

        .quick-actions h2 {
            color: #667eea;
            margin-bottom: 20px;
            text-align: center;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        button.action-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 600;
            transition: all 0.3s;
        }

        button.action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        button.action-btn:active {
            transform: translateY(-1px);
        }

        .message {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            animation: slideIn 0.3s ease;
            display: none;
        }

        .message.show {
            display: block;
        }

        .message.success {
            border-left: 4px solid #52c41a;
            color: #52c41a;
        }

        .message.error {
            border-left: 4px solid #ff6b6b;
            color: #ff6b6b;
        }

        .message.warning {
            border-left: 4px solid #ffd93d;
            color: #cc8800;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .death-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            color: white;
            text-align: center;
        }

        .death-screen.show {
            display: flex;
        }

        .death-screen-content {
            font-size: 3em;
            margin-bottom: 30px;
        }

        .death-screen h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .death-screen p {
            font-size: 1.2em;
            margin-bottom: 30px;
            color: #ccc;
        }

        .death-screen button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 10px;
            font-size: 1.2em;
            cursor: pointer;
            transition: all 0.3s;
        }

        .death-screen button:hover {
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .tamagochi-main {
                padding: 20px;
            }

            .tamagochi-visual {
                font-size: 80px;
            }

            .tamagochi-name input {
                width: 90%;
            }

            .controls-grid {
                grid-template-columns: 1fr;
            }

            .message {
                right: 10px;
                left: 10px;
                width: calc(100% - 20px);
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🐠 Tamagochi RRSS - Mi Compañero</h1>
        <div class="navbar-right">
            <div id="role-badge" class="navbar-role" style="display: none;"></div>
            <span class="settings-icon" onclick="openSettings()" title="Configuración">⚙️</span>
            <button onclick="logout()">Cerrar Sesión</button>
        </div>
    </div>

    <!-- SETTINGS MODAL -->
    <div id="settings-modal" class="settings-modal">
        <div class="settings-content">
            <div class="settings-header">
                <h2>⚙️ Configuración</h2>
                <span class="settings-close" onclick="closeSettings()">✕</span>
            </div>

            <!-- PERFIL -->
            <div class="settings-section">
                <h3>👤 Perfil</h3>
                <div class="setting-group">
                    <label>Nombre completo</label>
                    <input type="text" id="setting-name" placeholder="Tu nombre">
                </div>
                <div class="setting-group">
                    <label>Email</label>
                    <input type="email" id="setting-email" placeholder="tu@email.com" readonly style="background: #f9f9f9;">
                </div>
                <div class="setting-group">
                    <label>Bio/Descripción</label>
                    <textarea id="setting-bio" placeholder="Cuéntanos sobre ti..." maxlength="200"></textarea>
                </div>
            </div>

            <!-- TAMAGOCHI -->
            <div class="settings-section">
                <h3>🐠 Mi Tamagochi</h3>
                <div class="setting-group">
                    <label>Nombre del Tamagochi</label>
                    <input type="text" id="setting-tama-name" placeholder="Nombre de tu compañero" maxlength="30">
                </div>
                <div class="setting-group">
                    <label>Color favorito del Tamagochi</label>
                    <div class="color-picker">
                        <div class="color-option selected" style="background: #667eea;" onclick="selectColor('#667eea', this)"></div>
                        <div class="color-option" style="background: #ff6b6b;" onclick="selectColor('#ff6b6b', this)"></div>
                        <div class="color-option" style="background: #52c41a;" onclick="selectColor('#52c41a', this)"></div>
                        <div class="color-option" style="background: #ffd93d;" onclick="selectColor('#ffd93d', this)"></div>
                        <div class="color-option" style="background: #ff9a56;" onclick="selectColor('#ff9a56', this)"></div>
                        <div class="color-option" style="background: #a78bfa;" onclick="selectColor('#a78bfa', this)"></div>
                    </div>
                </div>
            </div>

            <!-- NOTIFICACIONES -->
            <div class="settings-section">
                <h3>🔔 Notificaciones</h3>
                <div class="setting-group">
                    <label>Alertas de hambre</label>
                    <div class="toggle-switch">
                        <label class="switch">
                            <input type="checkbox" id="setting-notify-hunger" checked>
                            <span class="slider-toggle"></span>
                        </label>
                        <span>Recibir notificaciones cuando tenga hambre</span>
                    </div>
                </div>
                <div class="setting-group">
                    <label>Alertas de cansancio</label>
                    <div class="toggle-switch">
                        <label class="switch">
                            <input type="checkbox" id="setting-notify-energy" checked>
                            <span class="slider-toggle"></span>
                        </label>
                        <span>Recibir notificaciones cuando esté cansado</span>
                    </div>
                </div>
                <div class="setting-group">
                    <label>Alertas de tristeza</label>
                    <div class="toggle-switch">
                        <label class="switch">
                            <input type="checkbox" id="setting-notify-happiness" checked>
                            <span class="slider-toggle"></span>
                        </label>
                        <span>Recibir notificaciones cuando esté triste</span>
                    </div>
                </div>
            </div>

            <!-- EXPERIENCIA -->
            <div class="settings-section">
                <h3>🎮 Experiencia</h3>
                <div class="setting-group">
                    <label>Tema</label>
                    <select id="setting-theme">
                        <option value="light">☀️ Claro</option>
                        <option value="dark">🌙 Oscuro</option>
                    </select>
                </div>
                <div class="setting-group">
                    <label>Idioma</label>
                    <select id="setting-language">
                        <option value="es">🇪🇸 Español</option>
                        <option value="en">🇬🇧 Inglés</option>
                        <option value="fr">🇫🇷 Francés</option>
                    </select>
                </div>
                <div class="setting-group">
                    <label>Sonidos</label>
                    <div class="toggle-switch">
                        <label class="switch">
                            <input type="checkbox" id="setting-sounds" checked>
                            <span class="slider-toggle"></span>
                        </label>
                        <span>Habilitar efectos de sonido</span>
                    </div>
                </div>
            </div>

            <!-- PRIVACIDAD -->
            <div class="settings-section">
                <h3>🔒 Privacidad</h3>
                <div class="setting-group">
                    <label>Perfil privado</label>
                    <div class="toggle-switch">
                        <label class="switch">
                            <input type="checkbox" id="setting-private">
                            <span class="slider-toggle"></span>
                        </label>
                        <span>Ocultar tu perfil de otros usuarios</span>
                    </div>
                </div>
                <div class="setting-group">
                    <label>Ocultar estadísticas</label>
                    <div class="toggle-switch">
                        <label class="switch">
                            <input type="checkbox" id="setting-hide-stats">
                            <span class="slider-toggle"></span>
                        </label>
                        <span>No mostrar tus estadísticas públicamente</span>
                    </div>
                </div>
            </div>

            <!-- SEGURIDAD -->
            <div class="settings-section">
                <h3>🔐 Seguridad</h3>
                <div class="setting-group">
                    <label>Cambiar contraseña</label>
                    <button class="action-btn" onclick="openPasswordChange()" style="width: 100%;">🔑 Cambiar Contraseña</button>
                </div>
                <div class="setting-group">
                    <label>Peligro</label>
                    <button class="action-btn" onclick="deleteAccount()" style="width: 100%; background: #ff6b6b; margin-top: 10px;">🗑️ Eliminar Mi Cuenta</button>
                </div>
            </div>

            <!-- BOTONES -->
            <div class="settings-buttons">
                <button class="save" onclick="saveSettings()">💾 Guardar Cambios</button>
                <button class="cancel" onclick="closeSettings()">✕ Cancelar</button>
            </div>
        </div>
    </div>

    <div class="container">
        <div id="login-prompt" class="login-prompt">
            ⚠️ No estás autenticado. <a href="/login">Ir a Login</a>
        </div>

        <div id="message" class="message"></div>

        <!-- DEATH SCREEN -->
        <div id="death-screen" class="death-screen">
            <div class="death-screen-content">💀</div>
            <h2>Tu Tamagochi ha muerto</h2>
            <p id="death-reason">Lo siento, no fue atendido correctamente.</p>
            <button onclick="reviveTamagochi()">🔄 Revivir Tamagochi</button>
        </div>

        <!-- TAMAGOCHI PRINCIPAL -->
        <div id="tamagochi-section" style="display: none;">
            <div class="tamagochi-main">
                <div class="tamagochi-display">
                    <div>
                        <div class="tamagochi-name">
                            <label>Mi Compañero</label>
                            <input type="text" id="tamagochi-name" placeholder="Nombre de tu Tamagochi" maxlength="30">
                        </div>
                    </div>

                    <div class="tamagochi-visual" id="tamagochi-emoji">🐠</div>

                    <div class="tamagochi-status">
                        <div class="status-badge" id="energy-status">⚡ Energía</div>
                        <div class="status-badge" id="hunger-status">🍽️ Hambre</div>
                        <div class="status-badge" id="happiness-status">😊 Felicidad</div>
                        <div class="status-badge" id="health-status">❤️ Salud</div>
                    </div>

                    <div class="time-display">
                        ⏱️ Última atención: <span id="last-interaction">hace unos momentos</span>
                    </div>
                </div>
            </div>

            <!-- CONTROLES DESLIZANTES -->
            <div class="controls-section">
                <h2>🎮 Controla a tu Tamagochi</h2>
                <div class="controls-grid">
                    <!-- ENERGÍA -->
                    <div class="control-item" id="energy-item">
                        <div class="control-label">
                            <strong>⚡ Energía</strong>
                            <span class="control-value" id="energy-value">100</span>
                        </div>
                        <input type="range" class="slider" id="energy-slider" min="0" max="100" value="100" oninput="updateTamagochi('energy')">
                        <div class="progress-bar">
                            <div class="progress-fill energy" id="energy-progress" style="width: 100%;"></div>
                        </div>
                        <div class="description">
                            ⚠️ Se reduce exponencialmente si no duermes. ¡Descuida y muere en 1 hora!
                        </div>
                    </div>

                    <!-- HAMBRE -->
                    <div class="control-item" id="hunger-item">
                        <div class="control-label">
                            <strong>🍽️ Hambre</strong>
                            <span class="control-value" id="hunger-value">0</span>
                        </div>
                        <input type="range" class="slider" id="hunger-slider" min="0" max="100" value="0" oninput="updateTamagochi('hunger')">
                        <div class="progress-bar">
                            <div class="progress-fill hunger" id="hunger-progress" style="width: 0%;"></div>
                        </div>
                        <div class="description">
                            ⚠️ Aumenta constantemente. Si alcanza 100%, ¡muere de inanición en 1 hora!
                        </div>
                    </div>

                    <!-- FELICIDAD -->
                    <div class="control-item" id="happiness-item">
                        <div class="control-label">
                            <strong>😊 Felicidad</strong>
                            <span class="control-value" id="happiness-value">75</span>
                        </div>
                        <input type="range" class="slider" id="happiness-slider" min="0" max="100" value="75" oninput="updateTamagochi('happiness')">
                        <div class="progress-bar">
                            <div class="progress-fill happiness" id="happiness-progress" style="width: 75%;"></div>
                        </div>
                        <div class="description">
                            ⚠️ Decrece rápidamente si no juegas. Muere por depresión en 1 hora.
                        </div>
                    </div>

                    <!-- SALUD -->
                    <div class="control-item" id="health-item">
                        <div class="control-label">
                            <strong>❤️ Salud</strong>
                            <span class="control-value" id="health-value">100</span>
                        </div>
                        <input type="range" class="slider" id="health-slider" min="0" max="100" value="100" oninput="updateTamagochi('health')">
                        <div class="progress-bar">
                            <div class="progress-fill health" id="health-progress" style="width: 100%;"></div>
                        </div>
                        <div class="description">
                            ⚠️ Se degrada por negligencia. Si llega a 0, ¡tu Tamagochi muere!
                        </div>
                    </div>
                </div>
            </div>

            <!-- ACCIONES RÁPIDAS -->
            <div class="quick-actions">
                <h2>⚡ Acciones Rápidas</h2>
                <div class="actions-grid">
                    <button class="action-btn" onclick="quickAction('feed')">🍽️ Alimentar</button>
                    <button class="action-btn" onclick="quickAction('play')">🎮 Jugar</button>
                    <button class="action-btn" onclick="quickAction('sleep')">🛌 Dormir</button>
                    <button class="action-btn" onclick="quickAction('cure')">💊 Curar</button>
                    <button class="action-btn" onclick="saveTamagochi()">💾 Guardar</button>
                </div>
            </div>

            <!-- ESTADÍSTICAS -->
            <div class="stat-info">
                <h2>📊 Información de tu Tamagochi</h2>
                <div class="stat-grid">
                    <div class="stat-box">
                        <div class="label">Nivel</div>
                        <div class="value" id="level-value">1</div>
                    </div>
                    <div class="stat-box">
                        <div class="label">Experiencia</div>
                        <div class="value" id="experience-value">0%</div>
                    </div>
                    <div class="stat-box">
                        <div class="label">Veces Jugado</div>
                        <div class="value" id="playtime-value">0</div>
                    </div>
                    <div class="stat-box">
                        <div class="label">Edad (días)</div>
                        <div class="value" id="age-value">1</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const API_URL = '/api';
        let updateInterval = null;
        let selectedColor = '#667eea';

        // Configuración del usuario
        let userSettings = {
            name: '',
            email: '',
            bio: '',
            tamagochi_name: '',
            tamagochi_color: '#667eea',
            notify_hunger: true,
            notify_energy: true,
            notify_happiness: true,
            theme: 'light',
            language: 'es',
            sounds: true,
            private_profile: false,
            hide_stats: false
        };

        // Estado del Tamagochi
        let tamagochi = {
            id: null,
            name: 'Mi Tamagochi',
            energy: 100,
            hunger: 0,
            happiness: 75,
            health: 100,
            level: 1,
            experience: 0,
            times_played: 0,
            age: 1,
            status: 'happy',
            last_interaction: Date.now(),
            created_at: Date.now(),
            is_alive: true
        };

        const DETERIORATION_RATES = {
            energy: 0.3,
            hunger: 0.25,
            happiness: 0.4,
            health: 0.15
        };

        // Inicialización
        window.addEventListener('load', () => {
            const token = localStorage.getItem('auth_token');
            if (token) {
                document.getElementById('login-prompt').style.display = 'none';
                document.getElementById('tamagochi-section').style.display = 'block';
                refreshUserInfo();
                loadSettings();
                loadTamagochi();
                startAutoUpdate();
            }
        });

        function openSettings() {
            document.getElementById('settings-modal').classList.add('show');
            loadSettingsForm();
        }

        function closeSettings() {
            document.getElementById('settings-modal').classList.remove('show');
        }

        function loadSettingsForm() {
            document.getElementById('setting-name').value = userSettings.name;
            document.getElementById('setting-email').value = userSettings.email;
            document.getElementById('setting-bio').value = userSettings.bio;
            document.getElementById('setting-tama-name').value = userSettings.tamagochi_name;
            document.getElementById('setting-notify-hunger').checked = userSettings.notify_hunger;
            document.getElementById('setting-notify-energy').checked = userSettings.notify_energy;
            document.getElementById('setting-notify-happiness').checked = userSettings.notify_happiness;
            document.getElementById('setting-theme').value = userSettings.theme;
            document.getElementById('setting-language').value = userSettings.language;
            document.getElementById('setting-sounds').checked = userSettings.sounds;
            document.getElementById('setting-private').checked = userSettings.private_profile;
            document.getElementById('setting-hide-stats').checked = userSettings.hide_stats;
            
            selectedColor = userSettings.tamagochi_color;
            updateColorSelection();
        }

        function selectColor(color, element) {
            selectedColor = color;
            document.querySelectorAll('.color-option').forEach(el => {
                el.classList.remove('selected');
            });
            element.classList.add('selected');
        }

        function updateColorSelection() {
            document.querySelectorAll('.color-option').forEach(el => {
                el.classList.remove('selected');
                if (el.style.background === selectedColor) {
                    el.classList.add('selected');
                }
            });
        }

        async function saveSettings() {
            const token = localStorage.getItem('auth_token');
            if (!token) return;

            userSettings = {
                name: document.getElementById('setting-name').value,
                email: document.getElementById('setting-email').value,
                bio: document.getElementById('setting-bio').value,
                tamagochi_name: document.getElementById('setting-tama-name').value,
                tamagochi_color: selectedColor,
                notify_hunger: document.getElementById('setting-notify-hunger').checked,
                notify_energy: document.getElementById('setting-notify-energy').checked,
                notify_happiness: document.getElementById('setting-notify-happiness').checked,
                theme: document.getElementById('setting-theme').value,
                language: document.getElementById('setting-language').value,
                sounds: document.getElementById('setting-sounds').checked,
                private_profile: document.getElementById('setting-private').checked,
                hide_stats: document.getElementById('setting-hide-stats').checked
            };

            try {
                const response = await fetch(`${API_URL}/settings`, {
                    method: 'PUT',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(userSettings)
                });

                if (response.ok) {
                    showMessage('💾 Configuración guardada exitosamente!', 'success');
                    
                    // Aplicar tema
                    if (userSettings.theme === 'dark') {
                        document.body.classList.add('dark-mode');
                    } else {
                        document.body.classList.remove('dark-mode');
                    }
                    
                    // Actualizar nombre del tamagochi
                    tamagochi.name = userSettings.tamagochi_name;
                    document.getElementById('tamagochi-name').value = tamagochi.name;
                    
                    // Guardar en localStorage para persistencia local
                    localStorage.setItem('userSettings', JSON.stringify(userSettings));
                    
                    setTimeout(closeSettings, 1000);
                } else {
                    showMessage('❌ Error al guardar configuración', 'error');
                }
            } catch (error) {
                showMessage('Error: ' + error.message, 'error');
            }
        }

        async function loadSettings() {
            const token = localStorage.getItem('auth_token');
            if (!token) return;

            try {
                const response = await fetch(`${API_URL}/settings`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    if (data.data) {
                        userSettings = {
                            name: data.data.name || '',
                            email: data.data.email || '',
                            bio: data.data.bio || '',
                            tamagochi_name: data.data.tamagochi_name || 'Mi Tamagochi',
                            tamagochi_color: data.data.tamagochi_color || '#667eea',
                            notify_hunger: data.data.notify_hunger !== false,
                            notify_energy: data.data.notify_energy !== false,
                            notify_happiness: data.data.notify_happiness !== false,
                            theme: data.data.theme || 'light',
                            language: data.data.language || 'es',
                            sounds: data.data.sounds !== false,
                            private_profile: data.data.private_profile || false,
                            hide_stats: data.data.hide_stats || false
                        };

                        // Aplicar tema
                        if (userSettings.theme === 'dark') {
                            document.body.classList.add('dark-mode');
                        }

                        // Guardar en localStorage
                        localStorage.setItem('userSettings', JSON.stringify(userSettings));
                    }
                }
            } catch (error) {
                console.log('No hay configuración previa');
                // Intentar cargar de localStorage
                const saved = localStorage.getItem('userSettings');
                if (saved) {
                    userSettings = JSON.parse(saved);
                    if (userSettings.theme === 'dark') {
                        document.body.classList.add('dark-mode');
                    }
                }
            }
        }

        function openPasswordChange() {
            const currentPassword = prompt('Ingresa tu contraseña actual:');
            if (!currentPassword) return;

            const newPassword = prompt('Ingresa tu nueva contraseña:');
            if (!newPassword) return;

            const confirmPassword = prompt('Confirma tu nueva contraseña:');
            if (!confirmPassword) return;

            if (newPassword !== confirmPassword) {
                showMessage('❌ Las contraseñas no coinciden', 'error');
                return;
            }

            changePassword(currentPassword, newPassword);
        }

        async function changePassword(currentPassword, newPassword) {
            const token = localStorage.getItem('auth_token');
            if (!token) return;

            try {
                const response = await fetch(`${API_URL}/settings/change-password`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        current_password: currentPassword,
                        new_password: newPassword,
                        new_password_confirmation: newPassword
                    })
                });

                const data = await response.json();
                if (response.ok) {
                    showMessage('✅ Contraseña cambiada exitosamente', 'success');
                } else {
                    showMessage('❌ ' + (data.message || 'Error al cambiar contraseña'), 'error');
                }
            } catch (error) {
                showMessage('Error: ' + error.message, 'error');
            }
        }

        function deleteAccount() {
            const confirm1 = confirm('⚠️ ¿Estás seguro de que deseas eliminar tu cuenta?');
            if (!confirm1) return;

            const confirm2 = confirm('⚠️ Esta acción es irreversible. Se eliminarán todos tus datos.');
            if (!confirm2) return;

            const password = prompt('Ingresa tu contraseña para confirmar:');
            if (!password) return;

            performDeleteAccount(password);
        }

        async function performDeleteAccount(password) {
            const token = localStorage.getItem('auth_token');
            if (!token) return;

            try {
                const response = await fetch(`${API_URL}/settings/delete-account`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ password: password })
                });

                if (response.ok) {
                    showMessage('✅ Cuenta eliminada', 'success');
                    setTimeout(() => {
                        localStorage.removeItem('auth_token');
                        location.href = '/login';
                    }, 2000);
                } else {
                    showMessage('❌ Error al eliminar cuenta', 'error');
                }
            } catch (error) {
                showMessage('Error: ' + error.message, 'error');
            }
        }

        function startAutoUpdate() {
            updateInterval = setInterval(() => {
                if (tamagochi.is_alive) {
                    applyTimeBasedDeterioration();
                    updateDisplay();
                }
            }, 1000);
        }

        function applyTimeBasedDeterioration() {
            const now = Date.now();
            const timeSinceInteraction = (now - tamagochi.last_interaction) / 1000;
            const hoursAgo = timeSinceInteraction / 3600;

            if (hoursAgo < 0.001) return;

            const energyDecay = Math.exp(-DETERIORATION_RATES.energy * hoursAgo);
            const hungerGrowth = 1 - Math.exp(-DETERIORATION_RATES.hunger * hoursAgo);
            const happinessDecay = Math.exp(-DETERIORATION_RATES.happiness * hoursAgo);
            const healthDecay = Math.exp(-DETERIORATION_RATES.health * hoursAgo);

            tamagochi.energy = Math.max(0, 100 * energyDecay);
            tamagochi.hunger = Math.min(100, 100 * hungerGrowth);
            tamagochi.happiness = Math.max(0, 75 * happinessDecay);
            tamagochi.health = Math.max(0, 100 * healthDecay);

            if (tamagochi.energy <= 0 || tamagochi.hunger >= 100 || tamagochi.happiness <= 0 || tamagochi.health <= 0) {
                tamagochi.is_alive = false;
                let deathReason = 'Lo siento, tu Tamagochi murió por negligencia.';

                if (tamagochi.energy <= 0) deathReason = '😴 Tu Tamagochi murió de agotamiento.';
                if (tamagochi.hunger >= 100) deathReason = '🍽️ Tu Tamagochi murió de inanición.';
                if (tamagochi.happiness <= 0) deathReason = '😢 Tu Tamagochi murió de depresión.';
                if (tamagochi.health <= 0) deathReason = '❤️ Tu Tamagochi murió por enfermedad.';

                showDeathScreen(deathReason);
                clearInterval(updateInterval);
            }
        }

        async function refreshUserInfo() {
            const token = localStorage.getItem('auth_token');
            if (!token) return;

            try {
                const response = await fetch(`${API_URL}/auth/me`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();
                const user = data.user;

                const roleBadge = document.getElementById('role-badge');
                roleBadge.textContent = '👤 Usuario Cliente';
                roleBadge.style.display = 'block';

                userSettings.email = user.email;
                userSettings.name = user.name;
            } catch (error) {
                showMessage('Error: ' + error.message, 'error');
            }
        }

        async function loadTamagochi() {
            const token = localStorage.getItem('auth_token');
            if (!token) return;

            try {
                const response = await fetch(`${API_URL}/tamagochi`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    if (data.data) {
                        tamagochi = {
                            id: data.data.id,
                            name: data.data.name || userSettings.tamagochi_name || 'Mi Tamagochi',
                            energy: data.data.energy || 100,
                            hunger: data.data.hunger || 0,
                            happiness: data.data.happiness || 75,
                            health: data.data.health || 100,
                            level: data.data.level || 1,
                            experience: data.data.experience || 0,
                            times_played: data.data.times_played || 0,
                            age: data.data.age || 1,
                            status: data.data.status || 'happy',
                            last_interaction: data.data.last_interaction ? new Date(data.data.last_interaction).getTime() : Date.now(),
                            created_at: data.data.created_at ? new Date(data.data.created_at).getTime() : Date.now(),
                            is_alive: data.data.is_alive !== false
                        };

                        if (tamagochi.is_alive) {
                            applyTimeBasedDeterioration();
                        }
                        updateDisplay();
                    }
                }
            } catch (error) {
                console.log('No hay Tamagochi previo, usando valores por defecto');
                updateDisplay();
            }
        }

        function updateDisplay() {
            const energy = Math.round(tamagochi.energy);
            const hunger = Math.round(tamagochi.hunger);
            const happiness = Math.round(tamagochi.happiness);
            const health = Math.round(tamagochi.health);

            document.getElementById('tamagochi-name').value = tamagochi.name;
            document.getElementById('energy-slider').value = energy;
            document.getElementById('hunger-slider').value = hunger;
            document.getElementById('happiness-slider').value = happiness;
            document.getElementById('health-slider').value = health;

            document.getElementById('energy-value').textContent = energy;
            document.getElementById('hunger-value').textContent = hunger;
            document.getElementById('happiness-value').textContent = happiness;
            document.getElementById('health-value').textContent = health;

            document.getElementById('energy-progress').style.width = energy + '%';
            document.getElementById('hunger-progress').style.width = hunger + '%';
            document.getElementById('happiness-progress').style.width = happiness + '%';
            document.getElementById('health-progress').style.width = health + '%';

            document.getElementById('energy-item').classList.toggle('critical', energy < 20);
            document.getElementById('hunger-item').classList.toggle('critical', hunger > 80);
            document.getElementById('happiness-item').classList.toggle('critical', happiness < 20);
            document.getElementById('health-item').classList.toggle('critical', health < 20);

            document.getElementById('energy-value').classList.toggle('critical', energy < 20);
            document.getElementById('hunger-value').classList.toggle('critical', hunger > 80);
            document.getElementById('happiness-value').classList.toggle('critical', happiness < 20);
            document.getElementById('health-value').classList.toggle('critical', health < 20);

            updateEmoji();
            updateStatusBadges();
            updateTimeDisplay();

            document.getElementById('level-value').textContent = tamagochi.level;
            document.getElementById('experience-value').textContent = tamagochi.experience + '%';
            document.getElementById('playtime-value').textContent = tamagochi.times_played;
            document.getElementById('age-value').textContent = tamagochi.age;
        }

        function updateTimeDisplay() {
            const now = Date.now();
            const secondsAgo = Math.floor((now - tamagochi.last_interaction) / 1000);

            let timeText = 'hace unos momentos';
            if (secondsAgo < 60) {
                timeText = `hace ${secondsAgo}s`;
            } else if (secondsAgo < 3600) {
                const minutes = Math.floor(secondsAgo / 60);
                timeText = `hace ${minutes}m`;
            } else {
                const hours = Math.floor(secondsAgo / 3600);
                timeText = `hace ${hours}h`;
            }

            document.getElementById('last-interaction').textContent = timeText;
        }

        function updateEmoji() {
            const energy = Math.round(tamagochi.energy);
            const hunger = Math.round(tamagochi.hunger);
            const happiness = Math.round(tamagochi.happiness);
            const health = Math.round(tamagochi.health);

            let emoji = '🐠';

            if (health <= 0) {
                emoji = '💀';
                tamagochi.status = 'dead';
            } else if (tamagochi.status === 'sleeping') {
                emoji = '😴';
            } else if (health < 20) {
                emoji = '🤒';
                tamagochi.status = 'sick';
            } else if (hunger > 80) {
                emoji = '😫';
                tamagochi.status = 'starving';
            } else if (happiness < 20) {
                emoji = '😢';
                tamagochi.status = 'sad';
            } else if (energy < 20) {
                emoji = '😓';
                tamagochi.status = 'tired';
            } else if (happiness > 70 && health > 60 && hunger < 50) {
                emoji = '😊';
                tamagochi.status = 'happy';
            } else {
                emoji = '🐠';
                tamagochi.status = 'normal';
            }

            document.getElementById('tamagochi-emoji').textContent = emoji;
        }

        function updateStatusBadges() {
            const energy = Math.round(tamagochi.energy);
            const hunger = Math.round(tamagochi.hunger);
            const happiness = Math.round(tamagochi.happiness);
            const health = Math.round(tamagochi.health);

            const getStatus = (value, thresholds) => {
                if (value >= thresholds.good) return { class: 'good', text: '✅ Perfecto' };
                if (value >= thresholds.normal) return { class: 'normal', text: '⚠️ Normal' };
                return { class: 'bad', text: '❌ Crítico' };
            };

            let status = getStatus(energy, { good: 60, normal: 30 });
            document.getElementById('energy-status').className = 'status-badge ' + status.class;
            document.getElementById('energy-status').textContent = '⚡ ' + status.text;

            status = getStatus(100 - hunger, { good: 80, normal: 50 });
            document.getElementById('hunger-status').className = 'status-badge ' + status.class;
            document.getElementById('hunger-status').textContent = '🍽️ ' + (hunger > 80 ? '❌ CRÍTICO' : hunger > 50 ? '⚠️ Hambiento' : '✅ Satisfecho');

            status = getStatus(happiness, { good: 70, normal: 40 });
            document.getElementById('happiness-status').className = 'status-badge ' + status.class;
            document.getElementById('happiness-status').textContent = '😊 ' + status.text;

            status = getStatus(health, { good: 80, normal: 50 });
            document.getElementById('health-status').className = 'status-badge ' + status.class;
            document.getElementById('health-status').textContent = '❤️ ' + status.text;

            // Advertencias según configuración
            if (energy < 30 && userSettings.notify_energy && tamagochi.status !== 'warning_energy') {
                showMessage('⚠️ ¡Tu Tamagochi está agotado! Necesita dormir.', 'warning');
                tamagochi.status = 'warning_energy';
            }
            if (hunger > 70 && userSettings.notify_hunger && tamagochi.status !== 'warning_hunger') {
                showMessage('⚠️ ¡Tu Tamagochi tiene hambre! Aliméntalo.', 'warning');
                tamagochi.status = 'warning_hunger';
            }
            if (happiness < 30 && userSettings.notify_happiness && tamagochi.status !== 'warning_happiness') {
                showMessage('⚠️ ¡Tu Tamagochi está triste! Juega con él.', 'warning');
                tamagochi.status = 'warning_happiness';
            }
        }

        function updateTamagochi(attribute) {
            const value = parseInt(document.getElementById(attribute + '-slider').value);
            tamagochi[attribute] = value;
            tamagochi.last_interaction = Date.now();

            document.getElementById(attribute + '-value').textContent = value;
            document.getElementById(attribute + '-progress').style.width = value + '%';

            updateEmoji();
            updateStatusBadges();
        }

        function quickAction(action) {
            tamagochi.last_interaction = Date.now();

            switch(action) {
                case 'feed':
                    tamagochi.hunger = Math.max(0, tamagochi.hunger - 30);
                    tamagochi.energy = Math.max(0, tamagochi.energy - 10);
                    tamagochi.happiness = Math.min(100, tamagochi.happiness + 5);
                    showMessage('🍽️ ¡Tu Tamagochi ha sido alimentado!', 'success');
                    break;

                case 'play':
                    tamagochi.energy = Math.max(0, tamagochi.energy - 20);
                    tamagochi.hunger = Math.min(100, tamagochi.hunger + 10);
                    tamagochi.happiness = Math.min(100, tamagochi.happiness + 30);
                    tamagochi.experience = Math.min(100, tamagochi.experience + 10);
                    tamagochi.times_played++;
                    if (tamagochi.experience >= 100) {
                        tamagochi.level++;
                        tamagochi.experience = 0;
                        showMessage('🎉 ¡Nivel subido! Ahora eres nivel ' + tamagochi.level, 'success');
                    }
                    showMessage('🎮 ¡Jugaste con tu Tamagochi!', 'success');
                    break;

                case 'sleep':
                    tamagochi.energy = Math.min(100, tamagochi.energy + 50);
                    tamagochi.health = Math.min(100, tamagochi.health + 20);
                    tamagochi.status = 'sleeping';
                    showMessage('🛌 Tu Tamagochi está durmiendo...', 'success');
                    setTimeout(() => {
                        tamagochi.status = 'happy';
                        updateEmoji();
                    }, 2000);
                    break;

                case 'cure':
                    tamagochi.health = Math.min(100, tamagochi.health + 50);
                    showMessage('💊 ¡Tu Tamagochi ha sido curado!', 'success');
                    break;
            }

            updateDisplay();
        }

        async function saveTamagochi() {
            const token = localStorage.getItem('auth_token');
            if (!token) return;

            tamagochi.name = document.getElementById('tamagochi-name').value;

            try {
                const response = await fetch(`${API_URL}/tamagochi`, {
                    method: 'PUT',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        name: tamagochi.name,
                        energy: Math.round(tamagochi.energy),
                        hunger: Math.round(tamagochi.hunger),
                        happiness: Math.round(tamagochi.happiness),
                        health: Math.round(tamagochi.health),
                        level: tamagochi.level,
                        experience: tamagochi.experience,
                        times_played: tamagochi.times_played,
                        age: tamagochi.age,
                        last_interaction: new Date(tamagochi.last_interaction).toISOString(),
                        is_alive: tamagochi.is_alive
                    })
                });

                if (response.ok) {
                    showMessage('💾 ¡Tamagochi guardado exitosamente!', 'success');
                } else {
                    showMessage('❌ Error al guardar', 'error');
                }
            } catch (error) {
                showMessage('Error: ' + error.message, 'error');
            }
        }

        function showDeathScreen(reason) {
            document.getElementById('death-reason').textContent = reason;
            document.getElementById('death-screen').classList.add('show');
        }

        function reviveTamagochi() {
            tamagochi = {
                id: tamagochi.id,
                name: tamagochi.name,
                energy: 100,
                hunger: 0,
                happiness: 75,
                health: 100,
                level: 1,
                experience: 0,
                times_played: 0,
                age: tamagochi.age + 1,
                status: 'happy',
                last_interaction: Date.now(),
                created_at: tamagochi.created_at,
                is_alive: true
            };

            document.getElementById('death-screen').classList.remove('show');
            updateDisplay();
            saveTamagochi();
            startAutoUpdate();
            showMessage('✨ ¡Tu Tamagochi ha renacido!', 'success');
        }

        function showMessage(message, type) {
            const el = document.getElementById('message');
            el.textContent = message;
            el.className = 'message show ' + type;
            setTimeout(() => {
                el.classList.remove('show');
            }, 3000);
        }

        async function logout() {
            const token = localStorage.getItem('auth_token');
            if (!token) {
                alert('No hay sesión activa');
                return;
            }

            try {
                await fetch(`${API_URL}/auth/logout`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (updateInterval) clearInterval(updateInterval);
                localStorage.removeItem('auth_token');
                localStorage.removeItem('userSettings');
                alert('✅ Sesión cerrada');
                location.href = '/login';
            } catch (error) {
                alert('❌ Error: ' + error.message);
            }
        }

        window.addEventListener('beforeunload', () => {
            if (tamagochi.id) {
                saveTamagochi();
            }
        });

        // Cerrar modal con ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeSettings();
            }
        });

        // Cerrar modal al hacer clic fuera
        document.getElementById('settings-modal')?.addEventListener('click', (e) => {
            if (e.target.id === 'settings-modal') {
                closeSettings();
            }
        });
    </script>

        async function refreshUserInfo() {
            const token = localStorage.getItem('auth_token');
            if (!token) return;

            try {
                const response = await fetch(`${API_URL}/auth/me`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();
                const user = data.user;

                const roleBadge = document.getElementById('role-badge');
                roleBadge.textContent = '👤 Usuario Cliente';
                roleBadge.style.display = 'block';
            } catch (error) {
                showMessage('Error: ' + error.message, 'error');
            }
        }

        async function loadTamagochi() {
            const token = localStorage.getItem('auth_token');
            if (!token) return;

            try {
                const response = await fetch(`${API_URL}/tamagochi`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    if (data.data) {
                        tamagochi = {
                            id: data.data.id,
                            name: data.data.name || 'Mi Tamagochi',
                            energy: data.data.energy || 100,
                            hunger: data.data.hunger || 0,
                            happiness: data.data.happiness || 75,
                            health: data.data.health || 100,
                            level: data.data.level || 1,
                            experience: data.data.experience || 0,
                            times_played: data.data.times_played || 0,
                            age: data.data.age || 1,
                            status: data.data.status || 'happy',
                            last_interaction: data.data.last_interaction ? new Date(data.data.last_interaction).getTime() : Date.now(),
                            created_at: data.data.created_at ? new Date(data.data.created_at).getTime() : Date.now(),
                            is_alive: data.data.is_alive !== false
                        };
                        
                        // Aplicar deterioro basado en el tiempo pasado
                        if (tamagochi.is_alive) {
                            applyTimeBasedDeterioration();
                        }
                        updateDisplay();
                    }
                }
            } catch (error) {
                console.log('No hay Tamagochi previo, usando valores por defecto');
                updateDisplay();
            }
        }

        function updateDisplay() {
            // Redondear valores para display
            const energy = Math.round(tamagochi.energy);
            const hunger = Math.round(tamagochi.hunger);
            const happiness = Math.round(tamagochi.happiness);
            const health = Math.round(tamagochi.health);

            // Actualizar sliders
            document.getElementById('tamagochi-name').value = tamagochi.name;
            document.getElementById('energy-slider').value = energy;
            document.getElementById('hunger-slider').value = hunger;
            document.getElementById('happiness-slider').value = happiness;
            document.getElementById('health-slider').value = health;

            // Actualizar valores mostrados
            document.getElementById('energy-value').textContent = energy;
            document.getElementById('hunger-value').textContent = hunger;
            document.getElementById('happiness-value').textContent = happiness;
            document.getElementById('health-value').textContent = health;

            // Actualizar barras de progreso
            document.getElementById('energy-progress').style.width = energy + '%';
            document.getElementById('hunger-progress').style.width = hunger + '%';
            document.getElementById('happiness-progress').style.width = happiness + '%';
            document.getElementById('health-progress').style.width = health + '%';

            // Marcar como crítico
            document.getElementById('energy-item').classList.toggle('critical', energy < 20);
            document.getElementById('hunger-item').classList.toggle('critical', hunger > 80);
            document.getElementById('happiness-item').classList.toggle('critical', happiness < 20);
            document.getElementById('health-item').classList.toggle('critical', health < 20);

            document.getElementById('energy-value').classList.toggle('critical', energy < 20);
            document.getElementById('hunger-value').classList.toggle('critical', hunger > 80);
            document.getElementById('happiness-value').classList.toggle('critical', happiness < 20);
            document.getElementById('health-value').classList.toggle('critical', health < 20);

            // Actualizar emoji según estado
            updateEmoji();

            // Actualizar badges de estado
            updateStatusBadges();

            // Actualizar tiempo transcurrido
            updateTimeDisplay();

            // Actualizar estadísticas
            document.getElementById('level-value').textContent = tamagochi.level;
            document.getElementById('experience-value').textContent = tamagochi.experience + '%';
            document.getElementById('playtime-value').textContent = tamagochi.times_played;
            document.getElementById('age-value').textContent = tamagochi.age;
        }

        function updateTimeDisplay() {
            const now = Date.now();
            const secondsAgo = Math.floor((now - tamagochi.last_interaction) / 1000);
            
            let timeText = 'hace unos momentos';
            if (secondsAgo < 60) {
                timeText = `hace ${secondsAgo}s`;
            } else if (secondsAgo < 3600) {
                const minutes = Math.floor(secondsAgo / 60);
                timeText = `hace ${minutes}m`;
            } else {
                const hours = Math.floor(secondsAgo / 3600);
                timeText = `hace ${hours}h`;
            }
            
            document.getElementById('last-interaction').textContent = timeText;
        }

        function updateEmoji() {
            const energy = Math.round(tamagochi.energy);
            const hunger = Math.round(tamagochi.hunger);
            const happiness = Math.round(tamagochi.happiness);
            const health = Math.round(tamagochi.health);

            let emoji = '🐠';

            if (health <= 0) {
                emoji = '💀';
                tamagochi.status = 'dead';
            } else if (tamagochi.status === 'sleeping') {
                emoji = '😴';
            } else if (health < 20) {
                emoji = '🤒';
                tamagochi.status = 'sick';
            } else if (hunger > 80) {
                emoji = '😫';
                tamagochi.status = 'starving';
            } else if (happiness < 20) {
                emoji = '😢';
                tamagochi.status = 'sad';
            } else if (energy < 20) {
                emoji = '😓';
                tamagochi.status = 'tired';
            } else if (happiness > 70 && health > 60 && hunger < 50) {
                emoji = '😊';
                tamagochi.status = 'happy';
            } else {
                emoji = '🐠';
                tamagochi.status = 'normal';
            }

            document.getElementById('tamagochi-emoji').textContent = emoji;
        }

        function updateStatusBadges() {
            const energy = Math.round(tamagochi.energy);
            const hunger = Math.round(tamagochi.hunger);
            const happiness = Math.round(tamagochi.happiness);
            const health = Math.round(tamagochi.health);

            const getStatus = (value, thresholds) => {
                if (value >= thresholds.good) return { class: 'good', text: '✅ Perfecto' };
                if (value >= thresholds.normal) return { class: 'normal', text: '⚠️ Normal' };
                return { class: 'bad', text: '❌ Crítico' };
            };

            // Energía
            let status = getStatus(energy, { good: 60, normal: 30 });
            document.getElementById('energy-status').className = 'status-badge ' + status.class;
            document.getElementById('energy-status').textContent = '⚡ ' + status.text;

            // Hambre
            status = getStatus(100 - hunger, { good: 80, normal: 50 });
            document.getElementById('hunger-status').className = 'status-badge ' + status.class;
            document.getElementById('hunger-status').textContent = '🍽️ ' + (hunger > 80 ? '❌ CRÍTICO' : hunger > 50 ? '⚠️ Hambiento' : '✅ Satisfecho');

            // Felicidad
            status = getStatus(happiness, { good: 70, normal: 40 });
            document.getElementById('happiness-status').className = 'status-badge ' + status.class;
            document.getElementById('happiness-status').textContent = '😊 ' + status.text;

            // Salud
            status = getStatus(health, { good: 80, normal: 50 });
            document.getElementById('health-status').className = 'status-badge ' + status.class;
            document.getElementById('health-status').textContent = '❤️ ' + status.text;

            // Mostrar advertencias
            if (energy < 30 && tamagochi.status !== 'warning_energy') {
                showMessage('⚠️ ¡Tu Tamagochi está agotado! Necesita dormir.', 'warning');
                tamagochi.status = 'warning_energy';
            }
            if (hunger > 70 && tamagochi.status !== 'warning_hunger') {
                showMessage('⚠️ ¡Tu Tamagochi tiene hambre! Aliméntalo.', 'warning');
                tamagochi.status = 'warning_hunger';
            }
            if (happiness < 30 && tamagochi.status !== 'warning_happiness') {
                showMessage('⚠️ ¡Tu Tamagochi está triste! Juega con él.', 'warning');
                tamagochi.status = 'warning_happiness';
            }
        }

        function updateTamagochi(attribute) {
            const value = parseInt(document.getElementById(attribute + '-slider').value);
            tamagochi[attribute] = value;
            tamagochi.last_interaction = Date.now();

            document.getElementById(attribute + '-value').textContent = value;
            document.getElementById(attribute + '-progress').style.width = value + '%';

            updateEmoji();
            updateStatusBadges();
        }

        function quickAction(action) {
            tamagochi.last_interaction = Date.now();

            switch(action) {
                case 'feed':
                    tamagochi.hunger = Math.max(0, tamagochi.hunger - 30);
                    tamagochi.energy = Math.max(0, tamagochi.energy - 10);
                    tamagochi.happiness = Math.min(100, tamagochi.happiness + 5);
                    showMessage('🍽️ ¡Tu Tamagochi ha sido alimentado!', 'success');
                    break;

                case 'play':
                    tamagochi.energy = Math.max(0, tamagochi.energy - 20);
                    tamagochi.hunger = Math.min(100, tamagochi.hunger + 10);
                    tamagochi.happiness = Math.min(100, tamagochi.happiness + 30);
                    tamagochi.experience = Math.min(100, tamagochi.experience + 10);
                    tamagochi.times_played++;
                    if (tamagochi.experience >= 100) {
                        tamagochi.level++;
                        tamagochi.experience = 0;
                        showMessage('🎉 ¡Nivel subido! Ahora eres nivel ' + tamagochi.level, 'success');
                    }
                    showMessage('🎮 ¡Jugaste con tu Tamagochi!', 'success');
                    break;

                case 'sleep':
                    tamagochi.energy = Math.min(100, tamagochi.energy + 50);
                    tamagochi.health = Math.min(100, tamagochi.health + 20);
                    tamagochi.status = 'sleeping';
                    showMessage('🛌 Tu Tamagochi está durmiendo...', 'success');
                    setTimeout(() => {
                        tamagochi.status = 'happy';
                        updateEmoji();
                    }, 2000);
                    break;

                case 'cure':
                    tamagochi.health = Math.min(100, tamagochi.health + 50);
                    showMessage('💊 ¡Tu Tamagochi ha sido curado!', 'success');
                    break;
            }

            updateDisplay();
        }

        async function saveTamagochi() {
            const token = localStorage.getItem('auth_token');
            if (!token) return;

            tamagochi.name = document.getElementById('tamagochi-name').value;

            try {
                const response = await fetch(`${API_URL}/tamagochi`, {
                    method: 'PUT',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        name: tamagochi.name,
                        energy: Math.round(tamagochi.energy),
                        hunger: Math.round(tamagochi.hunger),
                        happiness: Math.round(tamagochi.happiness),
                        health: Math.round(tamagochi.health),
                        level: tamagochi.level,
                        experience: tamagochi.experience,
                        times_played: tamagochi.times_played,
                        age: tamagochi.age,
                        last_interaction: new Date(tamagochi.last_interaction).toISOString(),
                        is_alive: tamagochi.is_alive
                    })
                });

                if (response.ok) {
                    showMessage('💾 ¡Tamagochi guardado exitosamente!', 'success');
                } else {
                    showMessage('❌ Error al guardar', 'error');
                }
            } catch (error) {
                showMessage('Error: ' + error.message, 'error');
            }
        }

        function showDeathScreen(reason) {
            document.getElementById('death-reason').textContent = reason;
            document.getElementById('death-screen').classList.add('show');
        }

        function reviveTamagochi() {
            tamagochi = {
                id: tamagochi.id,
                name: tamagochi.name,
                energy: 100,
                hunger: 0,
                happiness: 75,
                health: 100,
                level: 1,
                experience: 0,
                times_played: 0,
                age: tamagochi.age + 1,
                status: 'happy',
                last_interaction: Date.now(),
                created_at: tamagochi.created_at,
                is_alive: true
            };

            document.getElementById('death-screen').classList.remove('show');
            updateDisplay();
            saveTamagochi();
            startAutoUpdate();
            showMessage('✨ ¡Tu Tamagochi ha renacido!', 'success');
        }

        function showMessage(message, type) {
            const el = document.getElementById('message');
            el.textContent = message;
            el.className = 'message show ' + type;
            setTimeout(() => {
                el.classList.remove('show');
            }, 3000);
        }

        async function logout() {
            const token = localStorage.getItem('auth_token');
            if (!token) {
                alert('No hay sesión activa');
                return;
            }

            try {
                await fetch(`${API_URL}/auth/logout`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (updateInterval) clearInterval(updateInterval);
                localStorage.removeItem('auth_token');
                alert('✅ Sesión cerrada');
                location.href = '/login';
            } catch (error) {
                alert('❌ Error: ' + error.message);
            }
        }

        window.addEventListener('beforeunload', () => {
            if (tamagochi.id) {
                saveTamagochi();
            }
        });
    </script>
</body>
</html>
