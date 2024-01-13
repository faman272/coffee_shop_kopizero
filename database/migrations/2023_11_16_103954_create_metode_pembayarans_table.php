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
        Schema::dropIfExists('metode_pembayaran');

        Schema::create('metode_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_metode', 15);
            $table->string('norek', 16);
            $table->text('logo');
            $table->string('atas_nama', 40);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metode_pembayaran');
    }
};
