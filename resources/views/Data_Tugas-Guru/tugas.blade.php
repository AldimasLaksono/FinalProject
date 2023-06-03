@extends('layout.app')
@section('title', 'Tabel & Form Tugas')
@section('content')
<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Tugas</h6>
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
                        <th>ID Tugas</th>
                        <th>Class</th>
                        <th>Deskripsi Tugas</th>
                        <th>Gambar Tugas</th>
                        <th>File Tugas</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tugas as $tugas)
                    <tr>
                        <td>{{ $tugas->id_mt }}</td>
                        <td>{{ $tugas->name_tc }}</td>
                        <td>{{ $tugas->desk_tj }}</td>
                        <td><a href="{{ route('download.gambar', ['filename' => $tugas->gmb_tj]) }}">{{ $tugas->gmb_tj }}</a></td>
                        <td><a href="{{ route('download.gambar', ['filename' => $tugas->file_tj]) }}">{{ $tugas->file_tj }}</a></td>
                        <td>{{ $tugas->deadline_tt }}</td>
                        <td>{{ $tugas->status }}</td>

                        <td>
                            <div class="button-container">
                                <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href = '{{ route('detail_tugas', ['id_mt' => $tugas->id_mt]) }}'">Detail</button>
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
                                        <form action="{{ route('delete_tugas', $tugas->id_mt) }}" method="POST" style="display: inline;">
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
        <h6 class="m-0 font-weight-bold text-primary">Tambah Materi</h6>
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
        <form action="{{ route('create_tugas') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="ID Class">ID Class :</label>
                <input type="text" name="id_mut" class="form-control" value="{{ $data['id_mut'] }}" hidden>
                <input type="text" name="status" class="form-control" value="1" hidden>
                <input type="text" name="id_tc" class="form-control" value="{{ old('id_tc') }}" required>
                @error('id_tc')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="deadline_tt">Deadline :</label>
                <input type="text" name="deadline_tt" class="form-control" value="{{ old('deadline_tt') }}" required>
                @error('deadline_tt')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="desk_tj">Deskripsi :</label>
                <textarea name="desk_tj" class="form-control" required></textarea>
                @error('desk_tmat')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="gmb_tj">Gambar Tugas :</label>
                <input type="file" class="form-control-file" id="photo" name="gmb_tj">
                @error('gmb_tj')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="file_tj">File Tugas :</label>
                <input type="file" class="form-control-file" id="photo" name="file_tj">
                @error('file_tj')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

