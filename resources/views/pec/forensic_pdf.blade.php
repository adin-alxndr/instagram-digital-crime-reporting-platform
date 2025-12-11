<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Forensic Report #{{ $pec->report_id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; line-height: 1.4; color: #333; }
        h2, h3 { color: #2c3e50; margin-bottom: 5px; }
        h2 { border-bottom: 2px solid #2c3e50; padding-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        pre { background: #f9f9f9; padding: 10px; border: 1px solid #ddd; white-space: pre-wrap; }
        .section { margin-bottom: 20px; }
        .badge { display: inline-block; padding: 3px 6px; background: #2ecc71; color: #fff; border-radius: 4px; font-size: 11px; }
        .photo { max-width: 250px; max-height: 250px; margin-top: 5px; border: 1px solid #ccc; display:block; }
        .attachment { margin-bottom: 10px; }
    </style>
</head>
<body>

<h2>Forensic Report #{{ $pec->report_id }}</h2>

<div class="section">
    <h3>Informasi Pelapor</h3>
    <table>
        <tr><th>Nama</th><td>{{ $pec->is_anonymous ? 'Anonim' : $pec->reporter_name }}</td></tr>
        <tr><th>Email</th><td>{{ $pec->reporter_email ?? '-' }}</td></tr>
        <tr><th>Telepon</th><td>{{ $pec->reporter_phone ?? '-' }}</td></tr>
        <tr><th>Status Insiden</th><td>{{ $pec->status }}</td></tr>
        <tr><th>Tanggal Lapor</th><td>{{ $pec->created_at->format('d M Y H:i') }}</td></tr>
    </table>
</div>

<div class="section">
    <h3>Preservation (Pelestarian Bukti)</h3>
    <pre>{{ $pec->preservation_notes ?? 'Belum ada catatan' }}</pre>
</div>

<div class="section">
    <h3>Collection / Acquisition (Pengumpulan Bukti)</h3>
    <pre>{{ $pec->collection_notes ?? 'Belum ada catatan' }}</pre>
</div>

<div class="section">
    <h3>Examination (Pemeriksaan Bukti)</h3>
    <pre>{{ $pec->examination_notes ?? 'Belum ada catatan' }}</pre>
</div>

<div class="section">
    <h3>Analisis & Rekomendasi</h3>
    @if($pec->analysis_motif || $pec->analysis_impact || $pec->analysis_summary)
        <p><strong>Motif / Tujuan Pelaku:</strong> {{ $pec->analysis_motif }}</p>
        <p><strong>Dampak terhadap Korban:</strong> {{ $pec->analysis_impact }}</p>
        <p><strong>Ringkasan & Rekomendasi:</strong> {{ $pec->analysis_summary }}</p>
    @else
        <p>Belum ada analisis & rekomendasi.</p>
    @endif
</div>

@php
$attachments = json_decode($pec->attachments, true) ?? [];
$validImages = [];
$otherFiles = [];

foreach ($attachments as $file) {
    $path = public_path('uploads/'.$file);
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg','jpeg','png','gif','bmp'])) {
        $validImages[] = $file;
    } else {
        $otherFiles[] = $file;
    }
}
@endphp

@if(!empty($validImages) || !empty($otherFiles))
<div class="section">
    <h3>Lampiran Bukti (Screenshot / Foto / File)</h3>

    {{-- Gambar --}}
    @foreach($validImages as $file)
        @php
            if(file_exists($path)){
                $mime = mime_content_type($path); // otomatis dapat MIME
                $data = base64_encode(file_get_contents($path));
                $src = "data:{$mime};base64,{$data}";
            }
            $path = public_path('uploads/'.$file);
        @endphp
        @if(isset($src))
            <div class="attachment">
                <img src="{{ $src }}" class="photo">
                <p>{{ $file }}</p>
            </div>
        @endif
    @endforeach

    {{-- File Non-Gambar --}}
    @foreach($otherFiles as $file)
        <div class="attachment">
            <span class="badge bg-secondary">File: {{ $file }}</span>
        </div>
    @endforeach
</div>
@endif

<div class="section">
    <h3>Dokumentasi Lainnya</h3>
    <p>File bukti, metadata, dan catatan tambahan disimpan untuk arsip digital forensic.</p>
</div>

</body>
</html>
