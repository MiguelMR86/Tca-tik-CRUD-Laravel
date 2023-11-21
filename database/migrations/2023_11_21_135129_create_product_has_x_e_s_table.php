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
        Schema::create('product_has_x_e_s', function (Blueprint $table) {
            $table->id('productStoreId');
            $table->unsignedBigInteger('storeId')->nullable(false);
            $table->unsignedBigInteger('productId')->nullable(false);
            $table->integer('stock')->default(0)->nullable(false)->min(0)->max(1000);
            $table->timestamps(false);
            $table->foreign('storeId')->references('storeId')->on('stores')->onDelete('cascade');
            $table->foreign('productId')->references('productId')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_has_x_e_s');
    }
};
