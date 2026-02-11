<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Forensik Digital - #{{ $pec->report_id }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.6;
            margin: 25px;
        }

        /* Header */
        .header {
            text-align: center;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 12px;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 20px;
            margin: 0;
            color: #2c3e50;
            letter-spacing: 1px;
        }
        .header small {
            color: #555;
            font-size: 12px;
        }

        /* Section Title */
        .section-title {
            font-weight: bold;
            color: #2c3e50;
            margin-top: 25px;
            margin-bottom: 8px;
            font-size: 14px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 5px;
        }

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th {
            background: #f4f4f4;
            padding: 8px;
            text-align: left;
            border: 1px solid #ccc;
            width: 30%;
        }
        td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        /* Text Boxes */
        .box {
            background: #fafafa;
            border: 1px solid #ddd;
            padding: 10px;
            white-space: pre-wrap;
            margin-top: 5px;
        }

        /* Page Break for Attachments Page */
        .page-break {
            page-break-before: always;
        }

        /* Attachments Style */
        .attachment-section-title {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
            color: #2c3e50;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 6px;
        }

        .attachment-image {
            margin-bottom: 25px;
        }

        .attachment-image img {
            max-width: 450px;
            border: 1px solid #444;
            padding: 4px;
            background: #fff;
            display: block;
        }

        .attachment-file {
            background: #eee;
            border: 1px solid #ccc;
            padding: 6px;
            border-radius: 3px;
            font-size: 12px;
            margin-bottom: 8px;
            display: inline-block;
        }

        .footer-note {
            margin-top: 30px;
            font-size: 11px;
            color: #666;
            text-align: center;
            border-top: 1px solid #ccc;
            padding-top: 12px;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <h1>Laporan Forensik Digital</h1>
        <small>Nomor Laporan: #{{ $pec->report_id }}</small>
    </div>

    <!-- Informasi Pelapor -->
    <div class="section-title">Informasi Pelapor</div>
    <table>
        <tr><th>Nama</th><td>{{ $pec->is_anonymous ? 'Anonim' : $pec->reporter_name }}</td></tr>
        <tr><th>Email</th><td>{{ $pec->reporter_email ?? '-' }}</td></tr>
        <tr><th>Telepon</th><td>{{ $pec->reporter_phone ?? '-' }}</td></tr>
        <tr><th>Status Insiden</th><td>{{ $pec->status }}</td></tr>
        <tr><th>Tanggal Lapor</th><td>{{ $pec->created_at->format('d M Y H:i') }}</td></tr>
    </table>


    <!-- Preservation -->
    <div class="section-title">Preservation (Pelestarian Bukti)</div>
    <div class="box">{{ $pec->preservation_notes ?? 'Belum ada catatan.' }}</div>


    <!-- Collection -->
    <div class="section-title">Collection / Acquisition (Pengumpulan Bukti)</div>
    <div class="box">{{ $pec->collection_notes ?? 'Belum ada catatan.' }}</div>


    <!-- Examination -->
    <div class="section-title">Examination (Pemeriksaan Bukti)</div>
    <div class="box">{{ $pec->examination_notes ?? 'Belum ada catatan.' }}</div>


    <!-- Analisis -->
    <div class="section-title">Analisis & Rekomendasi</div>

    @if($pec->analysis_motif || $pec->analysis_impact || $pec->analysis_summary)
        <p><strong>Motif / Tujuan Pelaku:</strong></p>
        <div class="box">{{ $pec->analysis_motif }}</div>

        <p><strong>Dampak terhadap Korban:</strong></p>
        <div class="box">{{ $pec->analysis_impact }}</div>

        <p><strong>Ringkasan & Rekomendasi:</strong></p>
        <div class="box">{{ $pec->analysis_summary }}</div>
    @else
        <div class="box">Belum ada analisis dan rekomendasi.</div>
    @endif


    <!-- FOOTER FOR MAIN PAGE -->
    <div class="footer-note">
        Dokumen utama laporan forensik digital.
    </div>


    <!-- PAGE BREAK -->
    <div class="page-break"></div>


    <!-- ATTACHMENTS PAGE -->
    <div class="attachment-section-title">Lampiran Bukti</div>

    @php
        $attachments = json_decode($pec->attachments, true) ?? [];
    @endphp

    @forelse($attachments as $file)
        @php
            $path = storage_path('app/public/attachments/' . $file);
            if(file_exists($path)) {
                $mime = mime_content_type($path);
                $data = base64_encode(file_get_contents($path));
                $src = "data:{$mime};base64,{$data}";
            } else {
                $src = null;
            }
        @endphp

        @if($src && str_contains($mime, 'image'))
            <div class="attachment-image">
                <img src="{{ $src }}">
            </div>

        @else
            <div class="attachment-file">
                File: {{ $file }}
            </div>
        @endif

    @empty
        <p>Tidak ada lampiran bukti.</p>
    @endforelse


    <div class="footer-note">
        Semua lampiran merupakan salinan bukti digital yang disertakan oleh pelapor atau diperoleh saat investigasi.
    </div>

</body>
</html>
