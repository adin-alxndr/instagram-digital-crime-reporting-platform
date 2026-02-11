@extends('layouts.app')

@section('title', 'Ubah Status Insiden')

@section('content')
<div class="mb-4">
    <h2>Ubah Status Kasus #{{ $pec->report_id }}</h2>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('pec.updateStatus', $pec->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="status" class="form-label">Status Kasus</label>
                <select name="status" id="status" class="form-select">
                    @foreach(['Baru', 'Proses', 'Selesai', 'Ditolak'] as $status)
                        <option value="{{ $status }}" {{ $pec->status === $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('incidents.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
