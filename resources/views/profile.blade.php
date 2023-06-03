@extends('layout.app')
@section('title', 'profile')
<style>
    .profile-container {
        display: flex;
        align-items: center;
    }

    .profile-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 20px;
    }

    .profile-details {
        font-size: 18px;
    }
</style>
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    @if(session('error'))
        <div id="errorAlert" class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div id="successAlert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var errorAlert = document.getElementById('errorAlert');
        var successAlert = document.getElementById('successAlert');

        // Menghilangkan pesan setelah 5 detik
        setTimeout(function() {
            if (errorAlert) {
                errorAlert.style.display = 'none';
            }
            
            if (successAlert) {
                successAlert.style.display = 'none';
            }
        }, 5000);
    });
    </script>

    <!-- Main Content -->
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Content Row -->
            <div class="row">

                <!-- Grow In Utility -->
                <div class="col-lg-6">

                    <div class="card position-relative border-left-primary">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Profile User</h6>
                        </div>
                        <div class="card-body ">
                            <div class="profile-container">
                                <img class="profile-image" src="{{ asset('path_ke_foto/' . $data['foto_mut']) }}" alt="Foto Profil">
                                <div class="profile-details">
                                    <h2>{{ $data['name_mut'] }}</h2>
                                    <p>Email: {{ $data['email'] }}</p>
                                    <p>Alamat: {{ $data['alamat_mut'] }}</p>
                                    <!-- Tambahkan informasi profil pengguna lainnya -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="foto-container">
                                <form action="{{ route('update_photo') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                      <label for="photo">Foto Profil</label>
                                      <input type="file" class="form-control-file" id="photo" name="photo">
                                      @error('photo')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Upload</button>
                                  </form>
                            </div>
                        </div>
                    </div>

                    <div>
                        <br>
                    </div>

                    <div class="card position-relative border-left-primary">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edite Password</h6>
                        </div>
                        <div class="card-body">
                            <div class="password-container">
                                <form action="{{ route('updatePassword') }}" method="POST">
                                    @csrf
                                    <div class="form-group input-group-sm mb-3">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" name="current_password" class="form-control" required>
                                        @error('current_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group input-group-sm mb-3">
                                        <label for="password">New Password</label>
                                        <input type="password" name="new_password" class="form-control" required>
                                        @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group input-group-sm mb-3">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control" required>
                                        @error('confirm_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Fade In Utility -->
                <div class="col-lg-6">

                    <div class="card position-relative border-left-primary">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Biodata User</h6>
                        </div>
                        <div class="card-body">
                            <div class="password-container">
                                <form action="{{ route('update_guru') }}" method="POST">
                                    @csrf
                                    <div class="form-group input-group-sm mb-3">
                                        <label for="nip">NIP/No Induk Pegawai :</label>
                                        <input type="nip" name="nip" value="{{ $data['nip']}}" class="form-control" readonly>
                                        @error('nip')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group input-group-sm mb-3">
                                        <label for="jabatan">Jabatan :</label>
                                        <input type="text" class="form-control" value="{{ $data['name_mja'] }}" readonly>
                                        <input type="text" name="id_mja" value="{{ $data['id_mja']}}" class="form-control" hidden>
                                    </div>
                                    <div class="form-group input-group-sm mb-3">
                                        <label for="name_mut">Name :</label>
                                        <input type="text" name="name_mut" class="form-control" value="{{ $data['name_mut'] }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group input-group-sm mb-3">
                                        <label for="email">Email :</label>
                                        <input type="text" name="email" class="form-control" value="{{ $data['email'] }}" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group input-group-sm mb-3">
                                        <label for="notelp_mut">No Telpn :</label>
                                        <input type="numeric" name="notelp_mut" class="form-control" value="{{ $data['notelp_mut'] }}" required>
                                        @error('notelp_mut')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group input-group-sm mb-3">
                                        <label for="status_mut">Status Pegawai :</label>
                                        <input type="text" name="status_mut" value="{{ $data['status_mut']}}" class="form-control" readonly>
                                        <input type="text" name="password" value="{{ $data['password']}}" class="form-control" hidden>
                                        <input type="text" name="role_mut" value="{{ $data['role_mut']}}" class="form-control" hidden>
                                        <input type="text" name="status" value="{{ $data['status']}}" class="form-control" hidden>
                                        @error('status_mut')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group input-group-sm mb-3">
                                        <label for="gender_mut">Jenis Kelamin:</label>
                                        <select name="gender_mut" class="form-control" required>
                                            <option value="{{ $data['gender_mut'] }}">{{ $data['gender_mut'] }}</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group input-group-sm mb-3">
                                        <label for="ttl_mut">Tempat/tgl. lahir :</label>
                                        <input type="text" name="ttl_mut" class="form-control" value="{{ $data['ttl_mut'] }}" required>
                                        @error('ttl_mut')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat_mut">Alamat:</label>
                                        <textarea name="alamat_mut" class="form-control" required>{{ $data['alamat_mut'] }}</textarea>
                                        @error('alamat_mut')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
</div>
<!-- End of Content Wrapper -->
@endsection