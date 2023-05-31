@extends('layout.app')
@section('title', 'Data Mapel')
@section('content')
<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Mata Pelajaran</h6>
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
                        <th>ID T Mapel</th>
                        <th>Kode Mapel</th>
                        <th>Mapel</th>
                        <th>Nama Guru</th>
                        <th>Class Periode</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datatm as $datatm)
                    <tr>
                        <td>{{ $datatm->id_tm }}</td>
                        <td>{{ $datatm->kode_mm_tm }}</td>
                        <td>{{ $datatm->name_mm }}</td>
                        <td>{{ $datatm->name_mut }}</td>
                        <td>{{ $datatm->name_tpc }}</td>
                        <td>
                            <div class="button-container">
                                <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href = '{{ route('updateform_plotmap', ['id_tm' => $datatm->id_tm]) }}'">Update</button>
                                <button type="button" class="btn btn-danger btn-sm btn-hapus" data-toggle="modal" data-target="#deleteModal">Hapus</button>
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
                                        <form action="{{ route('delete_datatm', ['id_tm' => $datatm->id_tm]) }}" method="POST" style="display: inline;">
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

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ploting Mata Pelajaran</h6>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-body">
        <form action="{{ route('input_datatm') }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-4">
                <label for="id_tpc">ID Class Periode</label>
                <input type="number" class="form-control" name="id_tpc" value="{{ old('id_tpc') }}" placeholder="numeric" required>
                @error('id_tpc')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="id_mm">ID Mata Pelajaran</label>
                <input type="number" class="form-control" name="id_mm" value="{{ old('id_mm') }}" placeholder="numeric" required>
                @error('id_mm')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="id_mut">ID Guru</label>
                <input type="number" class="form-control" name="id_mut" value="{{ old('id_mut') }}" placeholder="numeric" required>
                @error('id_mut')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="kode_mm_tm">Kode Mata Pelajaran</label>
                <input type="text" class="form-control" name="kode_mm_tm" value="{{ old('kode_mm_tm') }}" required>
                @error('kode_mm_tm')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="col-12" style="margin-top: 10px;">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
        </form>
    </div>
</div>
@endsection

