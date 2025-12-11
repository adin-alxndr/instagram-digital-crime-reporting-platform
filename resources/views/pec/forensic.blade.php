@extends('layouts.app')
@section('title', 'Tindakan Forensik PEC')
@section('content')

<h2>PEC Step-by-Step - Insiden #{{ $pec->report_id }}</h2>

@php
$steps = [
    'preservation' => [
        'label' => 'Preservation (Pelestarian Bukti)',
        'sub' => [
            'Simpan screenshot atau file bukti asli tanpa perubahan',
            'Catat metadata bukti: tanggal unggah, sumber, akun pelaku, tipe file',
            'Buat hash/checksum untuk setiap file agar bisa dibuktikan tidak diubah'
        ],
        'notes' => $pec->preservation_notes
    ],
    'collection' => [
        'label' => 'Collection / Acquisition (Pengumpulan Bukti)',
        'sub' => [
            'Kumpulkan info tambahan dari profil pelaku',
            'Ambil rekaman digital (screenshot, logs, chat history)',
            'Simpan bukti secara terstruktur di server/cloud aman'
        ],
        'notes' => $pec->collection_notes
    ],
    'examination' => [
        'label' => 'Examination (Pemeriksaan Bukti)',
        'sub' => [
            'Analisis konten bukti untuk tipe kejahatan',
            'Periksa konsistensi bukti dengan deskripsi pelapor',
            'Identifikasi pola atau hubungan dengan kasus serupa'
        ],
        'notes' => $pec->examination_notes
    ]
];
@endphp

@foreach($steps as $stepKey => $step)
<div class="card mt-3 mb-3">
    <div class="card-header"><strong>{{ $step['label'] }}</strong></div>
    <div class="card-body">
        <ol>
            @foreach($step['sub'] as $index => $desc)
                @php $subStepNum = $index + 1; @endphp
                <li>
                    {{ $desc }}

                    @php $field = $stepKey.'_step'.$subStepNum; @endphp

                    @if(!$pec->$field)
                    <form action="{{ route('pec.markPecSubStep', $pec->id) }}" method="POST" class="mt-1">
                        @csrf
                        <input type="hidden" name="step" value="{{ $stepKey }}">
                        <input type="hidden" name="sub_step" value="{{ $subStepNum }}">
                        <textarea name="notes" class="form-control mb-1" placeholder="Catatan admin"></textarea>
                        <button type="submit" class="btn btn-sm btn-primary">Sudah</button>
                    </form>
                    @else
                    <span class="badge bg-success">Sub-step selesai</span>
                    @endif
                </li>
            @endforeach
        </ol>

        @if($step['notes'])
        <pre>{{ $step['notes'] }}</pre>
        @endif
    </div>
</div>
@endforeach

<div class="card mb-3">
    <div class="card-header"><strong>Analisis & Rekomendasi</strong></div>
    <div class="card-body">
        @if($pec->preservation_step3 && $pec->collection_step3 && $pec->examination_step3)
            @if(!$pec->analysis_motif && !$pec->analysis_impact && !$pec->analysis_summary)
                <!-- Form Analisis baru -->
                <form action="{{ route('pec.saveAnalysis', $pec->id) }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label>Motif / Tujuan Pelaku</label>
                        <textarea name="motif" class="form-control" placeholder="Penipuan, pelecehan, pencurian identitas"></textarea>
                    </div>
                    <div class="mb-2">
                        <label>Evaluasi Dampak terhadap Korban</label>
                        <textarea name="impact" class="form-control" placeholder="Dampak terhadap korban"></textarea>
                    </div>
                    <div class="mb-2">
                        <label>Ringkasan & Rekomendasi Tindakan</label>
                        <textarea name="summary" class="form-control" placeholder="Rekomendasi tindakan"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Analisis & Rekomendasi</button>
                </form>
            @else
                <!-- Tampilkan hasil analisis -->
                <h5 class="mb-3 border-bottom pb-2">Hasil Analisis</h5>
                <p><strong>Motif / Tujuan:</strong></p>
                <p> {{ $pec->analysis_motif }}</p>
                <p><strong>Dampak:</strong></p>
                <p> {{ $pec->analysis_impact }}</p>
                <p><strong>Ringkasan & Rekomendasi:</strong></p>
                <p> {{ $pec->analysis_summary }}</p>

                <!-- Tombol edit -->
                <button class="btn btn-warning mt-2" onclick="document.getElementById('editAnalysisForm').style.display='block'; this.style.display='none'">
                    Edit Analisis
                </button>

                <!-- Form edit tersembunyi -->
                <div id="editAnalysisForm" style="display:none;" class="mt-3">
                    <form action="{{ route('pec.saveAnalysis', $pec->id) }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label>Motif / Tujuan Pelaku</label>
                            <textarea name="motif" class="form-control">{{ $pec->analysis_motif }}</textarea>
                        </div>
                        <div class="mb-2">
                            <label>Evaluasi Dampak terhadap Korban</label>
                            <textarea name="impact" class="form-control">{{ $pec->analysis_impact }}</textarea>
                        </div>
                        <div class="mb-2">
                            <label>Ringkasan & Rekomendasi Tindakan</label>
                            <textarea name="summary" class="form-control">{{ $pec->analysis_summary }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Analisis & Rekomendasi</button>
                        <button type="button" class="btn btn-secondary" onclick="document.getElementById('editAnalysisForm').style.display='none'; document.querySelector('.btn-warning').style.display='inline-block'">
                            Batal
                        </button>
                    </form>
                </div>
            @endif
        @else
            <span class="badge bg-secondary">Lengkapi semua PEC step dulu</span>
        @endif
    </div>
</div>

<div class="card mb-3">
    <div class="card-header"><strong>Lampiran Bukti Foto / Screenshot</strong></div>
    <div class="card-body">
        @php
            $attachments = json_decode($pec->attachments, true) ?? [];
            $allowedExtensions = ['jpg','jpeg','png','gif','bmp','webp'];
        @endphp

        <!-- Form Upload Lampiran -->
        @if($pec->analysis_motif && $pec->analysis_impact && $pec->analysis_summary)
            <form action="{{ route('pec.uploadAttachments', $pec->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label>Unggah Foto / Screenshot Bukti (Bisa lebih dari 1)</label>
                    <input type="file" id="attachments" name="attachments[]" class="form-control" multiple accept="image/*">
                </div>
                <!-- Preview -->
                <div id="preview" class="d-flex flex-wrap mb-2"></div>
                <button type="submit" class="btn btn-primary">Upload Lampiran</button>
            </form>
        @endif

        <!-- Daftar Lampiran Saat Ini -->
        @if(count($attachments) > 0)
            <h5 class="mt-3">Lampiran Saat Ini</h5>
            <div class="d-flex flex-wrap">
                @foreach($attachments as $file)
                    @php
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        $isImage = in_array($ext, $allowedExtensions);
                    @endphp
                    <div class="m-2 text-center">
                        @if($isImage)
                            <img src="{{ asset('uploads/'.$file) }}" alt="Lampiran" style="max-width:150px; max-height:150px; display:block; border:1px solid #ccc; margin-bottom:5px;">
                        @else
                            <span class="badge bg-secondary">File: {{ $file }}</span>
                        @endif
                        <div class="mt-1">
                            <form action="{{ route('pec.deleteAttachment', [$pec->id, $file]) }}" method="POST" onsubmit="return confirm('Hapus lampiran ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- JavaScript Preview -->
<script>
    document.getElementById('attachments').addEventListener('change', function(event) {
        const preview = document.getElementById('preview');
        preview.innerHTML = ''; // reset preview
        const files = event.target.files;
        const allowedExtensions = ['jpg','jpeg','png','gif','bmp','webp'];

        for(let i = 0; i < files.length; i++){
            const file = files[i];
            const ext = file.name.split('.').pop().toLowerCase();
            if(!allowedExtensions.includes(ext)){
                alert('Hanya file gambar yang diperbolehkan: ' + file.name);
                continue;
            }

            const reader = new FileReader();
            reader.onload = function(e){
                const div = document.createElement('div');
                div.style.margin = '5px';
                div.style.textAlign = 'center';
                div.innerHTML = `<img src="${e.target.result}" style="max-width:150px; max-height:150px; display:block; border:1px solid #ccc; margin-bottom:5px;"><span>${file.name}</span>`;
                preview.appendChild(div);
            }
            reader.readAsDataURL(file);
        }
    });
</script>

<a href="{{ route('pec.show', $pec->id) }}" class="btn btn-secondary">Kembali ke Detail Insiden</a>
<a href="{{ route('pec.generatePdf', $pec->id) }}" class="btn btn-success">
    Download Laporan PDF
</a>

@endsection
