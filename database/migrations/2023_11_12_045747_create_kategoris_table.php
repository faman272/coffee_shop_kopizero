<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::dropIfExists('kategoris');

        Schema::create('kategoris', function (Blueprint $table) {
            $table->tinyInteger('id_kategori', 2);
            $table->string('nama_kategori', 50)->nullable(false);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE kategoris DROP PRIMARY KEY, ADD PRIMARY KEY (id_kategori)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};
