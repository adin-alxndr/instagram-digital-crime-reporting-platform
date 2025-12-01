<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('incident_id')->unique();
            $table->string('victim_name');
            $table->string('victim_contact');
            $table->string('case_type');
            $table->dateTime('incident_date');
            $table->string('location')->nullable();
            $table->longText('summary');
            $table->string('reporter');
            $table->enum('status', [
                'Reported', 
                'Triage', 
                'In Investigation', 
                'Resolved', 
                'Closed'
            ])->default('Reported');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
