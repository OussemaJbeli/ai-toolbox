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
        Schema::create('tools_feilds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tool');
                $table->foreign('id_tool')->references('id')->on('tools')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools_feilds');
    }
};
