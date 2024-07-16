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
        Schema::create('hotel_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('locale');
            $table->integer('hotel_id')->unsigned();
            $table->unique(['locale','hotel_id']);

            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_translations');
    }
};
