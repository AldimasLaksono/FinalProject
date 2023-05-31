@extends('layout.app')
@section('title', 'Input Data Siswa')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data User Siswa</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form data user siswa</h6>
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
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">File Excel:</label>
                <input type="file" name="file" class="form-control-file" accept=".xlsx, .xls">
            </div>
            <button type="submit" class="btn btn-primary">Import</button>
        </form>
    </div>
    <div class="card-body">
        <form action="{{ route('inputData') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nis">NIS / No Induk Siswa:</label>
                <input type="number" name="nis" class="form-control" value="{{ old('nis') }}" placeholder="Contoh: 21416255201050" required>
                @error('nis')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_tc">ID_Class:</label>
                <input type="number" name="id_tc" class="form-control" value="{{ old('id_tc') }}" placeholder="Numeric" required>
                @error('id_tc')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name_mus">Nama Siswa:</label>
                <input type="text" name="name_mus" class="form-control" value="{{ old('name_mus') }}" required>
                @error('name_mus')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="ttl_mus">Tempat Tanggal Lahir:</label>
                <input type="text" name="ttl_mus" class="form-control" value="{{ old('ttl_mus') }}" placeholder="Tempat/dd/mm/yy" required>
                @error('ttl_mus')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="gender_mus">Jenis Kelamin:</label>
                <select name="gender_mus" class="form-control" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat_mus">Alamat:</label>
                <textarea name="alamat_mus" class="form-control" required>{{ old('alamat_mus') }}</textarea>
                @error('alamat_mus')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="notelp_mus">No.Telp Siswa:</label>
                <input type="number" name="notelp_mus" class="form-control" value="{{ old('notelp_mus') }}" required>
                @error('notelp_mus')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email_mus">Email Siswa:</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
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
                <label for="status_mus">Level User :</label>
                <select name="status_mus" class="form-control" value="active" required>
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


