@extends('layout.app')
@section('title', 'Data Guru')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data User Guru</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Update data user guru</h6>
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
        <form action="{{ route('updateData_guru', ['id_mut' => $userTeacher->id_mut]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_mja">ID Jabatan :</label>
                <input type="number" name="id_mja" class="form-control" value="{{ $userTeacher->id_mja }}" required>
                @error('id_mja')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nis">NIP / No Induk Pegawai:</label>
                <input type="number" name="nip" class="form-control" value="{{ $userTeacher->nip }}" required>
                @error('nip')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name_mut">Nama Guru:</label>
                <input type="text" name="name_mut" class="form-control" value="{{ $userTeacher->name_mut }}" required>
                @error('name_mut')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="ttl_mut">Tempat Tanggal Lahir:</label>
                <input type="text" name="ttl_mut" class="form-control" value="{{ $userTeacher->ttl_mut }}" required>
                @error('ttl_mut')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="gender_mut">Jenis Kelamin:</label>
                <select name="gender_mut" class="form-control" required>
                    <option value="{{$userTeacher->gender_mut}}">{{$userTeacher->gender_mut}}</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat_mut">Alamat:</label>
                <textarea name="alamat_mut" class="form-control" required>{{ $userTeacher->alamat_mut }}</textarea>
                @error('alamat_mut')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="notelp_mut">No.Telp Guru:</label>
                <input type="number" name="notelp_mut" class="form-control" value="{{ $userTeacher->notelp_mut }}" required>
                @error('notelp_mut')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email_mut">Email Guru:</label>
                <input type="email" name="email" class="form-control" value="{{ $userTeacher->email }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status_mut">Status Pegawai :</label>
                <select name="status_mut" class="form-control" required>
                    <option value="{{$userTeacher->status_mut}}">{{$userTeacher->status_mut}}</option>
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
                    <option value="{{$userTeacher->role_mut}}">{{$userTeacher->role_mut}}</option>
                    <option value="admin">Administrator</option>
                    <option value="guru">Guru</option>
                </select>
                @error('role_mut')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" name="password" class="form-control" value="{{ $userTeacher->password }}">
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
            
            <button type="submit" class="btn btn-primary" name="submitButton">Submit</button>
            <button id="cancelButton" class="btn btn-danger" name="cancelButton">Batal Pembaruan</button>
        </form>
    </div>
</div> 
@endsection


