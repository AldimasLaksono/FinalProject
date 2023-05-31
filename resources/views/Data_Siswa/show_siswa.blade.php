@extends('layout.app')
@section('title', 'Data Siswa')
@section('content')
<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data User Siswa</h6>
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
                        <th>NIS</th>
                        <th>Class</th>
                        <th>Name</th>
                        <th>TTL</th>
                        <th>Gender</th>
                        <th>Alamat</th>
                        <th>No.Telp</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userStudent as $userStudent)
                    <tr>
                        <td>{{ $userStudent->nis }}</td>
                        <td>{{ $userStudent->name_tc }}</td>
                        <td>{{ $userStudent->name_mus }}</td>
                        <td>{{ $userStudent->ttl_mus }}</td>
                        <td>{{ $userStudent->gender_mus }}</td>
                        <td>{{ $userStudent->alamat_mus }}</td>
                        <td>{{ $userStudent->notelp_mus }}</td>
                        <td>{{ $userStudent->email }}</td>
                        <td>{{ $userStudent->status_mus }}</td>
                        <td>
                            <div style="display: flex; justify-content: space-between;">
                                <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href = '{{ route('updateform', ['id_mus' => $userStudent->id_mus]) }}'">Update</button>
                                {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{ $userStudent->id_mus }}">Hapus</button> --}}
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">Hapus</button>
                            </div>  
                        </td>
                        <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                    </tr>
                    <!-- Modal Hapus -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus data ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <form action="{{ route('deleteData', ['id_mus' => $userStudent->id_mus]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

