#  Intranet Arcade

Plataforma web interna corporativa orientada a la **gamificación y la agilidad mental** de los empleados mediante desafíos diarios competitivos. El sistema integra los siguientes módulos principales:

-  **Juegos diarios** — Wordle, TypeSpeed y BombParty con retos renovados cada día.
-  **Sistema de economía** — Moneda interna y tienda de marcos cosméticos para avatares.
-  **Historial de puntuaciones** — Registro individual y colectivo de partidas.
-  **Gráfico de radar analítico** — Visualización de habilidades desglosadas por categoría.

---

##  Stack Tecnológico

| Capa | Tecnología |
|---|---|
| Backend | Laravel 11.x (PHP 8.2+) |
| Frontend | Tailwind CSS + JavaScript nativo |
| Base de Datos | MySQL / MariaDB |
| Empaquetador | Vite |

---

##  Requisitos Previos

Asegúrate de tener instaladas las siguientes herramientas antes de continuar:

- **PHP** `>= 8.2` (con extensiones: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`)
- **Composer** (gestor de dependencias PHP)
- **Node.js & NPM** (versión LTS recomendada)
- **MySQL / MariaDB** (servidor de base de datos local)
- **Git** *(opcional — solo necesario si se clona desde GitHub)*

---

##  Guía de Instalación

### Paso 1 — Obtención del Código

**Opción A — Pendrive físico** *(entorno sin conexión)*

Localiza el archivo `.rar` en el pendrive físico entregado junto al proyecto. Descomprímelo en el directorio de trabajo local de tu elección.

**Opción B — Repositorio GitHub** *(requiere conexión a internet)*

```bash
git clone https://github.com/alexmorenT/intranet-juegos.git intranet-arcade
cd intranet-arcade
```

---

### Paso 2 — Instalación de Dependencias

Ejecuta los siguientes comandos de forma **independiente** desde la raíz del proyecto:

**Backend (PHP / Composer):**
```bash
composer install
```

**Frontend (Node.js / NPM):**
```bash
npm install
```

---

### Paso 3 — Configuración del Entorno

Copia el archivo de entorno de ejemplo:

```bash
cp .env.example .env
```

Abre el archivo `.env` generado y configura el bloque de conexión a la base de datos con los siguientes valores locales:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=intranet_juegos
DB_USERNAME=root
DB_PASSWORD=
```

---

### Paso 4 — Inicialización del Sistema

Genera la clave criptográfica de la aplicación:

```bash
php artisan key:generate
```

Crea el enlace simbólico para el sistema de almacenamiento de archivos:

```bash
php artisan storage:link
```

---

### Paso 5 — Importación de la Base de Datos

>  **El esquema de la base de datos se importa manualmente desde el volcado SQL incluido en el repositorio. No se utiliza el sistema de migraciones de Laravel.**

El archivo de volcado SQL se encuentra en la **raíz del repositorio**, en la siguiente ruta exacta:

```
intranet-arcade/intranet_juegos.sql
```

**Pasos a seguir:**

1. Accede a tu gestor de base de datos local (p. ej. **phpMyAdmin** o **MySQL Workbench**).
2. Crea una nueva base de datos vacía con el nombre exacto: `intranet_juegos`.
3. Selecciona dicha base de datos e importa el archivo `intranet_juegos.sql`.

---

### Paso 6 — Ejecución en Desarrollo

> **ATENCIÓN:** Este paso requiere **dos terminales simultáneas** abiertas en la raíz del proyecto.

**Terminal 1 — Servidor PHP (Backend):**
```bash
php artisan serve
```

**Terminal 2 — Compilación de assets en vivo (Frontend):**
```bash
npm run dev
```

---

## Acceso Local

Una vez levantados ambos servicios, el entorno de desarrollo estará disponible en:

```
http://127.0.0.1:8000
```
