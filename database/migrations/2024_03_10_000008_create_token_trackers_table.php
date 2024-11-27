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
        Schema::create('token_trackers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
                $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_tool');
                $table->foreign('id_tool')->references('id')->on('tools')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('current_words')->nullable();
            $table->integer('current_images')->nullable();
            $table->integer('current_minuts')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_trackers');
    }
};
