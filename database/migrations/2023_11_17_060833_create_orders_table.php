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
        Schema::dropIfExists('orders');

        Schema::create('orders', function (Blueprint $table) {
            $table->char('no_order', 6)->primary();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamp('tgl_order')->nullable(false);
            $table->char('nomor_meja', 2)->nullable();
            $table->enum('status', ['Menunggu Pembayaran', 'Diproses', 'Diterima', 'Dibatalkan', 'Pending'])->default('Menunggu Pembayaran');
            $table->text('catatan')->nullable();    
            $table->foreignId('metode_pembayaran_id')->constrained('metode_pembayaran')->nullable();
            $table->timestamps();
            // $table->foreign('user_id')
            //       ->references('id_user')
            //       ->on('users')
            //       ->onUpdate('cascade')
            //       ->onDelete('restrict');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
