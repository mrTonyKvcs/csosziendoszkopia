<section id="vizsgalataink" class="services section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Vizsgálataink</h2>
                    <img src="img/section-img.png" alt="#">
                    {{--<p>Lorem ipsum dolor sit amet consectetur adipiscing elit praesent aliquet. pretiumts</p>--}}
                </div>
            </div>
        </div>
        <div class="row d-flex flex-column flex-md-row justify-content-center">
            @for ($i = 0; $i < 3; $i++)
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">
                        {{--<i class="icofont icofont-prescription"></i>--}}
                        <img class="icofont" src="icons/online.svg" width="55">
                        <h4><a href="{{ route('appointments.index') }}">Online konzultáció</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
                    </div>
                    <!-- End Single Service -->
                </div>
            @endfor
        </div>
    </div>
</section>
