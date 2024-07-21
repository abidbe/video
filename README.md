# Video Streaming Laravel Application

Aplikasi ini adalah platform video streaming berbasis Laravel dengan dua jenis pengguna: admin dan customer. Admin dapat mengelola video dan memberikan izin akses kepada customer. Customer dapat meminta izin untuk menonton video dan menonton video setelah permintaan mereka disetujui oleh admin.

## Fitur Utama

1. **Autentikasi Pengguna**: Registrasi, login, dan pengelolaan user oleh admin.
2. **Manajemen Video oleh Admin**: CRUD video.
3. **Permintaan Akses Video oleh Customer**: Customer dapat meminta akses untuk menonton video.
4. **Persetujuan Akses oleh Admin**: Admin dapat menyetujui atau menolak permintaan akses video.
5. **Penentuan Batas Waktu Akses**: Admin dapat memberikan akses dengan batas waktu tertentu.

## Persiapan

### Kebutuhan Sistem

-   PHP >= 8.1
-   Composer
-   MySQL
-   Node.js & NPM
-   FFMpeg (untuk pengolahan video)

### Instalasi

1. **Clone Repository**:

    ```sh
    git clone https://github.com/abidbe/video.git
    cd video
    ```

2. **Instalasi Dependensi**:

    ```sh
    composer install
    npm install && npm run dev
    ```

3. **Konfigurasi Lingkungan**:

    - Salin `.env.example` menjadi `.env`:
        ```sh
        cp .env.example .env
        ```
    - Sesuaikan konfigurasi database pada `.env`:
        ```ini
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=video
        DB_USERNAME=root
        DB_PASSWORD=
        ```

4. **Generate Key dan Storage Link**:

    ```sh
    php artisan key:generate
    php artisan storage:link
    ```

5. **Migrasi dan Seed Database**:
    ```sh
    php artisan migrate --seed
    ```

### Instalasi FFMpeg

1. Unduh dan Instal FFMpeg

-   **Windows**:

    1. Unduh FFMpeg dari [situs resmi](https://ffmpeg.org/download.html).
    2. Ekstrak file unduhan.
    3. Tambahkan path folder `bin` ke `Environment Variables`.

-   **Mac**:

    ```sh
    brew install ffmpeg
    ```

-   **Linux:**

    ```sh
    sudo apt update
    sudo apt install ffmpeg
    ```

2. Instalasi Paket PHP FFMpeg

Instal paket PHP untuk FFMpeg menggunakan Composer:

    composer require php-ffmpeg/php-ffmpeg

## Penutup

Dokumentasi ini mencakup dasar-dasar aplikasi video streaming berbasis Laravel 11. Pastikan untuk melakukan konfigurasi yang diperlukan sesuai dengan lingkungan server yang Anda gunakan. Jika ada masalah atau bug, periksa kembali langkah-langkah instalasi dan konfigurasi, atau lihat dokumentasi resmi Laravel untuk informasi lebih lanjut.
