@extends('layouts.admin')

@section('content')
    <div id="admin">
        <div class="row">
            <div class="col-lg-12">

                <!-- Page Heading -->
                <h1 class="mb-2 text-gray-800 h3">Vizsgálat szerkesztése</h1>

                <!-- DataTales Example -->
                <div class="mb-4 shadow card">
                    {{--<div class="py-3 card-header">--}}
                        {{--<h6 class="m-0 font-weight-bold text-primary">Online konzultációra jelentkezők</h6>--}}
                        {{--</div>--}}
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.medical-examinations.update', $medicalExamination->id) }}" method="POST">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf
                            <div class="row d-flex flex-column align-items-center">
                                <div class="col-md-6">
                                    <div class="mt-4 row">
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="form-group">
                                                <input class="form-control" name="name" type="text" placeholder="Név" value="{{ $medicalExamination->name }}" rerquired>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Aktív / Inaktív</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="is_active">
                                                    <option value="1" selected>Aktív</option>
                                                    <option value="0">Inaktív</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary">Szerkeszt</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
