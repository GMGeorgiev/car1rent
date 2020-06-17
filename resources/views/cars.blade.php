@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('libraries/nouislider/nouislider.min.css') }}" rel="stylesheet">
    <script src="{{ asset('libraries/nouislider/nouislider.min.js') }}" ></script>
    <script src="{{ asset('js/cars-search-js.js') }}"></script>

<div class="container" style="margin-top: 60px;">

    <section class="top-header mb-1">

        <div class="container" style="padding-top: 16px;">
            <div class="top-header-title">Нашия автопарк</div>
        </div>
    </section>

    <!-- ================ category section start ================= -->
    <section class="section-margin--small mb-5">
        <div class="container" >
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-5">
                    <div class="col-lg-4  col-md-6 header-right cars-form-search">
                        {!! Form::open(['class' => 'needs-validation', 'novalidate' => 'novalidate', 'method' => 'get', 'route' => 'search.cars.base', 'id'=>'searchCarsBaseForm']) !!}
                        <div class="form-group">
                            <label class="label-bold" for="exampleInputEmail1">Място на взимане</label>
                            <select type="text" class="form-control" data-content="{{(isset($data['filters']['cityFrom']))? $data['filters']['cityFrom'] :''}}" name="city_from" id="city_from" required>
                                <option value="" selected style="background-color: #D5D8DC">Изберете град</option>
                                @if($data['cities'])
                                    @foreach($data['cities'] as $city)
                                        <option value="{{{$city->id}}}" {{(isset($data['filters']['cityFrom']) && $data['filters']['cityFrom'] == $city->id)? 'selected: selected':''}}>{{{$city->CityName}}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback">
                                Изберете град на взимане.
                            </div>
                        </div>
                        <div id="return-location" class="form-group return-location">
                            <label class="label-bold" for="exampleInputEmail1">Място на връщане</label>
                            <select type="text" class="form-control" data-content="{{(isset($data['filters']['cityTo']))? $data['filters']['cityTo'] :''}}" name="city_to" id="city_to" required>
                                <option value="" selected style="background-color: #D5D8DC">Изберете град</option>
                                @if($data['cities'])
                                    @foreach($data['cities'] as $city)
                                        <option value="{{{$city->id}}}" {{(isset($data['filters']['cityTo']) && $data['filters']['cityTo'] == $city->id)? 'selected: selected':''}}>{{{$city->CityName}}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback">
                                Изберете град на връщане.
                            </div>
                        </div>
                        <label class="label-bold" for="exampleInputEmail1">Дата и час на взимане</label>
                        <div class="date_from">

                            <div class="form-group" style="float: left; width: 48%;  margin-right: 9px;">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="date_from" data-content="{{(isset($data['filters']['dateFrom']))? $data['filters']['dateFrom']:''}}" placeholder="Дата от" id="date_from" value="{{(isset($data['filters']['dateFrom']))? $data['filters']['dateFrom']:''}}">
                                    <div class="input-group-append">
                                        <span class="fa fa-calendar input-group-text picker-icon" aria-hidden="true "></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="float: left; width: 48%">
                                <div class="input-group">
                                    <input class="form-control start_date" name="time_from" data-content="{{(isset($data['filters']['timeFrom']))? $data['filters']['timeFrom']:''}}" type="text" placeholder="Час от" id="time_from" value="{{(isset($data['filters']['timeFrom']))? $data['filters']['timeFrom']:''}}">
                                    <div class="input-group-append" for="time_from">
                                        <span class="fa fa-clock-o input-group-text picker-icon" aria-hidden="true "></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <label class="label-bold" for="exampleInputEmail1">Дата и час на връщане</label>
                        <div class="date_to">
                            <div class="form-group" style="float: left; width: 48%;  margin-right: 9px;">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="date_to" data-content="{{(isset($data['filters']['dateTo']))? $data['filters']['dateTo']:''}}"  placeholder="Дата до" id="date_to" value="{{(isset($data['filters']['dateTo']))? $data['filters']['dateTo']:''}}">
                                    <div class="input-group-append" for="date_to">
                                        <span class="fa fa-calendar input-group-text picker-icon"  aria-hidden="true "></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="float: left; width: 48%">
                                <div class="input-group">
                                    <input class="form-control start_date" type="text" name="time_to" data-content="{{(isset($data['filters']['timeTo']))? $data['filters']['timeTo']:''}}" placeholder="Час до" id="time_to" value="{{(isset($data['filters']['timeTo']))? $data['filters']['timeTo']:''}}">
                                    <div class="input-group-append">
                                        <span class="fa fa-clock-o input-group-text picker-icon"  aria-hidden="true "></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default btn-lg btn-block text-center text-uppercase">Промяна</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="sidebar-filter" id="sidebar-filter">
                        <div class="top-filter-head">Car Filters<a href="#pageSubmenuFilters" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle"> <span></span></a></div>
                        <ul class="main-categories collapse list-unstyled "  id="pageSubmenuFilters">
                        <div class="common-filter filters-fleets">
                            <div class="head">Class</div>
                            <form action="#">
                                <ul>
                                    @foreach($data['fleet_types'] as $type)
                                        <li class="filter-list">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input fleet-input-checkbox" id="fleet_checkbox_{{{$type->id}}}" name="fleet" value="{{{$type->FleetName}}}">
                                                <label class="custom-control-label" for="fleet_checkbox_{{{$type->id}}}">{{{$type->FleetName}}}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </form>
                        </div>
                        <div class="common-filter filters-models">
                            <div class="head">Model</div>
                            <form action="#">
                                <ul>
                                    @foreach($data['models'] as $model)
                                        <li class="filter-list">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input model-input-checkbox" id="model_checkbox_{{{$model->id}}}" name="model" value="{{{$model->ModelName}}}">
                                                <label class="custom-control-label" for="model_checkbox_{{{$model->id}}}">{{{$model->ModelName}}}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </form>
                        </div>
                        <div class="common-filter filters-gears">
                            <div class="head">Gear Type</div>
                            <form action="#">
                                <ul>
                                    <li class="filter-list">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input gear-input-checkbox" id="customCheck1" name="gear" value="1">
                                            <label class="custom-control-label" for="customCheck1">Manual</label>
                                        </div>
                                    </li>
                                    <li class="filter-list">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input gear-input-checkbox" id="customCheck2" name="gear" value="0">
                                            <label class="custom-control-label" for="customCheck2">Automatic</label>
                                        </div>
                                    </li>
                                </ul>
                            </form>
                        </div>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-7">
                    <!-- Start Filter Bar -->
                    @if(isset($data['cars']))
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
                                <input type="text" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="button"><i class="ti-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Filter Bar -->

                    <!-- Start Best Seller -->
                    <section class="lattest-product-area pb-40 category-list">
                        <!-- Car List Content Start -->
                        <?php $index = 0; ?>
                        <div class="col-lg-8 custom-car-box">
                            <div class="car-list-content m-t-50">
                                <!-- Single Car Start -->
                                @foreach($data['cars'] as $model)
                                    <?php $index++;
                                    if($model->image && $model->image != ''){
                                        $car_image = $model->image;
                                    }else{
                                        $car_image = 'car.png';
                                    }
                                    ?>
                                <div class="single-car-wrap" data-category="{{$model->FleetName}} {{$model->ModelName}} {{$model->GearType}}">
                                    <div class="row">
                                        <!-- Single Car Thumbnail -->
                                        <div class="col-lg-5">
                                            <div class="car-list-thumb" style="background-image: url('/img/cars/{{ $car_image }}')"></div>
                                        </div>
                                        <!-- Single Car Thumbnail -->

                                        <!-- Single Car Info -->
                                        <div class="col-lg-7">
                                            <div class="display-table">
                                                <div class="display-table-cell">
                                                    <div class="car-list-info">
                                                        <h2 class="cars-tittle" data-id="{{$model->ModelID}}"><a href="#">{{$model->MakerName}} {{$model->ModelName}}</a></h2>
                                                        {{--<p>Only {{$model->total}} free</p>--}}
                                                        {{--<h6 style="    color: #222222ad;">{{$model->priceRule->Name}}</h6>--}}
                                                        <div class="block-price-city">
                                                            <div class="block-city">
                                                                <div class="fleet-value" ><p>{{$model->FleetName}}</p></div>
                                                                <div class="office-value"  data-id="{{$model->OfficeID}}"><p>{{$model->OfficeName}}</p></div>
                                                            </div>
                                                            <div class="block-price">
                                                                @if(isset($model->priceRule->discount_percent) && $model->priceRule->discount_percent != 0)
                                                                    <div class="discount-price">
                                                                        <div class="discount-value">-{{$model->priceRule->discount_percent}}%</div>
                                                                    </div>
                                                                @endif

                                                                <div class="price-name" style="margin-top: 13px; text-align: end; color: #222222ad;">{{(isset($model->priceRule))?$model->priceRule->Name :   __('language.price') }}</div>

                                                                <div class="price-box">
                                                                    @if(isset($model->priceRule))
                                                                        @if(isset($model->priceRule->discount_price))
                                                                            <div class="price-value discount">{{$model->priceRule->price}} <span><i class="fa fa-eur" aria-hidden="true"></i></span></div>
                                                                            <div class="price-value">{{$model->priceRule->discount_price}} <span><i class="fa fa-eur" aria-hidden="true"></i></span></div>
                                                                        @else
                                                                            <div class="price-value">{{$model->priceRule->price}} <span><i class="fa fa-eur" aria-hidden="true"></i></span></div>
                                                                        @endif
                                                                        <div class="price-text"> {{  __('language.price') }} /{{$model->count_days}} days</div>
                                                                    @else
                                                                        {{--<div class="price-value discount">{{$model->CarBasePrice}} <span>BGN</span></div>--}}
                                                                        <div class="price-value">{{$model->CarBasePrice}} <span><i class="fa fa-eur" aria-hidden="true"></i></span></div>
                                                                        <div class="price-text"> {{  __('language.price') }} /{{$model->count_days}} days</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <p>описание на колата</p>
                                                        <ul class="car-info-list">
                                                            <li class="list-ac"><i class="fa fa-snowflake-o" aria-hidden="true" data-toggle="tooltip" data-html="true" title="Air conditienr"></i> </li>
                                                            <li class="list-doors img-icon-list" data-toggle="tooltip" data-html="true" title="Doors">
                                                                <img src="{{ URL::to('/') }}/img/icons/car-door.svg">
                                                                <span>{{$model->Doors}}</span>
                                                            </li>
                                                            <li class="list-seats img-icon-list" data-toggle="tooltip" data-html="true" title="Seats">
                                                                <img src="{{ URL::to('/') }}/img/icons/car-interior-seat.svg" >
                                                                <span>{{$model->Seats}}</span>
                                                            </li>
                                                            {{--<li class="list-fuel">{{$model->FuelName}}</li>--}}
                                                            @if($model->GearType == 1)
                                                                <li class="list-gear img-icon-list" data-content="{{$model->GearType}}">
                                                                    <img src="{{ URL::to('/') }}/img/icons/manuel.svg" data-toggle="tooltip" data-html="true" title="Manual Gear">
                                                                    <span></span>
                                                                </li>
                                                            @else
                                                                <li class="list-gear img-icon-list" data-content="{{$model->GearType}}">
                                                                    <img src="{{ URL::to('/') }}/img/icons/automat.svg" data-toggle="tooltip" data-placement="top"  title="Automatic Gear">
                                                                    {{--<span id="gear" data-toggle="tooltip" data-placement="top"  title="Automatic Gear">1</span>--}}
                                                                </li>
                                                            @endif

                                                            <li class="list-bag img-icon-list"  data-toggle="tooltip" data-html="true" title="2 big bags"><i class="fas fa-suitcase"></i > 2</li>
                                                        </ul>
                                                        <p class="rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star unmark"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Single Car info -->
                                    </div>
                                    <div class="row" style="margin-right: 0; margin-left: 0;">
                                        <div class="col-lg-5" style="background: #d3d3d373;">
                                            <div class="car-list-info second-list">
                                                <div class="fleet"><span data-toggle="tooltip" data-placement="top"  title="Full to Full" style="font-size: 25px"><i class="fas fa-gas-pump"></i></span><p style="margin-top: -44px;margin-left: 37px; padding: -11px; font-size: 12px;"> {{  __('language.gas-policy') }}</br>{{  __('language.FulltoFull') }}</p></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7" style="background: #d3d3d373">
                                        <div class="display-table">
                                            <div class="display-table-cell">
                                                <div class="car-list-info second-list">
                                                <p class="office" style="float: left;">Какво получавате с колата</p>
                                                </div>
                                                <a style="float: right; margin-bottom: 5px; margin-top: 5px;" href="#" class="button button-coupon" >Book It</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                </div>
                                @endforeach
                                <!-- Single Car End -->
                            </div>

                            <!-- Page Pagination Start -->
{{--                            <div class="page-pagi">--}}
{{--                                <nav aria-label="Page navigation example">--}}
{{--                                    <ul class="pagination">--}}
{{--                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>--}}
{{--                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
{{--                                        --}}{{--<li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                                        --}}{{--<li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                                        --}}{{--<li class="page-item"><a class="page-link" href="#">4</a></li>--}}
{{--                                        --}}{{--<li class="page-item"><a class="page-link" href="#">5</a></li>--}}
{{--                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>--}}
{{--                                    </ul>--}}
{{--                                </nav>--}}
{{--                            </div>--}}
                            <!-- Page Pagination End -->
                        </div>
                        <!-- Car List Content End -->
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

    {!! Form::open(['method' => 'get', 'route' => 'booking', 'id'=>'bookingForm']) !!}
    <input type="hidden" id="dateFrom" name="dateFrom">
    <input type="hidden" id="dateTo" name="dateTo">
    <input type="hidden" id="timeFrom" name="timeFrom">
    <input type="hidden" id="timeTo" name="timeTo">
    <input type="hidden" id="cityFrom" name="cityFrom">
    <input type="hidden" id="cityTo" name="cityTo">
    <input type="hidden" id="officeID" name="officeID">
    <input type="hidden" id="modelID" name="modelID">
    <input type="hidden" id="gear" name="gear">
    <input type="hidden" id="price" name="days">

    {!! Form::close() !!}


@endsection

