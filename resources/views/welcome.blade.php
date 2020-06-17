@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">

<div class="main-home">
    <!-- start banner Area -->
    <section class="banner-area relative" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row fullscreen d-flex align-items-center justify-content-between" >
                <div class="col-lg-4  col-md-6 header-right">
                    <h4 class="pb-30" style="margin-bottom: 32px;">Намерете автомобил</h4>
                    {!! Form::open(['class' => 'needs-validation', 'novalidate' => 'novalidate', 'method' => 'get', 'route' => 'search.cars.base', 'id'=>'searchCarsBaseForm']) !!}
                    {{--<form class='needs-validation' action="{{ route('search.cars.base') }}" method='POST' id='searchCarsBaseForm'>--}}
                        {{--<div class="from-group">--}}
                            {{--<input class="form-control txt-field" type="text" name="name" placeholder="Your name"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your name'">--}}
                            {{--<div class="invalid-feedback">--}}
                                {{--Please choose a grad.--}}
                            {{--</div>--}}
                            {{--<input class="form-control txt-field" type="email" name="email" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'">--}}
                            {{--<input class="form-control txt-field" type="tel" name="phone" placeholder="Phone number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone number'">--}}
                        {{--</div>--}}
                    {{--<div class="input-group mb-3">--}}
                        {{--<div class="input-group-prepend">--}}
                            {{--<span class="input-group-text custom-input-group-text-g" id="inputGroup-sizing-default">Клас</span>--}}
                        {{--</div>--}}
                        {{--<select class="custom-select" name="fleet" id="fleet">--}}
                            {{--<option value="0" selected style="background-color: #D5D8DC">Изберете...</option>--}}
                            {{--@if($data['fleet_types'])--}}
                                {{--@foreach($data['fleet_types'] as $type)--}}
                                    {{--<option value="{{{$type->id}}}">{{{$type->FleetName}}}</option>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                        {{--</select>--}}
                        {{--<input type="text" class="form-control" id="info-ac" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>--}}
                    {{--</div>--}}
                    {{--<div class="input-group mb-3">--}}
                        {{--<div class="input-group-prepend">--}}
                            {{--<label class="input-group-text" for="inputGroupSelect01">Клас</label>--}}
                        {{--</div>--}}
                        {{--<select class="custom-select" id="inputGroupSelect01">--}}
                            {{--<option value="0" selected style="background-color: #D5D8DC">Изберете...</option>--}}
                            {{--@if($data['fleet_types'])--}}
                                {{--@foreach($data['fleet_types'] as $type)--}}
                                    {{--<option value="{{{$type->id}}}">{{{$type->FleetName}}}</option>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                        {{--</select>--}}
                    {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<select type="text" class="form-control" name="fleet" id="fleet" >--}}
                                    {{--<option value="0" selected style="background-color: #D5D8DC">Клас</option>--}}
                                {{--@if($data['fleet_types'])--}}
                                    {{--@foreach($data['fleet_types'] as $type)--}}
                                        {{--<option value="{{{$type->id}}}">{{{$type->FleetName}}}</option>--}}
                                    {{--@endforeach--}}
                                {{--@endif--}}
                                {{--</select>--}}
                        {{--</div>--}}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text custom-input-group-text-g" id="inputGroup-sizing-default">Място на взимане</span>
                        </div>
                        <select class="custom-select" name="city_from" id="city_from" required>
                            {{--<select type="text" class="form-control" name="city_from" id="city_from" required>--}}
                            <option value="" selected style="background-color: #D5D8DC">Изберете...</option>

                                @if($data['cities'])
                                    @foreach($data['cities'] as $city)
                                        <option value="{{{$city->id}}}">{{{$city->CityName}}}</option>
                                    @endforeach
                                @endif
                            {{--</select>--}}
                        </select>
                        <div class="invalid-feedback">
                            Изберете град на взимане.
                        </div>
                        {{--<input type="text" class="form-control" id="info-ac" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>--}}
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text custom-input-group-text-g" id="inputGroup-sizing-default">Място на връщане</span>
                        </div>
                        <select class="custom-select" name="city_to" id="city_to" required>
                            {{--<select type="text" class="form-control" name="city_from" id="city_from" required>--}}
                            <option value="" selected style="background-color: #D5D8DC">Изберете...</option>
                            @if($data['cities'])
                                @foreach($data['cities'] as $city)
                                    <option value="{{{$city->id}}}">{{{$city->CityName}}}</option>
                                @endforeach
                            @endif
                            {{--</select>--}}
                        </select>
                        <div class="invalid-feedback">
                            Изберете град на връщане.
                        </div>
                        {{--<input type="text" class="form-control" id="info-ac" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>--}}
                    </div>
                        {{--<div class="form-group">--}}
                            {{--<label for="exampleInputEmail1">Място на взимане</label>--}}
                            {{--<select type="text" class="form-control" name="city_from" id="city_from" required>--}}
                                {{--<option value="0" selected style="background-color: #D5D8DC">Изберете град</option>--}}
                                {{--@if($data['cities'])--}}
                                    {{--@foreach($data['cities'] as $city)--}}
                                        {{--<option value="{{{$city->id}}}">{{{$city->CityName}}}</option>--}}
                                    {{--@endforeach--}}
                                {{--@endif--}}
                            {{--</select>--}}
                            {{--<div class="invalid-feedback">--}}
                                {{--Please choose a grad.--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    <label for="exampleInputEmail1">Дата и час на взимане</label>
                        <div class="date_from">

                            <div class="form-group" style="float: left; width: 48%;  margin-right: 9px;">
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-8">--}}
                                        <div class="input-group">
                                            <input class="form-control" type="text" name="date_from" placeholder="Дата от" id="date_from">
                                            <div class="input-group-append">
                                                <span class="fa fa-calendar input-group-text picker-icon" aria-hidden="true "></span>
                                            </div>
                                        </div>
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                            <div class="form-group" style="float: left; width: 48%">
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-7">--}}
                                        <div class="input-group">
                                            <input class="form-control start_date" name="time_from" type="text" placeholder="Час от" id="time_from">
                                            <div class="input-group-append" for="time_from">
                                                <span class="fa fa-clock-o input-group-text picker-icon" aria-hidden="true "></span>
                                            </div>
                                        </div>
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>

                    {{--<div id="return-location" class="form-group return-location">--}}
                        {{--<label for="exampleInputEmail1">Място на връщане</label>--}}
                        {{--<select type="text" class="form-control" name="city_to" id="city_to" required>--}}
                            {{--<option value="0"selected style="background-color: #D5D8DC">Изберете град</option>--}}
                            {{--@if($data['cities'])--}}
                                {{--@foreach($data['cities'] as $city)--}}
                                    {{--<option value="{{{$city->id}}}">{{{$city->CityName}}}</option>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    <label for="exampleInputEmail1">Дата и час на връщане</label>
                    {{--<span class="input-group-text" id="inputGroup-sizing-default">Дата и час на връщане</span>--}}
                        <div class="date_to">

                            <div class="form-group" style="float: left; width: 48%;  margin-right: 9px;">
                                {{--<div class="row">--}}
                                {{--<div class="col-md-8">--}}
                                <div class="input-group">
                                    <input class="form-control" type="text" name="date_to" placeholder="Дата до" id="date_to">
                                    <div class="input-group-append" for="date_to">
                                        <span class="fa fa-calendar input-group-text picker-icon"  aria-hidden="true "></span>
                                    </div>
                                </div>
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                            <div class="form-group" style="float: left; width: 48%">
                                {{--<div class="row">--}}
                                {{--<div class="col-md-7">--}}
                                <div class="input-group">
                                    <input class="form-control start_date" type="text" name="time_to" placeholder="Час до" id="time_to">
                                    <div class="input-group-append">
                                        <span class="fa fa-clock-o input-group-text picker-icon"  aria-hidden="true "></span>
                                    </div>
                                </div>
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    {{--<div class="custom-control custom-checkbox mb-3">--}}
                        {{--<input type="checkbox" class="custom-control-input" id="ReturnCityCheck" name="example1">--}}
                        {{--<label class="custom-control-label" for="ReturnCityCheck">Връщане на друго място</label>--}}
                    {{--</div>--}}



                        <div class="form-group">

                            <button class="btn btn-default btn-lg btn-block text-center text-uppercase">Търсене</button>

                        </div>
                    {{--<div class="form-group">--}}

                        {{--<span>* Задължително поле</span>--}}

                    {{--</div>--}}

                    {{--</form>--}}
                    {!! Form::close() !!}
                </div>
                <div class="banner-content col-lg-6 col-md-6 ">
                    <h6 class="text-white ">Need a car? just call</h6>
                    <h1 class="text-uppercase">
                        +359 88 971 3333
                    </h1>
                    <p class="pt-10 pb-10 text-white">
                        Whether you enjoy city breaks or extended holidays in the sun, you can always improve your travel experiences by staying in a small.
                    </p>
                    {{--<a href="#" class="primary-btn text-uppercase">Call for car</a>--}}
                </div>

            </div>
        </div>
    </section>

    <!-- Start services Area -->
    <section class="services-area pb-120">
        <div class="container">
            <div class="row section-title">
                <h1>Какви услуги предлагаме на нашите клиенти</h1>
                {{--<p>Които са изключително влюбени в екологичната система.</p>--}}
            </div>
            <div class="row">
                <div class="col-lg-4 single-service">
                    <i class="fa fa-car"></i>
                    <a href="#"><h4>Rent Car Services</h4></a>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                    </p>
                </div>
                <div class="col-lg-4 single-service">
                    <i class="fa fa-car"></i>
                    <a href="#"><h4>Office Pick-ups</h4></a>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                    </p>
                </div>
                <div class="col-lg-4 single-service">
                    <i class="fa fa-bus"></i>
                    <a href="#"><h4>Transfers Services</h4></a>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End services Area -->
    <!-- Start reviews Area -->
    <section class="reviews-area section-gap">
        <div class="container">
            <div class="row section-title">
                <h1>Client’s Reviews</h1>
                <p>Who are in extremely love with eco friendly system.</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-review">
                        <h4>Cody Hines</h4>
                        <p>
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                        </p>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-review">
                        <h4>Chad Herrera</h4>
                        <p>
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                        </p>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-review">
                        <h4>Andre Gonzalez</h4>
                        <p>
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                        </p>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-review">
                        <h4>Jon Banks</h4>
                        <p>
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                        </p>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-review">
                        <h4>Landon Houston</h4>
                        <p>
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                        </p>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-review">
                        <h4>Nelle Wade</h4>
                        <p>
                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                        </p>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- End footer Area -->
    <!-- End reviews Area -->


    <!-- End banner Area -->
    {{--<div class="wrapper">--}}
        {{--<div id="one">--}}
            {{--Place for Booking form--}}
        {{--</div>--}}
        {{--<div id="two">--}}
            {{--<img src="{{url('/img/cars/slide1.jpg')}} " width="100%" >--}}
        {{--</div>--}}
    {{--</div>--}}



</div>
    <!-- start footer Area -->
    <footer class="footer-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Quick links</h6>
                        <ul>
                            <li><a href="#">Jobs</a></li>
                            <li><a href="#">Brand Assets</a></li>
                            <li><a href="#">Investor Relations</a></li>
                            <li><a href="#">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Resources</h6>
                        <ul>
                            <li><a href="#">Guides</a></li>
                            <li><a href="#">Research</a></li>
                            <li><a href="#">Experts</a></li>
                            <li><a href="#">Agencies</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 social-widget">
                    <div class="single-footer-widget">
                        <h6>Follow Us</h6>
                        <p>Let us be social</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <script  type="text/javascript">
        (function() {
            'use strict';
            window.addEventListener('load', function() {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        console.log(form);
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        $.noConflict();
        jQuery(document).ready(function ($) {
            $('#city_from').on('change', function () {

                $('#city_to').val(this.value );



            });
//            $('#ReturnCityCheck').on('click', function (e) {
//
//                var check = document.getElementById("ReturnCityCheck").checked;
//                if (check) {
//                    $('.return-location').show();
//
//                } else {
//                    $('.return-location').hide();
//
//                }
//            });

            var localeJquery = $('html').attr('lang');
            $('#date_from').datetimepicker({
                locale: moment.locale(localeJquery),
                format: 'DD-MM-YYYY',
                defaultDate: moment(),
                allowInputToggle:true,

            });
            $('#date_to').datetimepicker({
                locale: moment.locale(localeJquery),
                format: 'DD-MM-YYYY',
                useCurrent: false, //Important! See issue #1075
                defaultDate: moment().add(3, 'days'),
            });
            $('#time_from').datetimepicker({
                locale: moment.locale(localeJquery),
                format: 'HH:mm',
                defaultDate: moment().hours(10).minutes(0).seconds(0).milliseconds(0)
            });
            $('#time_to').datetimepicker({
                locale: moment.locale(localeJquery),
                format: 'HH:mm',
                defaultDate: moment().hours(10).minutes(0).seconds(0).milliseconds(0)
            });

            $("#date_from").on("dp.change", function (e) {
                $('#date_to').data("DateTimePicker").minDate(e.date);
            });
            $("#date_to").on("dp.change", function (e) {
                $('#date_from').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>
    <style>
        .row{
            display: none; !important;
        }
        .body{
            background-color: #FFF !important;
        }

    </style>

@endsection


