@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <script src="{{ asset('js/booking-js.js') }}"></script>

<div class="container" style="margin-top: 60px;">
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Резервация</h1>
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
    <!--================Checkout Area =================-->
    <form class='needs-validation' action="{{ route('booking.create-booking') }}" method='POST' id='createBooking' novalidate>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <section class="checkout_area section-margin--small">
        <div class="container">
            <section class="booking-info mb-1">
                {{--<section class="lattest-product-area pb-40 category-list">--}}
                    <!-- Car List Content Start -->
                    <?php $index = 0; ?>
                    <div class="col-lg-8 custom-car-box">
                        <div class="car-list-content m-t-50">
                            <!-- Single Car Start -->
                            @foreach($data['car_info'] as $model)
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
                                                                <div class="fleet-value bolder" ><span>Клас:</span> {{$model->FleetName}}</div>
                                                                {{--<div class="office-value"  data-id="{{$model->OfficeID}}"><p>{{$model->OfficeName}}</p></div>--}}
                                                            </div>
                                                            {{--<div class="block-price">--}}
                                                                {{--@if(isset($model->priceRule->discount_percent) && $model->priceRule->discount_percent != 0)--}}
                                                                    {{--<div class="discount-price">--}}
                                                                        {{--<div class="discount-value">-{{$model->priceRule->discount_percent}}%</div>--}}
                                                                    {{--</div>--}}
                                                                {{--@endif--}}

                                                                {{--<div class="price-name" style="margin-top: 13px; text-align: end; color: #222222ad;">{{(isset($model->priceRule))?$model->priceRule->Name :   __('language.price') }}</div>--}}

                                                                {{--<div class="price-box">--}}
                                                                    {{--@if(isset($model->priceRule))--}}
                                                                        {{--@if(isset($model->priceRule->discount_price))--}}
                                                                            {{--<div class="price-value discount">{{$model->priceRule->price}} <span>BGN</span></div>--}}
                                                                            {{--<div class="price-value">{{$model->priceRule->discount_price}} <span>BGN</span></div>--}}
                                                                        {{--@else--}}
                                                                            {{--<div class="price-value">{{$model->priceRule->price}} <span>BGN</span></div>--}}
                                                                        {{--@endif--}}
                                                                        {{--<div class="price-text"> {{  __('language.price') }} /{{$model->count_days}} days</div>--}}
                                                                    {{--@else--}}
                                                                        {{--<div class="price-value discount">{{$model->CarBasePrice}} <span>BGN</span></div>--}}
                                                                        {{--<div class="price-value">{{$model->CarBasePrice}} <span>BGN</span></div>--}}
                                                                        {{--<div class="price-text"> {{  __('language.price') }} /{{$model->count_days}} days</div>--}}
                                                                    {{--@endif--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                        </div>

                                                        <p>описание на колата</p>
                                                        {{--<ul class="list">--}}
                                                            {{--<li><span>Място на наемане</span> : {{$data['search_data']['citys_name'][$data['cityFrom']]}} {{$model->OfficeName}}<span class="fa fa-calendar" aria-hidden="true "> {{$data['search_data']['dateFrom']}}</span></li>--}}
                                                            {{--<li><span>Място на връщане</span> : {{$data['search_data']['citys_name'][$data['cityTo']]}} {{$model->OfficeName}}<span class="fa fa-calendar" aria-hidden="true "> {{$data['search_data']['dateTo']}}</span></li>--}}
                                                        {{--</ul>--}}
                                                        <ul class="car-info-list-book" data-content="{{$model->count_days}}">
                                                            <li class="list-ac">
                                                                <div>
                                                                    <span class="bolder">Място на наемане:</span><span> {{$data['search_data']['citys_name'][$data['cityFrom']]}} </span>
                                                                    <span class="fa fa-calendar" aria-hidden="true "> {{$data['search_data']['dateFrom']}}</span>
                                                                    <span class="fa fa-clock-o" aria-hidden="true "> {{$data['search_data']['timeFrom']}}</span>
                                                                    <div class="col-md-12 form-group p_star">
                                                                        <input type="text" class="form-control" id="addТаке" name="addТаке" placeholder="Адрес на взимане/No на полет" value="{{ Input::old('addТаке') }}" >
                                                                        <span class="placeholder" data-placeholder="Address line 02"></span>
                                                                    </div>

                                                                </div>

                                                            </li>
                                                            <li class="list-ac">
                                                                <div>
                                                                    <span class="bolder">Място на връщане:</span><span> {{$data['search_data']['citys_name'][$data['cityTo']]}}</span>
                                                                    <span class="fa fa-calendar" aria-hidden="true "> {{$data['search_data']['dateTo']}}</span>
                                                                    <span class="fa fa-clock-o " aria-hidden="true "> {{$data['search_data']['timeTo']}}</span>
                                                                    <div class="col-md-12 form-group p_star">
                                                                        <input type="text" class="form-control" id="retТаке" name="retТаке" placeholder="Адрес на връщане/No на полет" value="{{ Input::old('retТаке') }}" >
                                                                        <span class="placeholder" data-placeholder="Address line 02"></span>
                                                                    </div>

                                                                </div>
                                                            </li>

                                                        </ul>
                                                        {{--<ul class="car-info-list">--}}
                                                            {{--<li class="list-ac"><i class="fa fa-snowflake-o" aria-hidden="true" data-toggle="tooltip" data-html="true" title="Air conditienr"></i> </li>--}}
                                                            {{--<li class="list-doors img-icon-list" data-toggle="tooltip" data-html="true" title="Doors">--}}
                                                                {{--<img src="{{ URL::to('/') }}/img/icons/car-door.svg">--}}
                                                                {{--<span>{{$model->Doors}}</span>--}}
                                                            {{--</li>--}}
                                                            {{--<li class="list-seats img-icon-list" data-toggle="tooltip" data-html="true" title="Seats">--}}
                                                                {{--<img src="{{ URL::to('/') }}/img/icons/car-interior-seat.svg" >--}}
                                                                {{--<span>{{$model->Seats}}</span>--}}
                                                            {{--</li>--}}
                                                            {{--<li class="list-fuel">{{$model->FuelName}}</li>--}}
                                                            {{--@if($model->GearType == 1)--}}
                                                                {{--<li class="list-gear img-icon-list" data-content="{{$model->GearType}}">--}}
                                                                    {{--<img src="{{ URL::to('/') }}/img/icons/manuel.svg" data-toggle="tooltip" data-html="true" title="Manual Gear">--}}
                                                                    {{--<span></span>--}}
                                                                {{--</li>--}}
                                                            {{--@else--}}
                                                                {{--<li class="list-gear img-icon-list" data-content="{{$model->GearType}}">--}}
                                                                    {{--<img src="{{ URL::to('/') }}/img/icons/automat.svg" data-toggle="tooltip" data-placement="top"  title="Automatic Gear">--}}
                                                                    {{--<span id="gear" data-toggle="tooltip" data-placement="top"  title="Automatic Gear">1</span>--}}
                                                                {{--</li>--}}
                                                            {{--@endif--}}

                                                            {{--<li class="list-bag img-icon-list"  data-toggle="tooltip" data-html="true" title="2 big bags"><i class="fas fa-suitcase"></i > 2</li>--}}
                                                        {{--</ul>--}}
                                                        <ul class="car-info-list-booking">
                                                            <li class="list-ac"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px" height="20px"> <i class="fa fa-snowflake-o" aria-hidden="true" data-toggle="tooltip" data-html="true" title="Air conditienr"></i></li>
                                                            <li class="list-ac"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px" height="20px"><img data-toggle="tooltip" data-html="true" title="Doors" src="{{ URL::to('/') }}/img/icons/car-door.svg" width="15px" height="15px"><span style="margin-left: 5px;">{{$model->Doors}}</span></li>
                                                            <li class="list-ac"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px" height="20px"> <img data-toggle="tooltip" data-html="true" title="Seats" src="{{ URL::to('/') }}/img/icons/car-interior-seat.svg" width="15px" height="15px"><span style="margin-left: 5px;">{{$model->Seats}}</span></li>
                                                            @if($model->GearType == 1)
                                                                <li class="list-ac" data-content="{{$model->GearType}}"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px" height="20px"> <img data-toggle="tooltip" data-html="true" title="Manual Gear" src="{{ URL::to('/') }}/img/icons/manuel.svg" width="15px" height="15px"><span style="margin-left: 5px;"></span></li>
                                                            {{--<li class="list-gear img-icon-list" data-content="{{$model->GearType}}">--}}
                                                            {{--<img src="{{ URL::to('/') }}/img/icons/manuel.svg" data-toggle="tooltip" data-html="true" title="Manual Gear">--}}
                                                            {{--<span></span>--}}
                                                            {{--</li>--}}
                                                            @else
                                                                <li class="list-ac" data-content="{{$model->GearType}}"><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px" height="20px"> <img data-toggle="tooltip" data-html="true" title="Automatic Gear" src="{{ URL::to('/') }}/img/icons/automat.svg" width="15px" height="15px"><span style="margin-left: 5px;"></span></li>
                                                            {{--<li class="list-gear img-icon-list" data-content="{{$model->GearType}}">--}}
                                                            {{--<img src="{{ URL::to('/') }}/img/icons/automat.svg" data-toggle="tooltip" data-placement="top"  title="Automatic Gear">--}}
                                                            {{--<span id="gear" data-toggle="tooltip" data-placement="top"  title="Automatic Gear">1</span>--}}
                                                            {{--</li>--}}
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

            <section>
                <div class="container" style="padding-right: 10px;   padding-left: 10px;">
                    <div class="row mt-30">
                        <div class="col-lg-12">

                            <fieldset class="booking-legend" style="min-height:100px;">
                                <legend><b> Какво е включено в цената </b></legend>
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
                                {{--<label><div class="circle-green"></div></label>--}}
                                {{--<label>Цената е с активирано правило</label>--}}
                            </fieldset>

                        </div>
                        {{--<div class="col-sm-5">--}}
                            {{--<div class="map-booking">--}}
                                {{--<div class="col-1-3">--}}
                                    {{--<div class="wrap-col">--}}
                                        {{--<h4>Location</h4>--}}
                                        {{--<div class="wrap-map">--}}
                                            {{--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3164.289259162295!2d-120.7989351!3d37.5246781!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8091042b3386acd7%3A0x3b4a4cedc60363dd!2sMain+St%2C+Denair%2C+CA+95316%2C+Hoa+K%E1%BB%B3!5e0!3m2!1svi!2s!4v1434016649434"--}}
                                                    {{--width="100%" height="200" frameborder="0" style="border:0"></iframe>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    </div>
                </div>

            </section>
            @if(isset($data['insurance']) && count($data['insurance']) > 0)
            <section style="margin-top: 15px">
                <div class="container" style="padding-right: 8px; padding-left: 8px;">
                    <div class="row mt-30">
                        <div class="col-lg-12">
                            <fieldset class="booking-legend" style="min-height:100px;">
                                <legend><b> Застраховки </b></legend>
                                <ul class="car-info-list-booking insurance">
                                <?php $index = 0; ?>
                                    @foreach($data['insurance'] as $insurance)
                        
                                        <?php $index++;
                                       
                                            $insurance_image = 'insurance1.png';
                                        
                                        ?>
                                    <li class="filter-list insurance-list data_insurance_{{$index}}">
                                        <div class="custom-control custom-checkbox mb-3 insurance_checkbox" data-toggle="tooltip" data-placement="top"  title="{{$insurance->insuranceName}}">
                    
                                            <span class="custom-control-indicator" style="padding-right: 24px;" for="extra_checkbox_{{$insurance->id}}"><img src="{{ URL::to('/') }}/img/icons/{{ $insurance_image }}" width="100px" height="100px"></span>
                                           
                                            <input type="checkbox" class="custom-control-input insurance-input-checkbox"  data-ids="{{$insurance->id}}" data-content="{{$insurance->insurancePrice}}" id="insurance_checkbox_{{$insurance->id}}" name="insurance_{{$insurance->id}}" value="{{$insurance->insuranceName}}" {{($insurance->isDefault == 1)? 'checked=checked' :''}}>   
                                            <label  class="custom-control-label insurance-label" for="insurance_checkbox_{{$insurance->id}}">{{$insurance->insuranceName}}</label>
                                            <p style="text-align: center; margin-top: -40px; margin-left: 46px;">
                                            <span  class="insurance-span"> ( {{ $insurance->insurancePrice}} <i class="fa fa-eur" aria-hidden="true"></i>)</span>                                  
                                             </p>
                                        </div>
                                        <div class="include-descr">
                                        @foreach($insurance->descriptions as $insDescription)                           
                                                <p><img src="{{ URL::to('/') }}/img/check-mark1.png" width="20px"
                                                             height="20px">{{$insDescription}}</p>
                                         @endforeach
                                                
                                        </div>
                                    
                                       
                                    </li>
                                    @endforeach
                                 
                                </ul>
                            </fieldset>
                        </div>
                       
                    </div>
                </div>

            </section>
            @endif
            @if(isset($data['rent_extras']) && count($data['rent_extras']) > 0)
            <section style="margin-top: 15px">
                <div class="container" style="padding-right: 8px; padding-left: 8px;">
                    <div class="row mt-30">
                        <div class="col-lg-12">
                            <fieldset class="booking-legend" style="min-height:100px;">
                                <legend><b> Допълнителни екстри </b></legend>
                                <ul class="car-info-list-booking extra">
                                <?php $index = 0; ?>
                                    @foreach($data['rent_extras'] as $rent_extra)
                        
                                        <?php $index++;
                                        if($rent_extra->rental_extra_image && $rent_extra->rental_extra_image != ''){
                                            $extra_image = $rent_extra->rental_extra_image;
                                        }else{
                                            $extra_image = 'extra-icon.jpg';
                                        }
                                        ?>
                                    <li class="filter-list extra-list data_extra_{{$index}}">

                                        <div class="custom-control custom-checkbox mb-3 extra_checkbox" data-toggle="tooltip" data-placement="top"  title="{{$rent_extra->Description}}">
                                            <span class="custom-control-indicator" style="padding-right: 24px;" for="extra_checkbox_{{$rent_extra->id}}"><img src="{{ URL::to('/') }}/img/cars/{{ $extra_image }}" width="40px" height="40px"></span>
                                            <input type="checkbox" class="custom-control-input extra-input-checkbox" data-description="{{$rent_extra->Description}}" data-ids="{{$rent_extra->id}}" data-content="{{$rent_extra->RentExtraPrice}}" data-max="{{$rent_extra->MaxPrice}}"id="extra_checkbox_{{$rent_extra->id}}" name="extra_{{$rent_extra->id}}" value="{{$rent_extra->RentExtraName}}">
                                            @if($rent_extra->RentExtraPrice != 0.00)
                                            <label  class="custom-control-label extra-label" for="extra_checkbox_{{$rent_extra->id}}">{{$rent_extra->RentExtraName}}</label>
                                            <p style="text-align: center;">
                                            <span  class="extra-span"> ( {{ $rent_extra->RentExtraPrice}} <i class="fa fa-eur" aria-hidden="true"></i> /{{($rent_extra->allow_choice == 1)?' за брой' : ''}} на ден)</span>
                                            @else
                                            <label  class="custom-control-label extra-label" for="extra_checkbox_{{$rent_extra->id}}">{{$rent_extra->RentExtraName}}</label>
                                            <span class="extra-span"> (Обадете се за цена)</span>
                                            @endif
                                            
                                            @if($rent_extra->allow_choice == 1 && $rent_extra->choice_number)
                           
                                            <!-- <div class="col-md-3 form-group p_star"> -->
                                            
                                                <select class="extra_count"name="extra_count" data-ids="{{$rent_extra->id}}" id="extra_count_{{$rent_extra->id}}">
                                                    <!-- <option value="" selected>--</option> -->
                                                    <?php
                                                        
                                                        $numCount = $rent_extra->choice_number;
                                                        for ($i=1; $i <= $numCount; $i++) {
                                                            echo "<option value=\"$i\">$i</option>";
                                                        }
                                                    ?>
                                                
                                                </select>
                            
                                                
                                            <!-- </div> -->
                                    
                                            @endif
                                            </p>
                                            @if($rent_extra->MaxPrice != 0.00)
                                            <P  class="extra-p"> (Макс. цена {{$rent_extra->MaxPrice}} <i class="fa fa-eur" aria-hidden="true"></i>/ за брой. )</P>
                                            @else
                                            <P> </P>
                                            @endif
                                        </div>
                                    </li>
                                    @endforeach
                                    
                                </ul>
                            </fieldset>
                        </div>
                       
                    </div>
                </div>

            </section>
            @endif
            {{--<div class="returning_customer">--}}
                {{--<div class="check_title">--}}
                    {{--<h2>Returning Customer? <a href="#">Click here to login</a></h2>--}}
                {{--</div>--}}
                {{--<p>If you have shopped with us before, please enter your details in the boxes below. If you are a new--}}
                    {{--customer, please proceed to the Billing & Shipping section.</p>--}}
                {{--<form class="row contact_form" action="#" method="post" novalidate="novalidate">--}}
                    {{--<div class="col-md-6 form-group p_star">--}}
                        {{--<input type="text" class="form-control" placeholder="Username or Email*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Username or Email*'" id="name" name="name">--}}
                        {{--<!-- <span class="placeholder" data-placeholder="Username or Email"></span> -->--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6 form-group p_star">--}}
                        {{--<input type="password" class="form-control" placeholder="Password*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Password*'" id="password" name="password">--}}
                        {{--<!-- <span class="placeholder" data-placeholder="Password"></span> -->--}}
                    {{--</div>--}}
                    {{--<div class="col-md-12 form-group">--}}
                        {{--<button type="submit" value="submit" class="button button-login">login</button>--}}
                        {{--<div class="creat_account">--}}
                            {{--<input type="checkbox" id="f-option" name="selector">--}}
                            {{--<label for="f-option">Remember me</label>--}}
                        {{--</div>--}}
                        {{--<a class="lost_pass" href="#">Lost your password?</a>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        
            <div class="billing_details" style="margin-top: 30px;">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Лични данни</h3>
                        <div>
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
                            <div class="col-md-12 form-group" style="margin-top: 81px;">
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
                            
                            <div class="col-md-12 form-group p_star" style="margin-top: 81px;">
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


                            <div class="input-group col-md-12">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="file">
                                    <label class="custom-file-label" for="inputGroupFile01">Изберете файл</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                {{--<div class="creat_account" style="    margin-top: 12px;">--}}
                                {{--<input type="checkbox" id="f-option2" name="selector">--}}
                                {{--<label for="f-option2">Създаване на профил?</label>--}}
                                {{--</div>--}}
                                <div class="custom-control custom-checkbox mb-3" style="    margin-top: 12px;">
                                    <input type="checkbox" class="custom-control-input model-input-checkbox"
                                           id="model_checkbox_10" name="model" value="">
                                    <label class="custom-control-label" for="model_checkbox_10">Създаване на
                                        профил?</label>
                                </div>
                                <textarea style="height: 130px;" class="form-control" name="message" id="message"
                                          rows="1" placeholder="Коментар">{{ Input::old('message') }}</textarea>
                            </div>
                            {{--<div class="col-md-12 form-group mb-0">--}}
                            {{--<div class="creat_account">--}}
                            {{--<h3>Shipping Details</h3>--}}
                            {{--<input type="checkbox" id="f-option3" name="selector">--}}
                            {{--<label for="f-option3">Ship to a different address?</label>--}}
                            {{--</div>--}}
                            {{----}}
                            {{--</div>--}}
                            <div class="col-md-12 cupon_area">
                                {{--<div class="check_title">--}}
                                {{--<h2>Have a coupon? <a href="#">Click here to enter your code</a></h2>--}}
                                {{--</div>--}}

                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="cupon_code" name="cupon_code"
                                           placeholder="Въведете код на ваучер" value="{{ Input::old('cupon_code') }}">
                                    <div class="invalid-feedback" id="invalid_cupon_code"> Въведете код.</div>
                                </div>

                                <a class="button button-coupon" href="" onclick="return false;" id="submit-coupon">Приложи ваучер</a>
                            </div>

                      
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list" id="list">
                                <li><a href="#"><h4>Product <span>Total</span></h4></a></li>
                                @if(isset($model->priceRule))
                                    @if(isset($model->priceRule->discount_price))

                                        <li><a href="#">Car <span class="middle"> </span> <span
                                                        class="last">${{$model->priceRule->discount_price}}</span></a>
                                        </li>

                                    @else
                                        <li><a href="#">Car <span class="last">${{$model->priceRule->price}} <i
                                                            class="fa fa-eur" aria-hidden="true"></i></span></a></li>

                                    @endif

                                @else

                                    <li><p>
                                            <span class="title-item">{{$data['car_info'][0]->MakerName}} {{$data['car_info'][0]->ModelName}}</span><span
                                                    class="middle"> </span><span class="item-price"> {{$model->CarBasePrice}}
                                                .00</span><span class="euro-symbol"><i class="fa fa-eur"
                                                                                       aria-hidden="true"></i></span>
                                        </p></li>

                                @endif
                                @if(isset($data['rent_extras']) && count($data['rent_extras']) > 0)
                                    @foreach($data['rent_extras'] as $extra_item)
                                        <li id="ïtem_extra_{{$extra_item->id}}" style="display:none;"><p><span
                                                        class="title-item">{{$extra_item->RentExtraName}}  </span><span
                                                        class="middle">x 01</span><span
                                                        class="item-price"> 0.00</span><span class="euro-symbol"><i
                                                            class="fa fa-eur" aria-hidden="true"></i></span></p></li>
                                    @endforeach
                                @endif
                                <li id="coupon_list" style="display:none;"><p><span
                                                class="title-item">Coupon </span><span class="middle"></span><span
                                                class="item-price"> 0.00</span><span class="euro-symbol"
                                                                                     id="euro-symbol-coupon"><i
                                                    class="fa fa-eur" aria-hidden="true"></i></span></p></li>
                                @if(isset($data['insurance_default']) && count($data['insurance_default']))

                                    @foreach($data['insurance_default'] as $insurance_data_default)
                                        @if($insurance_data_default->isDefault == 1)
                                            <li id="ïtem_insurance_{{$insurance_data_default->id}}"><p><span
                                                            class="title-item">{{$insurance_data_default->insuranceName}}  </span><span
                                                            class="middle">x 01</span><span
                                                            class="item-price"> {{$insurance_data_default->insurancePrice}}</span><span
                                                            class="euro-symbol"><i class="fa fa-eur"
                                                                                   aria-hidden="true"></i></span></p>
                                            </li>
                                        @else
                                            <li id="ïtem_insurance_{{$insurance_data_default->id}}"
                                                style="display:none;"><p><span
                                                            class="title-item">{{$insurance_data_default->insuranceName}}  </span><span
                                                            class="middle">x 01</span><span
                                                            class="item-price"> {{$insurance_data_default->insurancePrice}}</span><span
                                                            class="euro-symbol"><i class="fa fa-eur"
                                                                                   aria-hidden="true"></i></span></p>
                                            </li>
                                        @endif

                                    @endforeach
                                @endif
                            </ul>
                            <ul class="list list_2" id="list-total">
                                {{--<li><a href="#">Subtotal <span>$2160.00</span></a></li>--}}
                                {{--<li><a href="#">driver <span>Flat rate: $50.00</span></a></li>--}}
                                <li>
                                    <div>Total <span class="total-euro">{{$data['total']}}</span><span
                                                class="euro-symbol"><i class="fa fa-eur" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="bgn-total"><span>BGN </span><span class="bgn-value"
                                                                                  id="bgn-value">{{number_format($data['total'] * 1.95583, 2, '.','') }}</span>
                                    </div>
                                </li>
                            </ul>
                            @if(isset($data['paymentsTypes']) && count($data['paymentsTypes']) > 0)
                            @foreach($data['paymentsTypes'] as $paymentType)
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option{{$paymentType->id}}" name="payment" value="{{$paymentType->id}}" {{($paymentType->id == 1)? 'checked' :''}}>
                                    <label for="f-option4">{{$paymentType->PaymentTypeName}}</label>
                                    <div class="check"></div>
                                </div>
                                <p>{{$paymentType->PaymentTypeDescription}}</p>
                            </div>
                            @endforeach                    
                            @else
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option4" name="payment" value="cache" checked>
                                    <label for="f-option4">В брой</label>
                                    <div class="check"></div>
                                </div>
                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County,
                                    Store Postcode.</p>
                            </div>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="payment" value="bank">
                                    <label for="f-option5">По банков път</label>
                                    <div class="check"></div>
                                </div>
                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County,
                                    Store Postcode.</p>
                            </div>
                            <div class="payment_item active">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="payment" value="card">
                                    <label for="f-option6">С банкова карта</label>
                                    <!-- <img src="img/product/card.jpg" alt=""> -->
                                    <div class="check"></div>
                                </div>
                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                    account.</p>
                            </div>
                            @endif

                            <div class="creat_account" style=" text-align: center;">
                                {{--<input type="checkbox" id="f-option4" name="selector">--}}
                                {{--<label for="f-option4">I’ve read and accept the </label>--}}
                                <div class="custom-control custom-checkbox mb-3" style="    margin-top: 12px;">
                                    <input type="checkbox" class="custom-control-input model-input-checkbox"
                                           id="model_checkbox_11" name="model" value="" required>
                                    <label class="custom-control-label" for="model_checkbox_11">Прочетох и се съгласявам
                                        с </label>
                                </div>
                                @include('modal-terms')
                                <a class="btn" data-toggle="modal" data-target="#modal-terms">правила и условия*</a>
                            </div>
                            <div class="text-center">
                            <button type="submit" class="button button-paypal confirm-booking" id="confirm-booking">Продължи към плащането</button>
                                <!-- <a class="button button-paypal confirm-booking" href="javascript:void(0);" target="_parent" id="confirm-booking">Продължи към плащането</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
    </section>
    </form>
    @endif
    <!--================End Checkout Area =================-->

    {{--<section class="extras mb-1">--}}

        {{--<div class="container" style="padding-top: 16px; border: 1px solid ">--}}
            {{--<div class="top-header-title">Extras</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    {{--<section class="customer-info mb-1">--}}
        {{--<div class="container" style="padding-top: 16px; border: 1px solid ">--}}
            {{--<div class="top-header-title">Customer info</div>--}}
        {{--</div>--}}
    {{--</section>--}}

    {{--<section class="payment mb-1">--}}
        {{--<div class="container" style="padding-top: 16px; border: 1px solid ">--}}
            {{--<div class="top-header-title">Pay</div>--}}
        {{--</div>--}}
    {{--</section>--}}

</div>

    {!! Form::open(['method' => 'post', 'route' => 'booking', 'id'=>'bookingForm']) !!}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" id="dateFrom" name="dateFrom" value="">
    <input type="hidden" id="dateTo" name="dateTo" value="">
    <input type="hidden" id="timeFrom" name="timeFrom" value="">
    <input type="hidden" id="timeTo" name="timeTo" value="">
    <input type="hidden" id="cityFrom" name="cityFrom" value="">
    <input type="hidden" id="cityTo" name="cityTo" value="">
    <input type="hidden" id="officeID" name="officeID" value="">
    <input type="hidden" id="modelID" name="modelID" value="">
    <input type="hidden" id="gear" name="gear" value="">
    <input type="hidden" id="price" name="days" value="">

    {!! Form::close() !!}

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
            // $(function() {
            //     $("#createBooking").validate({

            //     // Specify the validation rules
            //     rules: {
            //         name: "required",
            //         last_name: "required",
            //     },

            //     // Specify the validation error messages
            //     messages: {
            //         name: "Lutfen Adres Giriniz",
            //         last_name: "dddddd",
            //     },

            //     submitHandler: function(form) {
            //         form.submit();
            //     }
            //     });

            //     $('#confirm-booking').click(function(){
            //     $("#register-form").valid();
            //     });
            // });
            </script>
@endsection

