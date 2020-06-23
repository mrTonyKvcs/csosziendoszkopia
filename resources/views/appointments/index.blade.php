@extends('layouts.app')

@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs overlay">
        <div class="container">
            <div class="bread-inner">
                <div class="row">
                    <div class="col-12">
							<h2>Online konzultáció</h2>
                        <ul class="bread-list">
                            <li><a href="/">Főoldal</a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active">Online konzultáció</li>
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
                <div class="row d-flex justify-content-center">
                    <appointment-component :examinations="{{ $medicalExaminations }}"></appointment-component>
                </div>
				{{--<div class="row">--}}
					{{--<div class="col-lg-7 col-md-12 col-12">--}}
						{{--<div class="appointment-inner">--}}
							{{--<div class="title">--}}
								{{--<h3>Időpontfoglalás és fizetés</h3>--}}
								{{--<p>Foglaljon időpontot az online konzultációra!</p>--}}
							{{--</div>--}}
							{{--<form class="form" action="{{ route('appointments.store') }}" method="POST">--}}
                                {{--@csrf--}}
								{{--<div class="row">--}}
									{{--<div class="col-lg-12 col-md-12 col-12">--}}
										{{--<div class="form-group">--}}
                                            {{--<input name="name" type="text" placeholder="Név" rerquired>--}}
										{{--</div>--}}
									{{--</div>--}}
									{{--<div class="col-lg-6 col-md-6 col-12">--}}
										{{--<div class="form-group">--}}
											{{--<input name="email" type="email" placeholder="Email" required>--}}
										{{--</div>--}}
									{{--</div>--}}
									{{--<div class="col-lg-6 col-md-6 col-12">--}}
										{{--<div class="form-group">--}}
											{{--<input name="phone" type="text" placeholder="Telefonszám" required>--}}
										{{--</div>--}}
									{{--</div>--}}
									{{--<div class="col-lg-12 col-md-12 col-12">--}}
										{{--<div class="form-group">--}}
                                            {{--<select id="appointment" name="appointment" required>--}}
                                                {{--<option value="" selected>Válasszon időpontot</option>--}}
                                                {{--@foreach($appointments as $date)--}}
                                                    {{--<option value="{{ $date->id }}">{{ $date->user->name }} | {{ $date->appointment }}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
										{{--</div>--}}
									{{--</div>--}}
									{{--<div class="col-lg-12 col-md-12 col-12">--}}
										{{--<div class="form-group">--}}
											{{--<textarea name="comment" placeholder="Megjegyzés....."></textarea>--}}
										{{--</div>--}}
									{{--</div>--}}
								{{--</div>--}}
								{{--<div class="row">--}}
									{{--<div class="col-12">--}}
										{{--<div class="form-group">--}}
											{{--<div class="button">--}}
												{{--<button type="submit" class="btn">Fizetés</button>--}}
											{{--</div>--}}
										{{--</div>--}}
									{{--</div>--}}
								{{--</div>--}}
							{{--</form>--}}
						{{--</div>--}}
					{{--</div>--}}
                    {{--<div class="col-lg-5 col-md-12 col-12">--}}
                        {{--<div class="single-table wow fadeInUp appointment-inner" data-wow-delay="0.8s" data-wow-duration="1s">--}}
                            {{--<!-- Table Head -->--}}
                            {{--<div class="table-head">--}}
                                {{--<div class="icon">--}}
                                    {{--<img class="icofont" src="icons/online.svg" width="75">--}}
                                {{--</div>--}}
                                {{--<h4 class="title">Online konzultáció</h4>--}}
                                {{--<div class="price">--}}
                                    {{--<p class="my-3 amount" style="font-size: 18px;">12000 Ft<span>/ Alkalom</span></p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<!-- Table List -->--}}
                            {{--<ul class="table-list">--}}
                                {{--<li class="fs-16"><i class="mr-1 icofont icofont-ui-check"></i>Ön az oldalon keresztül tud időpontot foglalni telefonos vagy inernetes konzultációra ( Skype vagy Zoom)</li>--}}
                                {{--<li class="mt-3 fs-16"><i class="mr-1 icofont icofont-ui-check"></i>Az időpont foglalása és a kártyás fizetést követően az orvos felveszi Önnel a kapcsolatot és megtörténik a megbeszélés.</li>--}}
                            {{--</ul>--}}
                            {{--<!-- Table Bottom -->--}}
                        {{--</div>--}}
                    {{--</div>--}}
				{{--</div>--}}
			</div>
		</section>
		<!-- End Appointment -->
@endsection
