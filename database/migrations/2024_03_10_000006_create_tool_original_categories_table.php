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
        Schema::create('tool_original_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_categorie');
                $table->foreign('id_categorie')->references('id')->on('original_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_tool');
                $table->foreign('id_tool')->references('id')->on('tools')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_original_categories');
    }
};
