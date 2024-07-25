# API Sekolah SMK

API ini menyediakan berbagai endpoint untuk mengelola data sekolah SMK, termasuk data siswa, guru, jurusan, mata pelajaran, jadwal pelajaran, mengajar, nilai, dan kelas. Selain operasi CRUD (Create, Read, Update, Delete) dasar, API ini juga menawarkan endpoint khusus untuk kebutuhan spesifik.

## Instalasi

1. Clone repositori ini:
   ```sh
   git clone https://github.com/adibbaguss/rest-api-sekolah-smk.git
   ```

2. Install dependensi:
   ```sh
   composer install
   ```

3. Salin file `.env.example` ke `.env` dan sesuaikan konfigurasi database:
   ```sh
   cp .env.example .env
   ```

4. **Konfigurasi Database**

   Edit file `.env` untuk mengonfigurasi pengaturan database sesuai dengan lingkungan Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sekolah_smk
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   - **DB_CONNECTION**: Jenis database yang digunakan. Untuk MySQL, biarkan `mysql`.
   - **DB_HOST**: Alamat host database. Umumnya `127.0.0.1` jika database berada di komputer lokal.
   - **DB_PORT**: Port yang digunakan oleh database. Default untuk MySQL adalah `3306`.
   - **DB_DATABASE**: Nama database yang akan digunakan. Pastikan nama ini sama dengan nama database yang telah Anda buat di MySQL.
   - **DB_USERNAME**: Nama pengguna untuk mengakses database. Default untuk MySQL adalah `root`.
   - **DB_PASSWORD**: Kata sandi untuk pengguna database. Kosongkan jika tidak ada kata sandi.

5. Generate key aplikasi:
   ```sh
   php artisan key:generate
   ```

6. Jalankan migrasi dan seeder (jika ada):
   ```sh
   php artisan migrate --seed
   ```

7. Jalankan server lokal:
   ```sh
   php artisan serve
   ```

## Struktur Endpoint

### Guru
- **GET** `/api/guru` - Mengambil semua data guru
- **POST** `/api/guru` - Menambahkan data guru baru
- **GET** `/api/guru/{guru}` - Mengambil data guru berdasarkan ID
- **PUT/PATCH** `/api/guru/{guru}` - Memperbarui data guru berdasarkan ID
- **DELETE** `/api/guru/{guru}` - Menghapus data guru berdasarkan ID
- **GET** `/api/guru/{id}/jadwal` - Mengambil jadwal mengajar guru berdasarkan ID guru

### Jadwal Pelajaran
- **GET** `/api/jadwal_pelajaran` - Mengambil semua data jadwal pelajaran
- **POST** `/api/jadwal_pelajaran` - Menambahkan data jadwal pelajaran baru
- **GET** `/api/jadwal_pelajaran/hari/{hari}` - Mengambil data jadwal pelajaran berdasarkan hari
- **GET** `/api/jadwal_pelajaran/{jadwal_pelajaran}` - Mengambil data jadwal pelajaran berdasarkan ID
- **PUT/PATCH** `/api/jadwal_pelajaran/{jadwal_pelajaran}` - Memperbarui data jadwal pelajaran berdasarkan ID
- **DELETE** `/api/jadwal_pelajaran/{jadwal_pelajaran}` - Menghapus data jadwal pelajaran berdasarkan ID

### Jurusan
- **GET** `/api/jurusan` - Mengambil semua data jurusan
- **POST** `/api/jurusan` - Menambahkan data jurusan baru
- **GET** `/api/jurusan/{jurusan}` - Mengambil data jurusan berdasarkan ID
- **PUT/PATCH** `/api/jurusan/{jurusan}` - Memperbarui data jurusan berdasarkan ID
- **DELETE** `/api/jurusan/{jurusan}` - Menghapus data jurusan berdasarkan ID

### Kelas
- **GET** `/api/kelas` - Mengambil semua data kelas
- **POST** `/api/kelas` - Menambahkan data kelas baru
- **GET** `/api/kelas/{id}/siswa` - Mengambil data siswa berdasarkan ID kelas
- **GET** `/api/kelas/{kelasid}/nilai/{mataPelajaranId}` - Mengambil nilai siswa dalam suatu kelas berdasarkan mata pelajaran tertentu
- **GET** `/api/kelas/{kela}` - Mengambil data kelas berdasarkan ID
- **PUT/PATCH** `/api/kelas/{kela}` - Memperbarui data kelas berdasarkan ID
- **DELETE** `/api/kelas/{kela}` - Menghapus data kelas berdasarkan ID

### Mata Pelajaran
- **GET** `/api/mata_pelajaran` - Mengambil semua data mata pelajaran
- **POST** `/api/mata_pelajaran` - Menambahkan data mata pelajaran baru
- **GET** `/api/mata_pelajaran/{mata_pelajaran}` - Mengambil data mata pelajaran berdasarkan ID
- **PUT/PATCH** `/api/mata_pelajaran/{mata_pelajaran}` - Memperbarui data mata pelajaran berdasarkan ID
- **DELETE** `/api/mata_pelajaran/{mata_pelajaran}` - Menghapus data mata pelajaran berdasarkan ID

### Mengajar
- **GET** `/api/mengajar` - Mengambil semua data mengajar
- **POST** `/api/mengajar` - Menambahkan data mengajar baru
- **GET** `/api/mengajar/{mengajar}` - Mengambil data mengajar berdasarkan ID
- **PUT/PATCH** `/api/mengajar/{mengajar}` - Memperbarui data mengajar berdasarkan ID
- **DELETE** `/api/mengajar/{mengajar}` - Menghapus data mengajar berdasarkan ID

### Nilai
- **GET** `/api/nilai` - Mengambil semua data nilai
- **POST** `/api/nilai` - Menambahkan data nilai baru
- **GET** `/api/nilai/{nilai}` - Mengambil data nilai berdasarkan ID
- **PUT/PATCH** `/api/nilai/{nilai}` - Memperbarui data nilai berdasarkan ID
- **DELETE** `/api/nilai/{nilai}` - Menghapus data nilai berdasarkan ID
- **GET** `/api/nilai/siswa/{id}/nilai` - Mengambil data nilai siswa berdasarkan ID siswa

### Siswa
- **GET** `/api/siswa` - Mengambil semua data siswa
- **POST** `/api/siswa` - Menambahkan data siswa baru
- **GET** `/api/siswa/{id}/jadwal_pelajaran` - Mengambil data jadwal pelajaran siswa berdasarkan ID siswa
- **GET** `/api/siswa/{id}/nilai` - Mengambil data nilai siswa berdasarkan ID siswa
- **GET** `/api/siswa/{siswa}` - Mengambil data siswa berdasarkan ID
- **PUT/PATCH** `/api/siswa/{siswa}` - Memperbarui data siswa berdasarkan ID
- **DELETE** `/api/siswa/{siswa}` - Menghapus data siswa berdasarkan ID

## Contoh Penggunaan

### Mendapatkan Jadwal Mengajar Guru
Endpoint ini mengembalikan data jadwal mengajar guru beserta mata pelajaran dan kelas yang diajar:
```php
public function getMengajarByGuru($id)
{
    $guru = Guru::with(['mengajar.mataPelajaran', 'mengajar.kelas', 'mengajar.jadwalPelajaran'])->find($id);

    if (!$guru) {
        return response()->json(['message' => 'Guru not found'], 404);
    }

    $jadwalGuru = $guru->mengajar->flatMap(function ($mengajarItem) {
        return $mengajarItem->jadwalPelajaran->map(function ($jadwal) use ($mengajarItem) {
            return [
                'hari' => $jadwal->hari,
                'jam_pelajaran' => $jadwal->jam_pelajaran,
                'semester' => $jadwal->semester,
                'pelajaran' => [
                    'kode_mapel' => $mengajarItem->mataPelajaran->kode_mapel,
                    'nama_mapel' => $mengajarItem->mataPelajaran->nama_mapel,
                    'nama_kelas' => $mengajarItem->kelas->nama_kelas,
                    'tahun_ajaran' => $mengajarItem->kelas->tahun_ajaran,
                ],
            ];
        });
    });

    $data = [
        'id' => $guru->id,
        'nip' => $guru->nip,
        'nama_lengkap' => $guru->nama_lengkap,
        'jadwal_guru' => $jadwalGuru,
    ];

    return new GuruResource(true, 'Data guru beserta mata pelajaran dan kelas yang diajar', $data);
}
```

### Mendapatkan Nilai Siswa Berdasarkan Mata Pelajaran
Endpoint ini mengembalikan data nilai siswa dalam suatu kelas berdasarkan mata pelajaran tertentu:
- **GET** `/api/kelas/{kelasid}/nilai/{mataPelajaranId}` - Mengambil nilai siswa dalam suatu kelas berdasarkan mata pelajaran:
```php
public function getNilaiByKelasAndMataPelajaran($kelasid, $mataPelajaranId)
{
    $kelas = Kelas::find($kelasid);
    if (!$kelas) {
        return response()->json(['message' => 'Data Kelas not found'], 404

);
    }

    $nilaiSiswa = Nilai::whereHas('siswa', function ($query) use ($kelas) {
        $query->where('kelas_id', $kelas->id);
    })->where('mata_pelajaran_id', $mataPelajaranId)->get();

    if ($nilaiSiswa->isEmpty()) {
        return response()->json(['message' => 'Data Nilai not found'], 404);
    }

    return new NilaiResource(true, 'Data nilai siswa dalam kelas berdasarkan mata pelajaran', $nilaiSiswa);
}
```

## Penutup
Dokumentasi ini menyediakan panduan dasar mengenai cara menggunakan API Sekolah SMK. Untuk informasi lebih lanjut atau pengembangan fitur, silakan periksa kode sumber atau hubungi pengembang API.

## Media Sosial

- **Instagram:** [adibbagus_](https://www.instagram.com/adibbagus_)
- **LinkedIn:** [Adib Bagus Sudiyono](https://www.linkedin.com/in/adibbaguss/)
- **GitHub:** [adibbaguss](https://github.com/adibbaguss)
- **Web Profile:** [adibbaguss.github.io](https://adibbaguss.github.io)
