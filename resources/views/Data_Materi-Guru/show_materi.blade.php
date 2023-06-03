@extends('layout.app')
@section('title', 'Tabel Materi/Mapel')
@section('content')
<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Materi Ajar</h6>
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
                        <th>ID Materi</th>
                        <th>Judul Materi</th>
                        <th>Deskripsi Materi</th>
                        <th>Gambar Materi</th>
                        <th>File Materi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materi as $materi)
                    <tr>
                        <td>{{ $materi->id_tmat }}</td>
                        <td>{{ $materi->judul_tmat }}</td>
                        <td>{{ $materi->desk_tmat }}</td>
                        <td><a href="{{ route('download_gambar', ['filename' => $materi->gmb_tmat]) }}">{{ $tugas->gmb_tmat }}</a></td>
                        <td><a href="{{ route('download_file', ['filename' => $materi->file_tmat]) }}">{{ $tugas->file_tmat }}</a></td>
                        <td>
                            <div class="button-container">
                                {{-- <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href = '#'">Lihat Materi</button> --}}
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
                                        <form action="{{ route('delete_materi', $materi->id_tmat) }}" method="POST" style="display: inline;">
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
        <form action="{{ route('tambah_materi', $data['id_tm']) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="judul_tmat">Judul Materi :</label>
                <input type="text" name="id_tm" class="form-control" value="{{ $data['id_tm'] }}" hidden>
                <input type="text" name="judul_tmat" class="form-control" value="{{ old('judul_tmat') }}" required>
                @error('judul_tmat')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="desk_tmat">Deskripsi :</label>
                <textarea name="desk_tmat" class="form-control" required>{{ old('desk_tmat') }}</textarea>
                @error('desk_tmat')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="gmb_tmat">Gambar Materi :</label>
                <input type="file" class="form-control-file" id="photo" name="gmb_tmat">
                @error('gmb_tmat')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="file_tmat">File Materi :</label>
                <input type="file" class="form-control-file" id="photo" name="file_tmat">
                @error('file_tmat')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

