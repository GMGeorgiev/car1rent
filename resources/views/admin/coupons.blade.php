@extends('admin.home')

@section('content')
    @include('admin.menu')


    {{--@include('admin.menu')--}}
    <div class="content">
        <div class="admin-main">
            <div class="creat-admin">
                <div class="back" style=" float: right; margin-top: -27px; margin-right: 3px;">
                    <a href = '{{ route('admin.dashboard') }}'>{{  __('language.back')}}</a>
                </div>
            </div>
            <div class="block-country-new">
                <div class="col-md-6 col-md-offset-4" style="margin-left: 1%">
                    <button type="submit" class="btn btn-primary" id="create-coupon">
                        {{  __('language.new')}} {{  __('language.coupon')}}
                    </button>
                </div>
                <div class="inactive-countries-checkbox" style="margin-left: 3%; margin-top: 20px;">
                    <label class="container-checkbox">{{  __('language.inactive')}} {{  __('language.coupons')}}
                        <input id="inActiveCoupons" type="checkbox" {{($data['allCoupons'] == true)? 'checked=checked' :''}}>
                        <span class="checkmark-checkbox"></span>
                    </label>

                </div>
            </div>

            <div class="models">
                <h2>{{  __('language.coupons')}}</h2>
                <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-1">#</div>
                        <div class="col col-2">{{  __('language.coupon')}}</div>
                        <div class="col col-1">{{  __('language.price')}}</div>
                        <div class="col col-1">{{  __('language.date_from')}}</div>
                        <div class="col col-1">{{  __('language.date_to')}}</div>
                        <div class="col col-5" style="flex-basis: 18%;">{{  __('language.description')}}</div>
                        <div class="col col-1">Once</div>
                        <div class="col col-1">Percent</div>
                        <div class="col col-1">{{ __('language.status')}}</div>
                        <div class="col col-3">{{ __('language.action')}}</div>
                    </li>
                    <?php $index = 0; ?>
                    @foreach ($data['coupons'] as $coupon)
                        <?php $index++;?>
                        <li class="table-row item_{{$index}}" style=" {{($coupon->isActive == 0)? 'background-color: #ff9e9efc':  ''}}">

                            {{--<div class="col col-1 cell allow_choice"  data-label="#" data-content="{{ $extra->allow_choice }}" style="display: none"></div>--}}
                            <div class="col col-1 cell iteration" data-label="#">{{$index}}</div>
                            <div class="col col-2 cell name" data-content="{{$coupon->text}}" data-label="Extra">{{$coupon->text}}</div>
                            <div class="col col-1 cell price" data-label="price">{{$coupon->couponPrice}}</div>
                            <div class="col col-1 cell from" data-label="from">{{$coupon->start_date}}</div>
                            <div class="col col-1 cell to" data-label="to">{{$coupon->end_date}}</div>
                            <div class="col col-5 cell description" data-label="{{$coupon->description}}" style="flex-basis: 18%;">{{$coupon->description}}</div>
                            @if($coupon->once)
                                <div class="col col-1 cell once"  data-label="once" data-content="{{ $coupon->once }}" data-once="{{ $coupon->once }}">Да</div>
                            @else
                                <div class="col col-1 cell once"  data-label="once" data-content="{{ $coupon->once }}" data-once="{{ $coupon->once }}">Не</div>
                            @endif
                            @if($coupon->percent)
                                <div class="col col-1 cell percent"  data-label="once" data-content="{{ $coupon->percent }}" data-once="{{ $coupon->percent }}">Да</div>
                            @else
                                <div class="col col-1 cell percent"  data-label="once" data-content="{{ $coupon->percent }}" data-once="{{ $coupon->percent }}">Не</div>
                            @endif
                            @if($coupon->isActive == 1)
                                <div class="col col-1 cell status" data-content="{{$coupon->isActive}}" data-label="{{ __('language.status')}}">{{ __('language.active') }}</div>
                            @else
                                <div class="col col-1 cell status" data-content="{{$coupon->isActive}}" data-label="{{ __('language.status')}}">{{ __('language.inactive') }}</div>
                            @endif

                            <div class="col col-3 cell">
                                <button type="button" class="btn btn-info responsive-btn-left"  id="edit-coupon" data-item-id="{{$coupon->id}}">
                                    <i class="fa fa-edit"></i> {{ __('language.edit') }}
                                </button>
                                {{--<button type="button" class="btn btn-info responsive-btn-right" id="delete-model" data-item-id="{{$model->id}}">--}}
                                {{--<i class="fa fa-trash"></i> {{ __('language.delete') }}--}}
                                {{--</button>--}}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>


        <div class="modal fade" id="create-modal-coupon">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="    background-color: #68b0ea;">
                        <div class="tt" style="width: 80%;">
                            <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>{{  __('language.new')}} {{  __('language.coupon')}}</b></h4>
                        </div>
                        <div class="ti" style="width: 20%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form class='needs-validation' action="{{ route('admin.add-coupon') }}" method='POST' id='createCouponForm' novalidate>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            @if(Session::has('error'))
                                <div class="alert-box success">
                                    <h2>{{ Session::get('error') }}</h2>
                                </div>
                            @endif
                            <div class="box-body">
                                <div class="input-group mb-3" >
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text">{{  __('language.coupon') }}</span>
                                    </div>
                                    <input type="text"  class="form-control"  name="name" id="name"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                    <div class="invalid-feedback">
                                        Въведете текст за кода.
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">{{  __('language.price') }}</span>
                                    </div>
                                    <input type="number" class="form-control"  name="price" id="rent-extra-price" aria-label="Sizing example input"  value="0.00" min="0.01" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" aria-describedby="inputGroup-sizing-default" required>
                                    <div class="invalid-feedback">
                                        Въведете стойност на цена.
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text"  style="width: 50px;" id="inputGroup-sizing-default">От</span>
                                    </div>
                                    <input class="form-control" type="text" name="date_start"  placeholder="..." id="date_start" >
                                    <div class="input-group-append" style="margin-right: 15px;">
                                        <span class="fa fa-calendar input-group-text picker-icon"
                                              aria-hidden="true "></span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Изберете дата на започване.
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text" style="width: 50px;"  id="inputGroup-sizing-default">До</span>
                                    </div>
                                    <input class="form-control" type="text" name="date_end"  placeholder="..." id="date_end" >
                                    <div class="input-group-append" style="margin-right: 15px;">
                                        <span class="fa fa-calendar input-group-text picker-icon"
                                              aria-hidden="true "></span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Изберете дата на свършване.
                                    </div>
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">Description</span>
                                    </div>
                                    <textarea type="text" class="form-control" name="description" id="description" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-default" ></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">

                                        <div class="input-group-text">
                                            <input class="check_number" type="checkbox" name="percent" id="check_percent" aria-label="Checkbox for following text input">
                                        </div>
                                    </div>
                                    <input type="number" class="form-control count_number" name="count_number" id="count_number" aria-label="Text input with checkbox" placeholder="Стоиноста е в проценти" disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">

                                        <div class="input-group-text">
                                            <input class="check_number" type="checkbox" name="once" id="check_once" aria-label="Checkbox for following text input">
                                        </div>
                                    </div>
                                    <input type="number" class="form-control count_number" name="count_number" id="count_number" aria-label="Text input with checkbox" placeholder="Еднократен код" disabled>
                                </div>

                            </div>
                            <div class="error-message">

                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary ">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit-modal-coupon">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="    background-color: #68b0ea;">
                        <div class="tt" style="width: 80%;">
                            <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>{{  __('language.edit')}} {{  __('language.coupon')}}</b></h4>
                        </div>
                        <div class="ti" style="width: 20%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form class='needs-validation' action="{{ route('admin.edit-coupon') }}" method='POST' id='editCouponForm' novalidate>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            @if(Session::has('error'))
                                <div class="alert-box success">
                                    <h2>{{ Session::get('error') }}</h2>
                                </div>
                            @endif
                            <div class="box-body">
                                <input type="hidden" class="form-control" name="coupon_id" id="coupon-id-edit" placeholder="Fleet ID" >
                                <div class="input-group mb-3" >
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text">{{  __('language.coupon') }}</span>
                                    </div>
                                    <input type="text"  class="form-control"  name="name" id="name-edit-coupon"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                    <div class="invalid-feedback">
                                        Въведете текст за кода.
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">{{  __('language.price') }}</span>
                                    </div>
                                    <input type="number" class="form-control"  name="price" id="price-edit-coupon" aria-label="Sizing example input"  value="0.00" min="0.01" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" aria-describedby="inputGroup-sizing-default" required>
                                    <div class="invalid-feedback">
                                        Въведете стойност на цена.
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text"  style="width: 50px;" id="inputGroup-sizing-default">От</span>
                                    </div>
                                    <input class="form-control" type="text" name="date_start"  placeholder="..." id="edit-date_start" >
                                    <div class="input-group-append" style="margin-right: 15px;">
                                        <span class="fa fa-calendar input-group-text picker-icon"
                                              aria-hidden="true "></span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Изберете дата на започване.
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text" style="width: 50px;"  id="inputGroup-sizing-default">До</span>
                                    </div>
                                    <input class="form-control" type="text" name="date_end"  placeholder="..." id="edit-date_end" >
                                    <div class="input-group-append" style="margin-right: 15px;">
                                        <span class="fa fa-calendar input-group-text picker-icon"
                                              aria-hidden="true "></span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Изберете дата на свършване.
                                    </div>
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">Description</span>
                                    </div>
                                    <textarea type="text" class="form-control" name="description" id="description-edit-coupon" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-default" ></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">

                                        <div class="input-group-text">
                                            <input class="check_number" type="checkbox" name="percent" id="check_percent-edit-coupon" aria-label="Checkbox for following text input">
                                        </div>
                                    </div>
                                    <input type="number" class="form-control count_number" name="count_number" id="count_number-edit-coupon" aria-label="Text input with checkbox" placeholder="Стоиноста е в проценти" disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">

                                        <div class="input-group-text">
                                            <input class="check_number" type="checkbox" name="once" id="check_once-edit-coupon" aria-label="Checkbox for following text input">
                                        </div>
                                    </div>
                                    <input type="number" class="form-control count_number" name="count_number" id="count_number" aria-label="Text input with checkbox" placeholder="Еднократен код" disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.status')}}</span>
                                    </div>
                                    <select class="custom-select" name="status" id="status-edit-coupon" required>
                                        <option value="0">In Active</option>
                                        <option value="1">Active</option>
                                    </select>
                                    <div class="invalid-feedback">

                                    </div>
                                    {{--<input type="text" class="form-control" id="info-ac" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>--}}
                                </div>

                            </div>
                            <div class="error-message">

                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary ">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



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

        var localeJquery = $('html').attr('lang');
        $.noConflict();
        jQuery(document).ready(function ($) {
            $('#date_start').datetimepicker({
                locale: moment.locale(localeJquery),
                format: 'DD-MM-YYYY',
            });

            $('#date_end').datetimepicker({
                locale: moment.locale(localeJquery),
                format: 'DD-MM-YYYY',
                useCurrent: false, //Important! See issue #1075
            });


            $("#date_start").on("dp.change", function (e) {
                $('#date_end').data("DateTimePicker").minDate(e.date);
            });
            $("#date_end").on("dp.change", function (e) {
                $('#date_start').data("DateTimePicker").maxDate(e.date);
            });

            $('#edit-date_start').datetimepicker({
                locale: moment.locale(localeJquery),
                format: 'DD-MM-YYYY',
            });

            $('#edit-date_end').datetimepicker({
                locale: moment.locale(localeJquery),
                format: 'DD-MM-YYYY',
                useCurrent: false, //Important! See issue #1075
            });


            $("#edit-date_start").on("dp.change", function (e) {
                $('#edit-date_end').data("DateTimePicker").minDate(e.date);
            });
            $("#edit-date_end").on("dp.change", function (e) {
                $('#edit-date_start').data("DateTimePicker").maxDate(e.date);
            });
        });


    </script>

@endsection

