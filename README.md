# MonsDB

## Project Overview

MonsDB adalah platform database interaktif modern yang merangkum data monster lengkap dari berbagai seri game Monster Hunter. Aplikasi web ini dirancang khusus untuk mempermudah para Hunter menjelajahi informasi target buruan mereka dengan cepat dan efisien. Proyek open-source ini dibangun menggunakan framework Laravel dan Tailwind CSS untuk performa serta UI yang optimal.

## Credit

Database open-source yang digunakan pada project ini berasal dari:

- [CrimsonNynja/monster-hunter-DB](https://github.com/CrimsonNynja/monster-hunter-DB)

## Stack

- Laravel 13
- Tailwind CSS v4
- Alpine.js
- PHP
- SQLite

## Installation / Setup

Langkah instalasi menggunakan Laragon 6.0.0:

1. Pastikan Laragon 6.0.0 sudah terpasang.
2. Buka terminal, lalu jalankan:

    ```bash
    cd /laragon/www/
    git clone https://github.com/username/monster-hunter-monsdb.git
    cd monster-hunter-monsdb
    ```

3. Install dependency PHP dengan Composer:

    ```bash
    composer install
    ```

4. Salin file environment dan sesuaikan konfigurasi database:

    ```bash
    cp .env.example .env
    ```

5. Buka `.env` dan atur koneksi database SQLite:

    ```env
    DB_CONNECTION=sqlite
    DB_DATABASE=/laragon/www/monster-hunter-monsdb/database/database.sqlite
    ```

    Jika file `database/database.sqlite` belum ada, buat file kosong di folder `database`.

6. Generate application key:

    ```bash
    php artisan key:generate
    ```

7. Jalankan migrasi dan seeder jika diperlukan:

    ```bash
    php artisan migrate --seed
    ```

8. Jalankan server lokal:

    ```bash
    php artisan serve
    ```

Jika menggunakan Laragon, Anda juga bisa membuka project langsung dari menu Laragon dan menjalankan `Start All`.

## Notes

- Proyek ini dibangun dengan Laravel 13.
- Tailwind CSS versi 4 digunakan untuk styling dan antarmuka.
