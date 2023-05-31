@extends('layout.app')
@section('title', 'Data Mapel')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Update data mapel</h6>
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
        <form action="{{ route('updateData_plotmap', ['id_tm' => $datatm->id_tm]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_tpc">ID Class Periode</label>
                <input type="number" class="form-control" name="id_tpc" value="{{ $datatm->id_tpc }}" placeholder="numeric" required>
                @error('id_tpc')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_mm">ID Mata Pelajaran</label>
                <input type="number" class="form-control" name="id_mm" value="{{ $datatm->id_mm }}" placeholder="numeric" required>
                @error('id_mm')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_mut">ID Guru</label>
                <input type="number" class="form-control" name="id_mut" value="{{ $datatm->id_mut }}" placeholder="numeric" required>
                @error('id_mut')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="kode_mm_tm">Kode Mata Pelajaran</label>
                <input type="text" class="form-control" name="kode_mm_tm" value="{{ $datatm->kode_mm_tm }}" required>
                @error('kode_mm_tm')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary" name="submitButton">Submit</button>
            <button id="cancelButton" class="btn btn-danger" name="cancelButton">Batal Pembaruan</button>
        </form>
    </div>
</div> 
@endsection


