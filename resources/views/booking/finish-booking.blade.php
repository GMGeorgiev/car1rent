@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

<div class="container" style="margin-top: 60px;">

    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>{{  __('language.yourRentCar')}}</h1>
                    {{--<nav aria-label="breadcrumb" class="banner-breadcrumb">--}}
                        {{--<ol class="breadcrumb">--}}
                            {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                            {{--<li class="breadcrumb-item active" aria-current="page">Checkout</li>--}}
                        {{--</ol>--}}
                    {{--</nav>--}}
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->
    @if (isset($data['error']))
    <p class="help-block">dddd</p>
     @else
        <section class="checkout_area section-margin--small">
            <div class="container">
                @if(isset($data['rent_info']['car_info']))
                <section class="booking-info mb-1">
                {{--<section class="lattest-product-area pb-40 category-list">--}}
                <!-- Car List Content Start -->
                    <?php $index = 0; ?>
                    <div class="col-lg-8 custom-car-box">
                        <div class="car-list-content m-t-50">
                            <!-- Single Car Start -->

                            @foreach($data['rent_info']['car_info'] as $model)
                                <?php $index++;
                                if($model->image && $model->image != ''){
                                    $car_image = $model->image;
                                }else{
                                    $car_image = 'car.png';
                                }
                                ?>

                                <div class="single-car-wrap booking-area">
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
                                                                <div class="fleet-value bolder" ><span>{{  __('language.carClass')}}:</span> {{$model->FleetName}}</div>
                                                                {{--<div class="office-value"  data-id="{{$model->OfficeID}}"><p>{{$model->OfficeName}}</p></div>--}}
                                                            </div>

                                                        </div>

                                                        {{--<ul class="list">--}}
                                                        {{--<li><span>Място на наемане</span> : {{$data['search_data']['citys_name'][$data['cityFrom']]}} {{$model->OfficeName}}<span class="fa fa-calendar" aria-hidden="true "> {{$data['search_data']['dateFrom']}}</span></li>--}}
                                                        {{--<li><span>Място на връщане</span> : {{$data['search_data']['citys_name'][$data['cityTo']]}} {{$model->OfficeName}}<span class="fa fa-calendar" aria-hidden="true "> {{$data['search_data']['dateTo']}}</span></li>--}}
                                                        {{--</ul>--}}
                                                        <ul class="car-info-list-book">
                                                            {{--<li class="list-ac">--}}
                                                                {{--<div>--}}
                                                                    {{--{{dd}}--}}
                                                                    {{--<span class="bolder">Място на наемане:</span><span> {{$data['cities'][[$data['rent_info']['search_info']['cityFrom']]]}} </span>--}}
                                                                    {{--<span class="fa fa-calendar" aria-hidden="true "> {{$data['rent_info']['search_info']['dateFrom']}}</span>--}}
                                                                    {{--<span class="fa fa-clock-o" aria-hidden="true "> {{$data['rent_info']['search_info']['timeFrom']}}</span>--}}
                                                                    {{--<div class="col-md-12 form-group p_star">--}}
                                                                        {{--<input type="text" class="form-control" id="addТаке" name="addТаке" placeholder="Адрес на взимане/No на полет" value="{{ Input::old('addТаке') }}" >--}}
                                                                        {{--<span class="placeholder" data-placeholder="Address line 02"></span>--}}
                                                                    {{--</div>--}}

                                                                {{--</div>--}}

                                                            {{--</li>--}}
                                                            {{--<li class="list-ac">--}}
                                                                {{--<div>--}}
                                                                    {{--<span class="bolder">Място на връщане:</span><span> {{$data['cities'][[$data['rent_info']['search_info']['cityTo']]]}}</span>--}}
                                                                    {{--<span class="fa fa-calendar" aria-hidden="true "> {{$data['rent_info']['search_info']['dateTo']}}</span>--}}
                                                                    {{--<span class="fa fa-clock-o " aria-hidden="true "> {{$data['rent_info']['search_info']['timeTo']}}</span>--}}
                                                                    {{--<div class="col-md-12 form-group p_star">--}}
                                                                        {{--<input type="text" class="form-control" id="retТаке" name="retТаке" placeholder="Адрес на връщане/No на полет" value="{{ Input::old('retТаке') }}" >--}}
                                                                        {{--<span class="placeholder" data-placeholder="Address line 02"></span>--}}
                                                                    {{--</div>--}}

                                                                {{--</div>--}}
                                                            {{--</li>--}}

                                                        </ul>

                                                        <ul class="car-info-list-booking">
                                                            <li class="list-ac"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px" height="20px"> <i class="fa fa-snowflake-o" aria-hidden="true" data-toggle="tooltip" data-html="true" title="Air conditienr"></i></li>
                                                            <li class="list-ac"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px" height="20px"><img data-toggle="tooltip" data-html="true" title="Doors" src="{{ URL::to('/') }}/img/icons/car-door.svg" width="15px" height="15px"><span style="margin-left: 5px;">{{$model->Doors}}</span></li>
                                                            <li class="list-ac"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px" height="20px"> <img data-toggle="tooltip" data-html="true" title="Seats" src="{{ URL::to('/') }}/img/icons/car-interior-seat.svg" width="15px" height="15px"><span style="margin-left: 5px;">{{$model->Seats}}</span></li>
                                                            @if($model->GearType == 1)
                                                                <li class="list-ac" data-content="{{$model->GearType}}"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px" height="20px"> <img data-toggle="tooltip" data-html="true" title="Manual Gear" src="{{ URL::to('/') }}/img/icons/manuel.svg" width="15px" height="15px"><span style="margin-left: 5px;"></span></li>

                                                            @else
                                                                <li class="list-ac" data-content="{{$model->GearType}}"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px" height="20px"> <img data-toggle="tooltip" data-html="true" title="Automatic Gear" src="{{ URL::to('/') }}/img/icons/automat.svg" width="15px" height="15px"><span style="margin-left: 5px;"></span></li>

                                                            @endif
                                                            {{--<li class="list-ac"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px" height="20px"> <i class="fa fa-snowflake-o" aria-hidden="true" data-toggle="tooltip" data-html="true" title="Air conditienr"></i></li>--}}
                                                            <li class="list-ac"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px" height="20px"> <i class="fas fa-suitcase"></i > 2</li>
                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Single Car info -->
                                    </div>

                                </div>
                        @endforeach
                        <!-- Single Car End -->
                        </div>

                    </div>
                    <!-- Car List Content End -->
                    {{--</section>--}}

                </section>
                @endif

                <section>
                    <div class="container" style="padding-right: 10px;   padding-left: 10px;">
                        <div class="row mt-30">
                            <div class="col-lg-12">

                                <fieldset class="booking-legend" style="min-height:100px;">
                                    <legend><b> {{  __('language.priceInclude')}}</b></legend>
                                    <ul class="car-info-list-booking">
                                        <li class="list-ac"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px"
                                                                 height="20px">Неограничен пробег в километри
                                        </li>
                                        <li class="list-ac"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px"
                                                                 height="20px">Платена винетна такса
                                        </li>
                                        <li class="list-ac"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px"
                                                                 height="20px">Заместващ автомобил
                                        </li>
                                        <li class="list-ac"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px"
                                                                 height="20px">Друго 1
                                        </li>
                                        <li class="list-ac"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px"
                                                                 height="20px">Друго 2
                                        </li>
                                        <li class="list-ac"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px"
                                                                 height="20px">Друго 3
                                        </li>

                                    </ul>

                                </fieldset>

                            </div>

                        </div>
                    </div>

                </section>
                    <!--================Order Details Area =================-->
                    <section class="order_details section-margin--small">
                        <div class="container">
                            <p class="text-center billing-alert">{{  __('language.thankYou')}} {{  __('language.bookingMessageOK')}}</p>
                            <p class="text-center billing-alert">{{  __('language.sentMailBooking')}}</p>
                            <div class="row mb-5">
                                <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                                    <div class="confirmation-card">
                                        <h3 class="billing-title">{{  __('language.rentInfo')}}</h3>

                                        <table class="order-table">
                                            <tr>
                                                <td>{{  __('language.bookingNumber')}}</td>
                                                <td>: {{$data['booking']->id}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.name')}}</td>
                                                <td>: {{$data['customer_data']['name']}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.date')}}</td>
                                                <td>: {{$data['bookingDate']}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.total')}}</td>
                                                <td>: {{$data['booking']->amount}} EUR</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.paymentMethod')}}</td>
                                                <td>: {{$data['bookingTypes'][$data['payment_type']]->PaymentTypeName}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.paid')}}</td>
                                                <td>: {{$data['paymentStatuses'][$data['rent_info']['payment_status']]->PaymentStatusName}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.dayPeriod')}}</td>
                                                <td>: {{$data['rent_info']['car_info'][0]->count_days}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                                    <div class="confirmation-card">
                                        <h3 class="billing-title">{{  __('language.pickup')}} {{  __('language.address')}}</h3>
                                        <table class="order-table">
                                            <tr>
                                                <td>{{  __('language.address')}}</td>
                                                @if(isset($data['rent_info']['TakeAddress']))
                                                <td>: {{$data['rent_info']['TakeAddress']}}</td>
                                                @else
                                                    <td>: </td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.city')}}</td>
                                                <td>: {{$data['cities'][$data['rent_info']['search_info']['cityFrom']]}}</td>
                                            </tr>

                                            <tr>
                                                <td>{{  __('language.date')}}</td>
                                                <td>: {{$data['rent_info']['search_info']['dateFrom']}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.hour')}}</td>
                                                <td>: {{$data['rent_info']['search_info']['timeFrom']}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.office')}}</td>
                                                <td>: {{$data['rent_info']['car_info'][0]->OfficeName}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                                    <div class="confirmation-card">
                                        <h3 class="billing-title">{{  __('language.drop')}} {{  __('language.address')}}</h3>
                                        <table class="order-table">
                                            <tr>
                                                <td>{{  __('language.address')}}</td>
                                                @if(isset($data['rent_info']['RetAddress']))
                                                <td>: {{$data['rent_info']['RetAddress']}} </td>
                                                @else
                                                    <td>: </td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.city')}}</td>
                                                <td>: {{$data['cities'][$data['rent_info']['search_info']['cityTo']]}}</td>
                                            </tr>

                                            <tr>
                                                <td>{{  __('language.date')}}</td>
                                                <td>: {{$data['rent_info']['search_info']['dateTo']}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.hour')}}</td>
                                                <td>: {{$data['rent_info']['search_info']['timeTo']}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.office')}}</td>
                                                <td>: {{$data['rent_info']['car_info'][0]->OfficeName}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="order_details_table">
                                <h2>{{  __('language.rentDetails')}}</h2>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">{{  __('language.quantity')}}</th>
                                            <th scope="col">{{  __('language.price')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($data['rent_info']['car_info']) && count($data['rent_info']['car_info']))
                                        <tr>
                                            <td>
                                                <p>{{$data['rent_info']['car_info'][0]->MakerName}}  {{$data['rent_info']['car_info'][0]->ModelName}} </p>
                                            </td>
                                            <td>
                                                <h5></h5>
                                            </td>
                                            <td>

                                                @if(isset($data['rent_info']['car_info'][0]->priceRule))
                                                    @if(isset($data['rent_info']['car_info'][0]->priceRule->discount_price))
                                                        <p>{{$data['rent_info']['car_info'][0]->priceRule->discount_price}} EUR</p>
                                                    @else
                                                        <p>{{$data['rent_info']['car_info'][0]->priceRule->price}} EUR</p>

                                                    @endif
                                                @else
                                                    <p>{{$data['rent_info']['car_info'][0]->CarBasePrice}} EUR</p>

                                                @endif

                                            </td>
                                        </tr>
                                        @endif
                                        @if(isset($data['rent_info']['rent_form']['selected_extras']) && count($data['rent_info']['rent_form']['selected_extras']) > 0)
                                            @foreach($data['rent_info']['rent_form']['selected_extras'] as $k_e=>$extra_item)
                                                <tr>
                                                    <td>
                                                        <p>{{$data['bookingExtras'][$k_e]->RentExtraName}}</p>
                                                    </td>
                                                    <td>
                                                        <h5>x {{$extra_item['count']}}</h5>
                                                    </td>
                                                    <td>
                                                        <p>{{$extra_item['price']}} EUR</p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if(isset($data['rent_info']['rent_form']['insurance']) && count($data['rent_info']['rent_form']['insurance']) > 0)
                                            @foreach($data['rent_info']['rent_form']['insurance'] as $k_i=>$insurance)
                                                <tr>
                                                    <td>
                                                        <p>{{$data['bookingInsurance'][$k_i]->insuranceName}}</p>
                                                    </td>
                                                    <td>
                                                        <h5></h5>
                                                    </td>
                                                    <td>
                                                        <p>{{$insurance}} EUR</p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if(isset($data['rent_info']['rent_form']['coupon']))
                                            <tr>
                                                <td>
                                                    <p>{{  __('language.coupon')}} {{$data['rent_info']['rent_form']['coupon']['coupon']}}</p>
                                                </td>
                                                <td>
                                                    <h5>- {{$data['rent_info']['rent_form']['coupon']['percent']}} %</h5>
                                                </td>
                                                <td>
                                                    <p>{{$data['rent_info']['rent_form']['coupon']['value']}}</p>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>
                                                <h4>{{  __('language.total')}}</h4>
                                            </td>
                                            <td>
                                                <h5></h5>
                                            </td>
                                            <td>
                                                <h4>{{$data['booking']->amount}} EUR</h4>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!--================End Order Details Area =================-->

            </div>
        </section>
     @endif
    <!--================Checkout Area =================-->
    

</div>
    <style>

    </style>

   
@endsection

