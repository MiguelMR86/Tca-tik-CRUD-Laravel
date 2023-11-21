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
        Schema::create('products', function (Blueprint $table) {
            $table->id('productId');
            $table->string('name', 100)->nullable(false)->unique();
            $table->decimal('price', 10, 2)->nullable(false);
            $table->string('observations', 255)->nullable(false);
            $table->string('categoryId', 20)->nullable();
            $table->foreign('categoryId')->references('categoryId')->on('categories')->nullOnDelete()->onUpdate('cascade');
            $table->timestamps(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
 