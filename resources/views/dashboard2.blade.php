@extends('layout.app')
@section('title', 'dashboard')
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">ini dashboard 2</h1>
            </div>

            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah Tugas Active</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeTeacher }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-fw fa-folder fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Annual) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Jumlah Tugas Non-Active</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $inactiveTeacher }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-fw fa-folder fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Class</th>
                                <th>Name Class</th>
                                <th>Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tClass as $data)
                            <tr>
                                <td>{{ $data->id_tc }}</td>
                                <td>{{ $data->name_tc }}</td>
                                <td>{{ $data->name_mr }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
<!-- End of Content Wrapper -->
@endsection