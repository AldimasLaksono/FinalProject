@extends('layout.app')
@section('title', 'Input Data Guru')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data User Guru</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form data user guru</h6>
    </div>
    @if(session('success'))
        <div id="successAlert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var successAlert = document.getElementById('successAlert');

        // Menghilangkan pesan setelah 5 detik
        setTimeout(function() {
            if (successAlert) {
                successAlert.style.display = 'none';
            }
        }, 5000);
    });
    </script> 

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-header py-3">
        <form action="{{ route('importGuru') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">File Excel:</label>
                <input type="file" name="file" class="form-control-file" accept=".xlsx, .xls">
            </div>
            <button type="submit" class="btn btn-primary">Import</button>
        </form>
    </div>
    <div class="card-body">
        <form action="{{ route('inputGuru') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_mja">ID Jabatan :</label>
                <input type="number" name="id_mja" class="form-control" value="{{ old('id_mja') }}" placeholder="Contoh: 1" required>
                @error('id_mja')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nip">NIP / No Induk Pegawai:</label>
                <input type="number" name="nip" class="form-control" value="{{ old('nip') }}" placeholder="Contoh: 21416255201050" required>
                @error('nip')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name_mut">Nama Guru:</label>
                <input type="text" name="name_mut" class="form-control" value="{{ old('name_mut') }}" required>
                @error('name_mut')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="ttl_mut">Tempat Tanggal Lahir:</label>
                <input type="text" name="ttl_mut" class="form-control" value="{{ old('ttl_mut') }}" placeholder="Tempat/dd/mm/yy" required>
                @error('ttl_mut')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="gender_mut">Jenis Kelamin:</label>
                <select name="gender_mut" class="form-control" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat_mut">Alamat:</label>
                <textarea name="alamat_mut" class="form-control" required>{{ old('alamat_mut') }}</textarea>
                @error('alamat_mut')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="notelp_mut">No.Telp Guru:</label>
                <input type="number" name="notelp_mut" class="form-control" value="{{ old('notelp_mut') }}" required>
                @error('notelp_mut')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email_mut">Email Guru:</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status_mut">Status Pegawai :</label>
                <select name="status_mut" class="form-control" required>
                    <option value="">Pilih Status Pegawai</option>
                    <option value="tetap">Pegawai tetap</option>
                    <option value="honorer">Tenaga Honorer</option>
                </select>
                @error('status_mut')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="role_mut">Level User :</label>
                <select name="role_mut" class="form-control" required>
                    <option value="">Pilih Level user</option>
                    <option value="admin">Administrator</option>
                    <option value="guru">Guru</option>
                </select>
                @error('role_mut')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" name="password" class="form-control" value="{{ old('password') }}" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Level User :</label>
                <select name="status" class="form-control" value="active" required>
                    <option value="active">Active</option>
                    <option value="deactive">Deactive</option>
                </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div> 
@endsection


