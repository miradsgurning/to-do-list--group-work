PROYEK UAS - PEMROGRAMAN WEB

Nama Proyek: Elite Squad To-Do List
Mata Kuliah: Proyek Pemrograman web
Dosen Pengampu: Kornelius Sitepu., M.Kom

1. Informasi Kelompok
    Nama Kelompok: Elite Squad
    Anggota Kelompok:
    1. Mira Dila Syafitri Gurning - 202301033
    2. Sun Angel Febyani - 202301053
    3. Farrel Diva Eliasar - 202301012
    4. Jonatan Hose Sihombing - 202301033
    5. Wira Astika Sihite - 202301057
    6. Putri Sonaria Damanik - 202302017

2. Deskripsi Singkat Aplikasi
    Elite Squad To-Do List adalah aplikasi pencatatan tugas harian berbasis web yang dibangun dengan framework CodeIgniter 4. 
    Aplikasi ini berfokus pada kemudahan penggunaan untuk memantau produktivitas individu maupun kelompok.

3. Daftar Fitur Utama
    1. Manajemen Tugas (CRUD): Menambah, melihat, dan menghapus daftar tugas.
    2. Update Status: Mengubah status tugas dari 'Aktif' menjadi 'Selesai' atau sebaliknya.
    3. Filtering: Menyaring tugas berdasarkan status (Semua, Aktif, Selesai).
    4. Searching: Mencari tugas berdasarkan kata kunci judul.
    5. Penyimpanan Data Persisten (Persisten Storage): Data tidak hilang ketika sesi aplikasi berakhir
    6. UI Responsif: Desain modern menggunakan Bootstrap 5 yang ramah di perangkat mobile.
    7. Upload File Gambar: Identitas visual logo kampus pada bagian header.

4. Akun Demo
    Aplikasi ini tidak menggunakan sistem login (akses publik untuk kebutuhan demo tugas).

5. Cara Menjalankan Aplikasi
    1. Ekstrak file .zip ke folder server lokal Anda (Contoh: htdocs pada XAMPP).
    2. Buat database baru bernama db_todo (atau sesuai keinginan) di phpMyAdmin.
    3. Impor file database.sql yang disertakan ke dalam database tersebut.
    4. Buka file .env di folder root proyek dan sesuaikan konfigurasi database:
        - database.default.hostname = localhost
        - database.default.database = db_todo
        - database.default.username = root
        - database.default.password = 
    5. Buka terminal/CMD di folder proyek, lalu jalankan perintah: php spark serve.
    6. Akses aplikasi melalui browser di alamat: http://localhost:8080.