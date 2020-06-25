@extends('admin.home')
@section('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endsection
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
@include('admin.menu')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Booking Calendar</div>
                    {!! $calendar->calendar() !!}
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ asset('js/admin-js.js') }}"></script>
<script src="{{ asset('js/fullcalendar.min.js') }}"></script>
{!! $calendar->script() !!}
@endsection
