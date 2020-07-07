@extends('layouts.app')

@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs overlay">
        <div class="container">
            <div class="bread-inner">
                <div class="row">
                    <div class="col-12">
							<h2>Online időpontfoglalás</h2>
                        <ul class="bread-list">
                            <li><a href="/">Főoldal</a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active">Online időpontfoglalás</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Appointment -->
    <section class="appointment single-page">
			<div class="container">
                <form class="form" action="{{ route('appointments.store') }}" method="POST">
                    @csrf
                    <div class="row d-flex flex-column align-items-center">
                        <div class="col-md-6">
                            <h3>Időpontfoglalás és fizetés</h3>
                            <p>Foglaljon időpontot a vizsgálatainkra!</p>
                            <div class="mt-4 row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="form-group">
                                        <input name="name" type="text" placeholder="Név" rerquired>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <input name="email" type="email" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <input name="phone" type="text" placeholder="Telefonszám" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="form-group">
                                        <textarea name="comment" placeholder="Megjegyzés....."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            </div>
                        </div>
                        <appointment-component :examinations="{{ $medicalExaminations }}"></appointment-component>
                    </div>
                </form>
			</div>
		</section>
		<!-- End Appointment -->
@endsection
