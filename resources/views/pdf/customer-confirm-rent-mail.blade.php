<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

</head>
<body style="padding-left: 1%;
    padding-right: 1%;">
<div id="head-cont" class="container-header">
    <div class="img-head" style="width: 20%; float: left;">
        <img class="image-logo-header" src="{{asset('img/logo-red-text.png')}}" width="100px" height="50px">
    </div>
    <div class="name-header" style="width: 80%; font-size: 20px; text-align: center;">
        <p>{{ config('app.name') }}</p>
    </div>

</div>

    <style type="text/css">
        * {
            /*font-family: Helvetica, sans-serif;*/
            font-family: "DejaVu Sans", sans-serif;
        }
    </style>
    <div class="container">


        <!-- ================ start banner area ================= -->
        <section class="blog-banner-area" id="category">
                    <div class="text-center" style="text-align: center; ">
                        <h3 style="font-size: 11px;">RESERVATION VOUCHER</h3>

                    </div>


        </section>
        <!-- ================ end banner area ================= -->
        @if (isset($data['error']))
            <p class="help-block">dddd</p>
        @else
            <section class="checkout_area section-margin--small">
                <div class="container">

                    <!--================Order Details Area =================-->
                    <section class="order_details section-margin--small" style="font-size: 13px;">
                        <div class="container">
                            <div class="row mb-5" style="background-color: #e2dcdc6e;">
                                <div class="col-md-6 col-xl-4 mb-4 mb-xl-0" style="padding: 1px;">
                                    <div class="confirmation-card">
                                        <h3 class="billing-title" style="text-align: center; font-size: inherit;    font-weight: 600;">{{  __('language.rentInfo')}}</h3>

                                        <table class="order-table" style="margin: auto;">
                                            <tr>
                                                <td>{{  __('language.bookingNumber')}}</td>
                                                <td>: {{$data['booking']->id}}</td>
                                            </tr>
                                            @if(isset($data['rent_info']['car_info']))
                                            <tr>
                                            @foreach($data['rent_info']['car_info'] as $model)
                                                    <td>{{  __('language.model')}}</td>
                                                    <td>: {{$model->MakerName}} {{$model->ModelName}}</td>
                                            @endforeach
                                            </tr>
                                            @endif
                                            <tr>
                                                <td>{{  __('language.name')}}</td>
                                                <td>: {{$data['customer_data']['name']}} {{$data['customer_data']['last_name']}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.address')}}</td>
                                                <td>: {{$data['customer_data']['customer_address']}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.phone')}}</td>
                                                <td>: {{$data['customer_data']['phone']}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.email')}}</td>
                                                <td>: {{$data['customer_data']['email']}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.date')}}</td>
                                                <td>: {{$data['bookingDate']}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.pickup')}}</td>
                                                <td>: {{$data['cities'][$data['rent_info']['search_info']['cityFrom']]}},  {{$data['rent_info']['search_info']['dateFrom']}} {{$data['rent_info']['search_info']['timeFrom']}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{  __('language.drop')}}</td>
                                                <td>: {{$data['cities'][$data['rent_info']['search_info']['cityTo']]}},  {{$data['rent_info']['search_info']['dateTo']}} {{$data['rent_info']['search_info']['timeTo']}}</td>
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

                            </div>

                            <div class="row mb-5" >
                                <div class="col-md-6 col-xl-4 mb-4 mb-xl-0" style="padding: 1px;">
                            <div class="order_details_table" style="background-color: #e2dcdc6e; padding: 1px;">
                                <h3 class="billing-title" style="text-align: center;   font-size: inherit;  font-weight: 600;">{{  __('language.rentDetails')}}</h3>
                                <div class="table-responsive">
                                    <table class="table" style="margin: auto; width: 50%; text-align: justify;">
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
                            </div>

                            <div class="order_details_table" style="background-color: #e2dcdc6e; padding: 1px;">
                                <h3 style="font-size: inherit; text-align: center;">Contact</h3>
                                <div class="table-responsive" style="    font-size: 9px;">
                                    <table class="data" style="margin: auto;  text-align: justify;">

                                        @if($data['rent_info']['car_info'])
                                            <tr>

                                                <td class="center" style="width: 20px"><span class="label">{{  __('language.office')}}: {{$data['offices'][$data['rent_info']['car_info'][0]->OfficeID]->OfficeName}}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="center" style="width: 20px"><span class="label">{{  __('language.city')}}: {{$data['cities'][$data['offices'][$data['rent_info']['car_info'][0]->OfficeID]->CityID]}}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="center" style="width: 20px"><span class="label">{{  __('language.address')}}: {{$data['offices'][$data['rent_info']['car_info'][0]->OfficeID]->Address}}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="center" style="width: 20px"><span class="label">{{  __('language.phone')}}: {{$data['offices'][$data['rent_info']['car_info'][0]->OfficeID]->Phone}}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="center" style="width: 20px"><span class="label">{{  __('language.email')}}: {{$data['offices'][$data['rent_info']['car_info'][0]->OfficeID]->email}}</span></td>
                                            </tr>

                                        @endif
                                        <tr>
                                            <td style="text-align: center">
                                                <span class="label" style="text-align: center ; font-weight: 600;">{{  __('language.thankYouMail')}}</span>
                                            </td>

                                        </tr>

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

<div id="head-foot" class="container" style="background-color: #e2dcdc6e ;    height: 60px; text-align: center;     padding-top: 1px;">
    <a class="navbar-brand" href="{{ url('/') }}"><p> © {{ date('Y') }} {{ config('app.name') }}</p></a>
</div>
</body>
</html>