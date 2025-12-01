<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evidence', function (Blueprint $table) {
            $table->id();
            $table->string('evidence_id')->unique();
            $table->string('name');
            $table->string('type');
            $table->unsignedBigInteger('incident_id');
            $table->longText('description')->nullable();
            $table->string('hash')->nullable();
            $table->string('physical_location')->nullable();
            $table->string('acquired_by');
            $table->dateTime('acquired_at');
            $table->timestamps();
            
            $table->foreign('incident_id')
                  ->references('id')
                  ->on('incidents')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evidence');
    }
};
