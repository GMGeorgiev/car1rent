@extends('admin.home')
@section('content')
<link rel="stylesheet" href="{{ asset('libraries/jquery-sked-tape-master/dist/jquery.skedTape.css') }}">
<script src="{{ asset('libraries/jquery-sked-tape-master/dist/jquery.skedTape.js') }}"></script>
    @include('admin.menu')

    <div id="callendar-container" class="container" style="margin-top: 60px;">
    </div>
<script src="{{ asset('js/custom.js') }}"></script>
@endsection

