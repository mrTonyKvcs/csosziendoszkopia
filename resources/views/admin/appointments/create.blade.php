@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <!-- Page Heading -->
        <h1 class="mb-2 text-gray-800 h3">Új időpont létrehozása</h1>

        <!-- DataTales Example -->
        <div class="mb-4 shadow card">
            {{--<div class="py-3 card-header">--}}
                {{--<h6 class="m-0 font-weight-bold text-primary">Online konzultációra jelentkezők</h6>--}}
            {{--</div>--}}
        <div class="card-body">
            <form action="{{ route('admin.appointments.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="formGroupExampleInput">Időpont</label>
                    <input type="datetime-local" name="appointment" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                </div>
                <button type="submit" class="mb-3 btn btn-success btn-icon-split mr-md-3">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Létrehozás</span>
                  </button>
                <a href="{{ route('admin.appointments.index') }}" class="mb-3 btn btn-danger btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Mégse</span>
                </a>
            </form>
        </div>
        </div>

    </div>
    </div>
@endsection
