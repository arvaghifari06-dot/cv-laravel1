<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('skill', function (Blueprint $table) {
            $table->id();
            $table->string('nama_skill', 100);
            $table->string('tingkat', 20);
            $table->unsignedTinyInteger('nilai')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skill');
    }
};
