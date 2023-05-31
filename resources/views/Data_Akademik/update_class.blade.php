@extends('layout.app')
@section('title', 'Data Akademik')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Update Ploting Mata Pelajaran & Class</h6>
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
        <form action="{{ route('updateData_class', ['id_tc' => $class->id_tc]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_tpc">ID Class Periode</label>
                <input type="number" class="form-control" name="id_tpc" value="{{ $class->id_tc }}" placeholder="numeric" required>
                @error('id_tpc')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_mr">ID Ruangan</label>
                <input type="number" class="form-control" name="id_mr" value="{{ $class->id_mr }}" placeholder="numeric" required>
                @error('id_mr')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name_tc">Name Class</label>
                <input type="text" class="form-control" name="name_tc" value="{{ $class->name_tc }}" required>
                @error('name_tc')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary" name="submitButton">Submit</button>
            <button id="cancelButton" class="btn btn-danger" name="cancelButton">Batal Pembaruan</button>
        </form>
    </div>
</div> 
@endsection


