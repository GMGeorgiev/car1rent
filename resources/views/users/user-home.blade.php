@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-2.css') }}" rel="stylesheet">

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
                                        <h1 class="user-home-tittle">Информация за вашите наети коли</h1>
                                        <p>Who are in extremely love with eco friendly system.</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-review">
                                                <h4>Всички</h4>
                                                <p>

                                                </p>
                                                <div class="star">
                                                <span style="color: #fab702">{{ $data[activeBookings] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-review">
                                                <h4>Неплатени</h4>
                                                <p>

                                                </p>
                                                <div class="star">
                                                    <span style="color: #fab702">{{ $data[unpaidBookings] }}</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-review">
                                                <h4>Активни</h4>
                                                <p>

                                                </p>
                                                <div class="star">
                                                    <span style="color: #fab702">{{ $data[allBookings] }}</span>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
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
