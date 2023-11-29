<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('menus');
        
        Schema::create('menus', function (Blueprint $table) {
            $table->tinyIncrements('id_menu');
            $table->string('nama_menu', 50)->nullable(false);
            $table->tinyInteger('kategori_id');
            $table->decimal('H_Hot', 10, 2)->nullable(false);
            $table->decimal('H_Ice', 10, 2)->nullable(false);
            $table->text('deskripsi')->nullable(false);
            $table->string('gambar', 100)->nullable();
        
            $table->foreign('kategori_id')
                  ->references('id_kategori')
                  ->on('kategoris')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        
            $table->timestamps();
        });
        
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
