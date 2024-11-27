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
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('color')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_color')->nullable();
            $table->boolean('Free')->default(false);
            $table->boolean('Standard')->default(false);
            $table->boolean('pro')->default(false);
            $table->boolean('premium')->default(false);
            $table->text('prompte')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
