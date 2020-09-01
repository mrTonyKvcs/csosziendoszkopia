@extends('layouts.admin')

@section('content')
    <div id="admin">
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
                        <form class="form" action="{{ route('admin.appointments.store') }}" method="POST">
                            @csrf
                            <div class="row d-flex flex-column align-items-center">
                                <div class="col-md-6">
                                    <div class="mt-4 row">
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="form-group">
                                                <input class="form-control" name="name" type="text" placeholder="Név" rerquired>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input class="form-control"  name="email" type="email" placeholder="Email" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input name="phone" class="form-control" type="text" placeholder="Telefonszám" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="form-group">
                                                <input class="form-control" name="social_security_number" type="number" placeholder="TAJ-szám" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input class="form-control" name="zip" type="text" placeholder="Irányítószám" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input class="form-control" name="city" type="text" placeholder="Város" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="form-group">
                                                <input class="form-control" name="street" type="text" placeholder="Utca" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="form-group">
                                                <textarea class="form-control" name="comment" placeholder="Megjegyzés....."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    </div>
                                </div>
                                <appointment-component :isAdmin="true" :examinations="{{ $medicalExaminations }}"></appointment-component>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
