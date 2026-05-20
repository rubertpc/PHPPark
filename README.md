# 🎢 NavaPark2 — Sistema de Gestión de Parque de Atracciones

NavaPark2 es una aplicación web desarrollada en PHP y MySQL para la gestión completa de un parque de atracciones ubicado en **Navarredonda de Gredos**. Permite registrar viajeros, gestionar atracciones y controlar todos los viajes realizados en el parque.

---

## 🚀 Tecnologías utilizadas

| Tecnología | Versión |
|------------|---------|
| PHP | 8.3.30 |
| MySQL | 8.0.44 |
| Apache | 2.4.66 |
| phpMyAdmin | 5.2.3 |
| MAMP | 7.4 |

---

## 🗄️ Base de datos

El sistema utiliza tres tablas relacionadas entre sí:

- **viajero** — Almacena nombre, edad, email y contraseña de cada usuario
- **atraccion** — Almacena el nombre y temática de cada atracción del parque
- **viaje** — Tabla intermedia que relaciona viajeros con atracciones y registra la hora

---

## 📁 Estructura del proyecto
'''

navapark2/

├── db.php

├── registro.php

├── login.php

├── perfil.php

├── nueva_visita.php

├── logout.php

├── navapark2.sql

└── admin/

├── control_general.php

├── atracciones_listar.php

├── atracciones_insertar.php

├── atracciones_modificar.php

└── atracciones_borrar.php

'''

---

## 👤 Vista Cliente

- Registro e inicio de sesión con contraseña encriptada
- Perfil personal con nombre, edad y listado de viajes realizados
- Formulario para registrar nuevos viajes a las atracciones del parque

## 🔧 Vista Administrador

- Control general: todas las atracciones con horas de viajes y edades de viajeros
- Gestión completa de atracciones: listar, insertar, modificar y borrar

---

## 🔒 Seguridad

- Contraseñas almacenadas con `password_hash()` (bcrypt)
- Sentencias preparadas con `prepare()` y `bind_param()` para prevenir inyección SQL
- Control de sesiones para proteger páginas privadas

---

## ⚙️ Instalación local

1. Clona el repositorio:
```bash
git clone https://github.com/rubertpc/PHPPark.git
```

2. Copia la carpeta en `/Applications/MAMP/htdocs/`

3. Importa el script SQL en phpMyAdmin:
   - Abre `http://localhost:8888/phpmyadmin`
   - Ve a la pestaña **SQL**
   - Pega el contenido de `navapark2.sql` y ejecuta

4. Arranca MAMP y accede en:
http://localhost:8888/navapark2/
---

## 🌐 URLs del proyecto

| Página | URL |
|--------|-----|
| Registro | `/navapark2/registro.php` |
| Login | `/navapark2/login.php` |
| Perfil | `/navapark2/perfil.php` |
| Nuevo viaje | `/navapark2/nueva_visita.php` |
| Admin - Control general | `/navapark2/admin/control_general.php` |
| Admin - Atracciones | `/navapark2/admin/atracciones_listar.php` |

---

## 👨‍💻 Autor

**Rubert Pacheco**
