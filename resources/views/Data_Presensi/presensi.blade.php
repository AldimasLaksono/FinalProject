@extends('layout.app')
@section('title', 'Activity Log')
@section('content')
<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Log Presensi</h6>
    </div>  

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID User Siswa</th>
                        <th>Name Siswa</th>
                        <th>Status</th>
                        <th>latitude</th>
                        <th>longitude</th>
                        <th>Created At</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($presensi as $presensi)
                    <tr>
                        <td>{{ $presensi->id_mus }}</td>
                        <td>{{ $presensi->name_mus }}</td>
                        <td>{{ $presensi->status }}</td>
                        <td>{{ $presensi->latitude }}</td>
                        <td>{{ $presensi->longitude }}</td>
                        <td>{{ $presensi->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

