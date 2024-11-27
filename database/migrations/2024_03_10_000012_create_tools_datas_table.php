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
        Schema::create('tools_datas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
                $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_tool');
                $table->foreign('id_tool')->references('id')->on('tools')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('language')->nullable();
            $table->string('type_data')->nullable();
            $table->string('image_path')->nullable();
            $table->string('voice_path')->nullable();
            $table->longText('text_content')->nullable();
            $table->longText('htmlContent')->nullable();
            $table->string('Gender')->nullable();
            $table->string('Description')->nullable();
            $table->string('VoiceName')->nullable();
            $table->integer('chars')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools_datas');
    }
};
