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
        Schema::create('products_models', function (Blueprint $table) {
            $table->bigIncrements('id',255);
            $table->string("product_id", 255)->uniqid();
            $table->string("user_id", 255);
            $table->string("type", 255);
            $table ->float("price");
            $table->string("description", 255);
            $table->string("picture", 255);
            $table->date("expiry_date");
            $table->date("ftm_date");
            $table->boolean('expired');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_models');
    }
};
