@extends('admin.home')

@section('content')
    @include('admin.menu')
    <div class="content">

        <div class="admin-main">
            <div class="creat-admin">
                <div class="back" style=" float: right; margin-top: -27px; margin-right: 3px;">
                    <a href='{{ route('admin.dashboard') }}'>{{  __('language.back')}}</a>
                </div>
            </div>
            <div class="block-country-new">
                <div class="col-md-6 col-md-offset-4" style="margin-left: 1%">
                    <button type="submit" class="btn btn-primary" id="create-carextra">
                        {{  __('language.new')}} {{  __('language.extra')}}
                    </button>
                </div>
                <div class="inactive-countries-checkbox" style="margin-left: 3%; margin-top: 20px;">
                    <label class="container-checkbox">{{  __('language.inactive')}} {{  __('language.extras')}}
                        <input id="inActiveCarExtras"
                               type="checkbox" {{($data['allExtras'] == true)? 'checked=checked' :''}}>
                        <span class="checkmark-checkbox"></span>
                    </label>

                </div>
            </div>

            <div class="test">
                <h2>{{ __('language.extras') }}</h2>
                <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-1">#</div>
                        <div class="col col-1">{{ __('language.extra')}}</div>
                        <div class="col col-1">{{ __('language.status')}}</div>
                        <div class="col col-3">{{ __('language.action')}}</div>
                    </li>
                    <?php $index = 0; ?>
                    @foreach ($data['extras'] as $extra)
                        <?php $index++; ?>
                        <li class="table-row item_{{$index}}"
                            style=" {{($extra->isActive == 0)? 'background-color: #ff9e9efc':  ''}}">
                            <div class="col col-1 cell iteration" data-label="#">{{$index}}</div>
                            <div class="col col-1 cell name" data-content="{{$extra->id}}"
                                 data-label="{{ __('language.name')}}">{{$extra->ExtraName}}</div>
                            @if($extra->isActive == 1)
                                <div class="col col-1 cell status"
                                     data-content="{{$extra->isActive}}" data-label="{{ __('language.status')}}">{{ __('language.active') }}</div>
                            @else
                                <div class="col col-1 cell status"
                                     data-content="{{$extra->isActive}}" data-label="{{ __('language.status')}}">{{ __('language.inactive') }}</div>
                            @endif

                            <div class="col col-3 cell">
                                <button type="button" class="btn btn-info responsive-btn-left" id="edit-carextra"
                                        data-item-id="{{$extra->id}}">
                                    <i class="fa fa-edit"></i> {{ __('language.edit') }}
                                </button>
                                {{--<button type="button" class="btn btn-info responsive-btn-right" id="delete-carextra"--}}
                                        {{--data-item-id="{{$extra->id}}">--}}
                                    {{--<i class="fa fa-trash"></i> {{ __('language.delete') }}--}}
                                {{--</button>--}}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="modal fade" id="create-modal-carextra">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="tt" style="width: 80%;">
                            <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>{{  __('language.new')}} {{  __('language.extra')}}</b></h4>
                        </div>
                        <div class="ti" style="width: 20%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['method' => 'post', 'route' => 'admin.cars-settings.add-carextra', 'id'=>'createCarExtraForm']) !!}
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
                                        <label for="modal-input-name-{{$app_language->iso}}">{{  __('language.extra') }}-{{$app_language->iso}}</label>
                                        <input type="text" class="form-control" name="name_{{$app_language->iso}}" id="name-carextra-{{$app_language->iso}}"
                                               placeholder="{{  __('language.extra')}}-{{$app_language->iso}}">
                                        <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name_'. $lang)) has-error @endif"></span>
                                        @if ($errors->has('name_'. $lang)) <p
                                                class="help-block">{{ $errors->first('name_'. $lang) }}</p> @endif
                                        <div id="name_{{$app_language->iso}}_error" class="help-text"></div>
                                    </div>
                                @endforeach
                            @else
                                <div id="name-group"
                                     class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                                    <label for="modal-input-name">{{  __('language.extra') }}</label>
                                    <input type="text" class="form-control" name="name-bg" id="name-carextra"
                                           placeholder="{{  __('language.fuel')}}">
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

        <div class="modal fade" id="edit-modal-carextra">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="tt" style="width: 80%;">
                            <h4 class="modal-title" align="center" style="margin-left: 24%;"><b>{{  __('language.edit')}} {{  __('language.extra')}}</b></h4>
                        </div>
                        <div class="ti" style="width: 20%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['method' => 'post', 'route' => 'admin.cars-settings.edit-carextra', 'id'=>'editCarExtraForm']) !!}
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        @if(Session::has('error'))
                            <div class="alert-box success">
                                <h2>{{ Session::get('error') }}</h2>
                            </div>
                        @endif
                        <div class="box-body">
                            @if($data['app_languages'])
                                <input type="hidden" class="form-control" name="carextra_id" id="carextra-id-edit" placeholder="Fleet ID" >
                                @foreach ($data['app_languages'] as $app_language)
                                    <?php $lang = $app_language->iso; ?>
                                    <div id="name_{{$app_language->iso}}-group"
                                         class="form-group has-feedback @if ($errors->has('name_'. $lang)) has-error @endif">
                                        <label for="modal-input-name-{{$app_language->iso}}">{{  __('language.extra') }}-{{$app_language->iso}}</label>
                                        <input type="text" class="form-control" name="name_{{$app_language->iso}}" id="name-carextra-{{$app_language->iso}}-edit"
                                               placeholder="{{  __('language.extra')}}-{{$app_language->iso}}">
                                        <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name_'. $lang)) has-error @endif"></span>
                                        @if ($errors->has('name_'. $lang)) <p
                                                class="help-block">{{ $errors->first('name_'. $lang) }}</p> @endif
                                        <div id="name_{{$app_language->iso}}_error" class="help-text"></div>
                                    </div>
                                @endforeach
                            @else
                                <div id="name-group"
                                     class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                                    <label for="modal-input-name">{{  __('language.extra') }}</label>
                                    <input type="text" class="form-control" name="name-bg" id="name-carextra-edit"
                                           placeholder="{{  __('language.extra')}}">
                                    <span class="glyphicon glyphicon-lock form-control-feedback @if ($errors->has('name')) has-error @endif"></span>
                                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                                    <div id="name_error" class="help-text"></div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select type="text" class="form-control" name="status" id="status-edit-carextra" >
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
    </div>
@endsection
