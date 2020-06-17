@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <script src="{{ asset('js/cars-search-js.js') }}"></script>

    <div class="container" style="margin-top: 60px;">

        <section class="top-header mb-1">

            <div class="container" style="padding-top: 16px;">
                <div class="top-header-title">Здравей  {{ Auth::user()->name }}</div>
            </div>
        </section>

        <!-- ================ category section start ================= -->
        <section class="section-margin--small mb-5">
            <div class="container" >
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-5">
                        @include('users.user-menu')
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-7">

                        <!-- Start Filter Bar -->
                        @if(Auth::user())

                            <!-- Start Best Seller -->
                            <section class="reviews-area section-gap">
                                <div class="container">
                                    <div class="row section-title">
                                        <h1 class="user-home-tittle">Лични данни</h1>
                                    </div>
                                    <div class="row">


                                            <div style="width: 100%">
                                                <div class="col-md-6 form-group p_star" style="float: left;">
                                                    <input type="text" class="form-control" id="first" name="name" value="{{ Input::old('name') }}" placeholder="Име*"
                                                           value="" required>
                                                    <span class="placeholder" data-placeholder="First name"></span>
                                                    <div class="invalid-feedback" >
                                                        Valid first name is required.
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form-group p_star" style="float: left;">
                                                    <input type="text" class="form-control" id="last" name="last_name" value="{{ Input::old('last_name') }}" placeholder="Фамилия*"
                                                           value="" required>
                                                    <span class="placeholder" data-placeholder="Last name"></span>
                                                    <div class="invalid-feedback">
                                                        Valid last name is required.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group" >
                                                <input type="email" class="form-control" id="email" name="email" value="{{ Input::old('email') }}"
                                                       placeholder="you@example.com*" required>
                                                <div class="invalid-feedback">
                                                    Please enter a valid email.
                                                </div>
                                                @if($errors->has('email'))
                                                    <div class="error-response">Please enter a valid email address.</div>
                                                @endif
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <input type="email" class="form-control" id="email-re" name="repeatEmail"
                                                       placeholder="Re: you@example.com*" value="{{ Input::old('repeatEmail') }}" required>
                                                <div class="invalid-feedback" {{($errors->has('repeatEmail'))? 'style="display: block"' : ''}}>
                                                    Please enter a valid email address for shipping updates.
                                                </div>
                                                @if($errors->has('repeatEmail'))
                                                    <div class="error-response">The repeat email and email must match.</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6 form-group p_star" style="float: left;">
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ Input::old('phone') }}" placeholder="Телефон*"required>
                                                <span class="placeholder" data-placeholder="Град"></span>
                                            </div>
                                            <div class="col-md-6 form-group p_star" style="float: left;">
                                                <select class="country_select form-control" id="country" name="country" required>
                                                    <option value="" selected>Choose...</option>
                                                    @if($data['countries'])
                                                        @foreach($data['countries'] as $country)
                                                            <option value="{{$country->id}}" @if(Input::old('country') == $country->id) selected @endif > {{$country->CountryName}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>

                                            <div class="col-md-12 form-group p_star">
                                                <input type="text" class="form-control" id="add1" name="add1" value="{{ Input::old('add1') }}" placeholder="Адрес" required>
                                                <span class="placeholder" data-placeholder="Address line 01"></span>
                                            </div>
                                            {{--<div class="col-md-12 form-group p_star">--}}
                                            {{--<input type="text" class="form-control" id="add2" name="add2">--}}
                                            {{--<span class="placeholder" data-placeholder="Address line 02"></span>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-12 form-group p_star">--}}
                                            {{--<input type="text" class="form-control" id="city" name="city">--}}
                                            {{--<span class="placeholder" data-placeholder="Town/City"></span>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-12 form-group p_star">--}}
                                            {{--<select class="country_select">--}}
                                            {{--<option value="1">District</option>--}}
                                            {{--<option value="2">District</option>--}}
                                            {{--<option value="4">District</option>--}}
                                            {{--</select>--}}
                                            {{--</div>--}}
                                            <div class="col-md-3 form-group p_star" style="float: left;">
                                                <label style="padding-top: 9px; padding-left: 11px;">Дата на раждане:</label>
                                            </div>
                                            <div class="col-md-3 form-group p_star" style="float: left;">
                                                <select class="country_select form-control" name="dob_day" id="dob-day" required>
                                                    <option value="" selected>Choose...</option>
                                                    @if(isset($data['days']))

                                                        @foreach($data['days'] as $day)
                                                            <option value="{{$day}}" @if(Input::old('dob_day') == $day) selected @endif > {{$day}}</option>
                                                        @endforeach

                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-3 form-group p_star" style="float: left;">
                                                <select class="country_select form-control" name="dob_month" id="dob-month" required>
                                                    <option value="" selected>Choose...</option>
                                                    @if(isset($data['months']))

                                                        @foreach($data['months'] as $kay_m=>$mon)
                                                            <option value="{{$kay_m}}" @if(Input::old('dob_month') == $kay_m) selected @endif > {{$mon}}</option>
                                                        @endforeach

                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-3 form-group p_star" style="float: left;">
                                                <select class="country_select form-control" name="dob_year" id="dob-year" required>
                                                    <option value="" selected>Choose...</option>
                                                    @if(isset($data['years']))

                                                        @foreach($data['years'] as $year)
                                                            <option value="{{$year}}" @if(Input::old('dob_year') == $year) selected @endif > {{$year}}</option>
                                                        @endforeach

                                                    @endif
                                                </select>
                                            </div>

                                    </div>

                                </div>
                                <div class="submit-button">
                                    <a class="button button-coupon" id="submit-coupon">Промени</a>

                                </div>
                            </section>
                            <!-- End Best Seller -->
                        @elseif($errors)
                            <div class="filter-bar d-flex flex-wrap align-items-center error-text">
                                <div style="width: 100%; text-align: center;" class="error-text">Данните не са актуални!</div>
                                {{--<div>--}}
                                {{--<div class="input-group filter-bar-search">--}}
                                {{--<input type="text" placeholder="Search">--}}
                                {{--<div class="input-group-append">--}}
                                {{--<button type="button"><i class="ti-search"></i></button>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </section>
        <!-- ================ category section end ================= -->
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



@endsection
