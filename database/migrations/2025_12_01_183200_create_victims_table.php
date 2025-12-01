<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('victims', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('organization')->nullable();
            $table->string('contact');
            $table->enum('role', ['User', 'Employee', 'Customer'])->default('User');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('victims');
    }
};
