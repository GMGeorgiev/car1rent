@extends('admin.home')

@section('content')
    @include('admin.menu')

    <div class="content">
        <div class="admin-main">
            <div class="creat-admin">
                <div class="back" style=" float: right;  margin-right: 3px;">
                    <a href = '{{ route('admin.dashboard') }}'>Назад</a>
                </div>
            </div>

            <div class="cities">
                <h2>{{  __('language.rentInfo')}}</h2>
                <ul class="responsive-table">
                    <li class="table-header"   style="font-size: 13px; text-transform: none;">
                        <div class="col col-1 small-column">#</div>
                        <div class="col col-1 small-column">{{ __('language.bookingNumber')}}</div>
                        <div class="col col-2 small-column" >{{ __('language.date_from')}}</div>
                        <div class="col col-2 small-column" >{{ __('language.date_to')}}</div>
                        <div class="col col-2 small-column ">{{ __('language.user')}}</div>
                        <div class="col col-1 small-column">{{ __('language.maker')}}</div>
                        <div class="col col-1 small-column">{{ __('language.model')}}</div>
                        <div class="col col-1 small-column">{{ __('language.regNumber')}}</div>
                        <div class="col col-1 small-column">{{ __('language.name')}}</div>
                        <div class="col col-1 small-column">{{ __('language.lastName')}}</div>
                        <div class="col col-1 small-column">{{ __('language.status')}}</div>
                        <div class="col col-1 small-column">{{ __('language.paid')}}</div>
                        <div class="col col-3"></div>
                    </li>
                    <?php $index = 0; ?>
                    @foreach ($data['all_bookings'] as $booking)
                        <?php $index++; ?>
                        <li class="table-row item_{{$index}}" style="font-size: 12px; {{($booking->payment_status == 3)? 'background-color: #ff9e9efc':  ''}}">
                            <div class="col col-1 cell small-column iteration" data-label="#">{{$index}}</div>
                            <div class="col col-1 cell small-column booking" data-content="{{$booking->id}}" data-label="{{ __('language.bookingNumber')}}">{{$booking->id}}</div>
                            <div class="col col-2 cell small-column date_from" data-label="{{ __('language.date_from')}}">{{$booking->from_date}}</div>
                            <div class="col col-2 cell small-column date_to" data-label="{{ __('language.date_to')}}">{{$booking->to_date}}</div>
                            <div class="col col-2 cell small-column user" data-content="{{$booking->user_id}}" data-label="{{ __('language.user')}}">{{$booking->UserName}}</div>
                            <div class="col col-1 cell small-column maker" data-label="{{ __('language.maker')}}">{{$booking->MakerName}}</div>
                            <div class="col col-1 cell small-column model" data-label="{{ __('language.model')}}">{{$booking->ModelName}}</div>
                            <div class="col col-1 cell small-column regNumber" data-label="{{ __('language.regNumber')}}">{{$booking->RegNumber}}</div>
                            <div class="col col-1 cell small-column name" data-label="{{ __('language.name')}}">{{$booking->CustomerName}}</div>
                            <div class="col col-1 cell small-column last_name" data-label="{{ __('language.lastName')}}">{{$booking->CustomerLastName}}</div>
                            <div class="col col-1 cell small-column status" data-label="{{ __('language.status')}}">{{$booking->BookingStatusName}}</div>
                            <div class="col col-1 cell small-column paid" data-label="{{ __('language.status')}}">{{$booking->PaymentStatusName}}</div>

                            <div class="col col-3 cell">
                                <button type="button" class="btn btn-info responsive-btn-left"  id="edit-price-rule" data-item-id="{{$booking->id}}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-info responsive-btn-right" id="info-price-rule" data-item-id="{{$booking->id}}">
                                    <i class="fa fa-info"></i>
                                </button>
                                {{--<button type="button" class="btn btn-info responsive-btn-right" id="delete-city" data-item-id="{{$city->id}}">--}}
                                {{--<i class="fa fa-trash"></i> --}}
                                {{--</button>--}}
                            </div>
                        </li>
                    @endforeach
                </ul>

                @if ($data['all_bookings']->lastPage() > 1)
                    <ul class="pagination">
                        <li class="page-item {{ ($data['all_bookings']->currentPage() == 1) ? ' disabled' : '' }}">
                            <a class="page-link" href="{{ $data['all_bookings']->url(1) }}"><span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span></a>
                        </li>
                        @for ($i = 1; $i <= $data['all_bookings']->lastPage(); $i++)
                            <li class="page-item {{ ($data['all_bookings']->currentPage() == $i) ? ' active' : '' }}">
                                <a href="{{ $data['all_bookings']->url($i) }}" class="page-link">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ ($data['all_bookings']->currentPage() == $data['all_bookings']->lastPage()) ? ' disabled' : '' }}">
                            <a class="page-link" href="{{ $data['all_bookings']->url($data['all_bookings']->currentPage()+1) }}" >&raquo;</a>
                        </li>
                    </ul>
                @endif
            </div>


        </div>

        <div class="modal fade" id="create-modal-price">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="tt" style="width: 80%;">
                            <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>{{  __('language.newA')}} {{  __('language.price')}}</b></h4>
                        </div>
                        <div class="ti" style="width: 20%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['method' => 'post', 'route' => 'admin.price-settings.add-price', 'id'=>'createPriceForm']) !!}
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        @if(Session::has('error'))
                            <div class="alert-box success">
                                <h2>{{ Session::get('error') }}</h2>
                            </div>
                        @endif
                        <div class="box-body">
                            @if($data['app_languages'])

                                @foreach ($data['app_languages'] as $app_language)
                                    <?php $lang = $app_language->iso; ?>
                                    <div id="name_{{$app_language->iso}}-group"
                                         class="form-group has-feedback @if ($errors->has('name_'. $lang)) has-error @endif">
                                        <label for="modal-input-name-{{$app_language->iso}}">{{  __('language.price') }}-{{$app_language->iso}}</label>
                                        <input type="text" class="form-control" name="name_{{$app_language->iso}}" id="name-price-{{$app_language->iso}}"
                                               placeholder="{{  __('language.enter')}} {{  __('language.price')}}-{{$app_language->iso}}">
                                        <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name_'. $lang)) has-error @endif"></span>
                                        @if ($errors->has('name_'. $lang)) <p
                                                class="help-block">{{ $errors->first('name_'. $lang) }}</p> @endif
                                        <div id="name_{{$app_language->iso}}_error" class="help-text"></div>
                                    </div>
                                @endforeach
                            @else
                                <div id="name-group"
                                     class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                                    <label for="modal-input-name">{{  __('language.price') }}</label>
                                    <input type="text" class="form-control" name="name-bg" id="name-price"
                                           placeholder="{{  __('language.price')}}">
                                    <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name')) has-error @endif"></span>
                                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                                    <div id="name_error" class="help-text"></div>
                                </div>
                            @endif

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit-modal-price">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="tt" style="width: 80%;">
                            <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>{{  __('language.edit')}} {{  __('language.price')}}</b></h4>
                        </div>
                        <div class="ti" style="width: 20%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['method' => 'post', 'route' => 'admin.price-settings.edit-price', 'id'=>'editPriceForm']) !!}
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        @if(Session::has('error'))
                            <div class="alert-box success">
                                <h2>{{ Session::get('error') }}</h2>
                            </div>
                        @endif
                        <div class="box-body">
                            @if($data['app_languages'])
                                <input type="hidden" class="form-control" name="price_id" id="price-id-edit" placeholder="Fleet ID" >
                                @foreach ($data['app_languages'] as $app_language)
                                    <?php $lang = $app_language->iso; ?>
                                    <div id="name_{{$app_language->iso}}-group"
                                         class="form-group has-feedback @if ($errors->has('name_'. $lang)) has-error @endif">
                                        <label for="modal-input-name-{{$app_language->iso}}">{{  __('language.price') }}-{{$app_language->iso}}</label>
                                        <input type="text" class="form-control" name="name_{{$app_language->iso}}" id="name-price-{{$app_language->iso}}-edit"
                                               placeholder="{{  __('language.coupe')}}-{{$app_language->iso}}">
                                        <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name_'. $lang)) has-error @endif"></span>
                                        @if ($errors->has('name_'. $lang)) <p
                                                class="help-block">{{ $errors->first('name_'. $lang) }}</p> @endif
                                        <div id="name_{{$app_language->iso}}_error" class="help-text"></div>
                                    </div>
                                @endforeach
                            @else
                                <div id="name-group"
                                     class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                                    <label for="modal-input-name">{{  __('language.price') }}</label>
                                    <input type="text" class="form-control" name="name-bg" id="name-price-edit"
                                           placeholder="{{  __('language.price')}}">
                                    <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name')) has-error @endif"></span>
                                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                                    <div id="name_error" class="help-text"></div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select type="text" class="form-control" name="status" id="status-edit-price" >
                                    <option value="0">In Active</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="create-modal-price-rule">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="    background-color: #68b0ea;">
                        <div class="tt" style="width: 80%;">
                            <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>{{  __('language.create')}} {{  __('language.price-rule')}}</b></h4>
                        </div>
                        <div class="ti" style="width: 20%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form class='needs-validation' action="{{ route('admin.price-settings.add-price-rule') }}" method='POST' id='createPriceRuleForm' novalidate>
                            {{--{!! Form::open(['class' => 'needs-validation', 'method' => 'post', 'novalidate' => 'novalidate' ,'route' => 'admin.price-settings.add-price-rule', 'id'=>'createPriceRuleForm']) !!}--}}
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            @if(Session::has('error'))
                                <div class="alert-box success">
                                    <h2>{{ Session::get('error') }}</h2>
                                </div>
                            @endif
                            <div class="box-body">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.price')}} {{ __('language.name')}}</span>
                                    </div>
                                    <select class="custom-select" name="name" id="price-rule-id" required>
                                        @if($data['prices'])
                                            <option value="" selected style="background-color: #D5D8DC">Изберете...</option>

                                            @foreach($data['prices'] as $price)
                                                {{--@if($price->isUsed == 0)--}}
                                                <option value="{{{$price->id}}}">{{{$price->Name}}}</option>
                                                {{--@endif--}}
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        Изберете цена.
                                    </div>
                                    {{--<input type="text" class="form-control" id="info-ac" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>--}}
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.model')}}</span>
                                    </div>
                                    <select class="custom-select" name="model" id="price-rule-model-id" required>
                                        @if($data['models'])
                                            <option value="" selected style="background-color: #D5D8DC">Изберете...</option>

                                            @foreach($data['models'] as $model)
                                                <option value="{{{$model->id}}}">{{{$model->ModelName}}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        Изберете модел.
                                    </div>
                                    {{--<input type="text" class="form-control" id="info-ac" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>--}}
                                </div>

                                <section style="margin: 10px;">
                                    <fieldset style="min-height:100px; width: auto">
                                        <legend><b> {{ __('language.prices') }} </b> </legend>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default"> 1 ден</span>
                                            </div>
                                            <input type="number" style="margin-right: 15px;" class="form-control"  name="price1" id="price-rule-price1" value="0.00" min="0.01" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Въведете стойност на цена за ден.
                                            </div>
                                        </div>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend ">
                                                <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default"> 2-4 дни</span>
                                            </div>
                                            <input type="number" class="form-control" style="margin-right: 15px;" name="price2_4" id="price-rule-price2_4"  aria-label="Sizing example input" min="0.01" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100"  value="0.00" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Въведете стойност на цена за 2-4 дни.
                                            </div>
                                        </div>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default"> 5-7 дни</span>
                                            </div>
                                            <input type="number" class="form-control" style="margin-right: 15px;" name="price_5_7" id="price-rule-price5_7" aria-label="Sizing example input" min="0.01" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100"  value="0.00" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Въведете стойност на цена за 5-7 дни.
                                            </div>
                                        </div>
                                        <small>Не задължителни (0.00 = Запитване) </small>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default"> 8-15 дни</span>
                                            </div>
                                            <input type="number" class="form-control" style="margin-right: 15px;" name="price_8_15" id="price-rule-price8_15" aria-label="Sizing example input"  step="0.01" data-number-to-fixed="2" data-number-stepfactor="100"  value="0.00" aria-describedby="inputGroup-sizing-default">
                                            <div class="invalid-feedback">
                                                Въведете стойност на цена за 8-15 дни.
                                            </div>
                                        </div>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default"> 16-30 дни</span>
                                            </div>
                                            <input type="number" class="form-control" style="margin-right: 15px;" name="price_16_30" id="price-rule-price16_30" aria-label="Sizing example input"  step="0.01" data-number-to-fixed="2" data-number-stepfactor="100"  value="0.00" aria-describedby="inputGroup-sizing-default">
                                            <div class="invalid-feedback">
                                                Въведете стойност на цена за 16_30 дни.
                                            </div>
                                        </div>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default"> 31+ дни</span>
                                            </div>
                                            <input type="number" class="form-control" style="margin-right: 15px;" name="price_31" id="price-rule-price31" aria-label="Sizing example input"  step="0.01" data-number-to-fixed="2" data-number-stepfactor="100"  value="0.00" aria-describedby="inputGroup-sizing-default">
                                            <div class="invalid-feedback">
                                                Въведете стойност на цена за 31+ дни.
                                            </div>
                                        </div>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default"> Weekend</span>
                                            </div>
                                            <input type="number" class="form-control" style="margin-right: 15px;" name="price_weekend" id="price-rule-price_weekend" aria-label="Sizing example input"  step="0.01" data-number-to-fixed="2" data-number-stepfactor="100"  value="0.00" aria-describedby="inputGroup-sizing-default">
                                            <div class="invalid-feedback">
                                                Въведете стойност на цена за weekend.
                                            </div>
                                        </div>
                                        {{--<label><div class="circle-green"></div></label>--}}
                                        {{--<label>Цената е с активирано правило</label>--}}
                                    </fieldset>
                                </section>
                                {{--<div id="price-group" class="form-group has-feedback @if ($errors->has('price')) has-error @endif">--}}
                                {{--<label for="exampleInputEmail1">{{ __('language.price')}}</label>--}}
                                {{--<input type="text" class="form-control" name="price" id="price-rule-price" placeholder="Enter Price">--}}
                                {{--<span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('price')) has-error @endif"></span>--}}
                                {{--@if ($errors->has('price')) <p class="help-block">{{ $errors->first('price') }}</p> @endif--}}
                                {{--<div id ="price_error" class="help-text"></div>--}}
                                {{--</div>--}}
                                {{--<div id="price1-group" class="form-group has-feedback @if ($errors->has('price1')) has-error @endif">--}}
                                {{--<label for="exampleInputEmail1">{{ __('language.price')}} 1 day</label>--}}
                                {{--<input type="text" class="form-control" name="price1" id="price-rule-price1" placeholder="Enter Price for 1 day">--}}
                                {{--<span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('price1')) has-error @endif"></span>--}}
                                {{--@if ($errors->has('price1')) <p class="help-block">{{ $errors->first('price1') }}</p> @endif--}}
                                {{--<div id ="price1_error" class="help-text"></div>--}}
                                {{--</div>--}}
                                {{--<div id="price2-group" class="form-group has-feedback @if ($errors->has('price2')) has-error @endif">--}}
                                {{--<label for="exampleInputEmail1">{{ __('language.price')}} 2 days</label>--}}
                                {{--<input type="text" class="form-control" name="price2" id="price-rule-price2" placeholder="Enter Price for 2 days">--}}
                                {{--<span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('price2')) has-error @endif"></span>--}}
                                {{--@if ($errors->has('price2')) <p class="help-block">{{ $errors->first('price2') }}</p> @endif--}}
                                {{--<div id ="price2_error" class="help-text"></div>--}}
                                {{--</div>--}}
                                {{--<div id="price3-group" class="form-group has-feedback @if ($errors->has('price3')) has-error @endif">--}}
                                {{--<label for="exampleInputEmail1">{{ __('language.price')}} 3 days</label>--}}
                                {{--<input type="text" class="form-control" name="price3" id="price-rule-price3" placeholder="Enter Price for 3 days">--}}
                                {{--<span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('price3')) has-error @endif"></span>--}}
                                {{--@if ($errors->has('price3')) <p class="help-block">{{ $errors->first('price3') }}</p> @endif--}}
                                {{--<div id ="price3_error" class="help-text"></div>--}}
                                {{--</div>--}}

                                <section style="margin: 10px;">
                                    <fieldset style="min-height:100px; width: auto">
                                        <legend><b> Период на валидност </b> </legend>

                                        <div id="date_start-group" class="form-group has-feedback @if ($errors->has('date_start')) has-error @endif">
                                            {{--<label for="">End to</label>--}}
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text custom-input-group-text"  style="width: 50px;" id="inputGroup-sizing-default">От</span>
                                                </div>
                                                <input class="form-control" type="text" name="date_start"  placeholder="Изберете..." id="date_start" required>
                                                <div class="input-group-append" style="margin-right: 15px;">
                                        <span class="fa fa-calendar input-group-text picker-icon"
                                              aria-hidden="true "></span>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Изберете дата на започване.
                                                </div>
                                            </div>
                                            {{--@if ($errors->has('date_start')) <p class="help-block">{{ $errors->first('date_start') }}</p> @endif--}}
                                            {{--<div id="date_start_error" class="help-text"></div>--}}
                                        </div>
                                        <div id="date_end-group" class="form-group has-feedback @if ($errors->has('date_end')) has-error @endif">
                                            {{--<label for="">End to</label>--}}
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text custom-input-group-text" style="width: 50px;"  id="inputGroup-sizing-default">До</span>
                                                </div>
                                                <input class="form-control" type="text" name="date_end"  placeholder="Изберете..." id="date_end" required>
                                                <div class="input-group-append" style="margin-right: 15px;">
                                        <span class="fa fa-calendar input-group-text picker-icon"
                                              aria-hidden="true "></span>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Изберете дата на свършване.
                                                </div>
                                            </div>
                                            {{--@if ($errors->has('date_end')) <p class="help-block">{{ $errors->first('date_end') }}</p> @endif--}}
                                            {{--<div id="date_end_error" class="help-text"></div>--}}
                                        </div>
                                    </fieldset>
                                </section>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default"> {{  __('language.discount') }}</span>
                                    </div>
                                    <input type="number" class="form-control"  name="discount" id="price-rule-discount" aria-label="Sizing example input" min="0" step="1" data-number-to-fixed="2" data-number-stepfactor="100"  value="0" aria-describedby="inputGroup-sizing-default">
                                    <div class="input-group-append">
                                        <span class="fa fa-percent input-group-text picker-icon"
                                              aria-hidden="true "></span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Въведете стойност за отстъпка.
                                    </div>
                                </div>
                                {{--<div class="form-group">--}}
                                {{--<label for="exampleInputEmail1">AC</label>--}}
                                {{--<select type="text" class="form-control" name="ac" id="ac" >--}}
                                {{--<option value="-1">Select AC</option>--}}
                                {{--<option value="0">No</option>--}}
                                {{--<option value="1">Yes</option>--}}
                                {{--</select>--}}
                                {{--</div>--}}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.gear')}}</span>
                                    </div>
                                    <select class="custom-select" name="gear" id="gear" required>
                                        <option value="" selected style="background-color: #D5D8DC">Изберете...</option>
                                        <option value="0">Manual</option>
                                        <option value="1">Automatic</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Изберете тип на скоростната кутия.
                                    </div>
                                    {{--<input type="text" class="form-control" id="info-ac" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>--}}
                                </div>

                                {{--<div class="form-group">--}}
                                {{--<label for="exampleInputEmail1">Gear Type</label>--}}
                                {{--<select type="text" class="form-control" name="gear" id="gear" >--}}
                                {{--<option value="-1">Select Gear Type</option>--}}
                                {{--<option value="0">Manual</option>--}}
                                {{--<option value="1">Automatic</option>--}}
                                {{--</select>--}}
                                {{--</div>--}}
                            </div>
                            <div class="error-message">

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary ">Save</button>
                            </div>
                        </form>
                        {{--{!! Form::close() !!}--}}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="edit-modal-price-rule">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="    background-color: #68b0ea;">
                    <div class="tt" style="width: 80%;">
                        <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>{{  __('language.edit')}} {{  __('language.price-rule')}}</b></h4>
                    </div>
                    <div class="ti" style="width: 20%;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <form class='needs-validation' action="{{ route('admin.price-settings.edit-price-rule') }}" method='POST' id='editPriceRuleForm' novalidate>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        @if(Session::has('error'))
                            <div class="alert-box success">
                                <h2>{{ Session::get('error') }}</h2>
                            </div>
                        @endif
                        <div class="box-body">
                            <input type="hidden" class="form-control" name="rule_id" id="price-rule-id-edit" placeholder="User ID" >
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.price')}} {{ __('language.name')}}</span>
                                </div>
                                <select class="custom-select" name="name" id="edit-price-rule-id" required>
                                    @if($data['prices'])
                                        <option value="" selected style="background-color: #D5D8DC">Изберете...</option>

                                        @foreach($data['prices'] as $price)
                                            {{--@if($price->isUsed == 0)--}}
                                            <option value="{{{$price->id}}}">{{{$price->Name}}}</option>
                                            {{--@endif--}}
                                        @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    Изберете цена.
                                </div>
                                {{--<input type="text" class="form-control" id="info-ac" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>--}}
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.model')}}</span>
                                </div>
                                <select class="custom-select" name="model" id="edit-price-rule-model-id" required>
                                    @if($data['models'])
                                        <option value="" selected style="background-color: #D5D8DC">Изберете...</option>

                                        @foreach($data['models'] as $model)
                                            <option value="{{{$model->id}}}">{{{$model->ModelName}}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    Изберете модел.
                                </div>
                                {{--<input type="text" class="form-control" id="info-ac" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>--}}
                            </div>

                            <section style="margin: 10px;">
                                <fieldset style="min-height:100px; width: auto">
                                    <legend><b> {{ __('language.prices') }} </b> </legend>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">1 ден</span>
                                        </div>
                                        <input type="number" style="margin-right: 15px;" class="form-control"  name="price1" id="edit-price-rule-price1" value="0.00" min="0.01" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                        <div class="invalid-feedback">
                                            Въведете стойност на цена за ден.
                                        </div>
                                    </div>

                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">2-4 дни</span>
                                        </div>
                                        <input type="number" style="margin-right: 15px;" class="form-control"  name="price2_4" id="edit-price-rule-price2_4" value="0.00" min="0.01" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                        <div class="invalid-feedback">
                                            Въведете стойност на цена за 2-4 дни.
                                        </div>
                                    </div>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">5-7 дни</span>
                                        </div>
                                        <input type="number" style="margin-right: 15px;" class="form-control"  name="price5_7" id="edit-price-rule-price5_7" value="0.00" min="0.01" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                        <div class="invalid-feedback">
                                            Въведете стойност на цена за 5-7 дни.
                                        </div>
                                    </div>

                                    <small>Не задължителни (0.00 = Запитване) </small>

                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">8-15 дни</span>
                                        </div>
                                        <input type="number" style="margin-right: 15px;" class="form-control"  name="price8_15" id="edit-price-rule-price8_15" value="0.00" min="0.00" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
                                        <div class="invalid-feedback">
                                            Въведете стойност на цена за 8-15 дни.
                                        </div>
                                    </div>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">8-15 дни</span>
                                        </div>
                                        <input type="number" style="margin-right: 15px;" class="form-control"  name="price16_30" id="edit-price-rule-price_16_30" value="0.00" min="0.00" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
                                        <div class="invalid-feedback">
                                            Въведете стойност на цена за 16-30 дни.
                                        </div>
                                    </div>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">8-15 дни</span>
                                        </div>
                                        <input type="number" style="margin-right: 15px;" class="form-control"  name="price31" id="edit-price-rule-price_31" value="0.00" min="0.00" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
                                        <div class="invalid-feedback">
                                            Въведете стойност на цена за 31+ дни.
                                        </div>
                                    </div>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default">8-15 дни</span>
                                        </div>
                                        <input type="number" style="margin-right: 15px;" class="form-control"  name="price_weekend" id="edit-price-rule-price_weekend" value="0.00" min="0.00" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
                                        <div class="invalid-feedback">
                                            Въведете стойност на цена за weekend.
                                        </div>
                                    </div>


                                    {{--<label><div class="circle-green"></div></label>--}}
                                    {{--<label>Цената е с активирано правило</label>--}}
                                </fieldset>
                            </section>
                            <section style="margin: 10px;">
                                <fieldset style="min-height:100px; width: auto">
                                    <legend><b> Период на валидност </b> </legend>

                                    <div id="date_start-group" class="form-group has-feedback @if ($errors->has('date_start')) has-error @endif">
                                        {{--<label for="">End to</label>--}}
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text custom-input-group-text"  style="width: 50px;" id="inputGroup-sizing-default">От</span>
                                            </div>
                                            <input class="form-control" type="text" name="date_start"  placeholder="Изберете..." id="edit-date_start" required>
                                            <div class="input-group-append" style="margin-right: 15px;">
                                        <span class="fa fa-calendar input-group-text picker-icon"
                                              aria-hidden="true "></span>
                                            </div>
                                            <div class="invalid-feedback">
                                                Изберете дата на започване.
                                            </div>
                                        </div>
                                        {{--@if ($errors->has('date_start')) <p class="help-block">{{ $errors->first('date_start') }}</p> @endif--}}
                                        {{--<div id="date_start_error" class="help-text"></div>--}}
                                    </div>
                                    <div id="date_end-group" class="form-group has-feedback @if ($errors->has('date_end')) has-error @endif">
                                        {{--<label for="">End to</label>--}}
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text custom-input-group-text" style="width: 50px;"  id="inputGroup-sizing-default">До</span>
                                            </div>
                                            <input class="form-control" type="text" name="date_end"  placeholder="Изберете..." id="edit-date_end" required>
                                            <div class="input-group-append" style="margin-right: 15px;">
                                        <span class="fa fa-calendar input-group-text picker-icon"
                                              aria-hidden="true "></span>
                                            </div>
                                            <div class="invalid-feedback">
                                                Изберете дата на свършване.
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </section>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default"> {{  __('language.discount') }}</span>
                                </div>
                                <input type="number" class="form-control"  name="discount" id="edit-price-rule-discount" aria-label="Sizing example input" min="0" step="1" data-number-to-fixed="2" data-number-stepfactor="100"  value="0" aria-describedby="inputGroup-sizing-default">
                                <div class="input-group-append">
                                        <span class="fa fa-percent input-group-text picker-icon"
                                              aria-hidden="true "></span>
                                </div>
                                <div class="invalid-feedback">
                                    Въведете стойност за отстъпка.
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.gear')}}</span>
                                </div>
                                <select class="custom-select" name="gear" id="edit-gear" required>
                                    <option value="" selected style="background-color: #D5D8DC">Изберете...</option>
                                    <option value="0">Manual</option>
                                    <option value="1">Automatic</option>
                                </select>
                                <div class="invalid-feedback">
                                    Изберете тип на скоростната кутия.
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">Статус</span>
                                </div>
                                <select class="custom-select" name="status" id="edit-price-rule-status" required>
                                    <option value="0">In Active</option>
                                    <option value="1">Active</option>
                                </select>
                                <div class="invalid-feedback">
                                    Изберете тип на скоростната кутия.
                                </div>
                            </div>

                        </div>
                        <div class="error-message"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="info-modal-price-rule">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="    background-color: #68b0ea;">
                    <div class="tt" style="width: 80%;">
                        <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>Info Price rule</b></h4>
                    </div>
                    <div class="ti" style="width: 20%;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    {!! Form::open([ 'id'=>'infoInfoRuleForm']) !!}
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="box-body">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.price')}} {{ __('language.name')}}</span>
                            </div>
                            <input type="text" class="form-control" id="info-name-rule" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">Date from</span>
                            </div>
                            <input type="text" class="form-control" id="info-date_from-rule" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">Date to</span>
                            </div>
                            <input type="text" class="form-control" id="info-date_to-rule" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.model')}}</span>
                            </div>
                            <input type="text" class="form-control" id="info-model-rule" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">Year</span>
                            </div>
                            <input type="text" class="form-control" id="info-year" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                        </div>
                        <section style="margin: 10px;">
                            <fieldset style="min-height:100px; width: auto">
                                <legend><b> {{ __('language.prices') }} </b> </legend>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">ден</span>
                                    </div>
                                    <input type="text" class="form-control"  style="margin-right: 15px;" name="price1" id="info-price-rule-price1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text" name="price1" id="inputGroup-sizing-default">2-4 дни</span>
                                    </div>
                                    <input type="text" class="form-control"  style="margin-right: 15px;" name="price2_4" id="info-price-rule-price2_4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">5-7 дни</span>
                                    </div>
                                    <input type="text" class="form-control"  style="margin-right: 15px;"  name="price_5_7" id="info-price-rule-price5_7" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                                </div>
                                <small>Не задължителни (0.00 = Запитване) </small>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">8-15 дни</span>
                                    </div>
                                    <input type="text" class="form-control"  style="margin-right: 15px;" name="price_8_15" id="info-price-rule-price8_15" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text" name="price1" id="inputGroup-sizing-default">16-30 дни</span>
                                    </div>
                                    <input type="text" class="form-control"  style="margin-right: 15px;" name="price_16_30" id="info-price-rule-price16_30" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">31+ дни</span>
                                    </div>
                                    <input type="text" class="form-control"  style="margin-right: 15px;"  name="price_31" id="info-price-rule-price31" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">weekend</span>
                                    </div>
                                    <input type="text" class="form-control"  style="margin-right: 15px;"  name="price_weekend" id="info-price-rule-price_weekend" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                                </div>

                                {{--<label><div class="circle-green"></div></label>--}}
                                {{--<label>Цената е с активирано правило</label>--}}
                            </fieldset>
                        </section>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text custom-input-group-text"  id="inputGroup-sizing-default"> {{  __('language.discount') }}</span>
                            </div>
                            <input type="number" class="form-control"  name="discount" id="info-price-rule-discount" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                            <div class="input-group-append">
                                        <span class="fa fa-percent input-group-text picker-icon"
                                              aria-hidden="true "></span>
                            </div>
                        </div>


                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">{{ __('language.gear')}}</span>
                            </div>
                            <input type="text" class="form-control" id="info-gear" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">Статус</span>
                            </div>
                            <input type="text" class="form-control" id="info-status" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default">Брой коли</span>
                            </div>
                            <input type="text" class="form-control" id="info-used" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    </div>
                    {!! Form::close() !!}

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

    <style>
        .col-1 {
            flex-grow: 1 !important;
        }

    </style>

@endsection

