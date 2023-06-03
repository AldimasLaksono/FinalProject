@extends('layout.app')
@section('title', 'Data Period')
@section('content')
<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Periodik Akademik</h6>
    </div>

    @if(session('cancelMessage'))
    <div id="cancelAlert" class="alert alert-info">
        {{ session('cancelMessage') }}
    </div>
@endif

@if(session('success'))
    <div id="successAlert" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    var cancelAlert = document.getElementById('cancelAlert');
    var successAlert = document.getElementById('successAlert');

    // Menghilangkan pesan setelah 5 detik
    setTimeout(function() {
        if (cancelAlert) {
            cancelAlert.style.display = 'none';
        }
        
        if (successAlert) {
            successAlert.style.display = 'none';
        }
    }, 5000);
});
</script>   

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>Deskripsi Jawaban</th>
                        <th>File</th>
                        <th>Nilai</th>
                        <th>Input Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jawab as $jawab)
                    <tr>
                        <td>{{ $jawab->name_mus }}</td>
                        <td>{{ $jawab->nis }}</td>
                        <td>{{ $jawab->desk_tj }}</td>
                        <td><><a href="{{ route('download.jawaban', ['filename' => $jawab->file_tj]) }}">{{ $jawab->file_tj }}</a></td>
                        <td>{{ $jawab->nilai_tn }}</td>
                        <td>
                            <form action="{{ route('input.nilai') }}" method="POST">
                                @method('POST')
                                @csrf
                                <div class="input-group mb-3">
                                    <button type="submit" class="btn btn-primary btn-sm">Input</button>
                                    <input type="text" name="id_tu" class="form-control" value="{{ $jawab->id_tu }}" hidden>
                                    <input type="text" name="nilai_tn" class="form-control" value="{{ old('nilai_tn') }}" required>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

