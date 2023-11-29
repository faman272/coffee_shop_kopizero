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
        Schema::dropIfExists('carts');

        Schema::create('carts', function (Blueprint $table) {
            $table->id('id_keranjang');
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedTinyInteger('menu_id');
            $table->foreign('menu_id')
                  ->references('id_menu')
                  ->on('menus');
            $table->integer('qty');
            $table->char('jenis_harga', 5);
            $table->integer('harga');
            $table->integer('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
