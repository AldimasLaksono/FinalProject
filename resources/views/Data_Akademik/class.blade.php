@extends('layout.app')
@section('title', 'Data Akademik')
@section('content')
<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ploting Mata Pelajaran & Class</h6>
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
                        <th>ID Class</th>
                        <th>Class Periode</th>
                        <th>Ruangan</th>
                        <th>Class</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($class as $class)
                    <tr>
                        <td>{{ $class->id_tc }}</td>
                        <td>{{ $class->name_tpc }}</td>
                        <td>{{ $class->name_mr }}</td>
                        <td>{{ $class->name_tc }}</td>
                        <td>
                            <div class="button-container">
                                <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href = '{{ route('updateform_class', ['id_tc' => $class->id_tc]) }}'">Update</button>
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
                                        <form action="{{ route('delete_class', ['id_tc' => $class->id_tc]) }}" method="POST" style="display: inline;">
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
        <h6 class="m-0 font-weight-bold text-primary">Ploting Class & Mapel</h6>
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
        <form action="{{ route('input_class') }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-4">
                <label for="id_tpc">ID Class Periode</label>
                <input type="number" class="form-control" name="id_tpc" value="{{ old('id_tpc') }}" placeholder="numeric" required>
                @error('id_tpc')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="id_mr">ID Ruangan</label>
                <input type="number" class="form-control" name="id_mr" value="{{ old('id_mr') }}" placeholder="numeric" required>
                @error('id_mr')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="name_tc">Name Class</label>
                <input type="text" class="form-control" name="name_tc" value="{{ old('name_tc') }}" required>
                @error('name_tc')
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

