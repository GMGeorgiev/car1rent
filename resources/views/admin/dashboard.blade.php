@extends('admin.home')
<<<<<<< HEAD
@section('content')
<link rel="stylesheet" href="{{ asset('libraries/jquery-sked-tape-master/dist/jquery.skedTape.css') }}">
<script src="{{ asset('libraries/jquery-sked-tape-master/dist/jquery.skedTape.js') }}"></script>
    @include('admin.menu')

    <div id="callendar-container" class="container" style="margin-top: 60px;">
=======
@section('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endsection
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
@include('admin.menu')
<div class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Booking Calendar</div>
                    {!! $calendar->calendar() !!}
            </div>
        </div>
        </div>
>>>>>>> 90fd2ec1c5d182a1907831a16e75939c162191b4
    </div>
<script src="{{ asset('js/custom.js') }}"></script>
@endsection
@section('script')
<script src="{{ asset('js/admin-js.js') }}"></script>
<script src="{{ asset('js/fullcalendar.min.js') }}"></script>
{!! $calendar->script() !!}
@endsection
