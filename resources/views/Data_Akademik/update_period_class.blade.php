@extends('layout.app')
@section('title', 'Data Akademik')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Update Periode Class</h6>
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
        <form action="{{ route('updateData_perclass', ['id_tpc' => $perclass->id_tpc]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_mper">ID Periode</label>
                <input type="number" class="form-control" name="id_mper" value="{{ $perclass->id_mper }}" placeholder="numeric" required>
                @error('id_mper')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name_tpc">Name Periode Class</label>
                <input type="text" class="form-control" name="name_tpc" value="{{ $perclass->name_tpc }}" required>
                @error('name_tpc')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description_tpc">Description</label>
                <input type="text" class="form-control" name="description_tpc" value="{{ $perclass->description_tpc }}" required>
                @error('description_tpc')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary" name="submitButton">Submit</button>
            <button id="cancelButton" class="btn btn-danger" name="cancelButton">Batal Pembaruan</button>
        </form>
    </div>
</div> 
@endsection


