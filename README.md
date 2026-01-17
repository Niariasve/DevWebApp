# DevWebCamp

## Description

DevWebApp from Udemy's Desarrollo Web Completo con HTML5, CSS3, JS AJAX PHP y MySQL course.

## 📌 Project Setup

This project requires environment configuration and two development servers (PHP and Node) to run locally.

---

## 📋 Requirements

### Backend

* **PHP ≥ 8.4**
  (Developed with PHP 8.5, PHP 8.4 should be sufficient)

### Frontend / Tooling

* **Node.js ≥ 18**
  (Developed with Node 22.14, earlier LTS versions should work)

### Other

* npm (comes with Node.js)
* A local database (MySQL / MariaDB or compatible)

---

## ⚙️ Environment Configuration

This project uses environment variables.

1. Copy the example file:

```bash
cp .env.example .env
```

2. Fill in the required values in `.env`:

```env
DB_HOST=""
DB_USER=""
DB_PASS=""
DB_NAME=""

EMAIL_HOST=""
EMAIL_PORT=""
EMAIL_USER=""
EMAIL_PASS=""

HOST=""
```

⚠️ **Do not commit your `.env` file** — it must remain local.

---

## 🚀 Running the Project Locally

There are **two supported ways** to run the project during development.

---

## 🔹 Option 1: Manual (Two Terminals)

This is the most explicit way and useful for debugging.

### 1️⃣ Start the PHP Development Server

From the project root:

```bash
cd public
php -S localhost:3000
```

You may use any available port if needed.

---

### 2️⃣ Start the Frontend / Asset Dev Server

From the **project root**, in another terminal:

```bash
npm install
npm run dev
```

---

## 🔹 Option 2: Single Command (Recommended)

This project supports running **both servers at once** using `concurrently`.

### Requirements

`concurrently` is already installed as a dev dependency.

### Scripts

Your `package.json` should include something similar to:

```json
{
  "scripts": {
    "php": "php -S localhost:3000 -t public",
    "gulp": "npm run dev",
    "dev": "concurrently \"npm run php\" \"npm run gulp\""
  },
}
```

### Run Everything

From the project root:

```bash
npm run dev
```

This will start:

* PHP server at `http://localhost:3000`
* Frontend dev server simultaneously

---

## 🛠 Development Notes

* The backend is served using PHP’s built-in development server:

  ```bash
  php -S localhost:3000 -t public
  ```

* Frontend assets are handled using **Gulp**.

### CSS

* SCSS files are located in `src/scss/`
* Compiled to `public/build/css`
* Source maps are generated for development
* Output style is expanded (not minified)

### JavaScript

* JavaScript files are located in `src/js/`
* Files are minified using `terser`
* Source maps are generated
* Output files are written to `public/build/js` with `.min.js` suffix

### Images

* Original images are located in `src/img/`
* Optimized images are output to `public/build/img`
* Additional formats are automatically generated:
* **WebP**
* **AVIF**
* Image optimization is cached to improve build performance

### Watch Mode

When running the development workflow:

* Gulp watches for changes in:
    * SCSS files
    * JavaScript files
    * Image files
    * Assets are automatically rebuilt when changes are detected
* PHP and Gulp run **in parallel** using `concurrently`

---

## 📄 License

This project is for development and learning purposes.
