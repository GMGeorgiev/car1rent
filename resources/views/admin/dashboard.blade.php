@extends('admin.home')

@section('content')
    @include('admin.menu')
    {{--<div class="content">--}}
    {{--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css" rel="stylesheet" />--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-8 col-md-offset-2">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Full Calendar Example</div>--}}

                    {{--<div class="panel-body">--}}
                        {{--{!! $calendar->calendar() !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>--}}

   {{--{!! $calendar->script() !!}--}}


{{--</div>--}}
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
                        {{--@include('admin.menu')--}}
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
                                                    <span style="color: #fab702">5</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-review">
                                                <h4>Неплатени</h4>
                                                <p>

                                                </p>
                                                <div class="star">
                                                    <span style="color: #fab702">0</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-review">
                                                <h4>Активни</h4>
                                                <p>

                                                </p>
                                                <div class="star">
                                                    <span style="color: #fab702">0</span>

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
@endsection

