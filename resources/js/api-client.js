// 🔐 Ejemplo de Login con JavaScript/Fetch

const API_URL = 'https://tamagochi-rrss.ddev.site/api';

// Credenciales de demo
const credentials = {
  email: 'demo@tamagochi.test',
  password: 'password123'
};

// 1. HACER LOGIN
async function login() {
  try {
    const response = await fetch(`${API_URL}/auth/login`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify(credentials)
    });

    const data = await response.json();
    
    if (!response.ok) {
      console.error('❌ Error en login:', data.message);
      return null;
    }

    console.log('✅ Login exitoso');
    console.log('Token:', data.token);
    console.log('Usuario:', data.user);

    // Guardar token en localStorage
    localStorage.setItem('auth_token', data.token);
    
    return data.token;
  } catch (error) {
    console.error('❌ Error en la petición:', error);
  }
}

// 2. OBTENER USUARIO ACTUAL
async function getMe(token) {
  try {
    const response = await fetch(`${API_URL}/auth/me`, {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
      }
    });

    const data = await response.json();

    if (!response.ok) {
      console.error('❌ Error:', data.message);
      return null;
    }

    console.log('✅ Usuario actual:', data.user);
    return data.user;
  } catch (error) {
    console.error('❌ Error en la petición:', error);
  }
}

// 3. REGISTRARSE
async function register(name, email, password) {
  try {
    const response = await fetch(`${API_URL}/auth/register`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({ name, email, password })
    });

    const data = await response.json();

    if (!response.ok) {
      console.error('❌ Error en registro:', data.message);
      return null;
    }

    console.log('✅ Usuario registrado');
    console.log('Token:', data.token);

    localStorage.setItem('auth_token', data.token);
    return data;
  } catch (error) {
    console.error('❌ Error en la petición:', error);
  }
}

// 4. LOGOUT
async function logout(token) {
  try {
    const response = await fetch(`${API_URL}/auth/logout`, {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
      }
    });

    const data = await response.json();

    if (!response.ok) {
      console.error('❌ Error:', data.message);
      return false;
    }

    console.log('✅ Logout exitoso');
    localStorage.removeItem('auth_token');
    return true;
  } catch (error) {
    console.error('❌ Error en la petición:', error);
  }
}

// ═══════════════════════════════════════════════════════════════════════════

// EJEMPLO DE USO EN LA CONSOLA DEL NAVEGADOR:

/*

// 1. Hacer login
await login();

// 2. Obtener usuario actual (necesitas el token)
const token = localStorage.getItem('auth_token');
await getMe(token);

// 3. Registrar nuevo usuario
await register('Juan Perez', 'juan@example.com', 'password123');

// 4. Logout
await logout(token);

*/

// ═══════════════════════════════════════════════════════════════════════════

// CLASE HELPER PARA FACILITAR EL USO

class TamagochiAPI {
  constructor(baseUrl = 'https://tamagochi-rrss.ddev.site/api') {
    this.baseUrl = baseUrl;
    this.token = localStorage.getItem('auth_token');
  }

  async request(endpoint, options = {}) {
    const url = `${this.baseUrl}${endpoint}`;
    const defaultOptions = {
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
    };

    if (this.token) {
      defaultOptions.headers['Authorization'] = `Bearer ${this.token}`;
    }

    const response = await fetch(url, { ...defaultOptions, ...options });
    const data = await response.json();

    if (!response.ok) {
      throw new Error(data.message || 'Error en la petición');
    }

    return data;
  }

  async login(email, password) {
    const data = await this.request('/auth/login', {
      method: 'POST',
      body: JSON.stringify({ email, password })
    });
    this.token = data.token;
    localStorage.setItem('auth_token', data.token);
    return data;
  }

  async register(name, email, password) {
    const data = await this.request('/auth/register', {
      method: 'POST',
      body: JSON.stringify({ name, email, password })
    });
    this.token = data.token;
    localStorage.setItem('auth_token', data.token);
    return data;
  }

  async logout() {
    await this.request('/auth/logout', { method: 'POST' });
    this.token = null;
    localStorage.removeItem('auth_token');
  }

  async getMe() {
    return this.request('/auth/me');
  }

  async getUser() {
    return this.request('/user');
  }
}

// ═══════════════════════════════════════════════════════════════════════════

// EJEMPLO CON LA CLASE:

/*

const api = new TamagochiAPI();

// Login
await api.login('demo@tamagochi.test', 'password123');

// Obtener usuario
const userData = await api.getMe();
console.log(userData);

// Logout
await api.logout();

*/
