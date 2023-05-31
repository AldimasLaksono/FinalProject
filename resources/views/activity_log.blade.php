@extends('layout.app')
@section('title', 'Activity Log')
@section('content')
<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Activity Log</h6>
    </div>  

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>Action</th>
                        <th>Useraccesss</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Module</th>
                        <th>Action</th>
                        <th>Useraccesss</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($dataLog as $dataLog)
                    <tr>
                        <td>{{ $dataLog->module }}</td>
                        <td>{{ $dataLog->action }}</td>
                        <td>{{ $dataLog->useraccess }}</td>
                        <td>{{ $dataLog->created_at }}</td>
                        <td>{{ $dataLog->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

