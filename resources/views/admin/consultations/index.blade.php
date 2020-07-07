@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <!-- Page Heading -->
        <h1 class="mb-2 text-gray-800 h3">Rendelési napok</h1>

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
                                <th>Orvos neve</th>
                                <th>Rendelés</th>
                                <th>Első időpont</th>
                                <th>Utolsó időpont</th>
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
                            @forelse($consultations  as $consultation)
                                <tr>
                                    <td>{{ $consultation->user->name }}</td>
                                    <td>{{ $consultation->day }}</td>
                                    <td>{{ $consultation->open }}</td>
                                    <td>{{ $consultation->close }}</td>
                                    <td class="text-center ">
                                        <form action="{{ route('admin.consultations.destroy', $consultation->id) }}" method="POST">
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
