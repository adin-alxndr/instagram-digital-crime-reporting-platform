<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportSeeder extends Seeder
{
    public function run()
    {
        DB::table('reports')->insert([
            [
                'report_id' => 'RPT-' . strtoupper(Str::random(8)),
                'crime_type' => 'cyberbullying',
                'suspect_username' => 'toxic_user01',
                'suspect_profile_url' => 'https://instagram.com/toxic_user01',
                'description' => 'Pelaku melakukan pelecehan verbal melalui komentar dan DM secara berulang.',
                'evidence_type' => 'screenshot',
                'evidence_file' => 'dummy/screenshot1.jpg',
                'reporter_name' => 'Andi Pratama',
                'reporter_email' => 'andi@mail.com',
                'reporter_phone' => '+6281234567890',
                'is_anonymous' => false,
                'agree' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'report_id' => 'RPT-' . strtoupper(Str::random(8)),
                'crime_type' => 'fraud',
                'suspect_username' => 'scammer_id',
                'suspect_profile_url' => 'https://instagram.com/scammer_id',
                'description' => 'Penipuan jual beli online, korban diminta transfer namun barang tidak dikirim.',
                'evidence_type' => 'photo',
                'evidence_file' => 'dummy/photo2.jpg',
                'reporter_name' => null,
                'reporter_email' => null,
                'reporter_phone' => null,
                'is_anonymous' => true,
                'agree' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'report_id' => 'RPT-' . strtoupper(Str::random(8)),
                'crime_type' => 'identity_theft',
                'suspect_username' => 'fake_account99',
                'suspect_profile_url' => null,
                'description' => 'Akun pelaku meniru identitas korban dan menggunakan foto tanpa izin.',
                'evidence_type' => 'screenshot',
                'evidence_file' => 'dummy/screenshot3.jpg',
                'reporter_name' => 'Siti Aisyah',
                'reporter_email' => 'siti@mail.com',
                'reporter_phone' => null,
                'is_anonymous' => false,
                'agree' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
