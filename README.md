# Sistem Pendukung Keputusan (SPK) dengan Metode SAW & ARAS

Aplikasi web sederhana yang dibangun dengan Laravel untuk membantu proses pengambilan keputusan menggunakan metode *Simple Additive Weighting* (SAW) dan *Additive Ratio Assessment* (ARAS). Aplikasi ini dapat digunakan untuk merangking berbagai alternatif (contoh: siswa, karyawan, produk) berdasarkan kriteria yang telah ditentukan.

Selain itu, aplikasi ini juga dilengkapi dengan perhitungan Korelasi Rank Spearman untuk membandingkan dan memvalidasi konsistensi hasil dari kedua metode.

---

## ✨ Fitur Utama

-   **CRUD Kriteria**: Manajemen data kriteria, termasuk kode, keterangan, bobot ternormalisasi, dan jenis (Benefit/Cost).
-   **CRUD Alternatif**: Manajemen data alternatif yang akan dinilai.
-   **Input Penilaian Dinamis**: Halaman input penilaian dalam bentuk matriks (tabel) yang mudah diisi dan disimpan secara efisien.
-   **Perhitungan Detail SAW**: Tampilan langkah demi langkah proses perhitungan metode SAW, mulai dari matriks keputusan hingga perangkingan akhir.
-   **Perhitungan Detail ARAS**: Tampilan langkah demi langkah proses perhitungan metode ARAS, menggunakan pendekatan inversi untuk kriteria *cost*.
-   **Hasil Akhir & Korelasi**: Halaman rangkuman yang menampilkan perbandingan hasil peringkat SAW dan ARAS secara berdampingan, lengkap dengan perhitungan Korelasi Rank Spearman.

---

## 🛠️ Teknologi yang Digunakan

-   **Backend**: Laravel Framework, PHP
-   **Frontend**: Bootstrap 4, JavaScript, jQuery, AJAX
-   **Database**: MySQL / MariaDB

---

## 🚀 Panduan Instalasi

Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan lokal Anda.

1.  **Clone Repository**
    ```bash
    git clone https://github.com/ridhopujiono/laravel-system-recommendation-aras-saw
    cd laravel-system-recommendation-aras-saw
    ```

2.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
    ```bash
    cp .env.example .env
    ```
    Buka file `.env` dan atur `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`.

3.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

4.  **Jalankan Migrasi Database**
    Perintah ini akan membuat semua tabel yang dibutuhkan di database Anda.
    ```bash
    php artisan migrate
    ```

5.  **Jalankan Database Seeder (Opsional)**
    Jika Anda memiliki seeder (seperti `PenilaianSeeder` yang kita buat), jalankan perintah ini untuk mengisi data awal.
    ```bash
    php artisan db:seed
    ```

6.  **Jalankan Development Server**
    ```bash
    php artisan serve
    ```
    Aplikasi sekarang dapat diakses di `http://127.0.0.1:8000`.

---

## Workflow Aplikasi

Alur kerja penggunaan aplikasi ini adalah sebagai berikut:

1.  **Isi Data Master**:
    -   Buka menu **Data Kriteria** untuk menambahkan semua kriteria yang akan digunakan beserta bobot ternormalisasi dan jenisnya.
    -   Buka menu **Data Alternatif** untuk mendaftarkan semua kandidat atau item yang akan dinilai.

2.  **Proses Penilaian**:
    -   Masuk ke menu **Input Penilaian**.
    -   Isi semua nilai asli dari setiap alternatif terhadap setiap kriteria pada tabel yang disediakan.
    -   Klik tombol simpan (ikon disket) untuk menyimpan semua nilai.

3.  **Lihat Hasil**:
    -   Untuk melihat detail perhitungan, buka menu **Perhitungan** lalu pilih **Perhitungan SAW** atau **Perhitungan ARAS**.
    -   Untuk melihat rangkuman akhir, buka menu **Hasil Akhir**. Halaman ini akan menampilkan peringkat dari kedua metode dan hasil korelasi Spearman.

---

## 📝 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE.md).