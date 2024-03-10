DataPenduduk Website
--
Data Penduduk adalah aplikasi manajemen data penduduk atau aplikasi pencatatan data penduduk.

Tujuannya adalah untuk memungkinkan pengguna untuk memasukkan, menyimpan, dan mengakses informasi tentang penduduk, serta melakukan pencarian data berdasarkan kriteria tertentu, seperti nama, alamat, usia, jenis kelamin, dll.

#### How to run
> These tutorial below is only for local test.

1. Run following these commands.
    ```shell script
    cp .env.example .env
   ```
   ```shell script
    composer install
   ```
   
   ```shell script
    npm install #optional
   ```
   ```shell script
    php artisan key:generate
    ```
2. Setup database, change db config in `.env`
3. Run migration and seeder
    ```shell script
    php artisan migrate --seed
    ```
4. Run this command below in different terminal session
    ```shell script
    npm run prod #optional
    ```
    ```shell script
    php artisan serve 
    ```
> Made with ♥ 2024 
