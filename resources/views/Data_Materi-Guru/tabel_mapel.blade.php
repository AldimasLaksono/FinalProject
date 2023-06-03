@extends('layout.app')
@section('title', 'Tabel Mapel')
@section('content')
<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Mata Pelajaran Yang Diampu</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Mapel</th>
                        <th>Nama Mapel</th>
                        <th>Class periode</th>
                        <th>Periode</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mapel as $mapel)
                    <tr>
                        <td>{{ $mapel->id_tm }}</td>
                        <td>{{ $mapel->kode_mm_tm }}</td>
                        <td>{{ $mapel->name_tpc }}</td>
                        <td>{{ $mapel->name_mper }}</td>
                        <td>
                            <div class="button-container">
                                <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href = '{{ route('show_materi', $mapel->id_tm) }}'">Lihat Materi</button>
                            </div>  
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

