<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_id')->unique();
            $table->string('crime_type');
            $table->string('suspect_username');
            $table->string('suspect_profile_url')->nullable();
            $table->text('description');
            $table->string('evidence_type');
            $table->string('evidence_file'); // file name disimpan
            $table->string('reporter_name')->nullable();
            $table->string('reporter_email')->nullable();
            $table->string('reporter_phone')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->boolean('agree')->default(false);
            $table->timestamps();
        });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
