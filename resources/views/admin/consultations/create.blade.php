@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <!-- Page Heading -->
        <h1 class="mb-2 text-gray-800 h3">Új rendelés  létrehozása</h1>

        <!-- DataTales Example -->
        <div class="mb-4 shadow card">
            {{--<div class="py-3 card-header">--}}
                {{--<h6 class="m-0 font-weight-bold text-primary">Online konzultációra jelentkezők</h6>--}}
            {{--</div>--}}
        <div class="card-body">
            <form action="{{ route('admin.consultations.store') }}" method="POST">
                @csrf
                <div class="form-group">
                        <label for="formGroupExampleInput">Orvosi rendelő</label>
                        <select name="office_id" class="custom-select" id="inputGroupSelect01">
                            <option selected>Orvosi rendelő kivalasztasa...</option>
                            @foreach($offices as $office)
                                <option value="{{ $office->id }}">{{ $office->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @if(auth()->user()->role == 'doctor')
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                @else
                    <div class="form-group">
                        <label for="formGroupExampleInput">Orvos</label>
                        <select name="user_id" class="custom-select" id="inputGroupSelect01">
                            <option selected>Orvos kivalasztasa...</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <label for="formGroupExampleInput">Rendelés napja</label>
                    <input type="date" name="day" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                    {{-- <input type="text" class="form-control datePicker" placeholder="Pick the multiple dates"> --}}
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Első időpont</label>
                    <input type="time" name="open" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Utolsó időpont</label>
                    <input type="time" name="close" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" id="checkbox1" name="is_digital" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Online konzultációs rendelés</label>
                </div>
                <button type="submit" class="mb-3 btn btn-success btn-icon-split mr-md-3">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Létrehozás</span>
                  </button>
                <a href="{{ route('admin.consultations.index') }}" class="mb-3 btn btn-danger btn-icon-split">
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

{{-- @section('date-picker') --}}
{{--     <script> --}}
{{--         $('.datePicker').datepicker({ --}}
{{--             multidate: true, --}}
{{--             format: 'yyyy-mm-dd' --}}
{{--         }); --}}
{{--     </script> --}}
{{-- @endsection --}}
