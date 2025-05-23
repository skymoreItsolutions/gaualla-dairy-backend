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
           
            $table->id();
            $table->string('name');
            $table->json('images')->nullable(); 
            $table->integer('quantity');
            $table->string('quantity_type'); 
            $table->decimal('price', 10, 2);
            $table->string('type'); 
           
            $table->boolean('status')->default(true);
            $table->float('rating')->default(0); 
            $table->timestamps();
           
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
