@extends('layouts.app')

@section('title', 'Proses Insiden')

@section('content')
<div class="mb-4">
    <h2>Proses Kasus #{{ $pec->pec_id }}</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('pec.updateProcess', $pec->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Status Insiden</label>
                <select name="status" class="form-select" required>
                    <option value="Baru" {{ $pec->status == 'Baru' ? 'selected' : '' }}>Baru</option>
                    <option value="Proses" {{ $pec->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Selesai" {{ $pec->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Ditolak" {{ $pec->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Catatan Admin</label>
                <textarea name="admin_notes" class="form-control" rows="5">{{ $pec->admin_notes ?? '' }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('pec.show', $pec->id) }}" class="btn btn-secondary">Kembali</a>

        </form>
    </div>
</div>
@endsection
