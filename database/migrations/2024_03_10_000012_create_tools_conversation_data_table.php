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
        Schema::create('tools_conversation_datas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_conversation');
                $table->foreign('id_conversation')->references('id')->on('tools_conversations')->onUpdate('cascade')->onDelete('cascade');
            $table->string('side')->nullable();
            $table->longText('text_content')->nullable();
            $table->longText('image_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools_conversation_datas');
    }
};
