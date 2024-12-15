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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->text('description');
            $table->enum('type', ['kejahatan', 'pembangunan', 'sosial']);
            $table->string('province');
            $table->string('regency');
            $table->string('subdistrict');
            $table->string('village');
            $table->json('voting')->nullable();
            $table->integer('viewers')->default(0);
            $table->string('image');
            $table->boolean('statement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};