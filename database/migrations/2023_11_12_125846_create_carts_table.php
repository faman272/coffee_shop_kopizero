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
        // Schema::create('carts', function (Blueprint $table) {
        //     $table->id('id_keranjang');
        //     $table->foreignId('user_id')->constrained('users');
        //     $table->foreignId('id_menu')->constrained('menus')->references('id_menu');
        //     $table->integer('qty');
        //     $table->integer('harga');
        //     $table->integer('subtotal');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
