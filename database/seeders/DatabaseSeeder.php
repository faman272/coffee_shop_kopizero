<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@gmail.com', 'email_verified_at' => '2024-01-13 20:08:19', 'no_telp' => '081263955962', 'password' => bcrypt('admin'), 'role' => 'admin']
        ]);

        DB::table('kategoris')->insert([
            ['id_kategori' => 1, 'nama_kategori' => 'Kopi'],
            ['id_kategori' => 2, 'nama_kategori' => 'NonKopi']
        ]);

        DB::table('menus')->insert([
            ['id_menu' => 1, 'nama_menu' => 'Americano', 'kategori_id' => 1, 'H_Hot' => 10000.00, 'H_Ice' => 12000.00, 'deskripsi' => 'Minuman kopi hitam yang terbuat dari satu atau dua shot espresso dicampur dengan air panas.', 'gambar' => 'image/menu-img.png'],
            ['id_menu' => 2, 'nama_menu' => 'Espresso', 'kategori_id' => 1, 'H_Hot' => 10000.00, 'H_Ice' => 0.00, 'deskripsi' => 'Minuman kopi pekat yang dihasilkan dengan mengekstrak air panas melalui bubuk kopi.', 'gambar' => 'image/menu-img.png'],
            ['id_menu' => 3, 'nama_menu' => 'Badak Susu', 'kategori_id' => 2, 'H_Hot' => 0.00, 'H_Ice' => 12000.00, 'deskripsi' => 'Minuman soda dengan tambahan susu dan es.', 'gambar' => 'image/menu-img.png'],
            ['id_menu' => 4, 'nama_menu' => 'Kopi Sanger', 'kategori_id' => 1, 'H_Hot' => 12000.00, 'H_Ice' => 15000.00, 'deskripsi' => 'Minuman kopi unik dengan tambahan jahe, gula merah, dan santan.', 'gambar' => 'image/menu-img.png'],
            ['id_menu' => 5, 'nama_menu' => 'Teh Hijau', 'kategori_id' => 2, 'H_Hot' => 6000.00, 'H_Ice' => 7000.00, 'deskripsi' => 'Minuman teh yang terbuat dari daun teh hijau, memberikan rasa segar dan kaya akan antioksidan.', 'gambar' => 'image/menu-img.png'],
            ['id_menu' => 6, 'nama_menu' => 'Kopi Latte', 'kategori_id' => 1, 'H_Hot' => 13000.00, 'H_Ice' => 15000.00, 'deskripsi' => 'Minuman kopi yang terbuat dari espresso dicampur dengan susu steamed dan foam susu.', 'gambar' => 'image/menu-img.png'],
            ['id_menu' => 7, 'nama_menu' => 'Lemon Tea', 'kategori_id' => 2, 'H_Hot' => 10000.00, 'H_Ice' => 12000.00, 'deskripsi' => 'Minuman teh segar dengan tambahan sari lemon, memberikan rasa segar dan nikmat.', 'gambar' => 'image/menu-img.png'],
            ['id_menu' => 8, 'nama_menu' => 'Kopi Zero', 'kategori_id' => 1, 'H_Hot' => 13000.00, 'H_Ice' => 15000.00, 'deskripsi' => 'Minuman kopi tanpa tambahan gula atau pemanis, memberikan rasa kopi murni.', 'gambar' => 'image/menu-img.png'],
            ['id_menu' => 9, 'nama_menu' => 'Cokelat Milk', 'kategori_id' => 2, 'H_Hot' => 10000.00, 'H_Ice' => 12000.00, 'deskripsi' => 'Minuman susu cokelat hangat maupun dingin yang lezat.', 'gambar' => 'image/menu-img.png'],
            ['id_menu' => 10, 'nama_menu' => 'Tubruk', 'kategori_id' => 1, 'H_Hot' => 10000.00, 'H_Ice' => 12000.00, 'deskripsi' => 'Minuman kopi khas Indonesia dengan cara menyeduh kopi bubuk dan gula aren langsung di dalam gelas.', 'gambar' => 'image/menu-img.png'],
            ['id_menu' => 11, 'nama_menu' => 'Matcha Milk', 'kategori_id' => 2, 'H_Hot' => 10000.00, 'H_Ice' => 12000.00, 'deskripsi' => 'Minuman susu dengan tambahan bubuk matcha, memberikan kombinasi unik rasa teh hijau dan kelembutan susu.', 'gambar' => 'image/menu-img.png'],
            ['id_menu' => 12, 'nama_menu' => 'Teh Manis', 'kategori_id' => 2, 'H_Hot' => 6000.00, 'H_Ice' => 7000.00, 'deskripsi' => 'Minuman teh dengan tambahan gula, memberikan rasa manis yang nikmat.', 'gambar' => 'image/menu-img.png'],
        ]);

        DB::table('metode_pembayaran')->insert([
            ['id' => 1, 'nama_metode' => 'Mandiri', 'norek' => '', 'logo' => 'image/logo-mandiri.png', 'atas_nama' => 'GEBOY DONNY AURORA S'],
            ['id' => 2, 'nama_metode' => 'QRIS', 'norek' => '-', 'logo' => 'image/qris.png', 'atas_nama' => 'GEBOY DONNY AURORA S'],
            ['id' => 3, 'nama_metode' => 'Cash', 'norek' => '-', 'logo' => '-', 'atas_nama' => '-'],
        ]);

        DB::unprepared('
    CREATE FUNCTION fHitungNomorMeja(table_number INT)
    RETURNS INT DETERMINISTIC
    READS SQL DATA
    BEGIN
        DECLARE order_count INT;
        SELECT COUNT(*) INTO order_count FROM orders WHERE nomor_meja = table_number COLLATE utf8mb4_unicode_ci AND status NOT IN ("Dibatalkan", "Diterima");
        RETURN order_count;
    END
');
    }
}