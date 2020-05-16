@extends('layouts.app')

@section('content')
    <!-- Slider Area -->
    @include('sections.slider')
    <!--/ End Slider Area -->

    <!-- Start service -->
    @include('sections.services')
    <!--/ End service -->

    <!-- Start Fun-facts -->
    @include('sections.counter')
    <!--/ End Fun-facts -->

    <!-- Start portfolio -->
    @include('sections.portfolio')
    <!--/ End portfolio -->

    <!-- Start Team -->
    @include('sections.team')
    <!--/ End Team -->

    <!-- Start Price -->
    @include('sections.price')
    <!--/ End Price -->
@endsection
