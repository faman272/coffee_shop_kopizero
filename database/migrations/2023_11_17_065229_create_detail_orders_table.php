<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('detail_orders');

        Schema::create('detail_orders', function (Blueprint $table) {
            $table->char('no_order', 6);
            $table->unsignedTinyInteger('menu_id');
            $table->integer('qty');
            $table->integer('harga');
            $table->char('jenis_harga', 3);
            $table->integer('subtotal');
        
            $table->foreign('no_order')
                  ->references('no_order')
                  ->on('orders');
        
            $table->foreign('menu_id')
                  ->references('id_menu')
                  ->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_orders');
    }
};
