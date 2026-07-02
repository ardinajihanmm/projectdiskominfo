# Project Diskominfo Pemalang

Sistem Informasi Service Desk Diskominfo Kabupaten Pemalang.

## Tech Stack

- Laravel 11
- PHP 8.2+
- MySQL
- Bootstrap 5
- Git & GitHub

---

# Clone Project

Clone repository:

```bash
git clone https://github.com/ardinajihanmm/projectdiskominfo.git
```

Masuk ke folder project:

```bash
cd projectdiskominfo
```

---

# Install Project

Install dependency:

```bash
composer install
```

Copy file environment:

Windows

```bash
copy .env.example .env
```

Linux / Mac

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

---

# Konfigurasi Database

Buat database MySQL dengan nama:

```
projectdiskominfo
```

Kemudian edit file `.env`

Contoh:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=projectdiskominfo
DB_USERNAME=root
DB_PASSWORD=
```

> **Catatan**
>
> Jika MySQL menggunakan port **3307**, ubah:
>
> ```env
> DB_PORT=3307
> ```

---

# Jalankan Migration

```bash
php artisan migrate
```

---

# Menjalankan Project

```bash
php artisan serve
```

Project dapat diakses melalui:

```
http://127.0.0.1:8000
```

---

# Push Perubahan ke GitHub

Cek perubahan:

```bash
git status
```

Tambahkan semua file:

```bash
git add .
```

Commit perubahan:

```bash
git commit -m "Pesan commit"
```

Contoh:

```bash
git commit -m "Menambahkan halaman login"
```

Push ke GitHub:

```bash
git push origin main
```

---

# Mengambil Update dari GitHub

Sebelum mulai coding, lakukan:

```bash
git pull origin main
```

Supaya project selalu menggunakan versi terbaru.

---

# Workflow Tim

1. Jalankan:

```bash
git pull origin main
```

2. Kerjakan fitur masing-masing.

3. Simpan perubahan:

```bash
git add .
git commit -m "Pesan commit"
```

4. Upload ke GitHub:

```bash
git push origin main
```

---

# Struktur Branch

```
main
```

Semua anggota menggunakan branch **main**.

*(Jika nanti project berkembang, bisa ditambahkan branch `develop` dan `feature`.)*

---

# Catatan

File berikut **tidak diupload ke GitHub** karena sudah masuk `.gitignore`:

- `.env`
- `vendor`
- `node_modules`
- `storage/logs`

Setiap anggota harus membuat file `.env` masing-masing sesuai konfigurasi komputer.