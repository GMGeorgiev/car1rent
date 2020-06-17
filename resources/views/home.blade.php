@extends('layouts.app')

@section('content')


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
                        <div class="sidebar-categories">
                            <div class="head">Меню</div>
                            <ul class="main-categories">
                                <li class="common-filter">
                                    <form action="#">
                                        <ul>
                                            <a class="list-items {{ Request::is('admin/cars-settings/makers') ? ' active' : '' }}" href="{{ route('admin.cars-settings.makers') }}">
                                                <i class="list-items-icon fa fa-industry" aria-hidden="true"></i> <span>Редакция на профил</span>
                                            </a>

                                        </ul>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-7">
                        <!-- Start Filter Bar -->
                        @if(Auth::user())
                        @section('content')
                            @yield('content')
                        @endsection
                            <div class="filter-bar d-flex flex-wrap align-items-center">
                                {{--                        <div class="sorting">--}}
                                {{--                            <select>--}}
                                {{--                                <option value="1">Default sorting</option>--}}
                                {{--                                <option value="1">Default sorting</option>--}}
                                {{--                                <option value="1">Default sorting</option>--}}
                                {{--                            </select>--}}
                                {{--                        </div>--}}
                                {{--                        <div class="sorting mr-auto">--}}
                                {{--                            <select>--}}
                                {{--                                <option value="1">Show 12</option>--}}
                                {{--                                <option value="1">Show 12</option>--}}
                                {{--                                <option value="1">Show 12</option>--}}
                                {{--                            </select>--}}
                                {{--                        </div>--}}
                                <div>
                                    <div class="input-group filter-bar-search">
                                        {{--<input type="text" placeholder="Search">--}}
                                        {{--<div class="input-group-append">--}}
                                            {{--<button type="button"><i class="ti-search"></i></button>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                            <!-- End Filter Bar -->

                            <!-- Start Best Seller -->
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
