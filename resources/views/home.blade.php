@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4 d-sm-flex align-items-center justify-content-between">
            <h1 class="mb-0 text-gray-800 h3">Dashboard</h1>
            <a href="{{ route('admin.appointments.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> Új dőpont létrehozása</a>
        </div>

        <!-- Content Row -->
    </div>
    <div class="row">

        <div class="mb-4 col-xl-4 col-md-6">
            <div class="py-2 shadow card border-left-warning h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-warning text-uppercase">Összes időpont</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $allAppointments }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-calendar fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="mb-4 col-xl-4 col-md-6">
            <div class="py-2 shadow card border-left-primary h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-primary text-uppercase">Foglalt időpontok</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $reservedAppointments->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-calendar fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="mb-4 col-xl-4 col-md-6">
            <div class="py-2 shadow card border-left-success h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-success text-uppercase">Szabad időpont</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $freeAppointment }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-calendar fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
    </div>

    <div class="row">
    <div class="col-lg-12">

        <!-- Page Heading -->
        <h1 class="mb-2 text-gray-800 h3">Jelentkezők</h1>

        <!-- DataTales Example -->
        <div class="mb-4 shadow card">
            <div class="py-3 card-header">
                <h6 class="m-0 font-weight-bold text-primary">Online konzultációra jelentkezők</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Időpont</th>
                                <th>Név</th>
                                <th>Email</th>
                                <th>Telefonszám</th>
                                <th>Megjegyzés</th>
                                <th>Jelentkezés időpontja</th>
                            </tr>
                        </thead>
                        {{--<tfoot>--}}
                            {{--<tr>--}}
                                {{--<th>Name</th>--}}
                                {{--<th>Position</th>--}}
                                {{--<th>Office</th>--}}
                                {{--<th>Age</th>--}}
                                {{--<th>Start date</th>--}}
                                {{--<th>Salary</th>--}}
                            {{--</tr>--}}
                        {{--</tfoot>--}}
                        <tbody>
                            @forelse($reservedAppointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->appointment }}</td>
                                    <td>{{ $appointment->applicant->name }}</td>
                                    <td>{{ $appointment->applicant->email }}</td>
                                    <td>{{ $appointment->applicant->phone }}</td>
                                    <td>{{ $appointment->applicant->comment }}</td>
                                    <td>{{ $appointment->applicant->created_at }}</td>
                                </tr>
                            @empty
                                Nincs Jelentkező
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
