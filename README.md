# Intranet Arcade

Plataforma web de gamificación con desafíos diarios competitivos. Los usuarios juegan a Wordle, TypeSpeed y BombParty, suman monedas, compran marcos cosméticos para su avatar y consultan rankings y estadísticas.

Proyecto desarrollado como Trabajo Fin de Grado y actualizado a **versión 2.0** como proyecto de portfolio.

---

## Módulos

- **Juegos diarios**: Wordle, TypeSpeed y BombParty, con una partida por juego y día.
- **Economía**: monedas internas y tienda de marcos para el avatar.
- **Puntuaciones**: historial individual y ranking general.
- **Estadísticas**: gráfico de radar con el rendimiento por categoría.
- **Autenticación**: registro, inicio de sesión y recuperación de contraseña por correo electrónico.

### Novedades de la versión 2.0

- Recuperación de contraseña funcional, con el correo y los textos en español.
- Envío de correos mediante la API de [Mailtrap](https://mailtrap.io) (SDK `railsware/mailtrap-php`).
- Comando `php artisan send-mail` para comprobar el envío de correos.
- Validación de puntuaciones en servidor (`SaveScoreRequest`) y tests de partidas y tienda.
- Puerto de Vite fijo en `5173`.

---

## Stack tecnológico

| Capa | Tecnología |
|---|---|
| Backend | Laravel 12 (PHP 8.2+) |
| Frontend | Tailwind CSS, Alpine.js y JavaScript |
| Base de datos | MySQL / MariaDB |
| Correo | Mailtrap (API de envío) |
| Compilación de assets | Vite |
| Tests | Pest |

---

## Requisitos previos

- **PHP** `>= 8.2` con las extensiones `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `curl` y `fileinfo`.
- **Composer**
- **Node.js y npm** (versión LTS)
- **MySQL o MariaDB**. En Windows, **XAMPP** incluye Apache, PHP y MySQL.
- **Git** (solo si clonas el repositorio).

---

## Instalación

### 1. Obtener el código

```bash
git clone https://github.com/alexmorenT/intranet-juegos.git
cd intranet-juegos
```

Para ver la versión 2.0 exacta: `git checkout v2.0`.

### 2. Instalar dependencias

```bash
composer install
npm install
```

### 3. Configurar el entorno

Copia el archivo de ejemplo y genera la clave de la aplicación:

```bash
cp .env.example .env
php artisan key:generate
php artisan storage:link
```

Configura la base de datos en `.env`:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=intranet_juegos
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Importar la base de datos

El esquema **no usa migraciones**: se importa el volcado SQL incluido en la raíz del repositorio.

1. Crea una base de datos vacía llamada `intranet_juegos` (phpMyAdmin o MySQL Workbench).
2. Importa el archivo `intranet_juegos.sql`.

Tras importarla, puedes iniciar sesión con cualquiera de los usuarios de ejemplo. Su contraseña es `password`.

### 5. Configurar el correo (Mailtrap)

El correo de recuperación de contraseña se envía con Mailtrap. En `.env`:

```ini
MAIL_MAILER=mailtrap-sdk
MAILTRAP_HOST=send.api.mailtrap.io
MAILTRAP_API_KEY=tu_token_de_api
MAIL_FROM_ADDRESS="hello@demomailtrap.co"
MAIL_FROM_NAME="${APP_NAME}"
```

- `MAILTRAP_API_KEY`: token de API que generas en Mailtrap (Settings → API tokens). **No lo subas al repositorio.**
- Con el dominio de prueba `demomailtrap.co`, Mailtrap solo entrega correos a la dirección de tu cuenta. Para enviar a otros destinatarios hay que verificar un dominio propio en Mailtrap.

Para comprobar el envío:

```bash
php artisan config:clear
php artisan send-mail tu-correo@ejemplo.com
```

Los envíos aparecen en https://mailtrap.io/sending/email_logs.

---

## Ejecución en desarrollo

### Opción A: con XAMPP (la usada en el desarrollo)

1. Inicia **Apache** y **MySQL** desde el panel de XAMPP.
2. En una terminal, en la raíz del proyecto, ejecuta:
   ```bash
   npm run dev
   ```
   Vite se queda escuchando en `http://localhost:5173`. Deja esa terminal abierta.
3. Abre la aplicación en:
   ```
   http://localhost/intranet-juegos/public/
   ```

Si en `.env` `APP_URL` no coincide con esa ruta, los enlaces generados por Laravel (por ejemplo, el del correo de recuperación) pueden apuntar mal. En ese caso usa `APP_URL=http://localhost/intranet-juegos/public` y ejecuta `php artisan config:clear`.

### Opción B: con el servidor de Laravel

Necesitas dos terminales en la raíz del proyecto:

```bash
php artisan serve     # Terminal 1: http://127.0.0.1:8000
npm run dev           # Terminal 2: assets en http://localhost:5173
```

---

## Compilación para producción

```bash
npm run build
```

Genera los archivos en `public/build/`, que están incluidos en el repositorio para poder ejecutar la aplicación sin Node.js.

---

## Tests

```bash
php artisan test
```

Los tests usan SQLite en memoria y no modifican la base de datos MySQL.

---

## Estructura principal

```
app/Http/Controllers/   Juegos, tienda, ranking, estadísticas y autenticación
app/Http/Requests/      Validación de puntuaciones
app/Providers/          Textos y correo de recuperación de contraseña
lang/es/                Mensajes de estado en español
resources/views/        Vistas Blade (juegos, tienda, ranking, perfil y autenticación)
routes/web.php          Rutas de la aplicación
routes/console.php      Comandos artisan (send-mail)
tests/                  Tests de autenticación, puntuaciones y tienda
```

