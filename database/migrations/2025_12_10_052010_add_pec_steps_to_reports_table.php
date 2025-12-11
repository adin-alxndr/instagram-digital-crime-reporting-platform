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
        Schema::table('reports', function (Blueprint $table) {
            // Status & catatan admin (jika belum ada)
            $table->string('status')->default('Baru')->after('is_anonymous');
            $table->text('admin_notes')->nullable()->after('status');

            // Preservation sub-step
            $table->boolean('preservation_step1')->default(false)->after('admin_notes');
            $table->boolean('preservation_step2')->default(false);
            $table->boolean('preservation_step3')->default(false);
            $table->text('preservation_notes')->nullable();

            // Collection sub-step
            $table->boolean('collection_step1')->default(false);
            $table->boolean('collection_step2')->default(false);
            $table->boolean('collection_step3')->default(false);
            $table->text('collection_notes')->nullable();

            // Examination sub-step
            $table->boolean('examination_step1')->default(false);
            $table->boolean('examination_step2')->default(false);
            $table->boolean('examination_step3')->default(false);
            $table->text('examination_notes')->nullable();

            // Analysis sub-step
            $table->text('analysis_motif')->nullable();
            $table->text('analysis_impact')->nullable();
            $table->text('analysis_summary')->nullable();

            // Lampiran bukti (foto / screenshot)
            $table->json('attachments')->nullable()->after('analysis_summary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            //
        });
    }
};
