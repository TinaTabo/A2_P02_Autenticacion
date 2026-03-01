# Actividad 2 – P02
## Autenticación y Autorización con Laravel 12 + Spatie

Proyecto desarrollado para la asignatura Seguridad Web.
Implementa autenticación con Laravel UI y autorización basada en roles utilizando el paquete Spatie Laravel Permission.

Incluye:
- Sistema de login y registro.
- CRUD completo de Task.
- Control de acceso por roles (admin, editor, user).
- Listado de usuarios visible únicamente para el rol admin.
- Protección tanto en frontend (ocultando botones) como en backend (middleware con validación de roles).

---

REQUISITOS

- PHP >= 8.2
- Composer
- Node.js y npm
- MySQL
- Servidor local (MAMP, XAMPP o php artisan serve)

---

INSTALACIÓN

1. Clonar o descomprimir el proyecto.

2. Instalar dependencias de PHP:
   composer install

3. Instalar dependencias de frontend:
   npm install

4. Copiar archivo de entorno:
   cp .env.example .env

5. Configurar la base de datos en el archivo .env:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=a2_p02_autenticacion
   DB_USERNAME=root
   DB_PASSWORD=root

   (Adaptar las credenciales según la configuración local.)

6. Generar la clave de aplicación:
   php artisan key:generate

7. Ejecutar migraciones y seeders:
   php artisan migrate:fresh --seed

   Este comando:
   - Crea todas las tablas necesarias.
   - Genera los roles y permisos.
   - Crea usuarios de prueba.
   - Asigna automáticamente los roles correspondientes.

8. Iniciar el servidor:
   php artisan serve

   Acceder en el navegador a:
   http://127.0.0.1:8000

---

USUARIOS DE PRUEBA

Todos los usuarios tienen la contraseña:
password

ADMIN
Email: admin@test.com
Permisos:
- CRUD completo de Task.
- Acceso al listado de usuarios.

EDITOR
Email: editor@test.com
Permisos:
- CRUD completo de Task.
- No puede acceder al listado de usuarios.

USER
Email: user@test.com
Permisos:
- Solo puede visualizar tareas (index y show).
- No puede crear, editar ni eliminar.
- No puede acceder al listado de usuarios.

---

CONTROL DE ACCESO

La aplicación utiliza:
- Middleware auth para proteger rutas autenticadas.
- Middleware de roles proporcionado por Spatie:
  role:admin
  role:editor
  role:user

Las rutas están organizadas para que:
- Todos los usuarios autenticados puedan ver tareas.
- Solo admin y editor puedan crear, editar o eliminar.
- Solo admin pueda acceder al listado de usuarios.

Además:
- Los botones de acción (Create, Edit, Delete) se muestran dinámicamente según el rol.
- El acceso manual por URL está protegido y devuelve error 403 si el usuario no tiene permisos.

---

FLUJO DE PRUEBAS RECOMENDADO

1. Ejecutar:
   php artisan migrate:fresh --seed

2. Iniciar sesión como admin:
   - Probar CRUD completo.
   - Acceder a /users.

3. Iniciar sesión como editor:
   - Probar CRUD completo.
   - Verificar que no puede acceder a /users.

4. Iniciar sesión como user:
   - Verificar que solo puede visualizar tareas.
   - Confirmar que no puede crear, editar ni eliminar.
   - Confirmar que no puede acceder a /users.

---

NOTAS TÉCNICAS

- Task no está relacionada con User, siguiendo los requisitos de la práctica.
- Los roles y permisos se generan automáticamente mediante seeders.
- La redirección tras login apunta a /home, que redirige a /tasks.
- El proyecto puede reconstruirse completamente con un único comando:
  php artisan migrate:fresh --seed

---

ESTADO DEL PROYECTO

✔ Autenticación implementada
✔ Autorización por roles implementada
✔ CRUD protegido correctamente
✔ Protección frontend y backend
✔ Entorno reproducible automáticamente