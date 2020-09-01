@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <!-- Page Heading -->
        <h1 class="mb-2 text-gray-800 h3">Időpontok</h1>

        <!-- DataTales Example -->
        <div class="mb-4 shadow card">
            {{--<div class="py-3 card-header">--}}
                {{--<h6 class="m-0 font-weight-bold text-primary">Online konzultációra jelentkezők</h6>--}}
            {{--</div>--}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Vizsgálat típusa</th>
                                <th>Vizsgáló orvos neve</th>
                                <th>Időpont</th>
                                <th>Páciens neve</th>
                                <th>Páciens taj-száma</th>
                                <th>Páciens email címe</th>
                                <th>Páciens telefonszáma</th>
                                <th>Adatok</th>
                                <th>Törlés</th>
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
                            @forelse($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->medicalExamination->name }}</td>
                                    <td>{{ $appointment->consultation->user->name }}</td>
                                    <td>{{ $appointment->consultation()->first()->day }} | {{ $appointment->start_at }} - {{ $appointment->end_at }}</td>
                                    <td>{{ $appointment->applicant->name }}</td>
                                    <td>{{ $appointment->applicant->social_security_number }}</td>
                                    <td>{{ $appointment->applicant->email }}</td>
                                    <td>{{ $appointment->applicant->phone }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.appointments.details', $appointment->applicant->id) }}" class="btn btn-primary btn-icon-split">
                                            <span class="text">Adatok</span>
                                        </a>
                                    </td>
                                    <td class="text-center ">
                                        <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button href="#" class="btn btn-danger btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text">Törlés</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                Nincs időpont
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
