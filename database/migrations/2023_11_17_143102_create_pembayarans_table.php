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
        Schema::dropIfExists('pembayarans');

        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->char('no_order', 6);
            $table->decimal('total_pembayaran', 8, 2);
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();

            $table->foreign('no_order')
                  ->references('no_order')
                  ->on('orders')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
