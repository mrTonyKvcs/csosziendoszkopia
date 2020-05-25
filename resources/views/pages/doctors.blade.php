@extends('layouts.app')

@section('content')
    <div class="breadcrumbs overlay">
        <div class="container">
            <div class="bread-inner">
                <div class="row">
                    <div class="col-12">
                        <h2>Orvos</h2>
                        <ul class="bread-list">
                            <li><a href="/">Home</a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active">Orvos</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="doctor-details-area section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="doctor-details-item doctor-details-left">
                            <img src="https://via.placeholder.com/470x550" alt="#">
                            <div class="doctor-details-contact">
                                <h3>Kapcsolat</h3>
                                <ul class="basic-info">
                                    <li>
                                        <i class="icofont-ui-call"></i>
                                        Call : +07 554 332 322
                                    </li>
                                    <li>
                                        <i class="icofont-ui-message"></i>
                                        hello@medsev.com
                                    </li>
                                    <li>
                                        <i class="icofont-location-pin"></i>
                                        4th Floor, 408 No Chamber
                                    </li>
                                </ul>
								<!-- Social -->
								{{--<ul class="social">--}}
									{{--<li><a href="#"><i class="icofont-facebook"></i></a></li>--}}
									{{--<li><a href="#"><i class="icofont-google-plus"></i></a></li>--}}
									{{--<li><a href="#"><i class="icofont-twitter"></i></a></li>--}}
									{{--<li><a href="#"><i class="icofont-vimeo"></i></a></li>--}}
									{{--<li><a href="#"><i class="icofont-pinterest"></i></a></li>--}}
								{{--</ul>--}}
								<!-- End Social -->
								{{--<div class="doctor-details-work">--}}
									{{--<h3>Working hours</h3>--}}
									{{--<ul class="time-sidual">--}}
										{{--<li class="day">Monday - Fridayp <span>8.00-20.00</span></li>--}}
										{{--<li class="day">Saturday <span>9.00-18.30</span></li>--}}
										{{--<li class="day">Monday - Thusday <span>9.00-15.00</span></li>--}}
										{{--<li class="day">Monday - Fridayp <span>8.00-20.00</span></li>--}}
									{{--</ul>--}}
								{{--</div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="doctor-details-item">
                            <div class="doctor-details-right">
								<div class="doctor-name">
                                    <h3 class="name">{{ $doctor['name'] }}</h3>
                                    <p class="deg">{{ $doctor['job'] }}</p>
								</div>
                                <div class="doctor-details-biography">
                                    <p>{{ $doctor['description'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
